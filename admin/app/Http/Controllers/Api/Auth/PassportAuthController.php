<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PassportAuthController extends Controller
{
    protected $user, $baseController, $profileImagePath;
    public function __construct(User $user, BaseController $baseController)
    {
        $this->user = $user;
        $this->baseController = $baseController;
        $this->profileImagePath = config('constants.userPath');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'     => 'required|email',
            'password'  => 'required',
        ]);

        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $credentials = request(['email', 'password']);
        if(!Auth::attempt($credentials)){
            return response()->json(['message' => 'Invalid credentials. Please try again.'], 401);
        }
        $http = new \GuzzleHttp\Client;
        try{
            $response = $http->post(url('').config('services.passport.login_endpoint'),[
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => config('services.passport.client_id'),
                    'client_secret' => config('services.passport.client_secret'),
                    'username' => $request->email,
                    'password' => $request->password,
                ]
            ]);

            //fetch user
            $user = $this->user::where('email', $request->email)->first();

            //get response in accessible format
            $content = $response->getBody()->__toString();
            $data = json_decode($content, true);

            return [
                'access_token'  => $data['access_token'],
                'refresh_token' => $data['refresh_token'],
                'expires_in'    => date("Y-m-d H:i:s", strtotime('+'.($data['expires_in']/60/60).' hours', strtotime(now()))),
                'token_type'    => $data['token_type'],
                'name'          => $user->name,
                'email'         => $user->email,
                'phone_no'      => $user->phone_no,
                'user_id'       => $user->id,
            ];
        } catch(\GuzzleHttp\Exception\BadResponseException $e) { return $e;
            if($e->getCode() == 400) {
                return response()->json(['message' => 'Invalid request. Please enter a username or a password'], $e->getCode());
            }else if ($e->getCode() == 401){
                return response()->json(['message' => 'Invalid credentials. Please try again.'], $e->getCode());
            }
            return response()->json(['message' => 'Something went wrong on the server.'], $e->getCode());
        }
    }

    public function logout(Request $request) {
        Auth::user()->tokens->each(function($token, $key){
            $token->delete();
        });

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function profile(Request $request){
        $user = $this->user::select('id','name','email','phone_no','image')
            ->findOrFail($request->user()->id);

        return $user;
    }

    public function register(Request $request){
        $request->validate([
            'name'      => 'required|max:50',
            'email'     => 'required|email|max:50|unique:users,email,NULL,id,deleted_at,NULL',
            'password'  => 'required|max:50|min:8',
            'confirm_password'  => 'required|same:password|max:50|min:8',
            'phone_no'  => 'nullable|digits:10|unique:users,phone_no,NULL,id,deleted_at,NULL',
        ]);

        $user = $this->user->create([
            'name'      => $request['name'],
            'email'     => $request['email'],
            'password'  => $request['password'],
            'phone_no'  => $request['phone_no'],
        ]);

        return response()->json(['message'   => 'Successfully registered']);
    }

    public function updatePassword(Request $request){
        $request->validate([
            'old_password'      => 'required',
            'new_password'      => 'required|max:50|min:8',
            'confirm_password'  => 'required|same:new_password',
        ]);
        if (Hash::check($request->old_password, $request->user()->password)) {
            User::findOrFail($request->user()->id)->update([
                'password' => Hash::make($request->new_password),
            ]);
            return response(['message' => 'Password updated successfully.'], 200);
        }else {
            return response(['message' => 'Old password is not correct.'], 409);
        }
    }

    public function updateProfile(Request $request){
        $user = Auth::user();
        $request->validate([
            'name'          => 'required|max:50',
            'email'         => 'required|email|unique:users,email,'.$user->id.',id,deleted_at,NULL',
            'phone_no'      => 'digits:10|unique:users,phone_no,'.$user->id.',id,deleted_at,NULL',
            'image'         => 'sometimes|mimes:jpeg,jpg,png',
        ]);

        $current_profile_picture = $user->image;
        if(($request->image != '') && ($request->image != $current_profile_picture)){
            $fileName = $this->baseController->saveImageFile(public_path($this->profileImagePath),"profile",$request->image);
            $this->baseController->deleteImageFile(public_path($this->profileImagePath), $current_profile_picture);
        }
        else if(isset($request->image) && $current_profile_picture != ""){
            $this->baseController->deleteImageFile(public_path($this->profileImagePath),$current_profile_picture);
            $fileName = '';
        }
        else{
            $fileName = $user->image;
        }
        $this->user::findOrFail($user->id)->update([
            'name'      => $request->name,
            'email'     => $request->email,
            'phone_no'  => $request->phone_no,
            'image'     => $fileName,
        ]);
        $user = [
            'id'        => $user->id,
            'name'      => $request->name,
            'email'     => $request->email,
            'phone_no'  => $request->phone_no,
            'image'     => $fileName,
        ];
        return response(['message' => 'Profile updated successfully.', 'user' => $user],200);
    }
}

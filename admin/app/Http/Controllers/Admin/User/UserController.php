<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    protected $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()):
            $users = $this->user::where('is_admin','!=','1')->get();
            return Datatables($users)->make(true);
        else:
            return view('user.index');
        endif;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->user::findOrFail($id);
        if($user):
            if($user->campaigns()->count() > 0):
                return response()->json(['message' => 'User cannot be delete because it has campaigns'],409);
            else:
                $user->delete();
                return response()->json(['message' => 'User deleted successfully'],200);
            endif;
        else:
            return response()->json(['message' => 'User not found'],404);
        endif;
    }

    public function updateStatus(Request $request, $id){
        $user = $this->user::findOrFail($id);
        if($user):
            $user->update(['is_active' => $request->is_active]);
            return response()->json(['status' => Response::$statusTexts[Response::HTTP_OK],'status_code' => Response::HTTP_OK],200);
        else:
            return response()->json(['status' => Response::$statusTexts[Response::HTTP_NOT_FOUND],'status_code' => Response::HTTP_NOT_FOUND],404);
        endif;
    }
}

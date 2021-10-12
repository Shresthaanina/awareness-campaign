<?php

namespace App\Http\Controllers\Admin\Banner;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class BannerController extends Controller
{
    protected $banner, $baseController, $bannerImagePath;
    public function __construct(Banner $banner, BaseController $baseController)
    {
        $this->banner = $banner;
        $this->baseController = $baseController;
        $this->bannerImagePath = config('constants.bannerPath');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()):
            $banners = $this->banner::get();
            return Datatables($banners)->make(true);
        else:
            return view('banner.index');
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
        $request->validate([
            'title'         => 'max:75',
            'excerpt'       => 'max:150',
            'button_text'   => 'max:25',
            'button_link'   => 'max:100',
            'image'         => 'required|mimes:jpeg,jpg,png',
        ]);

        DB::transaction(function() use ($request){
            $data = $request->except("_token");
            $data['is_active'] = 1;

            if(isset($data['image']) && $data['image'] != ''){
                $fileName = $this->baseController->saveGeneralFile(public_path($this->bannerImagePath),'banner',$data['image']);
            }else {
                $fileName = NULL;
            }
            $data['image'] = $fileName;

            $banner = $this->banner->create($data);
        }, 3);
        return response(['message' => 'Banner added succcessfully.'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $banner = $this->banner::findOrFail($id);
        return $banner;
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
        $rules = [
            'title'         => 'max:75',
            'excerpt'       => 'max:150',
            'button_text'   => 'max:25',
            'button_link'   => 'max:100',
        ];
        if(!isset($request['prev_image'])){
            $rules[] = [
                'image'     => 'required|mimes:jpeg,jpg,png',
            ];

        }
        $request->validate($rules);

        $banner = $this->banner::findOrFail($id);
        DB::transaction(function() use ($request, &$banner){
            $data = $request->except("_token");
            $data['is_active'] = 1;

            $current_image = $banner->image;
            if(isset($data['image']) && $data['image'] != '' && ($this->data['image'] != $current_image)){
                $fileName = $this->baseController->saveGeneralFile(public_path($this->bannerImagePath),'banner',$data['image']);
                $this->baseController->deleteImageFile(public_path($this->bannerImagePath), $current_image);
            }else {
                $fileName = $current_image;
            }
            $data['image'] = $fileName;

            $banner = $this->banner->updateBanner($data, $banner->id);
        }, 3);
        return response(['message' => 'Banner updated succcessfully.'], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = $this->banner::findOrFail($id);
        if($banner):
            $this->baseController->deleteImageFile(public_path($this->bannerImagePath), $banner->image);
            $banner->delete();
            return response()->json(['message' => 'Banner deleted successfully'],200);
        else:
            return response()->json(['message' => 'Banner not found'],404);
        endif;
    }

    public function updateStatus(Request $request, $id){
        $banner = $this->banner::findOrFail($id);
        if($banner):
            $banner->update(['is_active' => $request->is_active]);
            return response()->json(['status' => Response::$statusTexts[Response::HTTP_OK],'status_code' => Response::HTTP_OK],200);
        else:
            return response()->json(['status' => Response::$statusTexts[Response::HTTP_NOT_FOUND],'status_code' => Response::HTTP_NOT_FOUND],404);
        endif;
    }
}

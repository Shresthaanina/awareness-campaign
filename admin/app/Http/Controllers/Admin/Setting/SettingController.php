<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    protected $setting, $baseController, $settingImagePath;
    public function __construct(Setting $setting, BaseController $baseController)
    {
        $this->setting = $setting;
        $this->baseController = $baseController;
        $this->settingImagePath = config('constants.settingPath');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = $this->setting::pluck('meta_value','meta_key');
        return view('setting.index', ['settings' => $settings]);
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
    public function update(Request $request)
    {
        $request->validate([
            'logo'     => 'mimes:jpg,jpeg,png,svg',
            'site_name'     => 'required|max:25',
            'site_tagline'  => 'sometimes|max:150',
        ]);

        $data = $request->except('_token','_method');

        if(isset($data['logo'])){
            $settingLogo = $this->setting::where('meta_key','logo')->firstOrFail();
            $current_image = $settingLogo->meta_value;
            if(isset($data['logo']) && $data['logo'] != '' && ($data['logo'] != $current_image) ){
                $fileName = $this->baseController->saveGeneralFile(public_path($this->settingImagePath),'setting',$data['logo']);
                $this->baseController->deleteImageFile(public_path($this->settingImagePath), $current_image);
            } else {
                $fileName = $current_image;
            }
            $data['logo'] = $fileName;
        }

        foreach($data as $key => $val){
            $this->setting::where('meta_key', $key)->update(['meta_value' => $val]);
        }
        toast('Setting data updated successfully.','success');
        return redirect()->route('settings.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

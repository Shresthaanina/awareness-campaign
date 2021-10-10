<?php

namespace App\Http\Controllers\Api\Campaign;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Http\Response as Res;
use Illuminate\Support\Facades\DB;

class CampaignController extends Controller
{
    protected $campaign, $campaignImagePath, $baseController;
    public function __construct(Campaign $campaign, BaseController $baseController)
    {
        $this->campaign = $campaign;
        $this->baseController = $baseController;
        $this->campaignImagePath = config('constants.campaignPath');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campaigns = $this->campaign::with('createdBy')
                                    ->select('id','slug','name','image','excerpt','start_date','created_by')
                                    ->where('is_published','1')
                                    ->orderBy('created_at','desc')
                                    ->get();
        return $campaigns;
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
            'name'         => 'required|max:200',
            'excerpt'      => 'max:250',
            'location'     => 'max:200',
            'image'        => 'sometimes|mimes:jpg,jpeg,png',
        ]);

        DB::transaction(function() use ($request){
            $this->data = $request->except('_token');

            if(isset($this->data['image']) && $this->data['image'] != ''){
                $fileName = $this->baseController->saveImageFile(public_path($this->campaignImagePath),'campaign',$this->data['image']);
            }else {
                $fileName = NULL;
            }
            $this->data['image'] = $fileName;
            $campaign = $this->campaign->create($this->data);
        }, 3);

        return response(['message' => 'Campaign created succcessfully.'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $campaign = $this->campaign::with('createdBy')->where('slug', $slug)
                                    ->where('is_published','1')
                                    ->firstOrFail();
        return $campaign;
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
        $request->validate([
            'name'         => 'required|max:200',
            'excerpt'      => 'max:250',
            'location'     => 'max:200',
            'image'        => 'sometimes|mimes:jpg,jpeg,png',
        ]);

        $campaign = $this->campaign::findOrFail($id);
        DB::transaction(function() use ($request, &$campaign){
            $this->data = $request->except('_token');

            $current_image = $campaign->image;
            if(isset($this->data['image']) && $this->data['image'] != '' && ($this->data['image'] != $current_image) ){
                $fileName = $this->baseController->saveImageFile(public_path($this->campaignImagePath),'campaign',$this->data['image']);
                $this->baseController->deleteImageFile(public_path($this->campaignImagePath), $current_image);
            } else {
                $fileName = $current_image;
            }
            $this->data['image'] = $fileName;

            $campaign->updateCampaign($this->data, $campaign->id);
        }, 3);

        return response(['message' => 'Campaign updated successfully.'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $campaign = $this->campaign::findOrFail($id);
        if($campaign){
            $this->baseController->deleteImageFile(public_path($this->campaignImagePath),$campaign->image);
            $campaign->delete();
            return response()->json(['status' => Res::$statusTexts[Res::HTTP_OK], 'status_code' => Res::HTTP_OK], 200);
        }else {
            return response()->json(['status' => Res::$statusTexts[Res::HTTP_NOT_FOUND],'status_code' => Res::HTTP_NOT_FOUND],404);
        }
    }
}

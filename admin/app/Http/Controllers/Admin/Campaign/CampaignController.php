<?php

namespace App\Http\Controllers\Admin\Campaign;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CampaignController extends Controller
{
    protected $campaign;
    public function __construct(Campaign $campaign)
    {
        $this->campaign = $campaign;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()):
            $campaigns = $this->campaign::with('createdBy','participants')->withCount('participants')->get();
            return Datatables($campaigns)->make(true);
        else:
            return view('campaign.index');
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

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $campaign = $this->campaign::findOrFail($id);
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
        if($campaign):
            $campaign->delete();
            return response()->json(['message' => 'Campaign deleted successfully'],200);
        else:
            return response()->json(['message' => 'Campaign not found'],404);
        endif;
    }

    public function updateStatus(Request $request, $id){
        $campaign = $this->campaign::findOrFail($id);
        if($campaign):
            $campaign->update(['is_active' => $request->is_active]);
            return response()->json(['status' => Response::$statusTexts[Response::HTTP_OK],'status_code' => Response::HTTP_OK],200);
        else:
            return response()->json(['status' => Response::$statusTexts[Response::HTTP_NOT_FOUND],'status_code' => Response::HTTP_NOT_FOUND],404);
        endif;
    }
}

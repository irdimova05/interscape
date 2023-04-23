<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportAdStoreRequest;
use App\Models\Ad;
use App\Models\ReportedAd;
use App\Services\ReportedAdService;
use Illuminate\Http\Request;

class ReportedAdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reportedAds = ReportedAdService::getReportedAds();
        return view('reported-ads.index', compact('reportedAds'));
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
     * @param  \Illuminate\Http\ReportAdStoreRequest  $reportAdStoreRequest
     * @return \Illuminate\Http\Response
     */
    public function store(ReportAdStoreRequest $reportAdStoreRequest, Ad $ad)
    {
        ReportedAdService::reportAd($ad->id, $reportAdStoreRequest->reason);
        return redirect()->route('ads.show', compact('ad'));
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
     * @param  Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ad $ad)
    {
        ReportedAdService::releaseAd($ad);
        return redirect()->route('reported-ads.index');
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

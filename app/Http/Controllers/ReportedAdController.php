<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportedAd\ReportedAdIndexRequest;
use App\Http\Requests\ReportedAd\ReportedAdStoreRequest;
use App\Http\Requests\ReportedAd\ReportedAdUpdateRequest;
use App\Models\Ad;
use App\Services\ReportedAdService;

class ReportedAdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ReportedAdIndexRequest $request)
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
    public function store(ReportedAdStoreRequest $reportAdStoreRequest, Ad $ad)
    {
        ReportedAdService::reportAd($ad->id, $reportAdStoreRequest->reason);
        return redirect()->route('ads.show', compact('ad'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function update(ReportedAdUpdateRequest $request, Ad $ad)
    {
        ReportedAdService::releaseAd($ad);
        return redirect()->route('reported-ads.index');
    }
}

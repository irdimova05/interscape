<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportedAd\ReportedAdIndexRequest;
use App\Http\Requests\ReportedAd\ReportedAdStoreRequest;
use App\Http\Requests\ReportedAd\ReportedAdUpdateRequest;
use App\Models\Ad;
use App\Services\MessageService;
use App\Services\ReportedAdService;
use DB;

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
        try {
            DB::beginTransaction();
            ReportedAdService::reportAd($ad->id, $reportAdStoreRequest->reason);
            DB::commit();
            MessageService::success('Успешно докладвахте обявата!');
            return redirect()->route('ads.show', compact('ad'));
        } catch (\Exception $e) {
            DB::rollBack();
            MessageService::error('Възникна грешка при докладването на обявата!');
            return redirect()->back();
        }
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
        try {
            DB::beginTransaction();
            ReportedAdService::releaseAd($ad);
            DB::commit();
            MessageService::success('Успешно освободихте обявата!');
            return redirect()->route('reported-ads.index');
        } catch (\Exception $e) {
            DB::rollBack();
            MessageService::error('Възникна грешка при освобождаването на обявата!');
            return redirect()->back();
        }
    }
}

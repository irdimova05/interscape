<?php

namespace App\Http\Controllers;

use App\Http\Requests\Ad\AdApplyRequest;
use App\Http\Requests\Ad\AdCreateRequest;
use App\Http\Requests\Ad\AdEditRequest;
use App\Http\Requests\Ad\AdIndexRequest;
use App\Http\Requests\Ad\AdSearchRequest;
use App\Http\Requests\Ad\AdShowRequest;
use App\Http\Requests\Ad\AdStatusRequest;
use App\Http\Requests\Ad\AdStoreRequest;
use App\Http\Requests\Ad\AdUpdateRequest;
use App\Models\Ad;
use App\Models\AdCategory;
use App\Models\AdStatus;
use App\Models\JobType;
use App\Services\AdService;
use App\Services\MessageService;
use App\Services\ReportedAdService;
use DB;
use Illuminate\Http\Request;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AdIndexRequest $request)
    {
        $ads = AdService::getAds();

        return view('ads.index', compact('ads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param AdCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function create(AdCreateRequest $request)
    {
        $categories = AdCategory::get()->pluck('name', 'id')->toArray();
        $jobTypes = JobType::get()->pluck('name', 'id')->toArray();
        return view('ads.create', compact('categories', 'jobTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AdStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $ad = AdService::createAd($request->all());
            DB::commit();
            MessageService::success('Обявата е създадена успешно!');
            return redirect()->route('ads.show', $ad->id);
        } catch (\Exception $e) {
            DB::rollBack();
            MessageService::error('Възникна грешка при създаването на обявата!');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function show(AdShowRequest $request, Ad $ad)
    {
        $reports = ReportedAdService::getReportedAdsReasons($ad);
        return view('ads.show', compact('ad', 'reports'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function edit(AdEditRequest $request, Ad $ad)
    {
        $categories = AdCategory::get()->pluck('name', 'id')->toArray();
        $jobTypes = JobType::get()->pluck('name', 'id')->toArray();
        return view('ads.edit', compact('ad', 'categories', 'jobTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AdUpdateRequest  $request
     * @param  Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function update(AdUpdateRequest $request, Ad $ad)
    {
        AdService::updateAd($ad, $request->all());
        return redirect()->route('ads.show', $ad->id);
    }

    public function search(AdSearchRequest $request)
    {
        $ads = AdService::getAds(function ($query) use ($request) {
            return AdService::applySearch($query, $request->get('q'));
        });
        return view('ads.components.ads', compact('ads'));
    }

    public function status(AdStatusRequest $request, Ad $ad)
    {
        $adStatus = AdStatus::where('slug', $request->get('status'))->firstOrFail()->id;
        AdService::updateStatus($ad, $adStatus);
        return redirect()->back();
    }
}

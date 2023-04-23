<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdCreateRequest;
use App\Http\Requests\AdStoreRequest;
use App\Http\Requests\AdUpdateRequest;
use App\Http\Requests\ReportAdStoreRequest;
use App\Models\Ad;
use App\Models\AdCategory;
use App\Models\AdStatus;
use App\Models\JobType;
use App\Services\AdService;
use App\Services\ReportedAdService;
use Illuminate\Http\Request;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        $ad = AdService::createAd($request->all());
        return redirect()->route('ads.show', $ad->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function show(Ad $ad)
    {
        $reports = $ad->reportedAds;
        return view('ads.show', compact('ad', 'reports'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function edit(Ad $ad)
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

    public function search(Request $request)
    {
        $ads = AdService::getAds(function ($query) use ($request) {
            return AdService::applySearch($query, $request->get('q'));
        });
        return view('ads.components.ads', compact('ads'));
    }

    public function apply(Ad $ad)
    {
        return view('ads.apply', compact('ad'));
    }

    public function status(Request $request, Ad $ad)
    {
        $adStatus = AdStatus::where('slug', $request->get('status'))->firstOrFail()->id;
        AdService::updateStatus($ad, $adStatus);
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdStoreRequest;
use App\Http\Requests\AdUpdateRequest;
use App\Models\Ad;
use App\Models\AdCategory;
use App\Models\JobType;
use App\Services\AdService;
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
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        return view('ads.show', compact('ad'));
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
}

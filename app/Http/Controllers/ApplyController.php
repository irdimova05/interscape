<?php

namespace App\Http\Controllers;

use App\Http\Requests\Apply\ApplyAdsFilterRequest;
use App\Http\Requests\Apply\ApplyCreateRequest;
use App\Http\Requests\Apply\ApplyIndexRequest;
use App\Http\Requests\Apply\ApplyShowRequest;
use App\Http\Requests\Apply\ApplyStoreRequest;
use App\Models\Ad;
use App\Models\Apply;
use App\Services\ApplyService;

class ApplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ApplyIndexRequest $request)
    {
        $applies = ApplyService::getApplies();
        $ads = ApplyService::getAdsNames();
        return view('applies.index', compact('applies', 'ads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ApplyCreateRequest $request, Ad $ad)
    {
        return view('ads.apply', compact('ad'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ApplyStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApplyStoreRequest $request)
    {
        $id = $request->ad_id;
        ApplyService::createApply($request, $id);
        return redirect()->route('ads.show', $id);
    }

    /**
     * Display the specified resource.
     *
     * @param  Apply  $apply
     * @return \Illuminate\Http\Response
     */
    public function show(ApplyShowRequest $request, Apply $apply)
    {
        ApplyService::loadApply($apply);
        return view('applies.show', compact('apply'));
    }

    public function adsFilter(ApplyAdsFilterRequest $request)
    {
        $applies = ApplyService::getApplies(function ($query) use ($request) {
            if (!$request->adId) {
                return $query;
            }
            return $query->whereHas('ad', function ($query) use ($request) {
                $query->where('id', $request->adId);
            });
        });

        return view('applies.components.applies_results', compact('applies'));
    }
}

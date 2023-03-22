<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplyStoreRequest;
use App\Models\Ad;
use App\Models\Apply;
use App\Services\AdService;
use App\Services\ApplyService;
use Illuminate\Http\Request;

class ApplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
    public function create(Ad $ad)
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
     * @param  Apply  $applies
     * @return \Illuminate\Http\Response
     */
    public function show(Apply $applies)
    {
        return view('applies.show', compact('applies'));
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
        //
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

    public function adsFilter(Request $request)
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

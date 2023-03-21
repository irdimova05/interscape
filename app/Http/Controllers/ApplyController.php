<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplyStoreRequest;
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
        return view('applies.index', compact('applies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        ApplyService::createApply($request->all());
        $ad = AdService::getAds();
        return redirect()->route('ads.show', $ad->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('applies.show', compact('apply'));
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
}

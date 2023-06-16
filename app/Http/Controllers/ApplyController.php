<?php

namespace App\Http\Controllers;

use App\Http\Requests\Apply\ApplyAdsFilterRequest;
use App\Http\Requests\Apply\ApplyApproveRequest;
use App\Http\Requests\Apply\ApplyCreateRequest;
use App\Http\Requests\Apply\ApplyIndexRequest;
use App\Http\Requests\Apply\ApplyRejectRequest;
use App\Http\Requests\Apply\ApplyShowRequest;
use App\Http\Requests\Apply\ApplyStoreRequest;
use App\Models\Ad;
use App\Models\Apply;
use App\Services\ApplyService;
use App\Services\MessageService;
use DB;

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
        try {
            DB::beginTransaction();
            $id = $request->ad_id;
            ApplyService::createApply($request, $id);
            DB::commit();
            MessageService::success('Успешно изпратихте кандидатура!');
            return redirect()->route('ads.show', $id);
        } catch (\Exception $e) {
            DB::rollBack();
            MessageService::error('Възникна грешка при изпращането на кандидатура!');
            return redirect()->back();
        }
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

    public function approve(ApplyApproveRequest $request, Apply $apply)
    {
        try {
            DB::beginTransaction();
            ApplyService::approveApply($apply);
            DB::commit();
            MessageService::success('Успешно одобрихте кандидатура!');
            return redirect()->route('applies.index');
        } catch (\Exception $e) {
            DB::rollBack();
            MessageService::error('Възникна грешка при одобряването на кандидатура!');
            return redirect()->back();
        }
    }

    public function reject(ApplyRejectRequest $request, Apply $apply)
    {
        try {
            DB::beginTransaction();
            ApplyService::rejectApply($apply);
            DB::commit();
            MessageService::success('Успешно отхвърлихте кандидатура!');
            return redirect()->route('applies.index');
        } catch (\Exception $e) {
            DB::rollBack();
            MessageService::error('Възникна грешка при отхвърлянето на кандидатура!');
            return redirect()->back();
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\Interests\InterestsIndexRequest;
use App\Http\Requests\Interests\InterestsStoreRequest;
use App\Services\InterestService;
use App\Services\MessageService;
use DB;
use Illuminate\Http\Request;

class InterestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(InterestsIndexRequest $request)
    {
        $interests = InterestService::getInterests();

        /** @var User $user */
        $user = auth()->user();
        if ($user->isEmployer()) {
            return view('interests.employers', compact('interests'));
        } else if ($user->isStudent()) {
            return view('interests.students', compact('interests'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InterestsStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            InterestService::createInterest($request);
            DB::commit();
            MessageService::success('Успешно проявихте интерес към този потребител!');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            MessageService::error('Възникна грешка при проявяването на интерес към този потребител!');
            return redirect()->back();
        }
    }
}

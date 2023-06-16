<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileCompleteRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Course;
use App\Models\EmployeeRanges;
use App\Models\Specialty;
use App\Models\Status;
use App\Models\User;
use App\Services\MessageService;
use App\Services\UserService;
use DB;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        $view = view('profile.edit', compact('user'));
        if ($user->isStudent()) {
            $user->load('student');
            $view->with('specialty', Specialty::pluck('name', 'id')->toArray())
                ->with('course', Course::pluck('name', 'id')->toArray());
        } else if ($user->isEmployer()) {
            $user->load('employer');
            $view->with('employeeRanges', EmployeeRanges::pluck('range', 'id')->toArray());
        }

        return $view;
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileCompleteRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $user = $request->user();

            $user->name = $request->name;
            $user->email = $request->email;
            $photoPath = Storage::url(Storage::disk('public')->putFile('profile_pictures', $request->file('photo')));

            if ($user->isStudent()) {
                $user->student->specialty_id = $request->specialty;
                $user->student->course_id = $request->course;
                $user->student->success = $request->success;
                $user->student->description = $request->description;
                $user->student->save();
            }

            if ($user->isEmployer()) {
                $user->employer->name = $request->name;
                $user->employer->description = $request->description;
                $user->employer->email = $request->email;
                $user->employer->phone = $request->phone;
                $user->employer->address = $request->address;
                $user->employer->website = $request->website;
                $user->employer->logo = $photoPath;
                $user->employer->employee_range_id = $request->employee_range;
                $user->employer->save();
            } else {
                $user->profile_picture = $photoPath;
            }

            $user->is_profile_completed = true;
            $user->status_id = Status::where('slug', Status::ACTIVE)->first()->id;

            $user->save();

            MessageService::success('Успешно завършихте профила си.');
            DB::commit();
            return Redirect::route('profile.edit')->with('status', 'profile-updated');
        } catch (\Exception $e) {
            DB::rollBack();
            MessageService::error('Възникна грешка при завършването на профила ви.');
            return Redirect::route('profile.edit')->with('status', 'profile-updated');
        }
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}

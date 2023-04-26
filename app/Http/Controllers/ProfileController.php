<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Course;
use App\Models\EmployeeRanges;
use App\Models\Specialty;
use App\Models\User;
use App\Services\UserService;
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
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        $user->name = $request->name;
        $user->email = $request->email;

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
            $photoPath = $request->photo->storePublicly('public/profiles');
            $user->employer->logo = Storage::url($photoPath);
            $user->employer->employee_ranges_id = $request->employee_ranges;
            $user->employer->save();
        } else {
            $photoPath = $request->photo->storePublicly('public/profiles');
            $user->profile_picture = Storage::url($photoPath);
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class FollowController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }
    public function store(User $user) {
        // return auth()->user()->following()->toggle($user->profile);

        $profile = $user->profile;
        $followerCount = $profile->followers->count();

        if (auth()->user()->following->contains($profile)) {
            auth()->user()->following()->detach($profile);
            $followerCount--;
        } else {
            auth()->user()->following()->attach($profile);
            $followerCount++;
        }

        return response()->json([
            'followerCount' => $followerCount
        ]);
    }
}

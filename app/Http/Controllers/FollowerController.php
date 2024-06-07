<?php

namespace App\Http\Controllers;

use App\Events\FollowerEvent;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class FollowerController extends Controller
{
    public function follow(User $user){

        $follower = auth()->user();

        $follower->followings()->attach($user);
        // $followedUser = user::find(auth()->user()->id);
        $followedUser = User::find($user->id);

        event(new FollowerEvent($follower, $followedUser));

        Alert::success('Success','You followed '. $user->name );

        return redirect()->route('users.show',$user->id);
    }

    public function unfollow(User $user){

        $follower = auth()->user();

        $follower->followings()->detach($user);

        Alert::success('Success','You unfollowed '. $user->name );

        return redirect()->route('users.show',$user->id);
    }
}

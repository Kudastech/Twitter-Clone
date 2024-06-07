<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class IdeaLikeController extends Controller
{
    public function like(Idea $idea){

        // $liker = auth()->user();

        // $liker->likes()->attach($idea);

        // the above two lines of code is thesame as the below code

        auth()->user()->likes()->attach($idea);

        Alert::success('Success','You like ' .$idea->user->name. ' Idea' );

        return redirect()->route('dashboard');
    }

    public function unlike(Idea $idea){

        // $liker = auth()->user();

        // $liker->likes()->detach($idea);

        // the above two lines of code is thesame as the below code

        auth()->user()->likes()->detach($idea);

        Alert::success('Success','You unlike ' .$idea->user->name. ' Idea' );

        return redirect()->route('dashboard');
    }
}

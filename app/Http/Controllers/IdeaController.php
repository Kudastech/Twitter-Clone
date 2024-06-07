<?php

namespace App\Http\Controllers;

use App\Events\DiscussionShared;
use App\Http\Requests\CreateIdeaRequest;
use App\Http\Requests\UpdateIdeaRequest;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class IdeaController extends Controller
{

    public function show(Idea $idea)
    {
        return view('ideas.show', compact('idea'));
    }

    public function store(CreateIdeaRequest $request)
    {
        $validated = $request->validated();

        $validated['user_id'] = auth()->id();

        $idea = Idea::create($validated);

        event(new DiscussionShared($idea));

        Alert::success('Success','Idea created successfully !' );

        return redirect()->route('dashboard');
    }

    public function destroy(Idea $idea)
    {
        //Another means of authorization

        // if(auth()->id() !== $idea->user_id)
        // {
        //     abort(404);
        // }
        $this->authorize('delete', $idea);

        $idea->delete();

        Alert::warning('Success','Idea deleted successfully !' );

        return redirect()->route('dashboard');
    }

    public function edit(Idea $idea)
    {
        $this->authorize('update', $idea);

        $editing = true;

        return view('ideas.show', compact('idea', 'editing'));
    }

    public function update(UpdateIdeaRequest $request, Idea $idea)
    {
        $this->authorize('update', $idea);

        $validated = $request->validated();

        $idea->update($validated);

        Alert::success('Success','Idea updated successfully !' );

        return redirect()->route('ideas.show', $idea->id);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIdeaRequest;
use App\Models\Idea;
use App\Notifications\IdeaPublished;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use function view;

class IdeaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        //dd('hello');

        // users can see their own ideas (Assigned to their user id)
        // $ideas = Idea::query()->where([
        //     'user_id' => Auth::id(),
        // ])->get();

        // users can see their own ideas via the User model's ideas() relationship
        // $ideas = Auth::user()->ideas;

        return view('ideas.index', [
            'ideas' => Auth::user()->ideas,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ideas.create');
    }

    /**
     * Store a newly created resource in storage.
     * --user submitting form--
     */
    public function store(StoreIdeaRequest $request)
    {
        // if validation fails, go back to form.
        // $request->validate([
        //     'description' => ['required', 'min:10'],
        // ]);

        // if we reach this point, validation success

          $idea = Auth::user()->ideas()->create([
            'description' => request('description'),
            'state' => 'Pending',
        ]);

        // notify the user - notifications
        Auth::user()->notify(new IdeaPublished($idea));

        return redirect('/ideas');
    }

    /**
     * Display the specified resource.
     */
    public function show(Idea $idea)
    {
        Gate::authorize('view', $idea);

        // referring to can method on current user
        // if user cannot update the idea, not authorised
        // if (Auth::user()->cannot('update', $idea)) {
        //     dd('not authorised');
        // }

        return view('ideas.show', [
        'idea' => $idea
    ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Idea $idea)
    {
        // user can only edit it if they were the one that created it
        Gate::authorize('update', $idea);

        return view('ideas.edit', [
            'idea' => $idea
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Idea $idea)
    {
        // letting the user update if they were the one that created it in the first place
        Gate::authorize('update', $idea);

        $idea->update([
        'description' => request('description'),
    ]);

    return redirect("/ideas/{$idea->id}");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Idea $idea)
    {
        Gate::authorize('delete', $idea);

        $idea->delete();

        return redirect('/ideas');
    }
}

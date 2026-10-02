<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\SessionsController;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/about', function () {
//     return view('about');
// });

// Route::get('/contact', function () {
//     return view('contact');
// });

// passing through array where each key represents a variable - this will be extracted into a variable in the view
// will have access to greeting and person variables in the view
// Route::view('/', 'welcome', [
//     'greeting' => 'Hello there',
//     // getting access to query string
//     'person' => request('person')
// ]);

// Route::view('/about', 'about');
// Route::view('/contact', 'contact');

// some situations may require route::get
// Route::get('/', function () {
//     return view('welcome', [
//         'greeting' => 'Hello there',
//         // getting access to query string
//         'person' => request('person', 'Guest') // default value if no query string is passed through
//     ]);
// });


// sending list of tasks to viewer
// Route::get('/', function () {
//     return view('welcome', [
//         // 'tasks' is the key
//         'tasks' => [
//             'Go to the store',
//             'Finish my screencast',
//             'Clean the house'
//         ]
//     ]);
// });

// ------ INDEX ------
// updating to ideas endpoint
// Route::get('/ideas', function () {
    //$ideas = session()->get('ideas', []);

    //HOW TO VIEW DATABASE - creating general DB query
    //getting all results
    //$ideas = DB::table('ideas')->get();

    //GET SPECIFIC RESULTS - getting first result -- creating eloquent model
    // getting values where they match the state being 'Pending' - assign this to $ideas variable
    // this creates a collection of ideas where the state is 'Pending'
    //$ideas = Idea::where('state', 'Pending')->get();

    //$ideas = Idea::all();

    // getting results based on URL query string
    // $ideas = Idea::query()
    //     ->when(request('state'), function ($query, $state) {
            // filtering results based on state from URL query string - e.g. http://localhost/?state=Pending
            // $query->where('state', $state);

            // get result from URL
            //dd($state);
        // })
        // ->get();

    //sanity check
    //dd($idea);

    // return collection from route - Laravel converts to JSON automatically
    // getting the first idea from the collection and returning the description
    //return $ideas[0]->description;
    //return $idea;

    // checking if we have any ideas in the session
    // dd($ideas);

    // passing ideas to view
    // return view('ideas.index', [
    //     'ideas' => $ideas
    // ]);
//});

Route::get('/', function () {
    return 'Welcome to the home page';
});

// middleware -- layer of the system that the user has to travel through
// middleware route means that the user has to be logged in to reach any screens inside the group method
Route::middleware('auth')->group(function () {
// user must travel to auth to get to root of app
    Route::get('/ideas', [IdeaController::class, 'index']);



// ------ CREATE ------
// Route::get('/ideas/create', function () {

//     return view('ideas.create');
// });
    Route::get('/ideas/create', [IdeaController::class, 'create']);



// ------ STORE ------
// using persistance to store ideas in session
// redirecting to home page after form submission
// Route::post('/ideas', function () {
//     // fetch users idea
//     //$idea = request('idea');

//     // session()->push('ideas', $idea);

//     // eloquent will guard attributes to prevent malicious activity
// // passing user idea to create method on eloquent model
//     Idea::create([
//         'description' => request('description'),
//         'state' => 'Pending'
//     ]);

//     return redirect('/ideas');
// });
    Route::post('/ideas', [IdeaController::class, 'store']);



// ------ SHOW ------
// this will equal what is referenced in the URL - e.g. http://localhost/ideas/1
// Route::get('/ideas/{idea}', function (Idea $idea) {
//         // if result does not equal ID from DB, return null
//     //$idea = Idea::findOrFail($id);

//     // Route Model (Eloquent) Building


//     //dd($idea);

//     //return $idea;

//     //$Ideas = Idea::all();

//         // if result does not equal ID from DB, return null
//     // if(is_null($idea)) {
//     //     abort(404);
//     // }

//     return view('ideas.show', [
//         'idea' => $idea
//     ]);
// });

//controlls whether we can see an idea
    Route::get('/ideas/{idea}', [IdeaController::class, 'show']);


// ------ EDIT ------
// Route::get('/ideas/{idea}/edit', function (Idea $idea) {

//     return view('ideas.edit', [
//         'idea' => $idea
//     ]);
// });
    Route::get('/ideas/{idea}/edit', [IdeaController::class, 'edit']);

// UPDATE
// Route::patch('/ideas/{idea}', function (Idea $idea) {
//     $idea->update([
//         'description' => request('description'),
//     ]);

//     return redirect("/ideas/{$idea->id}");
// });
    Route::patch('/ideas/{idea}', [IdeaController::class, 'update']);

// processing/ accessing request data (token and form entry)
// Route::post('/ideas', function () {
//     $idea = request()->all();
//     dd($idea);
// });




// ------ TEMPORARY ------
// Temporarily delete all items from list - should use delete requests
// can go to http://localhost/delete-ideas to delete items from the list
// this is not restful and should only be used as temp method
// Route::get('/delete-ideas', function () {
//     //session()->forget('ideas');

//     Idea::truncate(); // delete all ideas from database

//     return redirect('/ideas');
// });


// ------ DESTROY ------
// Route::delete('/ideas/{idea}', function (Idea $idea) {
//     $idea->delete();

//     return redirect('/ideas');
// });
    Route::delete('/ideas/{idea}', [IdeaController::class, 'destroy']);
    Route::delete('/logout', [SessionsController::class, 'destroy']);
});

// only accessible if visitor not logged in - prevents logged in users seeing login/ register screens.
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create']);
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [SessionsController::class, 'create'])->name('login');
    Route::post('/login', [SessionsController::class, 'store']);
});

// auth using gates ------
// Route::get('/admin', function () {
//     Gate::authorize('view-admin');
//     return 'Private admin only area';
// });

<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () { return view('welcome'); });

Route::get('login', function () { return view('login'); })->name('login');

Route::post('login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('dashboard');
    }

    return back()->withErrors(['email' => 'Invalid credentials']);
});

Route::post('logout', function (Request $request) {
    Auth::logout(); // 1. Logs the user out

    $request->session()->invalidate(); // 2. Destroys the session
    $request->session()->regenerateToken(); // 3. Refreshes the CSRF token for security

    return redirect('/login'); // 4. Redirects to the login page
})->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', function () {return view('dashboard');});
    Route::get('profile', function () {return view('profile');})->name('profile');
});




// Route::get('dashboard', function () {
//     return '
//         <h2>Hello ' . Auth::user()->name . '</h2>
//         <form action="/logout" method="POST">
//             ' . csrf_field() . '
//             <button type="submit">Logout</button>
//         </form>
//     ';
// })->middleware('auth');

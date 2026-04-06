<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () { return view('welcome'); });
Route::get('test', function () { return view('test'); });

Route::get('login', function () { return view('login'); })->name('login');

Route::post('login', function (Request $request) {
    $credentials = $request->only('username', 'password');

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
    // Route::get('profile', function () {return view('profile');})->name('profile');

    Route::match(['GET', 'POST'], 'profile', function (Request $request) {
        $user = Auth::user();

        if ($request->isMethod('POST')) {
            $request->validate([
                'name'     => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users,username,' . $user->id,
                'email'    => 'required|email|max:255|unique:users,email,' . $user->id,
                'phone'    => 'nullable|string|size:9|regex:/^[0-9]+$/',
                'avatar'   => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:2048',
                'current_pass'  => 'nullable|required_with:password|current_password',
                'password' => 'nullable|confirmed',
            ]);

            // Actualizar datos
            $user->name     = $request->name;
            $user->username = $request->username;
            $user->email    = $request->email;
            $user->phone    = $request->phone;

            // === Lógica del Avatar ===
            if ($request->has('remove_avatar') && $request->remove_avatar == '1') {
                // Eliminar avatar del disco
                if ($user->avatar) { Storage::disk('public')->delete($user->avatar); }
                $user->avatar = null;   // quitar de la base de datos
            }elseif ($request->hasFile('avatar')) {
                // Eliminar avatar anterior si existe
                if ($user->avatar) { Storage::disk('public')->delete($user->avatar); }
                // Guardar nuevo avatar
                $path = $request->file('avatar')->store('all_avatar', 'public');
                $user->avatar = $path;
            }

            if ($request->filled('password')) { $user->password = Hash::make($request->password); }

            $user->save();

            return redirect('profile')->with('success', 'Perfil actualizado correctamente');
        }

        // Si es GET, mostramos el formulario
        return view('profile');

    })->name('profile');


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

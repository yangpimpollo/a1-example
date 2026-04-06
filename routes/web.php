<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Image;


Route::get('/', function () { return view('home'); });
Route::get('test', function () { return view('test'); })->name('test');

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


Route::match(['GET', 'POST'], 'singup', function (Request $request) {
    if ($request->isMethod('POST')) {
        $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username', // Sin coma al final
            'email'    => 'required|email|max:255|unique:users,email',    // Quitamos el $user->id
            'phone'    => 'nullable|string|size:9|regex:/^[0-9]+$/',
            'avatar'   => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:2048',
            'password' => 'required|confirmed', // 'required' es necesario en registro
        ]);

        // Manejo del avatar opcional
        $path = null;
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('all_avatar', 'public');
        }

        $user = \App\Models\User::create([
            'name'     => $request->name,
            'username' => $request->username,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => Hash::make($request->password),
            'avatar'   => $path,
        ]);

        // Si quieres que entre directamente al registrarse, activa esto:
        // Auth::login($user);

        return redirect()->route('login')->with('success', 'Cuenta creada con éxito');
    }

    return view('singup');
})->name('singup');





Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', function () {
        $images = Image::with(['user', 'comments.user', 'likes'])
                    ->latest()
                    ->take(10)
                    ->get();

        return view('dashboard', compact('images'));
    })->name('dashboard');

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

    Route::match(['GET', 'POST'], 'addpost', function (Request $request) {
        if ($request->isMethod('POST')) {
            #dd($request->all(), $request->file('image_path'));

            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,webp,gif|max:2048',
                'caption' => 'nullable|string|max:1000',
            ]);

            $path = $request->file('image')->store('all_images', 'public');

            \App\Models\Image::create([
                'user_id' => Auth::id(), 
                'image_path' => $path,
                'description' => $request->description,
            ]);

            return redirect()->route('dashboard')->with('success', 'Post creado con éxito');
        }

        return view('addpost');
    })->name('addpost');
});


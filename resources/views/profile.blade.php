@include('components.user-bar')

<div style="padding: 20px; font-family: sans-serif; max-width: 600px; margin: 0 auto;">

    <h1>Edit Profile</h1>

    @if(session('success'))
        <p style="color: green; font-weight: bold;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('profile') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Avatar -->
        <div style="text-align: center; margin-bottom: 25px;">
            @if(Auth::user()->avatar)
                <img src="{{ Storage::url(Auth::user()->avatar) }}" 
                     alt="Avatar" 
                     style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; border: 3px solid #ddd;">
            @else
                <div style="width: 150px; height: 150px; background-color: #ddd; border-radius: 50%; margin: 0 auto; display: flex; align-items: center; justify-content: center; font-size: 50px;">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
            @endif
        </div>

        <label><strong>Nuevo Avatar (opcional):</strong></label><br>
        <input type="file" name="avatar" accept="image/*"><br><br>
        <label><input type="checkbox" name="remove_avatar" value="1">Quitar avatar</label><br><br>

        <label><strong>Name:</strong></label><br>
        <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required style="width: 100%; padding: 8px; margin-bottom: 10px;"><br>

        <label><strong>Username:</strong></label><br>
        <input type="text" name="username" value="{{ old('username', Auth::user()->username) }}" required style="width: 100%; padding: 8px; margin-bottom: 10px;"><br>

        <label><strong>Email:</strong></label><br>
        <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" required style="width: 100%; padding: 8px; margin-bottom: 10px;"><br>

        <label><strong>Phone:</strong></label><br>
        <input type="tel" name="phone" value="{{ old('phone', Auth::user()->phone) }}" style="width: 100%; padding: 8px; margin-bottom: 15px;"><br>

        <!-- Cambiar Contraseña -->
        <h3 style="margin-top: 30px;">Cambiar Contraseña</h3>
        <p style="font-size: 14px; color: #666;">Deja estos campos en blanco si no quieres cambiar la contraseña</p>

        <label><strong>Contraseña Actual:</strong></label><br>
        <input type="password" name="current_pass" style="width:100%; padding:8px; margin-bottom:10px;"><br>

        <label><strong>Nueva Contraseña:</strong></label><br>
        <input type="password" name="password" style="width:100%; padding:8px; margin-bottom:10px;"><br>

        <label><strong>Confirmar Nueva Contraseña:</strong></label><br>
        <input type="password" name="password_confirmation" style="width:100%; padding:8px; margin-bottom:20px;"><br>


        <p><strong>Role:</strong> <span style="text-transform: capitalize;">{{ Auth::user()->role }}</span></p>
        <p><strong>Joined:</strong> {{ Auth::user()->created_at->format('d/m/Y') }}</p>

        <button type="submit" style="padding: 10px 20px; background: #007bff; color: white; border: none; cursor: pointer;">
            Update Profile
        </button>
    </form>

    <br>
    <a href="/dashboard">← Back to Dashboard</a>

</div>
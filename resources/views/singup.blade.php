@extends('components.template')

@section('content')

<div style="padding: 20px; font-family: sans-serif; max-width: 600px; margin: 0 auto;">

    <h1>New Profile</h1>

    <!-- @if(session('success'))
        <p style="color: green; font-weight: bold;">{{ session('success') }}</p>
    @endif -->

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('singup') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Avatar -->
        <div style="text-align: center; margin-bottom: 25px;">

        
        </div>

        <label><strong>Avatar (opcional):</strong></label><br>
        <input type="file" name="avatar" accept="image/*"><br><br>

        <label><strong>Name:</strong></label><br>
        <input type="text" name="name" required style="width: 100%; padding: 8px; margin-bottom: 10px;"><br>

        <label><strong>Username:</strong></label><br>
        <input type="text" name="username" required style="width: 100%; padding: 8px; margin-bottom: 10px;"><br>

        <label><strong>Email:</strong></label><br>
        <input type="email" name="email" required style="width: 100%; padding: 8px; margin-bottom: 10px;"><br>

        <label><strong>Phone:</strong></label><br>
        <input type="tel" name="phone" style="width: 100%; padding: 8px; margin-bottom: 15px;"><br>

        <!-- Cambiar Contraseña -->
        <h3 style="margin-top: 30px;">Contraseña</h3>
    
        <label><strong>Contraseña:</strong></label><br>
        <input type="password" name="password" style="width:100%; padding:8px; margin-bottom:10px;"><br>

        <label><strong>Confirmar Contraseña:</strong></label><br>
        <input type="password" name="password_confirmation" style="width:100%; padding:8px; margin-bottom:20px;"><br>

        <button type="submit" style="padding: 10px 20px; background: #007bff; color: white; border: none; cursor: pointer;">
            sing up
        </button>
    </form>


</div>

@endsection
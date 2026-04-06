@extends('components.template')

@push('styles')
    <style>

        .login_container {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 40px;
            max-width: 350px;
            margin: 80px auto;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            text-align: center;
            font-family: "Share Tech";
        }

        .login_container h2 {
            margin-bottom: 25px;
            color: #333;
        }

        /* Estilo de los Inputs */
        .login_container input {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-sizing: border-box; /* Importante para que el padding no ensanche el input */
            outline: none;
            transition: border-color 0.3s;
        }

        .login_container input:focus {
            border-color: #4a90e2;
        }

        /* Estilo del Botón */
        .login_container button {
            width: 100%;
            padding: 12px;
            background-color: #4a90e2;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
            transition: background-color 0.3s;
            font-family: "Share Tech";
        }

        .login_container button:hover {
            background-color: #357abd;
        }

        /* Mensajes de error */
        .error-msg {
            color: #e74c3c;
            font-size: 14px;
            margin-top: 15px;
        }

        .btn_sing_up {
            padding: 12px;
            background-color: #272727;
            margin-top: 10px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
            transition: background-color 0.3s;
            
        }

        .btn_sing_up:hover {
            background-color: rgb(245, 51, 87);
        }


        .btn_sing_up a {
            text-decoration: none;
            color: white;
            font-family: "Share Tech";
        }

    </style>
@endpush



@section('content')
<div class="login_container">
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit">Login</button>

        @if($errors->any())
            <p>{{ $errors->first() }}</p>
        @endif
        @error('email44')
            <span style="color: red;">{{ $message }}</span>
        @enderror

        <div class="btn_sing_up">
            <a href="{{ route('singup') }}">Sign up</a>
        </div>
    </form>
    
</div>


@endsection
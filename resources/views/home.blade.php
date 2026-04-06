@extends('components.template')

@push('styles')
<style>
    .hero-section {
        text-align: center;
        margin-top: 50px;
        padding: 60px 20px 0px 20px;
        font-family: "Share Tech", sans-serif;
    }

    .hero-section h1 {
        font-size: 2.5rem;
        color: #333;
        margin-bottom: 15px;
    }

    .hero-section p {
        font-size: 1.2rem;
        color: #666;
        max-width: 600px;
        margin: 0 auto 30px;
    }

    .hero-actions {
        display: flex;
        justify-content: center;
        gap: 15px;
    }

    .btn-primary {
        background-color: #ff4d6d; /* Rosa del botón login */
        color: white;
        padding: 12px 25px;
        border-radius: 25px;
        text-decoration: none;
        font-weight: bold;
        transition: transform 0.2s;
    }

    .btn-secondary {
        border: 2px solid #ff4d6d;
        color: #ff4d6d;
        padding: 10px 23px;
        border-radius: 25px;
        text-decoration: none;
        font-weight: bold;
    }

    .btn-primary:hover {
        transform: scale(1.05);
    }

    .hero-image {
        background-image: url('{{ asset('img/hero-cats.png') }}');
        background-repeat: no-repeat;
        background-position: center;
        width: 100%;
        height: 300px;
        margin-top: 40px;   
        border-radius: 12px;
    }
</style>

@endpush


@section('content')

<div class="hero-section">
    <h1>Bienvenido a Meow Community! 😸</h1>
    <p>El lugar perfecto para compartir las historias y fotos en los momentos mas importantes de tu vida.</p>
    
    <div class="hero-actions">
        <a href="{{ route('singup') }}" class="btn-primary">Únete a la comunidad</a>
        <a href="{{ route('login') }}" class="btn-secondary">Ya tengo cuenta</a>
    </div>

    <div class="hero-image">
    </div>
</div>


@endsection
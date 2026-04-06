@extends('components.template')

@push('styles')
<style>
    .profile-header { display: flex; align-items: center; gap: 40px; margin-bottom: 40px; padding: 20px; }
    .profile-avatar { width: 150px; height: 150px; border-radius: 50%; object-fit: cover; border: 3px solid #ff4d6d; }
    .profile-info h2 { margin: 0; font-size: 28px; }
    .profile-stats { display: flex; gap: 20px; margin-top: 10px; color: #666; }
    
    /* Cuadrícula de fotos */
    .image-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; }
    .grid-item { aspect-ratio: 1 / 1; overflow: hidden; border-radius: 8px; position: relative; }
    .grid-item img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s; }
    .grid-item:hover img { transform: scale(1.1); filter: brightness(70%); }
</style>

@endpush

@section('content')
<div class="container" style="max-width: 900px; margin: 0 auto; padding: 20px;">
    
    <!-- Cabecera del Perfil -->
    <div class="profile-header">
        <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('img/default-avatar.png') }}" class="profile-avatar">
        
        <div class="profile-info">
            <h2>{{ $user->username }}</h2>
            <p><strong>{{ $user->name }} {{ $user->surname }}</strong></p>
            
            <div class="profile-stats">
                <span><strong>{{ $user->images->count() }}</strong> publicaciones</span>
                <span><strong>{{ $user->phone ?? 'Sin teléfono' }}</strong></span>
            </div>

            @if(auth()->id() == $user->id)
                <a href="#" style="display:inline-block; margin-top:10px; color:#ff4d6d;">Editar Perfil</a>
            @endif
        </div>
    </div>

    <hr>

    <!-- Galería de Imágenes -->
    <div class="image-grid">
        @forelse($user->images as $image)
            <div class="grid-item">
                <a href="{{ route('dashboard') }}#image-{{ $image->id }}">
                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="Post">
                </a>
            </div>
        @empty
            <p style="grid-column: span 3; text-align: center; padding: 50px;">Aún no hay historias miau-ravillosas aquí. 🐾</p>
        @endforelse
    </div>

</div>
@endsection
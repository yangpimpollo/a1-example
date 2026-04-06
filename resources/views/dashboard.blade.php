@extends('components.template')


@section('content')

<div class="container" style="max-width: 600px; margin: 0 auto;">
    @foreach ($images as $image)
        <div class="card" style="margin-bottom: 30px; border: 1px solid #ddd; padding: 20px; border-radius: 8px;">
            
            <!-- Usuario que subió la imagen -->
            <strong>{{ $image->user->name }} {{ $image->user->surname }}</strong>
            <p class="text-muted">{{ $image->created_at->diffForHumans() }}</p>

            <!-- Imagen -->
            <img src="{{ asset('storage/' . $image->image_path) }}" alt="Post" style="width: 100%; border-radius: 5px;">

            <!-- Descripción -->
            <p style="margin-top: 10px;">{{ $image->description }}</p>

            <!-- Likes -->
            <div style="color: red;">
                ❤️ {{ $image->likes->count() }} Likes
            </div>

            <hr>

            <!-- Comentarios -->
            <h4>Comentarios</h4>
            @if($image->comments->count() >= 1)
                @foreach ($image->comments as $comment)
                    <div style="margin-bottom: 5px;">
                        <strong>{{ $comment->user->name }} {{ $comment->user->surname }}:</strong> 
                        {{ $comment->content }}
                    </div>
                @endforeach
            @else
                <p>No hay comentarios aún.</p>
            @endif
        </div>
    @endforeach
</div>

@endsection
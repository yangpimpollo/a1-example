@extends('components.template')

@push('styles')
<style>
    .post-container {
        background: #fff;
        max-width: 500px;
        margin: 30px auto;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        font-family: "Share Tech", sans-serif;
    }
    .post-container h2 { text-align: center; margin-bottom: 20px; color: #333; }
    
    .form-group { margin-bottom: 15px; }
    .form-group label { display: block; margin-bottom: 5px; font-weight: bold; }
    
    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 6px;
        box-sizing: border-box;
    }
    
    .btn-submit {
        width: 100%;
        padding: 12px;
        background: rgb(245, 51, 87);
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 16px;
        font-weight: bold;
    }
    .btn-submit:hover { background: rgb(185, 51, 75); }
    
    .error { color: red; font-size: 13px; margin-top: 5px; }
</style>
@endpush

@section('content')
<div class="post-container">
    <h2>Subir nueva imagen</h2>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('addpost') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="image">Selecciona la imagen</label>
            <input type="file" name="image" id="image" class="form-control" required>
            @error('image') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="description">Descripción</label>
            <textarea name="description" id="description" class="form-control" rows="4" placeholder="Cuéntanos algo sobre esta foto..." required></textarea>
            @error('description') <span class="error">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn-submit">Publicar Imagen</button>
    </form>
</div>
@endsection
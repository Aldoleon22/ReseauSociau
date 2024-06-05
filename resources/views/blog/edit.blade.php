@extends('base')

@section('title', 'Modifier une publication')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Modifier une Publication</h5>
            <form action="" method="post" class="vstack gap-2" enctype="multipart/form-data">
                @csrf
               
                <div class="form-group">
                    <label for="title">Titre</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Entrez le titre" value="{{ old('title', $post->title) }}" required>
                </div>
                <div class="form-group">
                    <label for="content">Contenu Texte</label>
                    <textarea name="content" class="form-control" id="content" rows="3" placeholder="Entrez le contenu texte" required>{{ old('content', $post->content) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="image">Photo</label>
                    <input name='image' type="file" class="form-control-file" id="image">
                    @if($post->image_path)
                        <img src="{{ asset('storage/' . $post->image_path) }}" alt="{{ $post->title }}" class="img-thumbnail mt-2" style="max-width: 200px;">
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Modifier</button>
            
            </form>
            <form action="" method="post">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
            
        </div>
    </div>
</div>

<!-- Bootstrap JS (optional) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection

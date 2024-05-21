
@extends('base')

@section('title', 'modifier d'une pulication')

@section('content')


<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Modifier une Publication</h5>
            <form action="" method="post" class="vstack gap-2" enctype="multipart/form-data">
            @csrf
                <div class="form-group">
                    <label for="contenu">Titre</label>
                    <textarea name="title" class="form-control" id="title" rows="3" placeholder="Entrez le ltitre" value="{{ old('title', $post->title) }}"></textarea>
                  
                </div>
                <div class="form-group">
                    <label for="contenu">Contenu Texte</label>
                    <textarea name="content" class="form-control" id="content" rows="3" placeholder="Entrez le contenu texte" value="{{ old('content', $post->content) }}"></textarea>
                </div>
                <div class="form-group">
                    <label for="image">Photo</label>
                    <input name='image' type="file" class="form-control-file" id="image">
                 
                </div>
                <button type="submit" class="btn btn-primary">modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS (optional) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@endsection
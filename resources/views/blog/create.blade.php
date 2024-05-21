
@extends('base')
@section('title', 'créer une pulication')
@section('content')


<div class="container mt-5">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Créer une Publication</h5>
      <form action="" method="post" enctype="multipart/form-data">
      @csrf
        <div class="form-group">
          <label for="contenu">Titre</label>
          <textarea name="title" class="form-control" id="title" rows="3" placeholder="Entrez le ltitre"></textarea>
        </div>
        <div class="form-group">
          <label for="contenu">Contenu Texte</label>
          <textarea name="content" class="form-control" id="contenu" rows="3" placeholder="Entrez le contenu texte"></textarea>
        </div>
        <div class="form-group">
          <label for="image">Photo</label>
          <input name='image' type="file" class="form-control-file" id="image">
        </div>
        <button type="submit" class="btn btn-primary">Créer</button>
      </form>
    </div>
  </div>
</div>

<!-- Bootstrap JS (optional) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@endsection
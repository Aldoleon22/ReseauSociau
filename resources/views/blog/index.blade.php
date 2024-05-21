
@extends('base')
@section('title', 'Accueil du blog')
@section('content')

             <!-- Liste des contenus créés -->


@if(count($posts) > 0)
    <ul>
        @foreach($posts as $post)
          
            <div class="container">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <!-- Publication -->
        <div class="post-container">
          <div class="post">
            <!-- Nom et photo de l'auteur -->
            <div class="media">
              <img src="photo-utilisateur.jpg" class="mr-3" alt="Photo de profil" style="width: 64px; height: 64px;">
              <div class="media-body">
                <h5 class="mt-0"></h5>
              </div>
            </div>
            <!-- Contenu de la publication --> 
             <li>
                <h3>{{ $post->title }}</h3>
                <p>{{ $post->content }}</p>
                <!-- Si vous avez une colonne 'img' dans votre modèle, vous pouvez également l'afficher -->
                <!-- <img src="{{ asset($post->img) }}" alt="Image du post"> -->
            </li>
            <div class="mt-3">
            <img src="{{ asset('storage/' . $post->image_path) }}" class="img-fluid" alt="Image de la publication" name='image'>
            </div>
            <!-- J'aime et commentaires -->
            <div class="mt-3">
              <!-- Nombre de "J'aime" -->
              <div class="likes">
                <button type="button" class="btn btn-outline-primary btn-sm">J'aime</button>
                <span class="like-count ml-2">0 J'aime</span>
              </div>
              <!-- Commentaires -->
              <div class="comments mt-2">
                <textarea class="form-control mb-2" placeholder="Ajouter un commentaire"></textarea>
                <button type="button" class="btn btn-primary btn-sm">Commenter</button>
                <div class="comment-list mt-2">
                  <!-- Les commentaires seront ajoutés ici -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

        @endforeach
    </ul>
@else
    <p>Aucun contenu n'a été créé pour le moment.</p>
@endif
              <!-- Image de la publication -->
          
  <!-- Scripts Bootstrap -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@endsection
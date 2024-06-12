@extends('base')
@section('title', 'Accueil du blog')
@section('content')

<!-- Liste des contenus créés -->
@auth
@if($posts !== NULL and count($posts) > 0)
<div class="container mt-5">
    <div class="row">
        @foreach($posts as $post)
        <div class="col-md-8 offset-md-2 mb-4">
            <!-- Publication -->
            <div class="card">
                <div class="card-body">
                    <!-- Nom et photo de l'auteur -->
                    <div class="media mb-3">
                        @if($post->user)
                            <img src="{{ asset('storage/' . $post->user->profile_picture) }}" class="mr-3 rounded-circle" alt="Photo de profil" style="width: 64px; height: 64px;">
                            <div class="media-body">
                                <h5 class="mt-0">{{ $post->user->name }}</h5>
                                <small class="text-muted">{{ $post->created_at->format('d M Y, H:i') }}</small>
                            </div>
                        @elseif(!auth()->check())
                            {{-- Rediriger vers la page de connexion --}}
                            {{ redirect()->route('auth.login') }}
                        @else
                            <img src="{{ asset('images/default-profile.png') }}" class="mr-3 rounded-circle" alt="Photo de profil par défaut" style="width: 64px; height: 64px;">
                            <div class="media-body">
                                <h5 class="mt-0">Utilisateur non trouvé</h5>
                            </div>
                        @endif
                        <!-- Menu déroulant pour les options d'édition et de suppression -->
                        <div class="dropdown ml-auto">
                            <button style="background: transparent; border: none;">
                               <a href="/blog/{{$post->id}}/edit"> &#8230;</a>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Contenu de la publication -->
                    <h3 class="card-title">{{ $post->title }}</h3>
                    <p class="card-text">{{ $post->content }}</p>
                    @if($post->image_path)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $post->image_path) }}" class="img-fluid rounded" alt="Image de la publication">
                    </div>
                    @endif
                    
                    <!-- J'aime et commentaires -->
                    <div class="mt-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="likes">
                                <button type="button" class="btn btn-outline-primary btn-sm">J'aime</button>
                                <span class="like-count ml-2">0 J'aime</span>
                            </div>
                            <div class="comments-toggle">
                                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="toggleComments({{ $post->id }})">
                                    {{ $post->comments->count() }} Commentaires
                                </button>
                            </div>
                        </div>
                        <div class="comments mt-3" id="comments-{{ $post->id }}" style="display: none;">
                            <!-- Formulaire pour ajouter un commentaire -->
                            <form method="POST" action="{{ route('comments.store', $post->id) }}">
                                @csrf
                                <textarea class="form-control mb-2" name="content" placeholder="Ajouter un commentaire"></textarea>
                                <button type="submit" class="btn btn-primary btn-sm">Commenter</button>
                            </form>
                            <!-- Liste des commentaires -->
                            <div class="comment-list mt-3">
                                @foreach($post->comments as $comment)
                                    @if($comment->content)
                                    <div class="media mb-3">
                                        <img src="{{ asset('storage/' . $comment->user->profile_picture) }}" class="mr-3 rounded-circle" alt="Photo de profil" style="width: 32px; height: 32px;">
                                        <div class="media-body">
                                            <h6 class="mt-0">{{ $comment->user->name }}</h6>
                                            <p>{{ $comment->content }}</p>
                                            <small class="text-muted">{{ $comment->created_at->format('d M Y, H:i') }}</small>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@else
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <p class="text-center">Aucun contenu n'a été créé pour le moment.</p>
        </div>
    </div>
</div>
@endif
@endauth

<!-- Scripts Bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
function toggleComments(postId) {
    var comments = document.getElementById('comments-' + postId);
    if (comments.style.display === 'none') {
        comments.style.display = 'block';
    } else {
        comments.style.display = 'none';
    }
}
</script>

@endsection


@extends('base')
@section('title', 'profil')
@section('content')

    <h1>Profil de {{ $user->name }}</h1>
    <div>
        <label>Nom:</label>
        <span>{{ $user->name }}</span>
    </div>
    <div>
        <label>Email:</label>
        <span>{{ $user->email }}</span>
    </div>
    <div>
        <label>Photo de profil:</label>
        @if ($user->profile_picture)
            <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Photo de profil">
        @else
            <span>Aucune photo de profil</span>
        @endif
    </div>

    <div class="container mt-5">
    <h2>Liste des amis</h2>
    <div class="row">
          @foreach($friends as $friend)
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $friend->name }}</h5>
                            <p class="card-text">{{ $friend->email }}</p>
                            <!-- Vous pouvez ajouter des actions supplémentaires pour chaque ami -->
                        </div>
                    </div>
                </div>
            @endforeach
       
    </div>
</div>

    @endsection
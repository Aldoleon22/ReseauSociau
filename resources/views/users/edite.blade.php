@extends('base')
@section('title', 'Modifier le profil')
@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Modifier le profil</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Nom</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="profile_picture" class="form-label">Photo de profil</label>
                            <input type="file" name="profile_picture" id="profile_picture" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                    </form>
                    <form action="{{ route('profile.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer votre profil ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger mt-3">Supprimer le profil</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

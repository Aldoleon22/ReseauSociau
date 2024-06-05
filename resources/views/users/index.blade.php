<!-- resources/views/users/index.blade.php -->
@extends('base')
@section('title', 'Liste des utilisateurs')
@section('content')

<div class="container mt-5">
    <h2>Liste des utilisateurs</h2>
    <div class="row">
        @foreach($users as $user)
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $user->name }}</h5>
                        <p class="card-text">{{ $user->email }}</p>
                        <form action="{{ route('friend-request.send', $user->id) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm">Envoyer une demande d'ami</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection

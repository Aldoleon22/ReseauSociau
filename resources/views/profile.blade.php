@extends('base')
@section('title', 'Profil')
@section('content')

<div class="container mt-5">
    <div class="row">
        <!-- Profile Section -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    @if ($user->profile_picture)
                        <img src="{{ asset('storage/' . $user->profile_picture) }}" class="img-fluid rounded-circle mb-3" alt="Photo de profil" style="width: 150px; height: 150px;">
                    @else
                        <span class="d-inline-block bg-secondary rounded-circle" style="width: 150px; height: 150px; line-height: 150px; text-align: center;">Aucune photo de profil</span>
                    @endif
                    <h2>{{ $user->name }}</h2>
                    <p>{{ $user->email }}</p>
                    <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-primary mt-3">Modifier le profil</a>
                </div>
            </div>
        </div>


@endsection

@extends('base')
@section('title', 'Mes amis')
@section('content')

<div class="container mt-5">
    <h1>Mes amis</h1>
    @if ($friends->isEmpty())
        <p>Vous n'avez pas encore d'amis.</p>
    @else
        <div class="row">
            @foreach ($friends as $friend)
                <div class="col-4 col-md-3 mb-3 text-center">
                    <div class="card">
                        <div class="card-body p-2">
                            <img src="{{ asset('storage/' . $friend->profile_picture) }}" class="img-fluid rounded-circle mb-2" alt="Photo de profil" style="width: 80px; height: 80px;">
                            <p>{{ $friend->name }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

@endsection

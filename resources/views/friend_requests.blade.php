<!-- resources/views/friend_requests.blade.php -->
@extends('base')
@section('title', 'Demandes d\'amis')
@section('content')

<div class="container mt-5">
    <h2>Demandes d'amis en attente</h2>
    <div class="row">
        @forelse($pendingRequests as $friendship)
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $friendship->sender->name }}</h5>
                        <form action="{{ route('friend-request.accept', $friendship->id) }}" method="post" style="display: inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Accepter</button>
                        </form>
                        <form action="{{ route('friend-request.decline', $friendship->id) }}" method="post" style="display: inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Refuser</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p>Aucune demande d'amitié en attente.</p>
        @endforelse
    </div>
</div>

@endsection

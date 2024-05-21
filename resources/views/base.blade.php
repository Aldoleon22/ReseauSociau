<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>@yield('title')</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Mon Réseau Social</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="/blog">Accueil <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Profil</a>
      </li>
      <li class="nav-item"> 
        <a class="nav-link" href="/blog/new">Creer PUB</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Messages</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Paramètres</a>
      </li>
    </ul>
   
  </div>
  <div class="navbar-nav ms-auto mb-2 mb-lg-0">
      @auth
            {{\Illuminate\Support\Facades\Auth::user()->name}}
            <form class="nav-item" action="{{ route('auth.logout') }}" method="post">
              @method('delete')
              @csrf
              <button class="nav-link">Se déconnecter</button>
            </form>
      @endauth
      @guest
            <a href="{{ route('auth.login') }}">Se connecter</a>
      @endguest

    </div>
</nav>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>

    <div class="container">
      @if(session('success'))
      <div class="alert alert-success">
        {{ session('success')}}
        @endif
      </div>
        @yield('content')
    </div>
    
</body>
</html>
@extends("base")


@section("content")

<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card mt-5">
          <div class="card-header">
            <h3 class="text-center">Connexion</h3>
          </div>
          <div class="card-body">
            <form action="{{ route('auth.login') }}" method="post" class="vstack gap-3">
              @csrf

              <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" class="form-control" id="email" placeholder="Entrez votre email" name='email'>
              @error("email")
              {{$message}}
              @enderror
            </div>
              <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" class="form-control" id="password" placeholder="Entrez votre mot de passe" name='password'>
                @error("password")
              {{$message}}
              @enderror
            </div>
              <button type="submit" class="btn btn-primary btn-block">Se connecter</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>



@endsection 
@extends('layouts.user_type.guest')

@section('content')
  <div class="container">
    <div class="row my-3">
      <div class="col-md-6 d-flex flex-column mx-auto border rounded bg-white">
        <div class="card card-plain mt-20 ">

          <div class="card-header pb-0 text-center">
            <div>
              <img class="" src="../assets/img/newLogo.png" width="100px" alt="logo" >
            </div>
            <p class="mt-1 logoTitle">
                Plateforme de préinscription à l'Ecole Supérieure d'Education 
                et de Formation de l'Université Chouaîb Doukkali
            </p>
            <hr>
          </div>

          <div class="card-body">
            <form role="form" method="POST" action="/server.php/session">
              @csrf
              <label for="email">E-mail</label>
              <div class="mb-3">
                <input type="email" class="form-control" name="email" id="email" placeholder="E-mail" aria-label="Email" aria-describedby="email-addon">
                @error('email')
                  <p class="text-danger text-xs mt-2">{{ $message }}</p>
                @enderror
              </div>
              <label for="password">Mot de Passe</label>
              <div class="mb-3">
                <input type="password" class="form-control" name="password" id="password" placeholder="Mot de passe" aria-label="Password" aria-describedby="password-addon">
                @error('password')
                  <p class="text-danger text-xs mt-2">{{ $message }}</p>
                @enderror
              </div>
              <div class="d-flex justify-content-around">
                <div class="form-check form-switch rememberMe">
                  <label class="form-check-label" for="rememberMe">Souviens-toi de moi</label>
                  <input class="form-check-input" type="checkbox" id="rememberMe" checked="">
                </div>
                <div class="passwordForgotten">
                  <small class="text-muted" >
                    <a href="/login/forgot-password" class="font-weight-bold" style="color:#0f233a">Mot de passe oublié ?</a>
                  </small>
                </div>  
              </div>
              <div class="text-center">
                <button type="submit" class="btn text-light w-100 mt-4 mb-0" style="background-color:#0f233a">S'identifier</button>
              </div>
            </form>
          </div>

          <div class="card-footer text-center pt-0 px-lg-2 px-1">
            <div>
              <p class="mb-4 text-sm mx-auto">
              Vous n'avez pas de compte ?
                <a href="inscription" class="font-weight-bold" style="color:#0f233a">S'inscrire</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

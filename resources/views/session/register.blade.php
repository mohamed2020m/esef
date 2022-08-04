@extends('layouts.user_type.guest')
@section('content')

<div class="container">
    <div class="row my-3">
      <div class="col-md-6 d-flex flex-column mx-auto border rounded bg-white">
        <div class="card card-plain mt-20 ">

          <div class="card-header pb-0 text-center">
            <div>
              <img class="" src="../assets/img/logo.png" width="100px" alt="logo" >
            </div>
            <p class="mt-1 logoTitle">
                Plateforme de préinscription à l'Ecole Supérieure d'Education 
                et de Formation de l'Université Chouaîb Doukkali
            </p>
            <hr>
          </div>

          <div class="card-body">
            <form role="form" method="POST" action="/server.php/inscription">
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
              <label for="password_confirmation" >Confirmez le mot de passe</label>
              <div class="mb-3">
                <input type="password" class="form-control" placeholder="Confirmez le mot de passe" name="password_confirmation" id="password_confirmation" aria-label="Password" aria-describedby="password-addon">
              </div>
              <div class="form-check form-check-info text-left">
                <input class="form-check-input" type="checkbox" name="agreement" id="checkConditions" checked>
                <label class="form-check-label" for="checkConditions">
                  J'accepte <a href="javascript:;" class="text-dark font-weight-bolder">Les Termes et  Conditions</a>
                </label>
                @error('agreement')
                  <p class="text-danger text-xs mt-2">Acceptez les conditions générales, puis réessayez de vous inscrire.s</p>
                @enderror
              </div>
              <div class="text-center">
                <button type="submit" class="btn text-light w-100 mt-4 mb-0" style="background-color:#0f233a">S'inscrire</button>
              </div>
            </form>
          </div>

          <div class="card-footer text-center pt-0 px-lg-2 px-1">
            <div>
              <p class="mb-4 text-sm mx-auto">
                Vous avez déjà un compte?
                <a href="Accueil" class="font-weight-bold" style="color:#0f233a">s'identifier</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- <section class="min-vh-100 mb-8">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 mx-3 border-radius-lg" >
      <span class="mask bg-gradient-dark opacity-6" style=" background-image: url('../assets/img/curved-images/ensaj.jpg');"></span>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5 text-center mx-auto">
            <h1 class="text-white mb-2 mt-5">Bienvenue!</h1>
            <h3 class="text-lead text-white">créer un nouveau compte .</h3>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row mt-lg-n10 mt-md-n11 mt-n10">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
          <div class="card z-index-0">
            <div class="card-header text-center pt-4">
              <h5>Connexion</h5>
            </div>

            <div class="card-body">
              <form role="form text-left" method="POST" action="/inscription">
                @csrf
                <div class="mb-3">
                  <input type="email" class="form-control" placeholder="Email" name="email" id="email" aria-label="Email" aria-describedby="email-addon" value="{{ old('email') }}">
                  @error('email')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                  @enderror
                </div>
                <div class="mb-3">
                  <input type="password" class="form-control" placeholder="Password" name="password" id="password" aria-label="Password" aria-describedby="password-addon">
                  @error('password')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                  @enderror
                </div>
                <div class="mb-3">
                  <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" id="password_confirmation" aria-label="Password" aria-describedby="password-addon">
                </div>
                <div class="form-check form-check-info text-left">
                  <input class="form-check-input" type="checkbox" name="agreement" id="flexCheckDefault" checked>
                  <label class="form-check-label" for="flexCheckDefault">
                  J'accepte <a href="javascript:;" class="text-dark font-weight-bolder">Les Termes et  Conditions</a>
                  </label>
                  @error('agreement')
                    <p class="text-danger text-xs mt-2">Acceptez les conditions générales, puis réessayez de vous inscrire.s</p>
                  @enderror
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> -->

@endsection


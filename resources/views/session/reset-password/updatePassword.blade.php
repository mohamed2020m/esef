
@extends('layouts.user_type.auth')

@section('content')
<div class="card mb-4 mx-4">
    <div class="card-header pb-0">
        <div class="d-flex flex-row justify-content-center">
            <div  sytle="text-overflow: ellipsis !important; overflow: hidden !important; width: 40px; white-space: nowrap !important;">
                <h5 class="mb-0"><i class="fa fa-lg fa-lock ps-2 pe-2 text-center text-dark" aria-hidden="true"></i>Changement de mot de passe</h5>
            </div>
        </div>
    </div>
    <hr>
    <div class="card-body px-3 pt-0 pb-2">
        <div class="mb-3">
            <form method="POST" action="/server.php/change/password" class="md-float-material">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-lg @error('current_password') is-invalid @enderror" 
                            name="current_password" value="{{ old('current_password') }}" placeholder="Entrez l'ancien mot de passe">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            @error('current_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-lg @error('new_password') is-invalid @enderror" 
                            name="new_password" placeholder="Saisissez le mot de passe actuel">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            @error('new_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-lg" name="new_confirm_password" placeholder="Confirmez le mot de passe">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Changer le mot de passe</button>
                    </form>
                </div>
            </div>
</div>
@endsection
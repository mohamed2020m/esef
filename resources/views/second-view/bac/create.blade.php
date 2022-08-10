@extends('layouts.user_type.auth')

@section('content')
    <div class="m-3">
        <a  id="backto" href="https://www.esefj.ma/server.php/bac"><i class="fa fa-lg fa-arrow-left ps-2 pe-2 text-center text-dark" aria-hidden="true"></i>Retour</a>
    </div>
    <div class="card mb-4 mx-4">
        <div class="card-header pb-0">
            <div class="d-flex flex-row justify-content-between">
                <div sytle="text-overflow: ellipsis !important; overflow: hidden !important; width: 40px; white-space: nowrap !important;">
                    <h5 class="mb-0"><i class="fa fa-lg fa-plus ps-2 pe-2 text-center text-dark" aria-hidden="true"></i>Ajouter Bac</h5>
                </div>
            </div>
        </div>
        <div class="card-body px-3 pt-0 pb-2">
            <form action="/server.php/table/bac_create" method="POST"  enctype="multipart/form-data">
            @csrf
                <div class="form-outline mb-4 mt-6">
                    <label class="form-label" for="name">Série de Bac</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="ajouter Bac" required />
                </div>
                <button type="submit" class="btn" style="background-color: #0f233a !important;color:white">Enregistrer</button>
            </form>
        </div>
    </div>
@endsection

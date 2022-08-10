@extends('layouts.user_type.auth')

@section('content')
    <div class="m-3">
        <a  id="backto" href="https://esef.toubkalit.com/server.php/matiere"><i class="fa fa-lg fa-arrow-left ps-2 pe-2 text-center text-dark" aria-hidden="true"></i>Retour</a>
    </div>
    <div class="card mb-4 mx-4">
        <div class="card-header pb-0">
            <div class="d-flex flex-row justify-content-between">
                <div sytle="text-overflow: ellipsis !important; overflow: hidden !important; width: 40px; white-space: nowrap !important;">
                    <h5 class="mb-0"><i class="fa fa-lg fa-edit ps-2 pe-2 text-center text-dark" aria-hidden="true"></i>Modifier la matière</h5>
                </div>
            </div>
        </div>
        <div class="card-body px-3 pt-0 pb-2">
            @foreach($data_matiere as $key => $item)
            <form action="{{url('/matiere/update/'.$item->id)}}" method="POST"  enctype="multipart/form-data">
                @csrf
                <div class="form-outline mb-4 mt-6">
                    <label class="form-label" for="matiere">Matière</label>
                    <input type="text" value="{{$item->name}}" name="name" id="matiere" class="form-control" required />
                    @error('name')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                @endforeach
                <button type="submit" class="btn" style="background-color: #0f233a !important;color:white">Modifier</button>
            </form>
        </div>
    </div>
@endsection

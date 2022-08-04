@extends('layouts.user_type.auth')

@section('content')
@foreach($data_matiere as $key => $item)
    <form action="{{url('/matiere/update/'.$item->id)}}" method="POST"  enctype="multipart/form-data">
    @csrf
        <div class="form-outline mb-4 mt-6">
            <label class="form-label" for="name">Matiere</label>
            <input type="text" value="{{$item->name}}" name="name" id="name" class="form-control" required />
        @endforeach
        </div>
        <button type="submit" class="btn btn-success">modifier</button>
    </form>
@endsection

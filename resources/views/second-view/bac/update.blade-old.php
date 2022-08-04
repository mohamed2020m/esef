@extends('layouts.user_type.auth')

@section('content')
@foreach($data as $key => $item)
    <form action="{{url('/bac_update/'.$item->id)}}" method="POST"  enctype="multipart/form-data">
    @csrf
        <div class="form-outline mb-4 mt-6">
            <label class="form-label" for="name">Serie de Bac</label>
            <input type="text" value="{{$item->name}}" name="name" id="name" class="form-control" required />
        @endforeach
        </div>
        <button type="submit" class="btn btn-success">modifier</button>
    </form>
@endsection

@extends('layouts.user_type.auth')

@section('content')

    <form action="/server.php/table/licence_create" method="POST"  enctype="multipart/form-data">
    @csrf
        <div class="form-outline mb-4 mt-6">
            <label class="form-label" for="name">Licence</label>
            <input type="text" name="name" id="name" class="form-control" required />

        </div>
        <button type="submit" class="btn btn-success">Enregistrer</button>
    </form>
@endsection

@extends('layouts.user_type.auth')

@section('content')


<div>
    <form action="/server.php/user-profile/update" method="POST"  enctype="multipart/form-data" class="container py-5">
    @csrf
        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <img src="{{ URL::to('../public/images/images_profiles/'. auth()->user()->photo) }}" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                        <h5 class="my-3">{{auth()->user()->last_name}} {{auth()->user()->first_name}}</h5>
                        <label for="image_profile" class="btn" style="background-color: orange !important;color:white">Changer Image</label>
                        <input type="file" value="{{ URL::to('/images/images_profiles/'. auth()->user()->photo) }}" id="image_profile" name="image_profile" accept="image/png, image/gif, image/jpeg" hidden />
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Nom</p>
                            </div>
                            <div class="@error('user.name')border border-danger rounded-3 @enderror">
                                <input class="form-control" value="{{ auth()->user()->last_name }}" type="text" placeholder="your last Name" id="user-last_name" name="last_name">
                                @error('name')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-sm-3">
                                <p class="mb-0">Prénom</p>
                            </div>
                            <div class="@error('user.name')border border-danger rounded-3 @enderror">
                                <input class="form-control" value="{{ auth()->user()->first_name }}" type="text" placeholder="your first Name" id="user-first_name" name="first_name">
                                @error('name')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-sm-3">
                                <p class="mb-0">Email</p>
                            </div>
                            <div class="@error('email')border border-danger rounded-3 @enderror">
                                <input class="form-control" value="{{ auth()->user()->email }}" type="email" placeholder="@example.com" id="user-email" name="email" disabled>
                                @error('email')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn mt-4 mb-4" style="background-color: #0f233a !important;color:white">Enregistrer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

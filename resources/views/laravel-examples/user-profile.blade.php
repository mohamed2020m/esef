@extends('layouts.user_type.auth')

@section('content')


<div>
    <form action="/server.php/user-profile/update" method="POST"  enctype="multipart/form-data" class="container py-5">
        @csrf
        <div class="">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <div>
                        <img src="{{ URL::to('../public/images/images_profiles/'. auth()->user()->photo) }}" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                    </div>
                    <div>
                        <h5 class="my-3">{{auth()->user()->last_name}} {{auth()->user()->first_name}}</h5>
                    </div>
                    <div>
                        <label for="image_profile" class="btn" style="background-color: orange !important;color:white">Changer Image</label>
                        <input type="file" value="{{ URL::to('/images/images_profiles/'. auth()->user()->photo) }}" id="image_profile" name="image_profile" accept="image/png, image/gif, image/jpeg" hidden />
                    </div>
                </div>
            </div>
        </div>
        <div class="">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Nom</p>
                        </div>
                        <div class="@error('user.name')border border-danger rounded-3 @enderror">
                            <input class="form-control" value="{{ auth()->user()->last_name }}" type="text" placeholder="votre nom" id="user-last_name" name="last_name" required>
                            @error('last_name')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="">
                            <p class="mb-0 text-end">?????????? ??????????????</p>
                        </div>
                        <div class="@error('user.name')border border-danger rounded-3 @enderror">
                            <input class="form-control" value="{{ auth()->user()->last_name_arabic }}" type="text" placeholder="votre nom en arabe" id="user-last_name_arabic" name="last_name_arabic" required>
                            @error('last_name_arabic')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-sm-3">
                            <p class="mb-0">Pr??nom</p>
                        </div>
                        <div class="@error('user.name')border border-danger rounded-3 @enderror">
                            <input class="form-control" value="{{ auth()->user()->first_name }}" type="text" placeholder="votre pr??nom" id="user-first_name" name="first_name" required>
                            @error('first_name')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="">
                            <p class="mb-0 text-end">?????????? ????????????</p>
                        </div>
                        <div class="@error('user.name')border border-danger rounded-3 @enderror">
                            <input class="form-control" value="{{ auth()->user()->first_name_arabic }}" type="text" placeholder="votre pr??nom en arabe" id="user-first_name_arabic" name="first_name_arabic" required>
                            @error('first_name_arabic')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>


                    <div class="row mt-3">
                        <div class="col-sm-3">
                            <p class="mb-0">Date Naissance</p>
                        </div>
                        <div class="@error('user.name')border border-danger rounded-3 @enderror">
                            <input class="form-control" value="{{auth()->user()->birthday}}" type="date"  id="user-birthday" name="birthday" required>
                            @error('birthday')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>


                    <div class="row mt-3">
                        <div class="col-sm-3">
                            <p class="mb-0">Lieu Naissance</p>
                        </div>
                        <div class="@error('user.name')border border-danger rounded-3 @enderror">
                            <input class="form-control" value="{{auth()->user()->birth_place}}" type="text" placeholder="votre lieu de naissance" id="user-birth_place" name="birth_place" required>
                            @error('birth_place')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>


                    <div class="row mt-3">
                        <div class="col-sm-3">
                            <p class="mb-0">CIN</p>
                        </div>
                        <div class="@error('user.name')border border-danger rounded-3 @enderror">
                            <input class="form-control" value="{{auth()->user()->cin}}" type="text" placeholder="votre cin" id="user-cin" name="cin" required>
                            @error('cin')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>


                    <div class="row mt-3">
                        <div class="col-sm-3">
                            <p class="mb-0">CNE</p>
                        </div>
                        <div class="@error('user.name')border border-danger rounded-3 @enderror">
                            <input class="form-control" value="{{auth()->user()->cne}}" type="text" placeholder="votre cne" id="user-first_name" name="cne" required>
                            @error('cne')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-sm-3">
                            <p class="mb-0">T??l??phone</p>
                        </div>
                        <div class="@error('user.name')border border-danger rounded-3 @enderror">
                            <input class="form-control" value="{{auth()->user()->phone}}" type="tel" placeholder="Votre num??ro de t??l??phone" id="user-phone" name="phone" required>
                            @error('phone')
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

                    <div class="row mt-3">
                        <div class="col-sm-3">
                            <p class="mb-0">CIN (face 1)</p>
                            <font size="2" color="red">(Format png-jpg)</font>
                        </div>
                        <div class="@error('email')border border-danger rounded-3 @enderror">
                            <input class="form-control" type="file"  name="cin_first_face" accept="image/png, image/gif, image/jpeg"/>
                            @error('cin_first_face')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                            @if(Auth::user()->cin_image_face1 !="")
                            <p class="text-success">un fichier du m??me type existe d??j??</p>
                            @endif
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-sm-3">
                            <p class="mb-0">CIN (face 2)</p>
                            <font size="2" color="red">(Format png-jpg)</font>
                        </div>
                        <div class="@error('email')border border-danger rounded-3 @enderror">
                            <input class="form-control" type="file"  name="cin_second_face" accept="image/png, image/gif, image/jpeg"/>
                            @error('cin_second_face')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                            @if(Auth::user()->cin_image_face2 !="")
                            <p class="text-success">un fichier du m??me type existe d??j??</p>
                            @endif
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn mt-4 mb-4" style="background-color: #0f233a !important;color:white">Enregistrer</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

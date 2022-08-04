@extends('layouts.user_type.auth')

@section('content')
<div class="container rounded bg-white mt-5 mb-5">
    @foreach($data as $key => $item)
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="{{URL::to('../public/images/images_profiles/'.$item->photo)}}"></div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Informations sur le profil</h4>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels">Nom</label><input type="text" class="form-control"  value="{{$item->last_name}}" disabled></div>
                    <div class="col-md-6"><label class="labels">Prenom</label><input type="text" class="form-control" value="{{$item->first_name}}" disabled ></div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels">الإسم العائلي</label><input type="text" class="form-control" value="{{$item->last_name_arabic}}" disabled ></div>
                    <div class="col-md-6"><label class="labels">الإسم الشخصي</label><input type="text" class="form-control"  value="{{$item->first_name_arabic}}" disabled></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Telephone</label><input type="text" class="form-control" value="{{$item->phone}}" disabled></div>
                    <div class="col-md-12"><label class="labels">Email</label><input type="text" class="form-control" value="{{$item->email}}" disabled></div>
                    <div class="col-md-12"><label class="labels">Date de Naissance</label><input type="text" class="form-control" value="{{$item->birthday}}" disabled></div>
                    <div class="col-md-12"><label class="labels">Lieu Naissance</label><input type="text" class="form-control" value="{{$item->birth_place}}" disabled></div>
                    <div class="col-md-12"><label class="labels">CNE</label><input type="text" class="form-control" value="{{$item->cne}}" disabled></div>
                    <div class="col-md-12"><label class="labels">CIN</label><input type="text" class="form-control" value="{{$item->cin}}" disabled></div>
                    <div class="col-md-12"><label class="labels">CIN face 1</label><img ondblclick="affiche1()"  id="face_cin1" class="mt-5" width="150px" src="{{URL::to('../public/images/images_cin/first_face/'.$item->cin_image_face1)}}"> <button class="btn btn-primary" id="myBtn1" style="display: none;" onclick="diminuer1()">Reset</button> </div>
                    <div class="col-md-12"><label class="labels">CIN face 2</label><img ondblclick="affiche2()"  id="face_cin2" class="mt-5 " width="150px" src="{{URL::to('../public/images/images_cin/second_face/'.$item->cin_image_face2)}}"> <button class="btn btn-primary" id="myBtn2" style="display: none;" onclick="diminuer2()">Reset</button></div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
</div>
</div>
@endsection

<script>

    function affiche1(){
        var btn = document.getElementById("myBtn1");
        btn.style.display="block";
        var myImg = document.getElementById("face_cin1");
        myImg.style.width="800px";
    }
    function affiche2(){
        var btn = document.getElementById("myBtn2");
        btn.style.display="block";
        var myImg = document.getElementById("face_cin2");
        myImg.style.width="800px";
    }

    function diminuer1(){
        var myImg = document.getElementById("face_cin1");
        myImg.style.width="150px";
        var btn = document.getElementById("myBtn1");
        btn.style.display="none";
    }
    function diminuer2(){
        var myImg = document.getElementById("face_cin2");
        myImg.style.width="150px";
        var btn = document.getElementById("myBtn2");
        btn.style.display="none";
    }
</script>

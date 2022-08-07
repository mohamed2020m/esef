@extends('layouts.user_type.auth')

@section('content')
<!-- <div class="container rounded bg-white mt-5 mb-5">
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
</div> -->

    <div class="m-3">
        <a  id="backto" href="https://esef.toubkalit.com/server.php/candidats"><i class="fa fa-lg fa-arrow-left ps-2 pe-2 text-center text-dark" aria-hidden="true"></i>Retour</a>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <img src="{{URL::to('../public/images/images_profiles/'.auth()->user()->photo)}}" alt="avatar"
                    class="rounded-circle img-fluid" style="width: 150px;">
                </div>
            </div>
        </div>
        <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="mb-3">
                        <h4>Données personnelles</h4>
                    </div>
                    @foreach($user_data as $key =>$item)
                <div class="col-sm-4">
                    <p class="mb-0">Nom :</p>
                </div>
                <div class="col-sm-8">
                    <p class="text-muted mb-0">{{$item->last_name}}</p>
                </div>
                </div>
                <hr>
                <div class="row">
                <div class="col-sm-4">
                    <p class="mb-0">Prénom :</p>
                </div>
                <div class="col-sm-8">
                    <p class="text-muted mb-0">{{$item->first_name}}</p>
                </div>
                </div>
                <hr>
                <div class="row">
                <div class="col-sm-4">
                    <p class="mb-0">Date de naissance :</p>
                </div>
                <div class="col-sm-8">
                    <p class="text-muted mb-0">{{$item->birthday}}</p>
                </div>
                </div>
                <hr>
                <div class="row">
                <div class="col-sm-4">
                    <p class="mb-0">CIN :</p>
                </div>
                <div class="col-sm-8">
                    <p class="text-muted mb-0">{{$item->cin}}</p>
                </div>
                </div>
                <hr>
                <div class="row">
                <div class="col-sm-4">
                    <p class="mb-0">CIN (face 1) :</p>
                </div>
                <div class="col-sm-8">
                <a href="{{URL::to('../public/images/images_cin/first_face/'.$item->cin_image_face1)}}" download> <u> <p class="mb-0 text-info">Télécharger</p></u></a>
                </div>
                </div>
                <hr>
                <div class="row">
                <div class="col-sm-4">
                    <p class="mb-0">CIN (face 2) :</p>
                </div>
                <div class="col-sm-8">
                <a href="{{URL::to('../public/images/images_cin/second_face/'.$item->cin_image_face2)}}" download> <u> <p class="mb-0 text-info">Télécharger</p></u></a>
                </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="mb-3">
                        <h4>Baccalauréats</h4>
                    </div>
                <div class="col-sm-4">
                    <p class="mb-0">Diplôme :</p>
                </div>
                <div class="col-sm-8">
                    <p class="text-muted mb-0">Bac</p>
                </div>
                </div>
                <hr>
                <div class="row">
                <div class="col-sm-4">
                    <p class="mb-0">Spécialité :</p>
                </div>
                <div class="col-sm-8">
                    <p class="text-muted mb-0">{{$user_bac_name[0]->name}}</p>
                </div>
                </div>
                <hr>
                @foreach($user_bac_data as $key =>$item)
                <div class="row">
                <div class="col-sm-4">
                    <p class="mb-0">Date :</p>
                </div>
                <div class="col-sm-8">
                    <p class="text-muted mb-0">{{$item->annee_obtention}}</p>
                </div>
                </div>
                <hr>
                <div class="row">
                <div class="col-sm-4">
                    <p class="mb-0">Etablissment :</p>
                </div>
                <div class="col-sm-8">
                    <p class="text-muted mb-0">{{$item->etablissment_obtention}}</p>
                </div>
                </div>
                <hr>
                <div class="row">
                <div class="col-sm-4">
                    <p class="mb-0">Ville :</p>
                </div>
                <div class="col-sm-8">
                    <p class="text-muted mb-0">{{$item->ville_obtention}}</p>
                </div>
                </div>
                <hr>
                <div class="row">
                <div class="col-sm-4">
                    <p class="mb-0">Scan Bac :</p>
                </div>
                <div class="col-sm-8">
                <a href="{{URL::to('../public/images/scan_condidat/scan-bac/'.$item->scan_bac)}}" download> <u> <p class="mb-0 text-info">Télécharger</p></u></a>
                </div>
                </div>
                <hr>
                <div class="row">
                <div class="col-sm-4">
                    <p class="mb-0">Relevé de notes :</p>
                </div>
                <div class="col-sm-8">
                <a href="{{URL::to('../public/images/scan_condidat/scan-releve-note/'.$item->scan_releve_note)}}" download> <u> <p class="mb-0 text-info">Télécharger</p></u></a>
                </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="mb-3">
                        <h4>Licence</h4>
                    </div>
                <div class="col-sm-4">
                    <p class="mb-0">Diplôme :</p>
                </div>
                <div class="col-sm-8">
                    <p class="text-muted mb-0">Licence</p>
                </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-4">
                        <p class="mb-0">Spécialité :</p>
                    </div>
                    <div class="col-sm-8">
                        <p class="text-muted mb-0">{{$user_licence_name[0]->name}}</p>
                    </div>
                </div>
                <hr>
                @foreach($user_licence_data as $key =>$item)
                <div class="row">
                    <div class="col-sm-4">
                        <p class="mb-0">Date :</p>
                    </div>
                    <div class="col-sm-8">
                        <p class="text-muted mb-0">{{$item->annee_obtention}}</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-4">
                        <p class="mb-0">Etablissment :</p>
                    </div>
                    <div class="col-sm-8">
                        <p class="text-muted mb-0">{{$item->etablissment_obtention}}</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-4">
                        <p class="mb-0">Ville :</p>
                    </div>
                    <div class="col-sm-8">
                        <p class="text-muted mb-0">{{$item->ville_obtention}}</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-4">
                        <p class="mb-0">Relevé de notes S1 :</p>
                    </div>
                    <div class="col-sm-8">
                    <a href="{{URL::to('../public/images/scan_condidat/scan-s1/'.$item->releve_s1)}}" download> <u> <p class="mb-0 text-info">Télécharger</p></u></a>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-4">
                        <p class="mb-0">Relevé de notes S2 :</p>
                    </div>
                    <div class="col-sm-8">
                    <a href="{{URL::to('../public/images/scan_condidat/scan-s2/'.$item->releve_s2)}}" download> <u> <p class="mb-0 text-info">Télécharger</p></u></a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

<!-- <script>

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
</script> -->

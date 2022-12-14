@extends('layouts.user_type.auth')

@section('content')

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

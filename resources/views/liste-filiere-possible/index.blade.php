@extends('layouts.user_type.auth')
@section('content')

<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-center" >
                        <div>
                            <h5 class="text-center mb-0"><i class="fa fa-list me-2"></i>Liste des filières</h5>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="card-body px-0 pt-0 pb-2 mt-3">
                    <div class="table-responsive p-0">
                        <table class="table table-striped table-hover mb-0">
                            <thead class="mb-3">
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Intitule
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nombre de postes
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Date limite de dépôt
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($x as $key =>$item)
                                <tr class="align-middle" style="font-size: 18px;">
                                    <td class="ps-4">
                                        <p class=" font-weight-bold mb-0">{{$item->name}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class=" font-weight-bold mb-0">12</p>
                                    </td>
                                    <td class="text-center">
                                        <p class=" font-weight-bold mb-0">2022-8-21</p>
                                    </td>
                                    <td class="text-center d-flex align-items-center">
                                        <button class="myModal btn mt-2" name="{{$item->name}}" id="{{$item->id}}" data-other-attr='XX' onClick="reply_click(this)" style="background-color: #0f233a !important;color:white">Postuler</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-center" >
                        <div>
                            <h5 class="text-center mb-0"><i class="fa fa-users me-2"></i>Mes candidatures</h5>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="card-body px-0 pt-0 pb-2 mt-3">
                    <div class="table-responsive p-0">
                        <table class="table table-striped table-hover mb-0">
                            <thead class="mb-3">
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Intitule
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nombre de postes
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Reçu
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user_with_filiere as $item)
                                <tr class="align-middle" style="font-size: 18px;">
                                    <td class="ps-4">
                                        <p class=" font-weight-bold mb-0">{{$item->name}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class=" font-weight-bold mb-0">12</p>
                                    </td>
                                    <td class="text-center">
                                    <a href="#" id="recu" name="{{$item->id}}"><img src="#" alt="" width="50px" ><i class="fa fa-download" onclick="validate()"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade mt-6" id="modalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 800px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ModalLabel"></h4>
                <button type="button" class="btn btn-secondary rounded-circle px-2 py-1" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa fa-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="text-center">Veuillez remplir les notes de bac des matières :</h5>
                <form action="/server.php/ps/filiere/pre-insc" method="POST"  enctype="multipart/form-data">
                    @csrf
                    <input type="text" class="form-control" name="filiere_id" id="filiere_id" value="13" hidden/>
                    <div id="formModal"></div>
                    <div class="modal-footer d-block">
                        <button type="submit" class="btn btn-success float-end">Valider</button>
                        <button type="reset" data-bs-dismiss="modal" aria-label="Close" class="btn btn-secondary float-end">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade mt-6" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 800px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Veuillez remplir vos formations personnelles</h5>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">X</button>
      </div>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function(){
            var tag = document.getElementById("recu");
            var id = tag.getAttribute('name');
            $.ajax({
                type:"GET",
                url :"/server.php/verification/data/user",
                dataType:"json",
                success:function(response){
                    var fname = response.user_data[0].first_name;
                    var lname = response.user_data[0].last_name;
                    var phone = response.user_data[0].phone;
                    var cin = response.user_data[0].cin
                    if(fname != null && lname !=null && phone !=null && cin !=null){
                        const a = document.querySelector('#recu');
                        a.href = "/server.php/download/recu/"+id
                    }

                }
            });
    })

        function reply_click(clicked_object){
            var id = clicked_object.getAttribute('id');

            document.getElementById('formModal').innerHTML = "";
            $.ajax({
                type: "GET",
                url:"/server.php/get/mt/filiere/" + id,
                dataType: "json",
                success: function(response){
                    document.getElementById('filiere_id').value = response.filiere_id;
                    for(let i=0; i<response.matieres.length; i++){
                        let label = document.createElement('label');
                        label.textContent = "Note de " + response.matieres[i].name;
                        let inpt = document.createElement('input');
                        inpt.setAttribute('type','text');
                        inpt.setAttribute('name', response.matieres[i].id);
                        inpt.setAttribute('placeholder','Note de '+response.matieres[i].name);
                        inpt.setAttribute('class','form-control');
                        inpt.setAttribute('required','required');
                        let container = document.getElementById('formModal');
                        container.insertAdjacentElement('beforeEnd',label);
                        container.insertAdjacentElement('beforeEnd',inpt);
                        
                    }
                }
            });
            var name =clicked_object.getAttribute('name');
            document.getElementById('ModalLabel').innerHTML = "Pré-candidature à la licence d'éducation.<br/> Filière: " + `<span class="text-info">${name}</span>`;
            $('#modalForm').modal('show');
        }

        function validate(){
            const href = document.getElementById("recu");
            const attributHref = href.getAttribute("href");
            if(attributHref =="#"){
                alert("vous devez remplir votre informations");
                // $('#exampleModal').modal('show');
            }
        }
</script>
@endsection

@extends('layouts.user_type.auth')
@section('content')
<style>
    @import "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css";

.bottom-right {
  position:absolute;
  bottom:20px;
  right:20px;
}
.center {
  position:absolute;
  top:50%;
  left:50%;
  transform:translate(-50%,-50%);
}
.popup {
  width:350px;
  height:280px;
  padding:30px 20px;
  background:#f5f5f5;
  border-radius:10px;
  box-sizing:border-box;
  z-index:2;
  text-align:center;
  opacity:0;
  top:-200%;
  transform:translate(-50%,-50%) scale(0.5);
  transition: opacity 300ms ease-in-out,
              top 1000ms ease-in-out,
              transform 1000ms ease-in-out;
}
.popup.active {
  opacity:1;
  top:50%;
  transform:translate(-50%,-50%) scale(1);
  transition: transform 300ms cubic-bezier(0.18,0.89,0.43,1.19);
}
.popup .icon {
  margin:5px 0px;
  width:50px;
  height:50px;
  border:2px solid #34f234;
  text-align:center;
  display:inline-block;
  border-radius:50%;
  line-height:60px;
}
.popup .icon i.fa {
  font-size:30px;
  color:#34f234;
} 
.popup .title {
  margin:5px 0px;
  font-size:30px;
  font-weight:600;
}
.popup .description {
  color:#222;
  font-size:15px;
  padding:5px;
}
.popup .dismiss-btn {
  margin-top:15px;
}
.popup .dismiss-btn button {
  padding:10px 20px;
  background:#111;
  color:#f5f5f5;
  border:2px solid #111;
  font-size:16px;
  font-weight:600;
  outline:none;
  border-radius:10px;
  cursor:pointer;
  transition: all 300ms ease-in-out;
}
.popup .dismiss-btn button:hover {
  color:#111;
  background:#f5f5f5;
}
.popup > div {
  position:relative;
  top:10px;
  opacity:0;
}
.popup.active > div {
  top:0px;
  opacity:1;
}
.popup.active .icon {
  transition: all 300ms ease-in-out 250ms;
}
.popup.active .title {
  transition: all 300ms ease-in-out 300ms;
}
.popup.active .description {
  transition: all 300ms ease-in-out 350ms;
}
.popup.active .dismiss-btn {
  transition: all 300ms ease-in-out 400ms;
}
</style>

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
        <div id="exampleModal"  class="popup center">
        <div class="icon">
            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
        </div>
        <div class="title">
            Attention!!
        </div>
        <div class="description">
            Veuillez remplir vos informations personnelles
        </div>
        <div class="dismiss-btn">
            <button id="dismiss-popup-btn">
            OK
            </button>
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
                // alert("Veuillez remplir vos informations personnelles");
                $('#exampleModal').modal('show');
            }
        }
</script>
@endsection

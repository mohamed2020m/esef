@extends('layouts.user_type.auth')

@section('content')
<div class="container text-center my-3">
    <div class="d-flex justify-content-center">
        <div>
            <div class="d-flex flex-wrap mb-2 subContainer">
                <div class="mx-2 box">
                    <div class="d-flex justify-content-center mb-3">
                        <div class=" py-2 px-3 text-white fw-bold rounded-circle" style="background-color: #0f233a;">1</div>
                    </div>
                    <a href={{url("/user-profile")}}>
                        <img src="../public/img/images dashboard/personalInfo.png"  alt="user-profile" width="200px" height="200px">
                    </a>
                    <div class="box-title">
                        <p>
                            Informations Personnels
                        </p>
                    </div>
                </div>
                <div class="mx-2 box">
                    <div class="d-flex justify-content-center mb-3">
                        <div class=" py-2 px-3 text-white fw-bold rounded-circle" style="background-color: #0f233a;">2</div>
                    </div>
                    <a href={{url("/condidat-academique")}}>
                        <img src="../public/img/images dashboard/diploma.png" alt="acadimiques" width="200px" height="200px" >
                    </a>
                    <div class="box-title">
                        <p>
                            Diplômes
                        </p>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-wrap mt-2 subContainer">
                <div class="mx-2 box">
                    <div class="d-flex justify-content-center mb-3">
                        <div class=" py-2 px-3 text-white fw-bold rounded-circle" style="background-color: #0f233a;">3</div>
                    </div>
                    <a href="#" id="dossier_condidat">
                        <img src="../public/img/images dashboard/folder.png" alt="dossier_condidat" width="200px" height="200px" onclick="valide_dossier()"/>
                    </a>
                    <div class="box-title">
                        <p>
                            Dossier Personnel
                        </p>
                    </div>
                </div>
                <div class="mx-2 box">
                    <div class="d-flex justify-content-center mb-3">
                        <div class=" py-2 px-3 text-white fw-bold rounded-circle" style="background-color: #0f233a;">4</div>
                    </div>
                    <a href="#" id="condidat">
                        <input type="text" value="{{$user_id}}" id="user_id" hidden>
                        <img src="../public/img/images dashboard/student.png" id="img_condidat" alt="" width="200px" height="200px" onclick="valide_condidature()"/>
                    </a>
                    <div class="box-title">
                        <p>
                            Candidatures
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


   <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <i class="fas fa-exclamation-circle align-items-center"></i>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <p>D'abord, vous devez finaliser l'étape (1) et l'étape (2)</p>
            </div>
        </div>
    </div>
</div>


@endsection
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script>
    $( document ).ready(
        function validate(){
            var state = false;
            var id = $('#user_id').val();
            var inpt = $('#condidat');
            $.ajax({
                type:"GET",
                url:"verification/user/"+id,
                dataType:"json",
                success:function(response){
                    var fname = response.user_data[0].first_name;
                    // var lname = response.user_data[0].last_name;
                    // var birth = response.user_data[0].birthday;
                    // var cin = response.user_data[0].cin

                    if(response.data[0] !=null && fname!=null ){
                        const a = document.querySelector('#condidat');
                        a.href = '/server.php/condidature';

                        const aa = document.querySelector('#dossier_condidat');
                        aa.href = '/server.php/dossier-personnelle';
                    }
                }
            });
        },

    );

    function valide_condidature(){
        const href = document.getElementById("condidat");
        const attributHref = href.getAttribute("href");
        if(attributHref =="#"){
            // alert("Veuillez remplir vos informations personnelles");
            $('#exampleModal').modal('show');
        }
    }

    function valide_dossier(){
        const href = document.getElementById('dossier_condidat');
        const attributHref = href.getAttribute('href');
        if(attributHref =="#"){
            // alert("Veuillez remplir vos informations personnelles");
            $('#exampleModal').modal('show');
        }
    }
</script>

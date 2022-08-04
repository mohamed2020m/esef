@extends('layouts.user_type.auth')

@section('content')
<div class="container text-center mt-2">
    <div class="d-flex justify-content-center">
        <div>
            <div class="d-flex flex-wrap mb-2 subContainer">
                <div class="mx-2 box">
                    <div class="d-flex justify-content-center mb-3">
                        <div class=" py-2 px-3 bg-white rounded-circle">1</div>
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
                        <div class=" py-2 px-3 bg-white rounded-circle">2</div>
                    </div>
                    <a href={{url("/condidat-académique")}}>
                        <img src="../public/img/images dashboard/diploma.png" alt="acadimiques" width="200px" height="200px">
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
                        <div class=" py-2 px-3 bg-white rounded-circle">3</div>
                    </div>
                    <a href="#" id="condidat">
                        <input type="text" value="{{$user_id}}" id="user_id" hidden>
                        <img src="../public/img/images dashboard/student.png" id="img_condidat" alt="" width="200px" height="200px"/>
                    </a>
                    <div class="box-title">
                        <p>
                            Candidatures    
                        </p>
                    </div>
                </div>
                <div class="mx-2 box">
                    <div class="d-flex justify-content-center mb-3">
                        <div class=" py-2 px-3 bg-white rounded-circle">4</div>
                    </div>
                    <a href="#" id="dossier_condidat">
                        <img src="../public/img/images dashboard/folder.png" alt="dossier_condidat" width="200px" height="200px">
                    </a>
                    <div class="box-title">
                        <p>
                            Dossier Personnel    
                        </p>
                    </div>
                </div>
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
                    // console.log(response.data[0].name !="");
                    if(response.data[0] !=null){
                        const a = document.querySelector('#condidat');
                        a.href = '/server.php/ps-filiere';
                    }
                    var fname = response.user_data[0].first_name;
                    var lname = response.user_data[0].last_name;
                    var birth = response.user_data[0].birthday;
                    var cin = response.user_data[0].cin
                    if(fname != null && lname != null && birth != null && cin != null && response.data[0] !=null){
                        const a = document.querySelector('#dossier_condidat');
                        a.href = '/server.php/dossier-personnelle';
                    }
                }
            });
        },

        // function valide(){

        // }

    );
</script>

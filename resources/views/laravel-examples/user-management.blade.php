@extends('layouts.user_type.auth')

@section('content')
    <div class="card mb-4 mx-4">
        <div class="card-header pb-0">
            <div class="d-flex flex-row justify-content-center">
                <div  sytle="text-overflow: ellipsis !important; overflow: hidden !important; width: 40px; white-space: nowrap !important;">
                    <h5 class="mb-0"><i class="fa fa-lg fa-check ps-2 pe-2 text-center text-dark" aria-hidden="true"></i>Sélectionnez une filière</h5>
                </div>
            </div>
        </div>
        <hr>
        <div class="card-body px-3 pt-0 pb-2">
            <div class="row aling-items-center mb-3">
                <div class="col-10">
                    <form action="" method="">
                        @csrf
                        <select class="form-select form-select-lg select_filiere" style="border-color:#0f233a !important; box-shadow:none !important" aria-label="Default select example"  name="filiere"  required>
                            <option disabled selected>Sélectionner une filière</option>
                            @foreach($data_filiere as $row)
                            <option value="{{$row->id}}">{{$row->name}}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
                <!-- <a href="" class="" data-bs-toggle="tooltip" data-bs-original-title="supprimer Bac" onclick="return confirm('est ce que vous etes sur ?')">
                    <i class="cursor-pointer fa fa-file-excel text-white bg-success rounded p-3" style="font-weight:normal"></i>
                    Export
                </a> -->
                <div class="col-2 d-flex">
                    <button class="text-white font-weight-bold px-2 border-0 bg-secondary flex-grow-1 rounded " id="btn_export" type="button" data-bs-toggle="modal" data-bs-target="#export">
                        <i class="fa fa-file-excel me-sm-1"></i>
                        <span class="d-sm-inline d-none" id="span_export">Export</span>
                    </button>
                </div>
            </div>
            <div class="table-responsive p-0">
                <table class="table table-striped table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                ID
                            </th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Photo
                            </th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Nom
                            </th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Prénom
                            </th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                CIN
                            </th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                CNE
                            </th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Score
                            </th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                
                            </th>
                        </tr>
                    </thead>
                    <tbody id="UserDataTable">
                        <tr class="align-middle" style="font-size: 18px;">
                            <td colspan="8" class="text-center">Sélectionner une filière &#128515;</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="model_wrapper"></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">

    $(document).ready(function(){

        $(document).on('change','.select_filiere',function(){
            let filiere_id= $(this).val();
            let table="";
            let model="";
            let gone = false;
            $.ajax({
                type:'get',
                url:'{{URL::to("candidatsList")}}',
                data:{'id':filiere_id},
                success: function(data){
                    for(var i=0;i<data.length;i++){
                        table += 
                        `<tr class="align-middle" style="font-size: 18px;">
                            <td class="text-center"><p class="font-weight-bold mb-0"> ${data[i].id}</p></td>
                            <td class="text-center"><img src="../public/images/images_profiles/${data[i].photo}" alt="avatar" class="avatar avatar-sm me-3"></td>
                            <td class="text-center"><p class="font-weight-bold mb-0">${data[i].last_name}</p></td>
                            <td class="text-center"><p class="font-weight-bold mb-0">${data[i].first_name}</p></td>
                            <td class="text-center"><p class="font-weight-bold mb-0">${data[i].cin}</p></td>
                            <td class="text-center"><p class="font-weight-bold mb-0">${data[i].cne}</p></td>
                            <td class="text-center"><p class="font-weight-bold mb-0">${data[i].score}</p></td>
                            <td class="text-center">
                                <a href="/server.php/user-management-${data[i].id}" class="mr-3" data-bs-toggle="tooltip" data-bs-original-title="view condidature">
                                    <i class="fas fa-eye text-white bg-warning rounded-circle p-3" style="font-weight:normal"></i>
                                </a>
                            </td>
                        </tr>`
                    }  
                    $("#UserDataTable" ).html(table);
                    model += `<div class="modal fade" id="export" tabindex="-1" aria-labelledby="exportModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exportModalLabel">Exporter candidatures</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="text-danger">Vous êtes sur le point d'exporter la filière sélectionnée</p>
                                </div>
                                <div class="modal-footer d-flex align-items-center">
                                    <button type="button" class="btn btn-secondary mt-3 rounded-pill" data-bs-dismiss="modal">Annuler</button>
                                    <a href="/server.php/condidatures-export/${filiere_id}" id="export_btn" class="bg-success rounded-pill px-3 py-2" data-bs-toggle="tooltip" data-bs-original-title="supprimer Bac"> 
                                        <!-- onclick="return confirm('est ce que vous etes sur ?')"> -->
                                        <span class="d-sm-inline d-none text-whit px-3" id="span_export">Export</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>`
                    $("#btn_export").addClass("bg-success").removeClass("bg-secondary");
                    
                    $("#model_wrapper").html(model);
                },
                error:function(){
                    console.log("error")
                }
            });
        });
    });

</script>

@endsection


@extends('layouts.user_type.auth')

@section('content')
    <div class="card mb-4 mx-4">
        <div class="card-header pb-0">
            <div class="d-flex flex-row justify-content-center">
                <div  sytle="text-overflow: ellipsis !important; overflow: hidden !important; width: 40px; white-space: nowrap !important;">
                    <h5 class="mb-0"><i class="fa fa-lg fa-check ps-2 pe-2 text-center text-dark" aria-hidden="true"></i>Selectioner une filière</h5>
                </div>
            </div>
        </div>
        <hr>
        <div class="card-body px-3 pt-0 pb-2">
            <div class="mb-3">
                <form action="" method="">
                    @csrf
                    <select class="form-select form-select-lg select_filiere" style="border-color:#0f233a !important; box-shadow:none !important" aria-label="Default select example"  name="filiere"  required>
                        @foreach($data_filiere as $row)
                        <option value="{{$row->id}}">{{$row->name}}</option>
                        @endforeach
                    </select>
                </form>
            </div>
            <div class="table-responsive p-0">
                <table class="table table-striped table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
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
                                
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="align-middle" style="font-size: 18px;">
                            <td class="ps-4">
                                <p class="font-weight-bold mb-0">------</p>
                            </td>
                            <td class="text-center">
                                <p class="font-weight-bold mb-0">---</p>
                            </td>
                            <td class="text-center">
                                <p class="font-weight-bold mb-0">---</p>
                            </td>
                            <td class="text-center">
                                <p class="font-weight-bold mb-0">---</p>
                            </td>
                            <td class="text-center">
                                <p class="font-weight-bold mb-0">---</p>
                            </td>
                            <td class="text-center">
                                <p class="font-weight-bold mb-0">---</p>
                            </td>
                            <td class="text-center">
                                <a href="#" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="modifier Bac">
                                    <i class="fas fa-edit text-white bg-warning rounded-circle p-3" style="font-weight:normal"></i>
                                </a>
                                <a href="#" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="supprimer Bac" onclick="return confirm('est ce que vous etes sur ?')">
                                    <i class="cursor-pointer fa fa-trash text-white bg-danger rounded-circle p-3" style="font-weight:normal"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){

        $(document).on('change','.select_filiere',function(){
          //console.log("hmm");
            var filiere_id=$(this).val();
            var op="";
            var table="";
            
            //console.log(filiere_id);
            $.ajax({
                type:'get',
                // url:'{!!URL::to('candidatsList')!!}',
                data:{'id':filiere_id},
                success: function(data){
                    //console.log("succes");
                    //console.log(data);
                    //console.log(data.length);
                
                    for(var i=0;i<data.length;i++){
                        
                        table+='<tr>';
                        table+= '<td class="ps-4"><p class="text-xs font-weight-bold mb-0"> '+data[i].id+'</p></td>';
                        table+='<td><div><img src="" class="avatar avatar-sm me-3"></div></td>';
                        table+= '<td class="ps-4"><p class="text-xs font-weight-bold mb-0"> '+data[i].last_name+'</p></td>';
                        table+= '<td class="ps-4"><p class="text-xs font-weight-bold mb-0"> '+data[i].first_name+'</p></td>';
                        table+= '<td class="ps-4"><p class="text-xs font-weight-bold mb-0"> '+data[i].cin+'</p></td>';
                        table+= '<td class="ps-4"><p class="text-xs font-weight-bold mb-0"> '+data[i].cne+'</p></td>';
                        table+='<td class="text-center"><a href="" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="View user"><i class="fas fa-address-card"></i></a></td>';
                        table+='</tr>';
                    }  
                    $( ".select_candidat" ).html("");
                    $( ".select_candidat" ).append(op);
                    $( ".tableview" ).html("");
                    $( ".tableview" ).html(table);
                },
                error:function(){
                }
            });
        });
    });

</script>

@endsection


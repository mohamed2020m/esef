@extends('layouts.user_type.auth')

@section('content')

<div>
   
    <form  action="" method="">
   
   <div class="form-group">
      <label for="exampleFormControlSelect1">Selectioner une filière</label>
      <select class="form-select select_filiere" aria-label="Default select example"  name="filiere"  required>
            @foreach($data_filiere as $row)
             <option value="{{$row->id}}">{{$row->name}}</option>
            @endforeach
      </select>

  </div>


  <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0 ">
                    <table class="table align-items-center mb-0">
                    <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
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
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="tableview">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</form>
  
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
                url:'{!!URL::to('candidatsList')!!}',
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


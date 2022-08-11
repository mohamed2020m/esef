@extends('layouts.user_type.auth')

@section('content')
    <div class="card mb-4 ml-auto">
            <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0"><i class="fa fa-lg fa-gear ps-2 pe-2 text-center text-dark" aria-hidden="true"></i>Gestion des utilisateurs</h5>
                        </div>
                        <a href="/server.php/admin-create" class="btn btn-sm mb-0" type="button" style="background-color: #0f233a !important;color:white">+&nbsp; Nouveau utilisateur</a>
                    </div>
            </div>
        <hr>
        <div class="card-body px-3 pt-0 pb-2 mt-4 ">
            <div class="table-responsive p-0 ">
                <table id='empTable' class="table table-striped table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                ID
                            </th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Nom
                            </th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Prénom
                            </th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Email
                            </th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Role
                            </th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                État
                            </th>

                            
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


<script>

    $(document).ready(function() {


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        let users = $('#empTable').DataTable({
            "serverSide": true,
            "ajax": {
                url: "{{route('getUtilisateurs') }}", 
                method: "get",
                columns: [
                    { data: 'id' },
                    { data: 'first_name'},
                    { data: 'last_name'},
                    { data: 'email'},
                    {data: 'role'},
                    {data: 'state'},
                    
                ]
                
            },
            columnDefs: [ {     
                                "targets": -1,
                                "render": function ( data, type, row) {

                                    if ( data == "0"){
                                        return ' <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">Activer</button>';
                                    }else{
                                        return '<button type="button" class="btn btn-danger">Désactiver</button>';
                                    }
                                    

                                   
                                                      
                                },                      
                                                          
                                } ],

           // "fnDrawCallback": function( row, data ) {     
              //  $('.mySwitch').bootstrapToggle(
                //    {
                  //     on: 'Activé',
                    //   off: 'Désactivé',
                      // onstyle: "success",
                      // offstyle:"danger" ,
                      //size:"mini"
                   //});

                   
               // },           
                                
            "language": {
                "lengthMenu": "Afficher _MENU_ enregistrements par page",
                "zeroRecords": "Rien n'a été trouvé",
                "info": "Affichage de la page _PAGE_ sur _PAGES_",
                "infoEmpty": "Aucun enregistrement disponible",
                "infoFiltered": "(filtré à partir de _MAX_ enregistrements au total)",
                "paginate": {
                    "first":      "Première",
                    "last":       "Dernier",
                    "next":       "Suivant",
                    "previous":   "Précédent"
                },
                "search":         "Chercher:",
                "loadingRecords": "Chargement...",
            }
        });


        
    

       



       $('#empTable tbody').on('click', 'button', function () {
                
                let name= users.row($(this).parents('tr')).data();
                let id=name[0];
                console.log("click");
                

                $.ajax({ 
          
            url: "/server.php/state/"+id,
            type: 'PUT',
            dataType : "json",
            data: {id:id},
            success: function(data){
                
                //window.location.href='https://esefj.ma/server.php/utilisateurs';
                console.log(data.success);
                console.log(data.state);
               
               

            },
            error:function(err){
                console.log(err);
            }
                })


                

              
       })   


            



    })
    

</script> 
    
@endsection


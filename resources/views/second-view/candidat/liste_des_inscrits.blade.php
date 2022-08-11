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


<script>





    $(document).ready(function() {



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
                                        return '<input type="checkbox"  class ="mySwitch"   data-toggle="toggle">';
                                    }else{
                                        return '<input type="checkbox"  class ="mySwitch" checked  data-toggle="toggle">';
                                    }
                                    

                                   
                                                      
                                },                      
                                                          
                                } ],

            "fnDrawCallback": function( row, data ) {     
                $('.mySwitch').bootstrapToggle(
                    {
                       on: 'Activé',
                       off: 'Désactivé',
                       onstyle: "success",
                       offstyle:"danger" ,
                      size:"mini"
                   });

                   
                },           
                                
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


        
        $('#empTable').on('click', 'tr td:eq(5)', function () {
                console.log("checkBox");
                let name= users.row( this ).data();
                let state_value=name[0];
                console.log( state_value );

                
                


                    });

    })
</script> 
    
@endsection


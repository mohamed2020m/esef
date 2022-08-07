@extends('layouts.user_type.auth')

@section('content')
    <div class="card mb-4 ml-auto">
        <div class="card-header pb-0">
            <div class="d-flex flex-row justify-content-center">
                <div  sytle="text-overflow: ellipsis !important; overflow: hidden !important; width: 40px; white-space: nowrap !important;">
                    <h5 class="mb-0"><i class="fa fa-lg fa-check ps-2 pe-2 text-center text-dark" aria-hidden="true"></i>La liste des candidats inscrits</h5>
                </div>
            </div>
        </div>
        <hr>
        <div class="card-body px-3 pt-0 pb-2 ">
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
                                CIN
                            </th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Role
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>


<script>
    $(document).ready(function() {
        $('#empTable').DataTable({
            "serverSide": true,
            "processing": true,
            "ajax": {
                url: "{{route('getUtilisateurs') }}", 
                method: "get",
                columns: [
                    { data: 'id' },
                    { 
                        data: 'first_name',
                        "defaultContent":"Pas encore défini"
                    },
                    { 
                        data: 'last_name',
                        "defaultContent":"Pas encore défini"
                    },
                    { 
                        data: 'cin',
                        "defaultContent":"Pas encore défini"
                    },
                    { 
                        data: 'role',
                        render: function ( data, type, row){
                            console.log("data: ", data)
                            if(data == 'normal user'){
                                return 'condidat'
                            }
                        }  
                    },
                ]
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
    })
</script>
    
@endsection


@extends('layouts.user_type.auth')

@section('content')
    <div class="card mb-4 mx-4">
        <div class="card-header pb-0">
            <div class="d-flex flex-row justify-content-center">
                <div  sytle="text-overflow: ellipsis !important; overflow: hidden !important; width: 40px; white-space: nowrap !important;">
                    <h5 class="mb-0"><i class="fa fa-lg fa-check ps-2 pe-2 text-center text-dark" aria-hidden="true"></i>La liste des candidats inscrits</h5>
                </div>
            </div>
        </div>
        <hr>
        <div class="card-body px-3 pt-0 pb-2 ml-auto">
           
            <div class="table-responsive p-0 ">
                <table  id='empTable' class="table table-striped table-hover mb-0">
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
        "ajax": {
            url: "{{route('getUtilisateurs') }}", 
            method: "get",
            columns: [
                 { data: 'id' },
                 { data: 'photo' },
                 { data: 'first_name' },
                 { data: 'last_name' },
                 { data: 'cin' },
                 { data: 'role' },
             ]
        },
       
    });
});
</script>
    
@endsection


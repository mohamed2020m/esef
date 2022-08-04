


@extends('layouts.user_type.auth')

@section('content')



    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Gestion des series de Bac</h5>
                        </div>
                        <a href="/server.php/bac_create" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; Nouvelle serie de bac</a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Name
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach($data_bac as $key =>$item)
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{$item->id}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{$item->name}} </p>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{url('/updatebac-'.$item->id)}}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="modifier Bac">
                                            <!-- <i class="fas fa-user-edit text-secondary"></i> -->
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{url('/bac_delete-'.$item->id)}}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="supprimer Bac" onclick="return confirm('est ce que vous etes sur ?')">
                                            <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                        </a>
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







    
@endsection

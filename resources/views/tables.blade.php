


@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="alert alert-secondary mx-4" role="alert">
        <span class="text-white">
            <strong>Add, Edit, Delete features are not functional!</strong> This is a
            <strong>PRO</strong> feature! Click <strong>
            <a href="https://www.creative-tim.com/live/soft-ui-dashboard-pro-laravel" target="_blank" class="text-white">here</a></strong>
            to see the PRO product!
        </span>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Gestion des series de Bac</h5>
                        </div>
                        <a href="/bac/create" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; Nouvelle serie de bac</a>
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
                                        <a href="{{url('/updatebac/'.$item->id)}}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="modifier Bac">
                                            <!-- <i class="fas fa-user-edit text-secondary"></i> -->
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{url('bac/delete/'.$item->id)}}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="supprimer Bac" onclick="return confirm('est ce que vous etes sur ?')">
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
</div>




<div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Gestion des Matieres</h5>
                        </div>
                        <a href="/matiere/create" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; Nouvelle Matiere</a>
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
                                @foreach($data_matiere as $key =>$item)
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{$item->id}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{$item->name}} </p>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{url('/update/'.$item->id)}}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="modifier La Matiere">
                                            <!-- <i class="fas fa-user-edit text-secondary"></i> -->
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{url('matiere/delete/'.$item->id)}}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="supprimer La matiere" onclick="return confirm('est ce que vous etes sur ?')">
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
</div>



<div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Gestion des Licences</h5>
                        </div>
                        <a href="/licence/create" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; Nouvelle Licence</a>
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
                                @foreach($data_licence as $key =>$item)
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{$item->id}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{$item->name}} </p>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{url('/updatelicence/'.$item->id)}}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="modifier La Licence">
                                            <!-- <i class="fas fa-user-edit text-secondary"></i> -->
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{url('licence/delete/'.$item->id)}}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="supprimer La Licence" onclick="return confirm('est ce que vous etes sur ?')">
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
</div>

 

  @endsection

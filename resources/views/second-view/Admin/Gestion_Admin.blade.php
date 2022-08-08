


@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0"><i class="fa fa-lg fa-gear ps-2 pe-2 text-center text-dark" aria-hidden="true"></i>Gestion des administrateurs</h5>
                        </div>
                        <a href="/server.php/bac-create" class="btn btn-sm mb-0" type="button" style="background-color: #0f233a !important;color:white">+&nbsp; Ajoutez un Administrateur</a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table table-striped table-hover mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
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
                                        
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach($admins as $key =>$item)
                                <tr class="align-middle" style="font-size: 18px;">
                                    <td class="ps-4">
                                        <p class="font-weight-bold mb-0">{{$item->id}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="font-weight-bold mb-0">{{$item->first_name}} </p>
                                    </td>
                                    <td class="text-center">
                                        <p class="font-weight-bold mb-0">{{$item->last_name}} </p>
                                    </td>
                                    <td class="text-center">
                                        <p class="font-weight-bold mb-0">{{$item->email}} </p>
                                    </td>
                                    <td class="text-center">
                                        <p class="font-weight-bold mb-0">{{$item->role}} </p>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{url('/updatebac-'.$item->id)}}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="modifier Bac">
                                            <i class="fas fa-edit text-white bg-warning rounded-circle p-3" style="font-weight:normal"></i>
                                        </a>
                                        <a href="{{url('bac/delete-'.$item->id)}}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="supprimer Bac" onclick="return confirm('est ce que vous etes sur ?')">
                                            <i class="cursor-pointer fa fa-trash text-white bg-danger rounded-circle p-3" style="font-weight:normal"></i>
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

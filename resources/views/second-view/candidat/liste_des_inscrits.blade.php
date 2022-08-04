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
        <div class="card-body px-3 pt-0 pb-2">
           
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
                    @foreach($inscrits as $key =>$item)
                        <tr class="align-middle" style="font-size: 18px;">

                            <td class="ps-4">
                                <p class="font-weight-bold mb-0">{{$item->id}}</p>
                            </td>

                            <td>
                                <div>
                                    <img src="{{ URL::to('../public/images/images_profiles/'. $item->photo) }}" class="avatar avatar-sm me-3">
                                </div>
                            </td>

                            <td class="text-center">
                                <p class="font-weight-bold mb-0">{{$item->last_name}}</p>
                            </td>

                            <td class="text-center">
                                <p class="font-weight-bold mb-0">{{$item->first_name}}</p>
                            </td>
                            <td class="text-center">
                                <p class="font-weight-bold mb-0">{{$item->cin}}</p>
                            </td>
                            <td class="text-center">
                                <p class="font-weight-bold mb-0">{{$item->cne}}</p>
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
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection


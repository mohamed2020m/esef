@extends('layouts.user_type.auth')

@section('content')

<div>
    

    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">

                <div class="card-header pb-0">    
                    <div class="form-group">
                         <label for="exampleFormControlSelect1">Selectioner une filière</label>
                         <select class="form-select select_filiere" aria-label="Default select example" id="filiere" name="filiere"  onchange="selectfiliere()" required>
                         @foreach($data_filiere as $row)
                         <option value="{{$row->id}}">{{$row->name}}</option>
                         @endforeach
                        </select>
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
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Photo
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nom
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Email
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        role
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Creation Date
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $key =>$item)
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{$item->id}}</p>
                                    </td>
                                    <td>
                                        <div>
                                            <img src="{{ URL::to('../public/images/images_profiles/'. $item->photo) }}" class="avatar avatar-sm me-3">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{$item->first_name}} {{$item->last_name}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{$item->email}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{$item->role}}</p>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{$item->created_at}}</span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ url('user-management-'.$item->id) }}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="View user">
                                            <!-- <i class="fas fa-user-edit text-secondary"></i> -->
                                            <i class="fas fa-address-card"></i>
                                        </a>
                                        <a href="{{ url('delete/user/'.$item->id) }}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Delete user" onclick="return confirm('Are you sure to want to delete it?')">
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

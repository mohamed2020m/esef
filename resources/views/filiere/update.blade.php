@extends('layouts.user_type.auth')

@section('content')
    <div class="m-3">
        <a  id="backto" href="https://esef.toubkalit.com/server.php/filiere"><i class="fa fa-lg fa-arrow-left ps-2 pe-2 text-center text-dark" aria-hidden="true"></i>Retour</a>
    </div>
    <div class="card mb-4 mx-4">
        <div class="card-header pb-0">
            <div class="d-flex flex-row justify-content-between">
                <div sytle="text-overflow: ellipsis !important; overflow: hidden !important; width: 40px; white-space: nowrap !important;">
                    <h5 class="mb-0"><i class="fa fa-lg fa-edit ps-2 pe-2 text-center text-dark" aria-hidden="true"></i>Modifier Filières</h5>
                </div>
            </div>
        </div>
        <hr>
        <div class="card-body px-3 py-2 overflow-auto">
            @foreach($data_filiere as $key => $item)
            <form id="create_filiere" action="{{url('/filiere/update/'.$item->id)}}" method="POST"  enctype="multipart/form-data" >
                @csrf
                <div class="">
                    <div class="mb-3">
                        <label class="form-label" for="filiere_name">Nom de Filières</label>
                        <input type="text" class="form-control" name="filiere_name" id="filiere_name" value="{{$item->name}}" placeholder="Nom de filiere" required>
                    </div>

                    <div class="d-flex p-3 my-3 border rounded">
                        <div class="flex-grow-1 row">
                            <div class="col-4">
                                <div>
                                    <label>BAC :</label>
                                    @foreach($data_bac as $key =>$item)
                                    <div class="form-check mb-3">
                                        <input class="form-check-input box" data-box="bac-{{$item->id}}" type="checkbox" name="checkbox_bac[]" value="{{$item->id}}" >
                                        <label class="form-check-label" >{{$item->name}}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
        
                            <div class="col-4">
                                <label>Bonus :</label>
                                @foreach($data_bac as $key =>$item)
                                <div class="mb-2">
                                    <input class="form-control bac-{{$item->id}}" type="number" min="0" name="{{'bonus_bac'.$item->id}}" disabled>
                                </div>
                                @endforeach
                            </div>
    
                            <div class="col-4">
                                <label>Coefficient :</label>
                                @foreach($data_bac as $key =>$item)
                                <div class="mb-2">
                                    <input class="form-control bac-{{$item->id}}" type="number" min="0" name="{{'coefficient_bac'.$item->id}}" disabled>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center p-3 my-3 border rounded">
                        <div class="flex-grow-1 row">
                            <div class="col-6">
                                <label>Matières :</label>
                                @foreach($data_matiere as $key =>$item)
                                <div class="form-check mb-3">
                                    <input class="form-check-input box" data-box="matiere-{{$item->id}}" type="checkbox" name="checkbox_matiere[]" value="{{$item->id}}"  >
                                    <label class="form-check-label" >{{$item->name}} </label>
                                </div>
                                @endforeach
                            </div>
                            <div class="col-6">
                                <label>Coefficient :</label>
                                @foreach($data_matiere as $key =>$item)
                                <div class="mb-2">
                                    <input class="form-control matiere-{{$item->id}}" type="number" min="0" name="{{'coefficient_matiere'.$item->id}}" disabled>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center p-3 my-3 border rounded">
                        <div class="flex-grow-1 row">
                            <div class="col-4">
                                <label>Licence :</label>
                                @foreach($data_licence as $key =>$item)
                                <div class="form-check mb-3">
                                    <input class="form-check-input box" data-box="licence-{{$item->id}}" type="checkbox" name="checkbox_licence[]" value="{{$item->id}}">
                                    <label class="form-check-label" >{{$item->name}}</label>
                                </div>
                                @endforeach
                            </div>
                            <div class="col-4">
                                <label>Bonus :</label>
                                @foreach($data_licence as $key =>$item)
                                <div class="mb-2">
                                    <input class="form-control licence-{{$item->id}}" type="text"  name="{{'bonus_licence'.$item->id}}" disabled>
                                </div>
                                @endforeach
                            </div>
                            <div class="col-4">
                                <label>Coefficient</label>
                                @foreach($data_licence as $key =>$item)
                                <div class="mb-2">
                                    <input class="form-control licence-{{$item->id}}" type="text"  name="{{'coefficient_licence'.$item->id}}" disabled >
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="mb-3 d-flex justify-content-end">
                    <button type="submit" class="btn" style="background-color: #0f233a !important;color:white">Modifier</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.box').forEach(checkbox => {
                checkbox.addEventListener('click', function(){
                    if(!checkbox.checked){
                        console.log("hide")
                        hideInputs(this.dataset.box);
                    }
                    else{
                        console.log("show")
                        showInputs(this.dataset.box);
                    }
                })
            })
        })

        function showInputs(box) {
            document.querySelectorAll(`.${box}`).forEach(item => {
                console.log("removed")
                item.removeAttribute("disabled");
            })
        }

        function hideInputs(box){
            document.querySelectorAll(`.${box}`).forEach(item => {
                item.setAttribute("disabled", "disabled");
            })
        }
    </script>

@endsection
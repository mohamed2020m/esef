@extends('layouts.user_type.auth')

@section('content')
@foreach($data_filiere as $key => $item)
    <form class="container" action="{{url('/filiere/update/'.$item->id)}}" method="POST"  enctype="multipart/form-data">
    @csrf
        <div class="row align-items-start"  >
             <div class="mb-3">
                  <label class="form-label" for="name">Nom de la filière</label>
                  <input type="text" value="{{$item->name}}" name="name" id="name" class="form-control" required />
             </div>

        <div class="col">
            <label>BAC :</label>
            @foreach($data_bac as $key =>$item)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="checkbox_bac[]"   id ="{{$item->id}}"     value="{{$item->id}}"   >
                <label class="form-check-label" >{{$item->name}}</label>
            </div>
            @endforeach
        </div>

        <div class="col"  >
            <div class="mb-3 " >
                <label>Bonus :</label>
                @foreach($data_bac as $key =>$item)
                <div class="form-check bonus_bac {{$item->id}}"  id="{{'bonus_bac'.$item->id}}" >
                    <input class="form-input" type="number"  min="0" name="{{'bonus_bac'.$item->id}}" placeholder="{{'bonus de '.$item->name}}"  >
                </div>
                @endforeach
            </div>
        </div>

        <div class="col" class="bac">
            <div class="mb-3 ">
                <label>Coefficient :</label>
                @foreach($data_bac as $key =>$item)
                <div class="form-check coefficient_bac"    id="{{'coefficient_bac'.$item->id}}" >
                    <input class="form-input" type="number" min="0" name="{{'coefficient_bac'.$item->id}}"  placeholder="{{'coefficient de '.$item->name}}" >
                </div>
                @endforeach
            </div>
        </div>

        <div class="col">
            <div class="mb-3 ">
                <label>Matiere :</label>
                @foreach($data_matiere as $key =>$item)  
                <div class="form-check" >
                    <input class="form-check-input" type="checkbox" name="checkbox_matiere[]" id="'matiere'.{{ $item->id}}"   value="{{$item->id}}">
                    <label class="form-check-label" >{{$item->name}} </label>
                </div>
                @endforeach
            </div>
        </div>

        <div class="col">
            <div class="mb-3 ">
                <label>Coefficient :</label>
                @foreach($data_matiere as $key =>$item)
                <div class="form-check coefficient_matiere "  id="{{'coefficient_matiere'.$item->id}}"   >
                    <input class="form-input" type="number" min="0" name="{{'coefficient_matiere'.$item->id}}" placeholder="{{'coefficient de '.$item->name}}" >
                </div>
                @endforeach
            </div>
        </div>
    </div>
                 
    <div class="row align-items-start">
            <div class="col">
                <div class="mb-3 ">
                    <label>Licence :</label>
                    @foreach($data_licence as $key =>$item)
                    <div class="form-check ">
                        <input class="form-check-input" type="checkbox" name="checkbox_licence[]" value="{{$item->id}}" id="'licence'.{{ $item->id}}">
                        <label class="form-check-label" >{{$item->name}}</label>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col"  >
                <div class="mb-3 " style="margin-left:-190px;">
                    <label>Bonus :</label>
                    @foreach($data_licence as $key =>$item)
                    <div class="form-check bonus_licence" id="{{'bonus_licence'.$item->id}}">
                        <input class="form-input" type="text"  name="{{'bonus_licence'.$item->id}}" placeholder="{{'bonus de '.$item->name}}" >
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col"  >
                <div class="mb-3 " style="margin-left: -320px;">
                    <label>Coefficient</label>
                    @foreach($data_licence as $key =>$item)
                    <div class="form-check coefficient_licence" id="{{'coefficient_licence'.$item->id}}">
                        <input class="form-input" type="text"  name="{{'coefficient_licence'.$item->id}}" placeholder="{{'coefficient de '.$item->name}}" >
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
              




             
            @endforeach
        <button type="submit" class="btn btn-success">modifier</button>
    </form>

    
  <script>
  //disparaition des input pour bonus bac  
    var bonusBacs=document.querySelectorAll('.bonus_bac');
  bonusBacs.forEach(function(el) {el.style.display = 'none';});
    //disparaition des input pour coefficient bac  
  var bonusBacs=document.querySelectorAll('.coefficient_bac');
  bonusBacs.forEach(function(el) {el.style.display = 'none';})
  ;
  var bonusBacs=document.querySelectorAll('.coefficient_matiere');
  bonusBacs.forEach(function(el) {el.style.display = 'none';})
  ;
  var bonusBacs=document.querySelectorAll('.bonus_licence');
  bonusBacs.forEach(function(el) {el.style.display = 'none';})
  ;
  var bonusBacs=document.querySelectorAll('.coefficient_licence');
  bonusBacs.forEach(function(el) {el.style.display = 'none';})
  ;

    
  
//controle de checkbox  bac et affichage de input  correspoandant pour chaque bonus bac et coefficient bac 
@foreach($data_bac as $key =>$item)
            document.getElementById("{{ $item->id}}").addEventListener('change', function(e) {
                if(this.checked){
                    document.getElementById('{{'bonus_bac'.$item->id}}').style.display='block';
                    document.getElementById('{{'coefficient_bac'.$item->id}}').style.display='block';
                 
                 
                    
                }else{
                    document.getElementById('{{'bonus_bac'.$item->id}}').style.display='none';
                    document.getElementById('{{'coefficient_bac'.$item->id}}').style.display='none';
                }
                
                
            })
            @endforeach



            @foreach($data_matiere as $key =>$item)
            document.getElementById("'matiere'.{{ $item->id}}").addEventListener('change', function(e) {
                if(this.checked){
                    document.getElementById('{{'coefficient_matiere'.$item->id}}').style.display='block';
                }else{
                    
                    document.getElementById('{{'coefficient_matiere'.$item->id}}').style.display='none';
                } 
            })
            @endforeach

            @foreach($data_licence as $key =>$item)
            document.getElementById("'licence'.{{ $item->id}}").addEventListener('change', function(e) {
                if(this.checked){
                    document.getElementById('{{'bonus_licence'.$item->id}}').style.display='block';
                    document.getElementById('{{'coefficient_licence'.$item->id}}').style.display='block';
                }else{
                    document.getElementById('{{'bonus_licence'.$item->id}}').style.display='none';
                    document.getElementById('{{'coefficient_licence'.$item->id}}').style.display='none';
                }
                
                
            })
            @endforeach
  </script>
@endsection

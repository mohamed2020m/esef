

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/resources/sass/css.scss">
    <title>Document</title>

    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
        }
        #titre p{
            font-size: 26px;
        }
        #post_condidat{
            font-size: 25px;
            text-align: center;
            margin-top: 50px;
        }
    </style>
</head>

<body>
    {{-- <div style="display:grid;grid-template-columns: 300px auto;">
        <div>
            <img src="../assets/img/newLogo.png" style="width:100%" height="100px" alt="ESEF Logo">
        </div>
        <div>
            <img src="../assets/img/esef.png"  style="max-width:100%" alt="Logo de Université Chouaib Doukkali">
        </div>
    </div>
     --}}
    <div style="display:grid;grid-template-columns: 150px auto;">
        <div style="display:grid;justify-content: center;">
            <img src="../assets/img/newLogo.png" style="width:80px; height: 80px" alt="ESEF Logo">
        </div>
        <div style="display:grid;justify-content: end;">
            <img src="../assets/img/esef.png"  style="width:100%;" alt="Logo de Université Chouaib Doukkali">
        </div>
    </div>
    <div class="container">
        <div id="titre" style="display: flex; justify-content:center;margin-top: 40px;">
            <p style="text-decoration: underline; text-align:center">Fiche de pré-candidature </p>
        </div>
        <div id="attestation">
            <div>
                <div style="display:flex; flex-direction:column;justify-content:center;border:1px solid rgb(157, 157, 157); padding:10px">
                    @foreach ($user_data as $item)
                    <p><span style="width:300px">Nom </span>:<strong style="text-transform: uppercase;margin-top:30px">{{$item->last_name}} </strong> </p>
                    <p><span style="width:100px">Prénom</span>:<strong style="text-transform: uppercase;">{{$item->first_name}}</strong> </p>
                    <p><span style="width:100px">CIN </span>:<strong> {{$item->cin}}</strong></p>
                    <p><span style="width:100px">Email </span>:<strong> {{$item->email}}</strong></p>
                    <p><span style="width:100px">Téléphone </span>:<strong> {{$item->phone}}</strong></p>
                    @endforeach
                </div>
                
                <div>
                    <p id="post_condidat" style="text-decoration: underline">CANDIDATURE à la FILIÈRE</p>
                    <p>Etablissement :<strong> Ecole Supérieure d'Education et de Formation (ESEF) - EL JADIDA</strong></p>
                    <p>Spécialité :<strong>{{$filiere_data[0]->name}}</strong></p>
                    <p>Reçu LE : <strong>{{$register_in_filiere_at[0]->date}}</strong></p>
                </div>
            </div>
        </div>
    </div>
    <div style="position:fixed;bottom:0;">
        <hr>
        <div style="font-size: 10; display:flex;flex-wrap: wrap;">Route Nationale N°1 (Route AZEMMOUR), Km6, HAOUZIA BP:5096 ElJadida Plateau 24002</div>
        <div style="font-size: 10; display:flex;flex-wrap: wrap;font-weight:bold"> Téléphone: 0523 39 56 79-0523 34 48 22 /fax : 0523 39 49 15</div>
    </div>
</body>
</html>


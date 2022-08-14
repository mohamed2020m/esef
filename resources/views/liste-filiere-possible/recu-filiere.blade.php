

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
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

        #logos{
            display:grid;
            grid-template-columns: 150px auto;
        }
        #logo_1{
            display:grid;
            justify-content: center;
        }
        #logo_2{
            display:grid;
            justify-content: end;
        }
        #logo_1_img{
            width:80px; 
            height: 80px
        }
        #logo_2_img{
            width:600px;
        }
        .dt{
            width:100px;
        }
    </style>
</head>

<body>
    <div id="logos">
        <div id="logo_1">
            <img id="logo_1_img" src="../assets/img/newLogo.png" alt="ESEF Logo">
        </div>
        <div id="logo_2">
            <img id="logo_2_img" src="../assets/img/esef.png" alt="Logo de Université Chouaib Doukkali">
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
                    <p><span class="dt">Nom </span>:<strong style="text-transform: uppercase;margin-top:30px">{{$item->last_name}} </strong> </p>
                    <p><span class="dt">Prénom</span>:<strong style="text-transform: uppercase;">{{$item->first_name}}</strong> </p>
                    <p><span class="dt">CIN </span>:<strong> {{$item->cin}}</strong></p>
                    <p><span class="dt">Email </span>:<strong> {{$item->email}}</strong></p>
                    <p><span class="dt">Téléphone </span>:<strong> {{$item->phone}}</strong></p>
                    @endforeach
                </div>
                
                <div>
                    <p id="post_condidat" style="text-decoration: underline">CANDIDATURE à la FILIÈRE</p>
                    <p><span class="dt">Etablissement </span>:<strong> Ecole Supérieure d'Education et de Formation (ESEF) - EL JADIDA</strong></p>
                    <p><span class="dt">Spécialité</span> :<strong>{{$filiere_data[0]->name}}</strong></p>
                    <p><span class="dt">Reçu LE :</span> <strong>{{$register_in_filiere_at[0]->date}}</strong></p>
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


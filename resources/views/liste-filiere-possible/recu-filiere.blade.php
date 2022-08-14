

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
        /* header p {
            position: relative;
            margin-top: -90px;
            margin-left: -40px;
            text-align: center;
        } */
        #fin {
            position: relative;
            margin-left: 400px;
            margin-top: -90px;
            width: 320px;
            height: 90px;
        }

        #titre {
            position: relative;
            margin-left: 140px;
            margin-top: 40px;
            width: 500px;
            height: 40px;
            text-align: center;
        }
        #titre p{
            font-size: 26px;
        }
        #post_condidat{
            font-size: 25px;
            text-align: center;
            margin-top: 50px;
        }

        /* #attestation {
            position: relative;
            margin-left: 60px;
            margin-top:50px;
        } */

        /* #signature {
            position: relative;
            margin-left: 350px;
        } */
        /* footer {
            text-align: center;
            font-style: oblique;
            font-size: large;
        } */
    </style>
</head>

<body>
    <div>
        <img src="../assets/img/esef.png"  style="max-width:100%" alt="Logo de Université Chouaib Doukkali">
        {{-- <img id="fin" src="{{public_path('img/image_recu/universite.jpg')}}" > --}}
    </div>
    
    <div class="container">
        <div id="titre">
            <p style="text-decoration: underline">Fiche de pré-candidature </p>
        </div>
        <div id="attestation">
            <div>
                <div style="display:flex; flex-direction:column;justify-content-center;border:1px solid rgb(157, 157, 157); padding:10px">
                    @foreach ($user_data as $item)
                    <p id="paratest"><span style="width:40px">Nom </span>:<strong style="text-transform: uppercase;margin-top:30px">{{$item->last_name}} </strong> </p>
                    <p id="paratest"><span style="width:40px">Prénom</span>:<strong style="text-transform: uppercase;">{{$item->first_name}}</strong> </p>
                    <p id="paratest"><span style="width:40px">CIN </span>:<strong> {{$item->cin}}</strong></p>
                    <p id="paratest"><span style="width:40px">Email </span>:<strong> {{$item->email}}</strong></p>
                    <p id="paratest"><span style="width:40px">Téléphone </span>:<strong> {{$item->phone}}</strong></p>
                    @endforeach
                </div>
                
                <div>
                    <p id="post_condidat" style="text-decoration: underline">CANDIDATURE à la FILIERE</p>
                    <p id="paratest">Etablissement :<strong> Ecole Supérieure d'Education et de Formation (ESEF) - EL JADIDA</strong></p>
                    <p id="paratest">Spécialité :<strong>{{$filiere_data[0]->name}}</strong></p>
                    <p id="signature">Reçu LE : {{$register_in_filiere_at[0]->date}}</p>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <footer style="position:fixed;bottom:0; margin-top:10px">
        <div style="font-size: 10; display:flex;flex-wrap: wrap;">Route Nationale N°1 (Route AZEMMOUR), Km6, HAOUZIA BP:5096 ElJadida Plateau 24002</div>
        <div style="font-size: 10; display:flex;flex-wrap: wrap;font-weight:bold"> Téléphone: 0523 39 56 79-0523 34 48 22 /fax : 0523 39 49 15</div>
    </footer>
</body>
</html>


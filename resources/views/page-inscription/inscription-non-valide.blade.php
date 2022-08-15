@extends('layouts.user_type.auth')

@section('content')
    <style>
        * {
    margin: 0;
    padding: 0;
}

html {
    height: 100%;
}

p {
	color: grey;
}

#heading {
	text-transform: uppercase;
	color: #673AB7;
	font-weight: normal;
}

#msform {
    text-align: center;
    position: relative;
    margin-top: 20px;
}

#msform fieldset {
    background: white;
    border: 0 none;
    border-radius: 0.5rem;
    box-sizing: border-box;
    width: 100%;
    margin: 0;
    padding-bottom: 20px;

    /*stacking fieldsets above each other*/
    position: relative;
}

.form-card {
	text-align: left;
}

/*Hide all except first fieldset*/
#msform fieldset:not(:first-of-type) {
    display: none;
}

#msform textarea {
    padding: 8px 15px 8px 15px;
    border: 1px solid #ccc;
    border-radius: 0px;
    margin-bottom: 25px;
    margin-top: 2px;
    width: 100%;
    box-sizing: border-box;
    font-family: montserrat;
    color: #2C3E50;
    font-size: 16px;
    letter-spacing: 1px;
}

#msform input:focus, #msform textarea:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    border: 1px solid #673AB7;
    outline-width: 0;
}

/*Next Buttons*/
#msform .action-button {
    width: 100px;
    background: #673AB7;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 0px 10px 5px;
    float: right;
}

#msform .action-button:hover, #msform .action-button:focus {
    background-color: #311B92;
}

/*Previous Buttons*/
#msform .action-button-previous {
    width: 100px;
    background: #616161;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px 10px 0px;
    float: right;
}

#msform .action-button-previous:hover, #msform .action-button-previous:focus {
    background-color: #000000;
}

/*The background card*/
.card {
    z-index: 0;
    border: none;
    position: relative;
}

/*FieldSet headings*/
.fs-title {
    font-size: 25px;
    color: #673AB7;
    margin-bottom: 15px;
    font-weight: normal;
    text-align: left;
}

.purple-text {
	color: #673AB7;
    font-weight: normal;
}

/*Step Count*/
.steps {
	font-size: 25px;
    color: gray;
    margin-bottom: 10px;
    font-weight: normal;
    text-align: right;
}

/*Field names*/
.fieldlabels {
	color: black;
	text-align: left;
}

/*Icon progressbar*/
#progressbar {
    margin-bottom: 30px;
    overflow: hidden;
    color: lightgrey;
}

#progressbar .active {
    color: #673AB7;
}

#progressbar li {
    list-style-type: none;
    font-size: 15px;
    width: 50%;
    float: left;
    position: relative;
    font-weight: 400;
}

/*Icons in the ProgressBar*/
#progressbar #bac:before {
    font-family: FontAwesome;
    content: "\f022";
}

#progressbar #licence:before {
    font-family: FontAwesome;
    content: "\f0f6";
}

#progressbar #payment:before {
    font-family: FontAwesome;
    content: "\f030";
}

#progressbar #confirm:before {
    font-family: FontAwesome;
    content: "\f00c";
}

/*Icon ProgressBar before any progress*/
#progressbar li:before {
    width: 50px;
    height: 50px;
    line-height: 45px;
    display: block;
    font-size: 20px;
    color: #ffffff;
    background: lightgray;
    border-radius: 50%;
    margin: 0 auto 10px auto;
    padding: 2px;
}

/*ProgressBar connectors*/
#progressbar li:after {
    content: '';
    width: 100%;
    height: 2px;
    background: lightgray;
    position: absolute;
    left: 0;
    top: 25px;
    z-index: -1;
}

/*Color number of the step and the connector before it*/
#progressbar li.active:before, #progressbar li.active:after {
    background: #673AB7;
}

/*Animated Progress Bar*/
.progress {
	/* height: 20px; */
}

.progress-bar {
	background-color: #673AB7;
}

/*Fit image in bootstrap div*/
.fit-image{
    width: 100%;
    object-fit: cover;
}

    </style>
<div class="container">
    <div class="">
        <div class="row setup-panel">
            <form id="msform" action="/server.php/condidat/acadimiques" method="POST"  enctype="multipart/form-data">
                    @csrf

                    <ul id="progressbar">
                        <li class="active" id="bac"><strong>--Information du Bac----</strong></li>
                        <li id="licence"><strong>----Information de la Licence----</strong></li>
                    </ul>
                    <div class="progress">
                    	<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                	</div>
                    <br>
                    <fieldset>
                        <div class="form-card">
                            <label for="type_bac" class="fieldlabels">Série du Bac : *</label>
                            <select class="form-control" name="serie_bac" id="type_bac">
                                @foreach($liste_bac as $key =>$item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>

                            <label class="fieldlabels">Type du BAC : *</label>
                            <select class="form-control" name="type_bac" id="">
                                <option value="National">National</option>
                                <option value="Etranger">Etranger</option>
                            </select>

                            <label class="fieldlabels">Année : *</label>
                            <input type="text" name="annee_bac" class="form-control" required/>


                            <label class="fieldlabels">Etablissment : *</label>
                            <input type="text" name="etablissment_bac"  class="form-control" required/>

                            <label class="fieldlabels">Ville : *</label>
                            <input type="text" name="ville_bac" class="form-control" required/>

                            <label class="fieldlabels">Scan'Bac : *</label>
                            <font size="2" color="red">(Format png-jpg)</font>
                            <input type="file" name="scan_bac" class="form-control" required accept=".png, .jpg, .jpeg" />
                            <label class="fieldlabels">Scan relevé de notes : *</label>
                            <font size="2" color="red">(Format png-jpg)</font>
                            <input type="file" name="scan_releve_note" class="form-control" required accept=".png, .jpg, .jpeg"/>
                        </div>
                        <input type="button" name="next" class="next action-button" value="Suivant"/>
                    </fieldset>
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col">
                                    <label class="fieldlabels">Spécialité : *</label>
                                    <select class="form-control" name="genre_licence" id="genre_licence">
                                        @foreach($liste_licence as $key =>$item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="fieldlabels" >Equivalent:</label><br>
                                    <input type="checkbox" name="licence_equivalent[]" value="" id="flexCheckDefault"/>
                                    <label for="flexCheckDefault">
                                        Cochez la case si vous avez un diplôme équivalent à la licence sélectionnée
                                    </label>

                                </div>
                            </div>

                            <label for="genre_licence" class="fieldlabels">Type du Licence : *</label>
                            <select class="form-control" name="type_licence" id="genre_licence" required>
                                <option value="National">National</option>
                                <option value="Etranger">Etranger</option>
                            </select>

                            <label class="fieldlabels">Année : *</label>
                            <input type="text" name="annee_licence"  class="form-control" required/>

                            <label class="fieldlabels">Etablissment : *</label>
                            <input type="text" name="etablissment_licence"  class="form-control" required/>

                            <label class="fieldlabels">Ville : *</label>
                            <input type="text" name="ville_licence" class="form-control" required/>

                            <label class="fieldlabels">Note S 1: *</label>
                            <input type="text" name="note_s1" placeholder="Note S 1" class="form-control" required/>

                            <label class="fieldlabels">Note S 2: *</label>
                            <input type="text" name="note_s2" placeholder="Note S 2" class="form-control" required/>

                            <label class="fieldlabels"> Relevé de notes S 1: *</label>
                            <font size="2" color="red">(Format png-jpg)</font>
                            <input type="file" name="releve_s1" class="form-control" required accept=".png, .jpg, .jpeg"/>

                            <label class="fieldlabels"> Relevé de notes S 2: *</label>
                            <font size="2" color="red">(Format png-jpg)</font>
                            <input type="file" name="releve_s2" class="form-control" required accept=".png, .jpg, .jpeg"/>
                        </div>
                        <input type="submit" name="submit" class="submit action-button" value="Valider"/>
                        <input type="button" name="previous" class="previous action-button-previous" value="Précédent"/>
                    </fieldset>
                    </div>
                </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>
$(document).ready(function(){

    var current_fs, next_fs, previous_fs; //fieldsets
    var opacity;
    var current = 1;
    var steps = $("fieldset").length;

    setProgressBar(current);

    $(".next").click(function(){

        current_fs = $(this).parent();
        next_fs = $(this).parent().next();

        //Add Class Active
        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

        //show the next fieldset
        next_fs.show();
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function(now) {
                // for making fielset appear animation
                opacity = 1 - now;

                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                next_fs.css({'opacity': opacity});
            },
            duration: 500
        });
        setProgressBar(++current);
    });

    $(".previous").click(function(){

        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();

        //Remove class active
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

        //show the previous fieldset
        previous_fs.show();

        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function(now) {
                // for making fielset appear animation
                opacity = 1 - now;

                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                previous_fs.css({'opacity': opacity});
            },
            duration: 500
        });
        setProgressBar(--current);
    });

    function setProgressBar(curStep){
        var percent = parseFloat(100 / 2) * curStep;
        percent = percent.toFixed();
        $(".progress-bar")
          .css("width",percent+"%")
    }

    // $(".submit").click(function(){
    //     return false;
    // })

    });

</script>
@endsection

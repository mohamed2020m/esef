@extends('layouts.user_type.auth')

@section('content')
    <div class="card mb-4 mx-4">
        <div class="card-header pb-0">
            <div class="d-flex flex-row justify-content-center">
                <div  sytle="text-overflow: ellipsis !important; overflow: hidden !important; width: 40px; white-space: nowrap !important;">
                    <h5 class="mb-0"><i class="fa fa-lg fa-check ps-2 pe-2 text-center text-dark" aria-hidden="true"></i>Sélectionnez une filière</h5>
                </div>
            </div>
        </div>
        <hr>
        <div class="card-body px-3 pt-0 pb-2" id="Table_container">
            <div class="row aling-items-center mb-3">
                <div id="flt"></div>
                <div class="col-10" id="select_tag">
                    <form>
                        @csrf
                        <select class="form-select form-select-lg select_filiere" style="border-color:#0f233a !important; box-shadow:none !important" aria-label="Default select example"  name="filiere"  required>
                            <option disabled selected>Sélectionner une filière</option>
                            @foreach($data_filiere as $row)
                            <option value="{{$row->id}}">{{$row->name}}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
                <div class="col-2 d-flex">
                    <button class="text-white font-weight-bold px-2 border-0 bg-secondary flex-grow-1 rounded " id="btn_export" type="button" data-bs-toggle="modal" data-bs-target="#export">
                        <i class="fa fa-file-excel me-sm-1"></i>
                        <span class="d-sm-inline d-none" id="span_export">Export</span>
                    </button>
                </div>
            </div>
            <div class="table-responsive p-0">
                <table class="table table-striped table-hover mb-0" id="tab_candidate">
                    <thead>
                        <tr class="filters">
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
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
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" id="cin">
                                CIN
                            </th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                CNE
                            </th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Score
                            </th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                
                            </th>
                        </tr>
                    </thead>
                    <tbody id="UserDataTable">
                        <tr class="align-middle" style="font-size: 18px;">
                            <td colspan="8" class="text-center">Sélectionner une filière &#128515;</td>
                        </tr>
                    </tbody>
                    <tfoot class="" id="foot_condidate"></tfoot>
                </table>
            </div>
        </div>
    </div>
    <div id="model_wrapper"></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    var data = [];
    $(document).ready(function(){
        $(".select_filiere").on('change',function(){
            let filiere_id= $(this).val();
            // let table="";
            let model="";
            // const sections = [];
            let index = 0;
            let gone = false;
            $.ajax({
                type:'get',
                url:'{{URL::to("candidatsList")}}',
                data:{'id':filiere_id},
                success: function(data){
                    // remove filters: 
                    $('.select_filiere').change(function(){
                        $("#flt").children().removeClass("btn-warning").addClass("btn-secondary");
                        $("#cin_filter").remove();
                        $("#cin").html('CIN');
                        $("#n_lines" ).remove();
                    })

                    // getting new records
                    // for(var i=0;i<data.length;i++){
                    //     table += 
                    //     `<tr class="align-middle" style="font-size: 18px;">
                    //         <td class="text-center"><p class="font-weight-bold mb-0"> ${data[i].id}</p></td>
                    //         <td class="text-center"><img src="../public/images/images_profiles/${data[i].photo}" alt="avatar" class="avatar avatar-sm me-3"></td>
                    //         <td class="text-center"><p class="font-weight-bold mb-0">${data[i].last_name}</p></td>
                    //         <td class="text-center"><p class="font-weight-bold mb-0">${data[i].first_name}</p></td>
                    //         <td class="text-center"><p class="font-weight-bold mb-0">${data[i].cin}</p></td>
                    //         <td class="text-center"><p class="font-weight-bold mb-0">${data[i].cne}</p></td>
                    //         <td class="text-center"><p class="font-weight-bold mb-0">${data[i].score}</p></td>
                    //         <td class="text-center">
                    //             <a href="/server.php/user-management-${data[i].id}" class="mr-3" data-bs-toggle="tooltip" data-bs-original-title="view condidature">
                    //                 <i class="fas fa-eye text-white bg-warning rounded-circle p-3" style="font-weight:normal"></i>
                    //             </a>
                    //         </td>
                    //     </tr>`
                    // }  
                    
                    const sections = calculePagination(data);
                    const table = pagination(sections[index]);
                    
                    $("#UserDataTable" ).html(table);
                    
                    $('#foot_condidate').html(`
                        <nav aria-label="Page navigation example">
                            <tr>
                                <td colspan="8">
                                    <ul class="d-flex justify-content-center pagination">
                                        <li id="first" class="page-item mx-2">
                                            <a class="page-link" style="cursor: pointer;width:70px !important;border-radius:20% !important; box-shadow:none !important">Première</a>
                                        </li>
                                        <li id="prev" class="page-item mx-2">
                                            <a class="page-link" style="cursor: pointer;box-shadow:none !important">Prev</a>
                                        </li>
                                        <li id="next" class="page-item mx-2">
                                            <a class="page-link" style="cursor: pointer;box-shadow:none !important">Suiv</a>
                                        </li>
                                        <li id="last" class="page-item mx-2">
                                            <a class="page-link" style="cursor: pointer;width:70px !important;border-radius:20% !important; box-shadow:none !important">Dernier</a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="8">
                                    <div class="d-flex justify-content-center" id="show_id">
                                        <span class="text-sm">Afficher : ${index + 1}/${sections.length}</span>
                                    </div>
                                </td>
                            </tr>
                        </nav>
                        `
                    )
                    
                    $("#first").click(function(){
                        $("#UserDataTable" ).html(pagination(sections[0]));
                        $("#show_id").html(`<span class="text-sm">Afficher : ${1}/${sections.length}</span>`);
                    })

                    $("#prev").click(function(){
                        if(index > 0){
                            index--;
                            $("#UserDataTable" ).html(pagination(sections[index]));
                            $("#show_id").html(`<span class="text-sm">Afficher : ${index + 1}/${sections.length}</span>`)
                        }
                    })

                    $("#next").click(function(){
                        if(index < sections.length - 1){
                            index++
                            $("#UserDataTable" ).html(pagination(sections[index]));
                            $("#show_id").html(`<span class="text-sm">Afficher : ${index + 1}/${sections.length}</span>`);
                        }
                    })

                    $("#last").click(function(){
                        $("#UserDataTable" ).html(pagination(sections[sections.length - 1]));
                        $("#show_id").html(`<span class="text-sm">Afficher : ${sections.length}/${sections.length}</span>`);
                    })

                    // adding filter button
                    $("#Table_container").addClass("filterable");
                    $("#select_tag").removeClass("col-10").addClass("col-9");
                    $("#flt").addClass("col-1 d-flex");
                    $("#flt").html(`<button class="btn btn-filter btn-secondary m-0"><i class="fa fa-filter"></i></button>`);
                    
                    // export button
                    model += `<div class="modal fade" id="export" tabindex="-1" aria-labelledby="exportModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exportModalLabel">Exporter candidatures</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="text-danger">Vous êtes sur le point d'exporter la filière sélectionnée</p>
                                </div>
                                <div class="modal-footer d-flex align-items-center">
                                    <button type="button" class="btn btn-secondary mt-3 rounded-pill" data-bs-dismiss="modal">Annuler</button>
                                    <a href="/server.php/condidatures-export/${filiere_id}" id="export_btn" class="bg-success rounded-pill px-3 py-2" data-bs-toggle="tooltip" data-bs-original-title="supprimer Bac"> 
                                        <!-- onclick="return confirm('est ce que vous etes sur ?')"> -->
                                        <span class="d-sm-inline d-none text-white px-3" id="span_export">Export</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>`
                    $("#btn_export").addClass("bg-success").removeClass("bg-secondary");
                    $("#model_wrapper").html(model);

                    // $("#flt").click(function(){
                    //     let table = "";
                    //     for(var i=0;i<data.length;i++){
                    //         table += 
                    //         `<tr class="align-middle" style="font-size: 18px;">
                    //             <td class="text-center"><p class="font-weight-bold mb-0"> ${data[i].id}</p></td>
                    //             <td class="text-center"><img src="../public/images/images_profiles/${data[i].photo}" alt="avatar" class="avatar avatar-sm me-3"></td>
                    //             <td class="text-center"><p class="font-weight-bold mb-0">${data[i].last_name}</p></td>
                    //             <td class="text-center"><p class="font-weight-bold mb-0">${data[i].first_name}</p></td>
                    //             <td class="text-center"><p class="font-weight-bold mb-0">${data[i].cin}</p></td>
                    //             <td class="text-center"><p class="font-weight-bold mb-0">${data[i].cne}</p></td>
                    //             <td class="text-center"><p class="font-weight-bold mb-0">${data[i].score}</p></td>
                    //             <td class="text-center">
                    //                 <a href="/server.php/user-management-${data[i].id}" class="mr-3" data-bs-toggle="tooltip" data-bs-original-title="view condidature">
                    //                     <i class="fas fa-eye text-white bg-warning rounded-circle p-3" style="font-weight:normal"></i>
                    //                 </a>
                    //             </td>
                    //         </tr>`
                    //     } 
                    //     $("#foot_condidate").remove();
                    //     $("#UserDataTable" ).html(table);
                    // },
                error:function(err){
                    $('body').append(`
                        <div aria-live="polite" aria-atomic="true" class="position-fixed bottom-0 end-0 p-3">
                            <div class="toast-container">
                                <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                                    <div class="toast-header text-white bg-danger rounded-0">
                                        <strong class="me-auto">${err.statusText}</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);
                }
            });
        });
        $("#flt").click(function(){
            let classList = $(this).children().attr("class");          
            let classArr = classList.split(/\s+/);
            if($.inArray("btn-info", classArr) == -1) {
                $(this).children().removeClass("btn-secondary").addClass("btn-info");
                $("#cin").html(`<input type="text" placeholder="Filtrer par CIN" id="cin_filter">`);
                $("#cin_filter").first().focus();

                $(".filterable .filters input").keyup(function() {
                    let e = $(this);
                    let l = e.val().toLowerCase();
                    let n = e.parents(".filterable");
                    let i = n.find(".filters th").index(e.parents("th"));
                    let r = n.find(".table");
                    let o = r.find("tbody tr");
                    let d = o.filter(function() {
                        return -1 === $(this).find("td").eq(i).text().toLowerCase().indexOf(l)
                    });
                    
                    r.find("tbody .no-result").remove(), o.show(), d.hide(),
                    d.length === o.length && 
                    r.find("tbody").prepend($('<tr class="no-result text-center"><td colspan="' 
                    + r.find(".filters th").length + '">Aucun résultat trouvé</td></tr>'))
                    $("#rowcount").html(o.length - d.length);
                });
                $("#UserDataTable" ).append(`<p id="n_lines" class="mt-3 text-sm text-info">Nombre de lines : <span id="rowcount"></span></p>`);
            }
            else{
                $(this).children().removeClass("btn-info").addClass("btn-secondary");
                $("#cin_filter").remove();
                $("#cin").html('CIN');
                $("#n_lines" ).remove();
                // $("#foot_condidate").html();
                // $("#UserDataTable" ).remove();
            }
        })
    });

    function calculePagination(data){
        let sections = [];
        let n_sections = Math.ceil(data.length / 2);
        let j = 0;
        for(let i = 0; i < n_sections; i++){
            sections.push(data.slice(j,j+2))
            j += 2;
        }
        return sections;
    }
    function pagination(arr){
        let table = ""; 
        for(var i=0;i<arr.length;i++){
            table += 
            `<tr class="align-middle" style="font-size: 18px;">
                <td class="text-center"><p class="font-weight-bold mb-0"> ${arr[i].id}</p></td>
                <td class="text-center"><img src="../public/images/images_profiles/${arr[i].photo}" alt="avatar" class="avatar avatar-sm me-3"></td>
                <td class="text-center"><p class="font-weight-bold mb-0">${arr[i].last_name}</p></td>
                <td class="text-center"><p class="font-weight-bold mb-0">${arr[i].first_name}</p></td>
                <td class="text-center"><p class="font-weight-bold mb-0">${arr[i].cin}</p></td>
                <td class="text-center"><p class="font-weight-bold mb-0">${arr[i].cne}</p></td>
                <td class="text-center"><p class="font-weight-bold mb-0">${arr[i].score}</p></td>
                <td class="text-center">
                    <a href="/server.php/user-management-${arr[i].id}" class="mr-3" data-bs-toggle="tooltip" data-bs-original-title="view condidature">
                        <i class="fas fa-eye text-white bg-warning rounded-circle p-3" style="font-weight:normal"></i>
                    </a>
                </td>
            </tr>`
        }
        return table;  
    }
</script>

@endsection


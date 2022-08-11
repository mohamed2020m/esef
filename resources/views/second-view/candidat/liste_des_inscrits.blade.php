@extends('layouts.user_type.auth')

@section('content')
    <div class="card mb-4 ml-auto">
            <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0"><i class="fa fa-lg fa-gear ps-2 pe-2 text-center text-dark" aria-hidden="true"></i>Gestion des utilisateurs</h5>
                        </div>
                        <a href="/server.php/admin-create" class="btn btn-sm mb-0" type="button" style="background-color: #0f233a !important;color:white">+&nbsp; Nouveau utilisateur</a>
                    </div>
            </div>
        <hr>
        <div class="card-body px-3 pt-0 pb-2 mt-4 ">
            <div class="table-responsive p-0 ">
                <table id='empTable' class="table table-striped table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
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
                                État
                            </th>

                            
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>



<script>

$(document).ready(function () {
            var users;
            
 
            $.ajax({
                url: "{{route('getUtilisateurs') }}",
                type: "Get",
                datatype: "json",
                success: function (data) {
 
                    users = $("#empTable").DataTable({
                        select: true,
                        data: data,
                        columnDefs: [
                            {
                                "click": false, "targets": [5],
                                "width": "24%"
                            }
                        ],
                        columns: [
                            { data: 'id' },
                            { data: 'first_name'},
                            { data: 'last_name'},
                            { data: 'email'},
                             {data: 'role'},
                            
                             {
                                 "data": "state", "render": function (data) {
 
                                     return '<a class="btn btn-primary" style="margin-left:30px"  onclick="editdetails(' + data + ')">Edit</a>' ;
 
                                 }
                             }
                        ],
 
                    })
 
                        $('#empTable tbody tr').on('click', function (e) {
 
                            e.stopPropagation();
                            var datalist;
 
                            var id = users.row(this).data().Id;
 
                            $.ajax({
                                type: 'Post',
                                url: "/Details/ViewDetails/" + id + " ",
                                
                                success: function (data) {
                                    console.log("hey");

 
                                    //FirstName.textContent = data[0].Firstname,
                                    //LastName.textContent = data[0].LastName,
                                    //Address.textContent = data[0].Address,
                                    //DOB.textContent = data[0].DOBString,
                                    //Email.textContent = data[0].Email,
                                    //Phone.textContent = data[0].PhoneNo,
                                    //SSN.textContent = data[0].SSN
                                }
                            })
                        });
                    }
                 
            });
        })

        function editdetails(id) {
          $('#Person').parsley().reset();
          $.ajax({
              url: "/Details/Edit/",
              type: "POST",
              data: JSON.stringify({ id: id }),
              contentType: "application/json; charset=utf-8",
              dataType: "json",
              success: function (data) {
                  var id = data[0].Id;
                  $('#id').val(data[0].Id),
                  $('#firstname').val(data[0].Firstname),
                  $("#lastname").val(data[0].LastName),
                  $('#address').val(data[0].Address),
                   $('#dob').val(data[0].DOBString),
                  $('#email').val(data[0].Email),
                    $('#phone').val(data[0].PhoneNo),
                  $('#ssn').val(data[0].SSN)
              }
          });
      }
</script>
    
@endsection


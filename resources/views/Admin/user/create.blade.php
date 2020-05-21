
<!DOCTYPE html>
<html>

<head>
    @include('layouts.admin.head')
    <style type="text/css">
        input[type="file"] {
            display: none;
        }
        .custom-file-upload {
            border: 1px solid #ccc;
            display: inline-block;
            padding: 6px 12px;
            cursor: pointer;
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        @section('usersActive','active')
        @include('layouts.admin.sidebar')
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                {{-- header --}}
                @include('layouts.admin.header')
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Create User Profile</h3>
                    {{-- include message --}}
                    {{-- @include('includes.messages') --}}
                    {{-- include notify --}}
                    @include('includes.notify')
                    <form role="form" action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                     @csrf
                     <div class="row mb-3">
                        <div class="col-lg-4">
                            <div class="card mb-3">
                                <div class="card-body text-center shadow"><img class="rounded-circle mb-3 mt-4" src="" width="160" height="160">
                                    <label for="file-upload" class="custom-file-upload">
                                        <i class="fas fa-upload"></i> Upload image
                                    </label>
                                    <input id="file-upload" name="image" type="file"/>
                                    <div class="mb-3">
                                        <textarea style="margin-top: 10px" placeholder="bio" name="bio" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="text-primary font-weight-bold m-0">Appointments&nbsp;</h6>
                                </div>
                                <div class="card-body">
                                    <h4 class="small font-weight-bold">Pending<span class="float-right">20%</span></h4>
                                    <div class="progress progress-sm mb-3">
                                        <div class="progress-bar bg-danger" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;"><span class="sr-only">20%</span></div>
                                    </div>
                                    <h4 class="small font-weight-bold">In Process<span class="float-right">40%</span></h4>
                                    <div class="progress progress-sm mb-3">
                                        <div class="progress-bar bg-warning" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;"><span class="sr-only">40%</span></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Compleated<span class="float-right">Complete!</span></h4>
                                    <div class="progress progress-sm mb-3">
                                        <div class="progress-bar bg-success" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"><span class="sr-only">100%</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 font-weight-bold">User / Company Settings</p>
                                        </div>
                                        <div class="card-body">

                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group"><label for="companyname"><strong>Company Name</strong></label><input class="form-control" value=""  type="text"  name="company_name"></div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group"><label for="email"><strong>Company Email Address</strong></label><input class="form-control" value=""  type="email" name="company_email"></div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group"><label for="companyname"><strong>Name</strong></label><input class="form-control" value=""  type="text"  name="name"></div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group"><label for="email"><strong>Email Address</strong></label><input class="form-control" value=""  type="email"name="email"></div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group"><label for="first_name"><strong>Contact no.</strong></label><input class="form-control" value="" type="text"  name="phone"></div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group"><label for="last_name"><strong>Admin Password</strong></label><input class="form-control"  type="text" required name="old_password" ></div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group"><label for="last_name"><strong>Create Password</strong></label> <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password"></div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group"><label for="last_name"><strong>Confirm Password</strong></label><input id="password-confirm" type="password" class="form-control" placeholder="Password (repeat)" name="password_confirmation"  autocomplete="new-password"></div>
                                                </div>
                                            </div>
                                            <div class="form-group"><button class="btn btn-primary btn-sm" type="submit">Add User</button></div>

                                        </div>
                                    </div>
                                    <div class="card shadow">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 font-weight-bold">Company Address</p>
                                        </div>
                                        <div class="card-body">
                                            <form>
                                                <div class="form-group"><label for="address"><strong>Address</strong></label><input class="form-control" type="text" value=""  name="address"></div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <label>Select Country</label>
                                                        <select class="custom-select"  data-placeholder="Select a Country" id="country_id" style="width: 100%;" name="country">
                                                          @foreach ($countries as $country)
                                                          <option value="{{ $country->id }}"
                                                            {{-- @if ($country->id == $user->country)
                                                            selected
                                                            @endif --}}
                                                            >{{ $country->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col">
                                                        <label>Select State</label>
                                                        <select class="custom-select" id="state_id" data-placeholder="Select a State" style="width: 100%;" name="state">
                                                        </select>
                                                    </div>

                                                </div>
                                                <div class="form-row" style="padding-top:10px;">
                                                    <div class="col">
                                                        <label >Select City</label>
                                                        <select class="custom-select"  data-placeholder="Select a City" style="width: 100%;" id="city_id" name="city">
                                                        </select>
                                                    </div>
                                                    <div class="col">
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-group"><button class="btn btn-primary btn-sm" type="submit">Add User</button></div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <footer class="bg-white sticky-footer">
            <div class="container my-auto">
                <div class="text-center my-auto copyright"><span>Copyright © BookMyAppoint.2020</span></div>
            </div>
        </footer>
    </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>
    @include('layouts.admin.bottom')
</body>
<script>



    $('#state_id').prop("disabled",true);
    $('#city_id').prop("disabled",true);
    $("#country_id").on('change',function() {
        var id = $(this).val();
            //console.log(id);
            //alert(id);
          //  $("#loding2").show();
          $("#state_id").find('option').remove();
          if (id) {
                //console.log(id);
                $.ajax({
                    type: "GET",
                    url: '{{ route('map.getstates')}}' ,
                    data:  ({country_id : id}),
                    //cache: false,
                    success: function(msg)
                    {
                        // console.log('result: '+msg);
                        // console.log(JSON.stringify(msg));
                        //false;
                        $("#city_id").find('option').remove();
                        $("#city_id").prop("disabled",true);
                        $('#state_id').prop("disabled",false);
                        $("#loding2").hide();
                        var response = JSON.parse(msg);
                        // var response = JSON.stringify(msg);
                        var state_name="";
                        //console.log('result: '+response);
                        if(response.length>0)
                        {
                            //removeOptions(document.getElementById('cities'));

                            for(i=0;i<response.length;i++)
                            {
                                states = response[i]['name'];

                                document.getElementById("state_id").options[i] =  new Option(states,response[i]['id']);
                            }

                            document.getElementById('state_id').focus();

                        }


                    },
                    /*success: function(html) {
                        console.log(html);
                        $("#loding2").hide();
                        $.each(html, function(key, value) {
                            $('<option>').val('').text('select');
                            $('<option>').val(key).text(value).appendTo($("#cities"));
                        });
                    },*/
                    error: function(e)
                    {
                        //$('#city_id').prop("disabled", true);
                        //$('#state_id').prop("disabled", true);
                        alert("Country Invalid : " + e.responseText.message);
                        console.log(e);
                    }
                });
            }

            else{
                $("#loding2").hide();
                $('#city_id').prop("disabled", true);
                $('#state_id').prop("disabled",true);
            }
        });

    $("#state_id").on('change',function() {
        var state_id = $(this).val();
            //console.log(id);
            //alert('state_id'+state_id);
          //  $("#loding2").show();
          $("#city_id").find('option').remove();
          if (state_id) {
                //console.log(state_id);
                $.ajax({
                    type: "GET",
                    url: '{{ route('map.getcities')}}' ,
                    data:  ({state_id : state_id}),
                    //cache: false,
                    success: function(msg)
                    {
                        // console.log('result: '+msg);
                        // console.log(JSON.stringify(msg));
                        //false;
                        $('#city_id').prop("disabled",false)
                        $("#loding2").hide();
                        var response = JSON.parse(msg);
                        // var response = JSON.stringify(msg);
                        var city_name="";
                        //console.log('result: '+response);
                        if(response.length>0)
                        {
                            //removeOptions(document.getElementById('cities'));

                            for(i=0;i<response.length;i++)
                            {
                                cities = response[i]['name'];

                                document.getElementById("city_id").options[i] =  new Option(cities,response[i]['id']);
                            }

                            document.getElementById('city_id').focus();

                        }
                    },
                    /*success: function(html) {
                        console.log(html);
                        $("#loding2").hide();
                        $.each(html, function(key, value) {
                            $('<option>').val('').text('select');
                            $('<option>').val(key).text(value).appendTo($("#cities"));
                        });
                    },*/
                    error: function(e)
                    {
                        //$('#city_id').prop("disabled", true);
                        //$('#state_id').prop("disabled", true);
                        alert("State Invalid : " + e.responseText.message);
                        console.log(e);
                    }
                });
            }

            else{
                $("#loding2").hide();
                $('#city_id').prop("disabled", true);
                $('#state_id').prop("disabled",true);
            }
        });
    </script>
    {{-- ---------------------------------------------- --}}


</html>
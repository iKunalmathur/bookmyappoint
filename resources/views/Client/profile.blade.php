
<!DOCTYPE html>
<html>

<head>
    @include('layouts.client.head')
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
        @section('profileActive','active')
        @include('layouts.client.sidebar')
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                {{-- header --}}
            @include('layouts.client.header')
            <div class="container-fluid">
                <h3 class="text-dark mb-4">Profile</h3>
                {{-- include notify --}}
                @include('includes.notify')
            <form role="form" action="{{ route('client.profile.update',$client->id) }}" method="POST" enctype="multipart/form-data">
               @csrf
               @method('PUT')
                <div class="row mb-3">
                    <div class="col-lg-4">
                        <div class="card mb-3">
                            <div class="card-body text-center shadow"><img class="rounded-circle mb-3 mt-4" src="{{asset(Storage::disk('local')->url(Auth::user()->image))}}" width="160" height="160">
                                <label for="file-upload" class="custom-file-upload">
                                    <i class="fas fa-upload"></i> Upload image
                                </label>
                                <input id="file-upload" name="image" type="file"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col">
                                <div class="card shadow mb-3">
                                    <div class="card-header py-3">
                                        <p class="text-primary m-0 font-weight-bold">User Settings</p>
                                    </div>
                                    <div class="card-body">

                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group"><label for="companyname"><strong>Name</strong></label><input class="form-control" value="{{$client->name}}"  type="text" placeholder="name" name="name"></div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group"><label for="email"><strong>Email Address</strong></label><input class="form-control" value="{{$client->email}}"  type="email" placeholder="user@example.com" name="email"></div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group"><label for="first_name"><strong>Contact no.</strong></label><input class="form-control" value="{{$client->phone}}" type="text" placeholder="phone" name="phone"></div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group"><label for="last_name"><strong>Password</strong></label><input class="form-control"  type="text" required name="old_password"></div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group"><label for="last_name"><strong>New Password</strong></label> <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"placeholder="New Password" name="password" autocomplete="new-password"></div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group"><label for="last_name"><strong>Confirm Password</strong></label><input id="password-confirm" type="password" class="form-control" placeholder="Password (repeat)" name="password_confirmation"  autocomplete="new-password"></div>
                                                </div>
                                            </div>
                                            <div class="form-group"><button class="btn btn-primary btn-sm" type="submit">Save Settings</button></div>
                                    </div>
                                </div>
                                <div class="card shadow">
                                    <div class="card-header py-3">
                                        <p class="text-primary m-0 font-weight-bold">Contact Settings</p>
                                    </div>
                                    <div class="card-body">
                                        <form>
                                            <div class="form-group"><label for="address"><strong>Address</strong></label><input class="form-control" type="text" value="{{$client->address}}"  name="address"></div>
                                            <div class="form-row">
                                                <div class="col">
                                                    <label>Select Country</label>
                                                    <select class="custom-select"  data-placeholder="Select a Country" id="country_id" style="width: 100%;" name="country">
                                                      @foreach ($countries as $country)
                                                          <option value="{{ $country->id }}"
                                                            @if ($country->id == $client->country_id)
                                                              selected
                                                          @endif
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
                                            <div class="form-group"><button class="btn btn-primary btn-sm" type="submit">Save&nbsp;Settings</button></div>
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
    @include('layouts.client.bottom')
</body>
<script>



    $('#state_id').prop("disabled",true);
    $('#city_id').prop("disabled",true);
    $("#country_id").on('change',function() {
            var id = $(this).val();
            $("#state_id").find('option').remove();
            if (id) {
                $.ajax({
                    type: "GET",
                    url: '{{ route('map.getstates')}}' ,
                    data:  ({country_id : id}),
                    success: function(msg)
                    {
                         $("#city_id").find('option').remove();
                          $("#city_id").prop("disabled",true);
                        $('#state_id').prop("disabled",false);
                        $("#loding2").hide();
                        var response = JSON.parse(msg);
                        var state_name="";
                        if(response.length>0)
                        {
                            for(i=0;i<response.length;i++)
                            {
                                states = response[i]['name'];

                                document.getElementById("state_id").options[i] =  new Option(states,response[i]['id']);
                            }

                            document.getElementById('state_id').focus();

                        }


                    },
                    error: function(e)
                    {
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
            $("#city_id").find('option').remove();
            if (state_id) {
                $.ajax({
                    type: "GET",
                    url: '{{ route('map.getcities')}}' ,
                    data:  ({state_id : state_id}),
                    success: function(msg)
                    {
                        $('#city_id').prop("disabled",false)
                        $("#loding2").hide();
                        var response = JSON.parse(msg);
                        var city_name="";
                        if(response.length>0)
                        {
                            for(i=0;i<response.length;i++)
                            {
                                cities = response[i]['name'];

                                document.getElementById("city_id").options[i] =  new Option(cities,response[i]['id']);
                            }

                            document.getElementById('city_id').focus();

                        }
                    },
                    error: function(e)
                    {
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
<script>
    $(document).ready(function () {
        //debugger;
        var country_id = document.getElementById('country_id').value;
        var state_id = '{{$client->state}}';
        var cityid = '{{$client->city}}';
       $('#state_id').prop("disabled",true)
        $('#city_id').prop("disabled",true)
        $("#state_id").find('option').remove();
        $.ajax({
            type: "GET",
            url: '{{ route('map.getstates') }}' ,
            data:  ({country_id : country_id}),
            success: function(msg) {
                $('#state_id').prop("disabled", false)
                $("#loding2").hide();
                var response = JSON.parse(msg);
                if (response.length > 0) {
                    /**/
                    for(i=0;i<response.length;i++)
                    {
                        var state_id = '{{$client->state}}';
                        states = response[i]['name'];
                        if(response[i]['id'] == state_id){
                            document.getElementById("state_id").options[i] = new Option(states, response[i]['id']);
                            document.getElementById("state_id").options[i].setAttribute('selected',true);
                        }else{
                            document.getElementById("state_id").options[i] = new Option(states, response[i]['id']);
                        }
                    }
                    /**/
                }
                var country_id = document.getElementById('country_id').value;
                var  state_id = document.getElementById('state_id').value;
                $("#city_id").find('option').remove();
                $.ajax({
                    type: "GET",
                    url: '{{ route('map.getcities') }}' ,
                    data:  ({country_id : country_id, state_id: state_id}),
                    success: function(msg) {
                        $('#city_id').prop("disabled", false);
                        $("#loding2").hide();
                        var response = JSON.parse(msg);
                        var state_name = "";
                        /**/
                        for(i=0;i<response.length;i++)
                        {
                            var state_id = '{{$client->state}}';
                            var cityid = '{{$client->city}}';
                            citys = response[i]['name'];
                            if(response[i]['id'] == cityid){
                                document.getElementById("city_id").options[i] = new Option(citys, response[i]['id']);
                                document.getElementById("city_id").options[i].setAttribute('selected',true);
                            }else{
                                document.getElementById("city_id").options[i] = new Option(citys, response[i]['id']);
                            }
                        }
                        /**/
                    },
                    error: function(e)
                    {
                        alert("An error occurred: " + e.responseText.message);
                        console.log(e);
                    }
                });
            },
            error: function(e)
            {
                alert("An error occurred: " + e.responseText.message);
                console.log(e);
            }
        });
    })
</script>

</html>

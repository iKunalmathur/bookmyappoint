<!DOCTYPE html>
<html>

<head>
  @include('layouts.admin.head')
</head>

<body id="page-top">
  <div id="wrapper">
    @section('ManAppActive','active')
    @include('layouts.admin.sidebar')
    <div class="d-flex flex-column" id="content-wrapper">
      <div id="content">
        {{-- header --}}
        @include('layouts.admin.header')
        <div class="container-fluid">
          <div class="d-sm-flex justify-content-between align-items-center mb-4">
            <h3 class="text-dark mb-0">Edit Appointment</h3>
          </div>
          </div>
          <div class="col">
            <div class="card shadow mb-3">
              <div class="card-header py-3">
                <p class="text-primary m-0 font-weight-bold">Edit Appointment info</p>
              </div>
              @include('includes.notify')
              <div class="card-body">
                <form role="form" action="{{ route('admin.appointment.update',$appointment->id) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="form-row">
                    <div class="col">
                      <div class="form-group"><label for="companyname"><strong>Name</strong></label><input class="form-control" value="{{$appointment->getRelation('client')->name}}"  type="text" placeholder="name" name="name"></div>
                    </div>
                    <div class="col">
                      <div class="form-group"><label for="email"><strong>Email Address</strong></label><input class="form-control" value="{{$appointment->getRelation('client')->email}}"  type="email" name="email"></div>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col">
                      <div class="form-group"><label for="first_name"><strong>Contact no.</strong></label><input class="form-control" value="{{$appointment->getRelation('client')->phone}}" type="text" placeholder="phone" name="phone"></div>
                    </div>
                    <div class="col">
                      <label>Select Service provider</label>
                      <select class="custom-select"  data-placeholder="Select a user" required id="user_id" style="width: 100%;" name="user_id">
                        <option value="" selected disabled hidden>Choose here</option>
                        @foreach ($users as $user)
                          <option value="{{ $user->id }}"
                            @if ($user->id == $appointment->user_id)
                              selected
                            @endif
                            >{{ $user->company_name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col">
                        <label>Select Slot</label>
                        <select class="custom-select" id="slot_id" data-placeholder="Select a Slot" style="width: 100%;" name="slot_id">
                          <option value="" selected disabled hidden>Choose here</option>
                        </select>
                      </div>
                      <div class="col">
                        <label>Select Service</label>
                        <select class="custom-select" id="service_id" data-placeholder="Select a Service" style="width: 100%;" name="service_id">
                          <option value="" selected disabled hidden>Choose here</option>
                        </select>
                      </div>
                    </div>
                    <br>
                    <div class="form-group"><button class="btn btn-primary btn-sm" type="submit">Update</button></div>
                  </form>
                </div>
              </div>
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
      <script type="text/javascript">
      $('#slot_id').prop("disabled",true);
      $('#service_id').prop("disabled",true);
      $("#user_id").on('change',function() {
        var id = $(this).val();
        $("#slot_id").find('option').remove();
        $("#service_id").find('option').remove();
        if (id) {
          $.ajax({
            type: "GET",
            url: '{{ route('admin.getslots')}}' ,
            data:  ({user_id : id}),
            success: function(msg)
            {
              $('#slot_id').prop("disabled",false);
              $("#loding2").hide();
              var response = JSON.parse(msg);
              var state_name="";
              if(response.length>0)
              {
                for(i=0;i<response.length;i++)
                {
                  slots = ""+response[i]['slot_name'];
                  slotsdates = response[i]['date'];
                  const d = new Date(slotsdates)
                  const dtf = new Intl.DateTimeFormat('en', { year: 'numeric', month: 'short', day: '2-digit' })
                  const [{ value: mo },,{ value: da },,{ value: ye }] = dtf.formatToParts(d)
                  dateString = `${da}-${mo}-${ye}`

                  ///////// Time AM/PM ///////////
                  var timeString = response[i]['time'];
                  var H = +timeString.substr(0, 2);
                  var h = H % 12 || 12;
                  var ampm = (H < 12 || H === 24) ? "am" : "pm";
                  timeString = h + timeString.substr(2, 3)+" "+ ampm;
                  document.getElementById("slot_id").options[i] =  new Option(slots+", "+dateString+", "+timeString,response[i]['id']);
                }

                document.getElementById('slot_id').focus();

              }


            },
        error: function(e)
        {
          alert("Country Invalid : " + e.responseText.message);
          console.log(e);
        }
      });
      $.ajax({
        type: "GET",
        url: '{{ route('admin.getservices')}}' ,
        data:  ({user_id : id}),
        success: function(msg)
        {
          $('#service_id').prop("disabled",false);
          $("#loding2").hide();
          var response = JSON.parse(msg);
          var state_name="";
          if(response.length>0)
          {
            for(i=0;i<response.length;i++)
            {
              service = response[i]['service_name'];
              document.getElementById("service_id").options[i] =  new Option(service,response[i]['id']);
            }

            document.getElementById('slot_id').focus();

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
  $('#slot_id').prop("disabled",true);
}
});
</script>
<script type="text/javascript">
$(document).ready(function () {
  var user_id = document.getElementById('user_id').value;
  var slot_id = '{{$appointment->appointment_slot_id}}';
  $('#slot_id').prop("disabled",true)
  $("#slot_id").find('option').remove();
  var service_id = '{{$appointment->service_id}}';
  $('#service_id').prop("disabled",true)
  $("#service_id").find('option').remove();
  $.ajax({
    type: "GET",
    url: '{{ route('admin.getslots') }}' ,
    data:  ({user_id : user_id}),
    success: function(msg) {
      $('#slot_id').prop("disabled", false)
      var response = JSON.parse(msg);
      if (response.length > 0) {
        for(i=0;i<response.length;i++)
        {
          var slot_id = '{{$appointment->appointment_slot_id}}';
          states = response[i]['slot_name'];
          slots = ""+response[i]['slot_name'];
          slotsdates = response[i]['date'];
          const d = new Date(slotsdates)
          const dtf = new Intl.DateTimeFormat('en', { year: 'numeric', month: 'short', day: '2-digit' })
          const [{ value: mo },,{ value: da },,{ value: ye }] = dtf.formatToParts(d)
          dateString = `${da}-${mo}-${ye}`

          ///////// Time AM/PM ///////////
          var timeString = response[i]['time'];
          var H = +timeString.substr(0, 2);
          var h = H % 12 || 12;
          var ampm = (H < 12 || H === 24) ? "am" : "pm";
          timeString = h + timeString.substr(2, 3)+" "+ ampm;
          if(response[i]['id'] == slot_id){
            document.getElementById("slot_id").options[i] = new Option(slots+", "+dateString+", "+timeString,response[i]['id']);
            document.getElementById("slot_id").options[i].setAttribute('selected',true);
          }else{
            document.getElementById("slot_id").options[i] = new Option(slots+", "+dateString+", "+timeString,response[i]['id']);
          }
        }
        /**/

      }
    }
  })
  $.ajax({
    type: "GET",
    url: '{{ route('admin.getservices') }}' ,
    data:  ({user_id : user_id}),
    success: function(msg) {
      $('#service_id').prop("disabled", false)
      var response = JSON.parse(msg);
      if (response.length > 0) {
        /**/
        for(i=0;i<response.length;i++)
        {
          var service_id = '{{$appointment->service_id}}';
          states = response[i]['service_name'];
          if(response[i]['id'] == service_id){
            document.getElementById("service_id").options[i] = new Option(states, response[i]['id']);
            document.getElementById("service_id").options[i].setAttribute('selected',true);
          }else{
            document.getElementById("service_id").options[i] = new Option(states, response[i]['id']);
          }
        }
        /**/
      }
    }
  })

})
</script>
</html>

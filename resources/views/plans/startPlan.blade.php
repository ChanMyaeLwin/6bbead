@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
      <div class="col-lg-12 margin-tb">
          <div class="pull-left">
              <h2>Start Plan</h2>
          </div>
      </div>
  </div>
  <input type="hidden" id="user_day_id" name="user_day_id" value="{{ $todayuserday->id }}">
@if($todayuserday !== null)
  <table class="table table-bordered">
    <tr>
    <th>Today</th>
    <th>{{ date('d-m-Y') }}</th>
  </tr>
  <tr>
    <th>Plan Name</th>
    <th>{{$plan->plans_name}}</th>
  </tr>
  <tr>
    <th>Level Name</th>
    <th>{{ $todayuserday->levelDays->level_name }}</th>
  </tr>
  <tr>
    <th>First Definstion</th>
    <th>{{ $todayuserday->levelDays->first_defination }}</th>
  </tr>
  <tr>
    <th>Second Defination</th>
    <th>{{ $todayuserday->levelDays->second_defination }}</th>
  </tr>
  @if($todayuserday->levelDays->day_no == 5)
    <tr>
    <th>Today is vagiatable day</th>
  </tr>
  
  @endif
  <tr>
    <th>No of Round</th>
    <th><a id="round">{{ $todayuserday->levelDays->no_of_round }}</a>
      <!-- <button class="btn btn-success changeRoundAndCount form-control" type="button">Change To Count</button> -->
                              
    </th>
  </tr>

  </table>
  
  <div style="text-align: center;">
    <div style="font-weight: bold;">
      <a id="countresult">0</a> /
      <a>{{ ($todayuserday->levelDays->no_of_round) }}</a>
    </div>
    <div>
      <button class="btn btn-success clickbutton form-control" type="button" style="height: 150px;
        width: 150px;
        padding: 10px;
        border-radius: 50%;
        display: inline-block;">Change To Count</button>
    </div>
  </div>
@else
  <div style="text-align: center;">
    <div style="font-weight: bold;">
      <a> Today work is finish</a>
    </div>
  </div>
@endif
</div>



@endsection

@section('script')
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script>
    $(document).ready(function(){
      var start_time;
      var end_time;
      var id = document.getElementById("user_day_id").value;
      console.log(id,'aaw');
      $(".clickbutton").on('click',function(){
          if(!start_time){
            var today = new Date();
            var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
            var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
             start_time = date+' '+time;
          } 
          
          var round = {!! $todayuserday->levelDays->no_of_round !!};
    
          var count = round;
          var countresult=  document.getElementById("countresult").innerHTML;
          if(countresult  != count || countresult > count){
            countresult++;
            document.getElementById("countresult").innerHTML=countresult;
          }
          
          if(countresult  == count)
          {
            var today = new Date();
            var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
            var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
            end_time = date+' '+time;
            $.ajax({
              type: "POST", 
              url: "../../updatestatus" ,  //the url
              // 'contentType': 'application/json',
              data : {
                _token: "{{ csrf_token() }}",
                'user_day_id':id,
                'start_time':start_time,
               'end_time':end_time
               },
              'dataType': 'json',
            }).done(function (response) {
                // if(response.success == 1){
                   alert('complete for today');
                    document.location.href = '/choosedplans';
                // }
            }).fail(function (err)  {
            //
            });
            // alert('complete');
          }
       
      });  
    });

</script>
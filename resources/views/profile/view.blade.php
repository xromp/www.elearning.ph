

<div class="container" id="mainDiv">
    <div class="form-group" ng-class="">
        <img src="public/uploads/profile/erikson.png" /> 

    </div>
    <img src="{{ url('/') }}/uploads/profile/person-8x.png" style="width:150px;"/> 
    		<!-- @if(!empty(Session::get('elearning_sess_name')))
            {{ Session::get('elearning_sess_name') }} 
            @endif -->
            {{$student->fName}}
    <br>
    <div class="row">
        <div class="col-sm-6"> Question Posted </div>
        <div class="col-sm-6"> Answered </div>
    </div>

    <div class="row">
        <div class="col-sm-6"> Question Posted </div>
        <div class="col-sm-6"> Answered </div>
    </div>

</div>
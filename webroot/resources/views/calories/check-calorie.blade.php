@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">Complete this form to check your calories per day:</div>

                <div class="panel-body" >
                    <form method="POST" id="result" action="" @submit.prevent="onSubmit">
                        <div class="form-group">
                            <label for="weight">Weight (Kg) : </label>
                            <input type="text" name="weight" class="form-control" v-model="weight" />
                            <br />
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="submit" value="Submit" class="btn btn-success pull-right"/>
                        </div>
                    </form>
                    
                    
                </div>
                
            </div>
        </div>
    </div>
     <div class="row">
       <div class="col-md-8 col-md-offset-2">
          <div class="alert alert-success" role="alert">
        
            <div id="last-calorie"></div>
       </div>
     </div>
    </div>
</div>

@endsection
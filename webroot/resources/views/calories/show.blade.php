@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Individual Calorie</div>

                <div class="panel-body">
                  
                   {{ $calorie->user_id }} | {{ $calorie->caloriecalculate }}
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
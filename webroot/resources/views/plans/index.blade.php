@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            @if(Session::has('message'))
                <div class="alert alert-success">{{Session::get('message')}}</div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">Plans Created by You</div>

                <div class="panel-body">

                    <table class="table">
                        <tr>
                            <th>Title</th>
                             <th>Created By</th>

                        </tr>
                        @foreach(Auth::user()->getPlans() as $plan)
                            <tr>
                                <td> <a href="{{ route('plan.show',$plan) }}">{{$plan->plan_name}}</a></td>


                                <td>{{$plan->user->name}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        <a class="btn btn-primary" href="{{ route('plan.create') }}">Add new plan</a>

        <p>   </p><br>
        <div class="panel panel-default">
                <div class="panel-heading"> All Plans</div>

                <div class="panel-body">

                    <table class="table">
                        <tr>
                            <th>Title</th>
                            <th>Created By</th>


                        </tr>
                        @foreach($plans as $plan)
                            <tr>
                                <td> <a href="{{ route('plan.show',$plan) }}">{{$plan->plan_name}}</a></td>


                                <td>{{$plan->user->name}}</td>

                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

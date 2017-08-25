@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Tasks</div>

                <div class="panel-body">
                                        
                    {!!Form::open(array('route'=>'plan.store'))!!}
                        <div class="form-group">
                                {{Form::label('plan_name','Enter plan name')}}
                                {{Form::text('plan_name', null,['class'=>'form-control'])}}
                        </div>

  



                        <div class="form-group">
                                {{Form::button('create',['type'=>'submit','class'=>'btn btn-primary'])}}
                                
                        </div>


                    {!!Form::close()!!}
                             
                </div>
            </div>
   
                

        </div>
    </div>
</div>
@endsection

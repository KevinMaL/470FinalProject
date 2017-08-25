@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Tasks</div>

                <div class="panel-body">
                    You are logged in!<br>
                    
                    {!!Form::open(array('route'=>'planItem.store'))!!}

                        <div class="form-group">
                                {!!Form::label('item_name','Enter item name')!!}
                                {!!Form::text('item_name', null,['class'=>'form-control'])!!}
                        </div>

                         <div class="form-group">
                                {!!Form::label('item_body','Enter item ')!!}
                                {!!Form::textarea('item_body', null,['class'=>'form-control'])!!}
                        </div>
  



                        <div class="form-group">
                                {!!Form::button('create',['type'=>'submit','class'=>'btn btn-primary'])!!}
                                
                        </div>


                    {!!Form::close()!!}
                             
                </div>
            </div>
   
                

        </div>
    </div>
</div>
@endsection

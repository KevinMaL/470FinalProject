@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
                <h2>{{$plan->plan_name}} </h2>
                
        
 
            <div class="panel panel-default">
                <div class="panel-heading">Plan Items</div>

                <div class="panel-body">
                    
                    <table class="table">
                        <tr>
                            <th>Title</th>
                             <th>Describsion</th>
                             <th>Time</th>
                            
                        </tr>
                        @foreach($plan->planItems as $planItem)
                            <tr>
                                <td>{{$planItem->item_name}}</td>
           
                                  
                                <td>{{$planItem->item_body}}</td>
                                <td>
                                    @if($planItem -> Monday)
                                    Mon
                                    @endif
                                    @if($planItem -> Tuesday)
                                    Tue
                                    @endif                                    
                                    @if($planItem -> Wednesday)
                                    Wed
                                    @endif                                    
                                    @if($planItem -> Thursday)
                                    Thu
                                    @endif                                    
                                    @if($planItem -> Friday)
                                    Fri
                                    @endif                                    
                                    @if($planItem -> Saturday)
                                    Sat
                                    @endif 
                                    @if($planItem -> Sunday)
                                    Sun
                                    @endif   
                                    {{$planItem->time1}}:{{$planItem->time2}}-{{$planItem->time3}}:{{$planItem->time4}}                        
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>

            @if(Session::has('message'))
                <div class="alert alert-success">{{Session::get('message')}}</div>
            @endif
            <div class="panel-body">
                                        
                    {!!Form::open(array('route'=>'planItem.store'))!!}

                        <div class="form-group">
                                {{Form::label('item_name','Enter item name')}}
                                {{Form::text('item_name', null,['class'=>'form-control'])}}
                        </div>

                        <div class="form-group">
                                {{Form::label('Monday','Monday')}}
                                {{Form::checkbox('Monday', 'Monday')}}

                                {{Form::label('  Tuesday','Tuesday')}}
                                {{Form::checkbox('Tuesday', 'Tuesday')}}

                                {{Form::label('Wednesday','Wednesday')}}
                                {{Form::checkbox('Wednesday', 'Wednesday')}}

                                {{Form::label('Thursday','Thursday')}}
                                {{Form::checkbox('Thursday', 'Thursday')}}

                                {{Form::label('Friday','Friday')}}
                                {{Form::checkbox('Friday', 'Friday')}}

                                {{Form::label('Saturday','Saturday')}}
                                {{Form::checkbox('Saturday', 'Saturday')}}

                                {{Form::label('Sunday','Sunday')}}
                                {{Form::checkbox('Sunday', 'Sunday')}}

                        </div>


                        <div class="form-group">
                                {{Form::label('time1','Enter time')}}
                                {{Form::selectRange('time1', 0, 23)}}    

                                {{Form::label('time2',':')}}
                                {{Form::selectRange('time2', 0, 59)}}   

                                {{Form::label('time3','to')}}
                                {{Form::selectRange('time3', 0, 23)}}    

                                {{Form::label('time4',':')}}
                                {{Form::selectRange('time4', 0, 59)}}                      
                        </div>

                         <div class="form-group">
                                {{Form::label('item_body','Enter item ')}}
                                {{Form::textarea('item_body', null,['class'=>'form-control'])}}
                        </div>
  
                        <input name="planid" value={{$plan->id}} type="hidden">

                        <div class="form-group">
                                {{Form::button('create',['type'=>'submit','class'=>'btn btn-primary'])}}
                                
                        </div>


                    {!!Form::close()!!}
                             
                </div>

            

        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                  <div>
                    Email: {{$user->email}}
                  </div>
                  <div>
                    User Name: {{$user->name}}
                  </div>
                </div>

                <div class="panel-body">
                  @include('common.errors')
                    <form action="{{ route('save_profile', ['id' => $user->id])}}" method="POST" class="form-horizontal">
                      {{ csrf_field() }}
                        <div class="form-group">
                          <div class="row">
                            <label class="col-sm-3 control-label">Avater</label>
                            <div class="col-sm-6">
                              <img id="holder" style="margin-top:15px;max-height:100px;" src="{{$user->getProfile()->avatar}}">
                              <span class="input-group-btn">
                                <a id="lfm" data-input="avatar" data-preview="holder" class="btn btn-primary">
                                  <i class="fa fa-picture-o"></i> Choose
                                </a>
                              </span>
                              <input style="display:none;" id="avatar" class="form-control" type="text" name="avatar" value="{{$user->getProfile()->avatar}}">
                            </div>
                          </div>
                          <div class="row">
                            <label class="col-sm-3 control-label">Bio</label>
                            <div class="col-sm-6">
                                  <textarea class="form-control" rows="5" id="bio" name="bio"> {{$user->getProfile()->bio}}</textarea>
                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="col-sm-offset-3 col-sm-6">
                              <button type="submit" class="btn btn-success">
                                  <i class="fa fa-btn fa-save"></i>Save Profile
                              </button>
                              <a href="{{route('view_profile', ['id' => $user->id])}}" class="btn btn-default">
                                  <i class="fa fa-btn fa-undo"></i>Return</a>
                          </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>










@include('common.lfm_standalone')
@endsection




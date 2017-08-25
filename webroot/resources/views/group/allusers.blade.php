@extends('layouts.admin')

@section('content')
  <div class="col-sm-offset-2 col-sm-8">
    <div class="panel panel-default">
        <div class="panel-heading">
            Users
        </div>

        <div class="panel-body">
        <table>
          <tr>
            <th>ID</th>
            <th>Avatar</th>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
          </tr>
          @foreach ($users as $user)
          <tr>
            <td>
              {{$user->id}}
            </td>
            <td>
              <div class='form-avatar'>
                <img src="{{$user->getProfile()->avatar}}">
              </div>
            </td>
            <td>
              <a href="{{'/user/' . $user->id}}">{{$user->name}}</a>
            </td>
            <td>
              <a href="mailto:{{$user->email}}">{{$user->email}}</a>
            </td>
            <td style="display:flex;">
              <a href="{{'/user/' . $user->id . '/edit'}}" class="btn btn-info">
                  <i class="fa fa-btn fa-edit"></i>Edit
              </a>
              @if($user->is_admin)
              @if($user->id != 1)
              <form action="{{ route('revoke_admin', $user->id) }}" method="POST">
                              {{ csrf_field() }}
                  <button type="submit" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Revoke Admin</button>
              </form>
              @endif
              @else
              <form action="{{ route('promote_to_admin', $user->id) }}" method="POST">
                              {{ csrf_field() }}
                  <button type="submit" class="btn btn-warning"><i class="fa fa-wrench" aria-hidden="true"></i>&nbsp;Promote To Admin</button>
              </form>
              @endif
            </td>
          </tr>
          @endforeach
        </table>
          {{ $users->links() }}
        </div>
    </div>
  </div>
@endsection

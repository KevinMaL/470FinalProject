@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <h3 class="panel-heading">History Record {{ Auth::user()->name }} :</h3>

                <div class="panel-body">
                <a href="/calories/check">
                  <button type="submit" class="btn btn-success">
                        <i class="fa fa-btn fa-check"></i>Check your Calories
                  </button>
                </a>
                    <table class="table">
                    <thead>
                      <tr>
                        <th>Weight</th>
                        <th>Calories Calculate</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($calorie_obj as $calories)
                      <tr>
                        <td>{{ $calories->weight }} Kg</td>
                        <td>{{ $calories->caloriecalculate }}</td>

                      </tr>
                        @endforeach
                    </tbody>

                  </table>
                  <div class="text-center">

                  {{ $calorie_obj->links() }}
                  </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

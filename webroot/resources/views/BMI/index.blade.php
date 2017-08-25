@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <h3 class="panel-heading">History Record {{ Auth::user()->name }} :</h3>

                <div class="panel-body">
                <a href="/BMI/check">
                  <button type="submit" class="btn btn-success">
                        <i class="fa fa-btn fa-check"></i>Check your BMI
                  </button>
                </a>
                    <table class="table">
                    <thead>
                      <tr>
                        <th>Weight</th>
                        <th>Height</th>
                        <th>BMI Calculate</th>
                        <th>Classification</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($BMI_obj as $bmis)
                      <tr>
                        <td>{{ $bmis->weight }} Kg</td>
                        <td>{{ $bmis->height }} m</td>
                        <td>{{ $bmis->bmicalculate }}</td>
                        <td>{{ $bmis->classification }}</td>

                      </tr>
                        @endforeach
                    </tbody>

                  </table>
                  <div class="text-center">

                  {{ $BMI_obj->links() }}
                  </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

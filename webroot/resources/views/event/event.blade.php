@extends('layouts.app')

@section('headers')
<script>
  function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 16,
          center: {lat: -34.397, lng: 150.644}
        });
        var geocoder = new google.maps.Geocoder();


        geocodeAddress(geocoder, map);

      }

  function geocodeAddress(geocoder, resultsMap) {
    var address = document.getElementById('address').value;
    geocoder.geocode({'address': address}, function(results, status) {
      if (status === 'OK') {
        resultsMap.setCenter(results[0].geometry.location);
        var marker = new google.maps.Marker({
          map: resultsMap,
          position: results[0].geometry.location
        });
      } else {
        geocoder.geocode({'address': "8888 University Dr, Burnaby"}, function(results, status) {
            resultsMap.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
              map: resultsMap,
              position: results[0].geometry.location
            });
        });
        jQuery('#maperror').text('The address input cannot find a match, map set to SFU');
      }
    });
  }
</script>
@endsection


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
            <div class="panel-heading">{{$event->title}}</div>

                <div class="panel-body">
                {{$event->event_description}}
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Location</div>
                <div class="panel-body">
                    <div class="address">{{$event->address}}</div>

                    <input id="address" type="textbox" value="{{$event->address}}" style="display:none;">
                    <div id="maperror" style="color:red;"></div>
                    <div id="map" style="height:400px;"></div>

                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Time</div>
                <div class="panel-body">
                    <div class="upcoming-event" style="padding:20px; text-align:center;">
                        <a href={{url('/user/me')}}>
                        <img style="height:96px; width:96px;" src="/assets/images/calendar.png">
                        </a>
                        <div style="font-style:italic;">Starts:{{$event->event_start}}</div>
                        <div style="font-style:italic;">Ends:{{$event->event_end}}</div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Who's Coming</div>
                <div class="panel-body" style="text-align:center;">
                    @if(!$event->hasMe())
                    <form action="{{ route('add_me_to_event', $event->id) }}" method="POST">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Sign Me Up</button>
                    </form>

                    @else
                    <form action="{{ route('remove_me_from_event', $event->id) }}" method="POST">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Remove Me From List</button>
                    </form>

                    @endif
                    <div class="user-list" style="display: flex; flex-wrap: wrap; padding-top:15px">
                        @foreach ($users as $user)
                        <div class="user-list-item" style="flex-grow: 0;width: 33%;">
                            <div>
                            <img src="{{$user->getProfile()->avatar}}" style="width:64px; height:64px;">
                            </div>
                            <a href="{{'/user/' . $user->id}}">{{$user->name}}</a>
                        </div>
                        @endforeach
                        {{$users->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCpJbw-DipTtwa5bnuT_l-8tqI82SdAtPs&callback=initMap"
async defer></script>
@endsection

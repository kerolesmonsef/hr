{{Form::model($finger_print_location,array('route' => array('employee-finger-print.update', $finger_print_location->id), 'method' => 'PUT')) }}
<div class="row">
   

    <div class="form-group">
        <input type="hidden" name="employee_id"
        value="{{ $finger_print_location->employee_id }}" />
        {{Form::label('title',__('Title'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
        {{Form::text('title',$finger_print_location -> title ,array('class'=>'form-control' ))}}
        @error('title')
        <span class="invalid-name" role="alert">
            <strong class="text-danger">{{ $message }}</strong>
        </span>
        @enderror
    </div>

    

    <div class="col-md-12">
        <div class="form-group">
            <label for="timezone">{{__('company_map_location')}}</label>
            {{Form::hidden('lat',$finger_print_location->lat ? $finger_print_location->lat : '24.7305650',array('class'=>'form-control' , 'id' => 'lat'))}}
            {{Form::hidden('long',$finger_print_location->lon ? $finger_print_location->lon : '46.6555170',array('class'=>'form-control' , 'id' => 'lon'))}}
            <div style="width: 100%;height: 300px;" id="map"></div>
        </div>
    </div>

    <div class="col-12">
        <input type="submit" value="{{__('Update')}}" class="btn btn-primary">
        <input type="button" value="{{__('Cancel')}}" class="btn btn-white" data-bs-dismiss="modal">
    </div>
</div>
{{Form::close()}}

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_foD6VvulHSpxKYjtgehkQ_UoVGHH64Y&callback=initMap&libraries=places,geometry"></script>
<script>
    function initMap() {
            var latlng = new google.maps.LatLng(document.getElementById("lat").value, document.getElementById("lon").value);
            var map = new google.maps.Map(document.getElementById('map'), {
                center: latlng,
                zoom: 10,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            var marker = new google.maps.Marker({
                position: latlng,
                map: map,
                title: 'Set lat/lon values for this property',
                draggable: true
            });

            // Try HTML5 geolocation.
            if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    map.setCenter(pos);
                    marker.setPosition(pos);
                    document.getElementById("lat").value = pos.lat;
                    document.getElementById("lon").value = pos.lng;
                    }, function() {
                    handleLocationError(true, map.getCenter());
                    });
            } else {
                // Browser doesn't support Geolocation
                handleLocationError(false, map.getCenter());
            }

            google.maps.event.addListener(marker, 'dragend', function(a) {
            document.getElementById("lat").value = a.latLng.lat().toFixed(6);
            document.getElementById("lon").value = a.latLng.lng().toFixed(6);
            });
    };
</script>


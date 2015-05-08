function maps() {

    // Get map canvas elements

    var $maps = $('.map-canvas');

    // If map canvas elements exist

    if ($maps.length) {

        // Loop through each map canvas element

        $maps.each(function(index, element) {

            // Get map locations   

            $locations      = $(element).children('.location');

            // Get map options

            var width       = $(element).data("width");
            var height      = $(element).data("height");
            var zoom        = $(element).data("zoom");
            var scrollwheel = $(element).data("scrollwheel");

            // Declare map vairables

            var bounds;
            var map;
            var infowindow;
            var marker;
            var options = {
                zoom           : zoom,
                scrollwheel    : scrollwheel,
                MapTypeId      : google.maps.MapTypeId.ROADMAP,
            };

            bounds = new google.maps.LatLngBounds();

            map = new google.maps.Map(element, options);

            infowindow = new google.maps.InfoWindow();

            // Set map dimensions

            $(this).css({'width':width, 'height':height});

            // Plot each location

            $locations.each(function() {

                // Get location variables

                var location_information = $(this).children('[name=location_information]').val();
                var location_latitude = $(this).children('[name=location_latitude]').val();
                var location_longitude = $(this).children('[name=location_longitude]').val();
                var location_coordinates = new google.maps.LatLng(location_latitude,location_longitude);

                // Generate marker

                marker = new google.maps.Marker({
                    position: location_coordinates,
                });

                marker.setMap(map);

                // Extend bounds to include each marker

                bounds.extend(marker.position);

                // Set infowindow content

                var infowindowcontent = '';

                if (location_information) {
                    var infowindowinformation = location_information;
                }

                if (typeof infowindowinformation !== 'undefined') {
                    infowindowcontent += infowindowinformation;
                }

                // Open infowindow on click

                google.maps.event.addListener(marker, 'click', (function(marker) {
                    return function() {
                        if(infowindowcontent) {
                            infowindow.setContent(infowindowcontent);
                            infowindow.open(map, marker);
                        }
                    }
                })(marker));

                // If center location selected

                if ( $(this).hasClass("location_center") ) {
                    // Set variable to verify center location is found
                    location_center = true;
                    // Center map to master location
                    map.setCenter(location_coordinates);
                }

                // If location infowindow enabled

                if ( $(this).hasClass("location_infowindow") ) {
                    if(infowindowcontent) {
                        infowindow.setContent(infowindowcontent);
                        infowindow.open(map, marker);
                    }
                }
            });

            // If no center location selected

            if ( typeof location_center === 'undefined' ) {

                // Fit bounds extended to include each marker

                map.fitBounds(bounds);

                // Force reset zoom once bounds are fitted and map is centered

                /*var listener = google.maps.event.addListener(map, "idle", function () {
                    map.setZoom(10);
                    google.maps.event.removeListener(listener);
                });*/
            }
        });
    }
}

function initialize() {

    maps()

}

function loadScript() {
  //var map_container = document.getElementById('map-canvas-contact');
  //if (map_container) {
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&' +
        'callback=initialize';
    document.body.appendChild(script);
  //}
}

window.onload = loadScript;
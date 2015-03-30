function maps() {

    // Get map canvas elements

    var $maps = $('.map-canvas');

    // If map canvas elements exist

    if ($maps.length) {

        // Loop through each canvas element

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

                var location_title = $(this).children('[name=location_title]').val();
                var location_url = $(this).children('[name=location_url]').val();
                var location_phone = $(this).children('[name=location_phone]').val();
                var location_address = $(this).children('[name=location_address]').val();
                var location_latitude = $(this).children('[name=location_latitude]').val();
                var location_longitude = $(this).children('[name=location_longitude]').val();
                var location_coordinates = new google.maps.LatLng(location_latitude,location_longitude);

                // Generate marker

                var marker = new google.maps.Marker({
                    position: location_coordinates,
                    title: location_title,
                });

                marker.setMap(map);

                // Extend bounds to include each marker

                bounds.extend(marker.position);

                // Set infowindow content

                var infowindowcontent = '';

                if (location_title) {
                    var infowindowtitle = "<b>" + location_title + "</b><br/>";
                }

                if (location_url) {
                    var infowindowurl = "<a href='" + location_url + "' target='_blank'>" + location_url + "</a><br/>";
                }

                if (location_phone) {
                    var infowindowphone = "<a href='tel:" + location_phone + "' target='_blank'>" + location_phone + "</a><br/>";
                }

                if (location_address) {
                    var infowindowaddress = location_address;
                }

                if (typeof infowindowtitle !== 'undefined') {
                    infowindowcontent += infowindowtitle;
                }

                if (typeof infowindowurl !== 'undefined') {
                    infowindowcontent += infowindowurl;
                }

                if (typeof infowindowphone !== 'undefined') {
                    infowindowcontent += infowindowphone;
                }

                if (typeof infowindowaddress !== 'undefined') {
                    infowindowcontent += infowindowaddress;
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

                // If master location selected

                if ( $(this).hasClass("location_master") ) {
                    // Set variable to verify master location is found
                    location_master = true;
                    // Center map to master location
                    map.setCenter(location_coordinates);
                    // Open infowindow on load
                    if(infowindowcontent) {
                        infowindow.setContent(infowindowcontent);
                        infowindow.open(map, marker);
                    }
                }
            });

            // If no master location selected

            if ( typeof location_master === 'undefined' ) {

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
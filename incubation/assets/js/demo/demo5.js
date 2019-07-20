/* ----------------------------------
Description: Script for Home Event style
Name: demo5.js
---------------------------------- */

function demo_5() {
    (function($) {

        // menu on-scroll event
        $(window).scroll(function() {
            if ($("nav").offset().top > 50) {
                $("nav").addClass("scroll-nav");
            } else {
                $("nav").removeClass("scroll-nav");
            }
        });


        // equal height
        $('.part').matchHeight();

        // team-3 slider/carousel
        var owl = $('#team-3');
        owl.owlCarousel({
            singleItem: true,
            autoPlay: true,
            navigation: false,
            slideSpeed: 300,
            paginationSpeed: 500,
            rewindSpeed: 400
        });


        // initialize counter
        $('#countdown').countdown('2017/01/01 00:00:00', function(event) {
            $('#countdown #days').html(event.strftime('%D'));
            $('#countdown #hours').html(event.strftime('%H'));
            $('#countdown #minutes').html(event.strftime('%M'));
            $('#countdown #seconds').html(event.strftime('%S'));
        });

    })(jQuery);
}


// google map initialization
var marker;

function initialize() {

    // change map styles
    var styles = [{
        stylers: [{
            hue: '#2d313f'
        }, {
            saturation: '-20'
        }, {
            lightness: '5'
        }]
    }, {
        featureType: 'transit',
        elementType: 'geometry.fill',
        stylers: [{
            hue: '#2d313f'
        }, {
            saturation: '-20'
        }, {
            lightness: '5'
        }]
    }, {
        featureType: 'poi',
        elementType: 'geometry.fill',
        stylers: [{
            hue: '#2d313f'
        }, {
            saturation: '-20'
        }, {
            lightness: '5'
        }]

    }, {
        featureType: 'poi.government',
        elementType: 'geometry.fill',
        stylers: [{
            hue: '#2d313f'
        }, {
            saturation: '-20'
        }, {
            lightness: '5'
        }]

    }, {
        featureType: 'poi.sport_complex',
        elementType: 'geometry.fill',
        stylers: [{
            hue: '#2d313f'
        }, {
            saturation: '-20'
        }, {
            lightness: '5'
        }]

    }, {
        featureType: 'poi.attraction',
        elementType: 'geometry.fill',
        stylers: [{
            hue: '#2d313f'
        }, {
            saturation: '-20'
        }, {
            lightness: '5'
        }]

    }, {
        featureType: 'poi.business',
        elementType: 'geometry.fill',
        stylers: [{
            hue: '#2d313f'
        }, {
            saturation: '-20'
        }, {
            lightness: '5'
        }]

    }, {
        featureType: 'transit',
        elementType: 'geometry.fill',
        stylers: [{
            hue: '#2d313f'
        }, {
            saturation: '-20'
        }, {
            lightness: '5'
        }]
    }, {
        featureType: 'transit.station',
        elementType: 'geometry.fill',
        stylers: [{
            hue: '#2d313f'
        }, {
            saturation: '-20'
        }, {
            lightness: '5'
        }]

    }, {
        featureType: 'landscape',
        stylers: [{
            hue: '#2d313f'
        }, {
            saturation: '-20'
        }, {
            lightness: '5'
        }]

    }, {
        featureType: 'road',
        elementType: 'geometry.fill',
        stylers: [{
            hue: '#2d313f'
        }, {
            saturation: '-20'
        }, {
            lightness: '5'
        }]
    }, {
        featureType: 'road.highway',
        elementType: 'geometry.fill',
        stylers: [{
            hue: '#2d313f'
        }, {
            saturation: '-20'
        }, {
            lightness: '5'
        }]
    }, {
        featureType: 'water',
        elementType: 'geometry',
        stylers: [{
            hue: '#2d313f'
        }, {
            saturation: '-20'
        }, {
            lightness: '5'
        }]
    }];

    var my_position = {
        lat: 51.5048979,
        lng: -0.1335535
    };

    var mapProp = {
        zoom: 17,
        center: my_position,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        streetViewControl: false,
        mapTypeControl: false,
        scrollwheel: false
    };

    // icon address
    var iconBase = '../../assets/img/other/';
    // map goes here 
    var map = new google.maps.Map(document.getElementById('googleMap'), mapProp);

    // set new map style here
    map.setOptions({
        styles: styles
    });
    marker = new google.maps.Marker({
        position: my_position,
        icon: iconBase + 'icon-location.png'
    });
    marker.setMap(map);
    var contentString = 'Conference is here :-)';
    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });
    infowindow.open(map, marker);
    marker.addListener('click', function() {
        infowindow.open(map, marker);
        map.setCenter(marker.getPosition());
    });
    // to center the marker always on zoom-in-out
    google.maps.event.addListener(map, 'center_changed', function() {
        window.setTimeout(function() {
            map.panTo(marker.getPosition());
        }, 0);
    });
}
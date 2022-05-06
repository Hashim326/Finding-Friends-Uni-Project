var counter = 0;

//creates map with default view of europe
var map = new ol.Map({
    target: 'map',
    layers: [
        new ol.layer.Tile({
            source: new ol.source.OSM()
        })
    ],
    view: new ol.View({
        center: ol.proj.fromLonLat([15.2551, 54.5260]),
        zoom: 4
    })
})

//adds a layer to that allows markers to be added
var vectorLayer = new ol.layer.Vector({
    source: new ol.source.Vector(),
    style: new ol.style.Style({
        image: new ol.style.Icon({
            anchor: [0.5, 1],
            src: '../images/location-pin.png'
        })
    })
});

//assigns html elements to appropriate variables
const container = document.getElementById('popup');
const content = document.getElementById('popup-content');
const closer = document.getElementById('popup-closer');

//creates an overlay used to hold information about pin
const overlay = new ol.Overlay({
    element: container,
    //pans the view across to the pin the user has clicked
    autoPan: {
        animation: {
            duration: 250,
        },
    },
});

//adds the overlay to the map
map.addOverlay(overlay);

//closes the overlay element if close button is clicked
closer.onclick = function () {
    overlay.setPosition(undefined);
    closer.blur();
    //prevents pan animation from triggering
    return false;
};

//map click handler
map.on('singleclick', function (evt) {
    //variable to hold name from the pin
    let name;

    //holds the coordinates of the users clicks
    const coordinate = evt.coordinate;

    //assigns the clicked feature (if at that location) to a variable
    const features = map.getFeaturesAtPixel(evt.pixel, {
        layerFilter: (layer) => layer === vectorLayer
    });

    //if retrieved feature exists display popup overlay
    if (features.length > 0){
        //retrieves the name of the clicked pin
        const name = features[0].get("description");
        console.log(name);

        //outputs the name as html
        content.innerHTML = '<b>'+ name +'</b>';
        //sets the overlay to the user click position
        overlay.setPosition(coordinate);
        console.log(overlay.getPosition());
        //popup.show(event.coordinate, '<b>'+ name +'</b>');

    } else {
        overlay.setPosition(undefined)
    }


});

//returns the map error
function geoError(err) {
    console.warn(`ERROR(${err.code}): ${err.message}`);

}

//sets marker on  the users current location
function setCurUserMarker(pos) {
    var crd = pos.coords;
    //generates marker at users current geo location
    var marker = new ol.Feature({
        geometry: new ol.geom.Point(ol.proj.fromLonLat([crd.longitude, crd.latitude])),
        description: "This is you",
    });

    //centres the map if it is the first time being loaded
    if (counter == 0){
        map.getView().setCenter(ol.proj.fromLonLat([crd.longitude, crd.latitude]));
        map.getView().setZoom(6);
        counter++;
    }

    //adds the marker to the vector layer
    //console.log(layer.getSource());
    vectorLayer.getSource().addFeature(marker);
}


//creates markers from coords
function createMarkerCoord(lat, long, firstName, surname){
    var marker = new ol.Feature({
        geometry: new ol.geom.Point(ol.proj.fromLonLat([long, lat])),
        description: firstName + " " + surname,
    });

    //console.log(marker);

    vectorLayer.getSource().addFeature(marker);

}

//adds layer to the map
map.addLayer(vectorLayer)



//if location is set marker on location and zoom

if (!navigator.geolocation) {
} else {
    console.log('Locating...');
    //navigator.geolocation.getCurrentPosition(drawCustomMap, geoError);
    navigator.geolocation.getCurrentPosition(setCurUserMarker, geoError);
    //console.log(crd);
}



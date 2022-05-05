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

//creates popup as overlay
const popup = new Popup();
map.addOverlay(popup);

//if marker and click are in the same place, display the name of the marker
map.on("click", (event) => {
    let name;

    const features = map.getFeaturesAtPixel(event.pixel, {
        layerFilter: (layer) => layer === vectorLayer
    });

    if (features.length > 0){
        const name = features[0].get("description");
        console.log(name);
        popup.show(event.coordinate, '<b>'+ name +'</b>');

    } else {
        popup.hide();
    }
});


//returns the map error
function geoError(err) {
    console.warn(`ERROR(${err.code}): ${err.message}`);

}



//sets marker on  the users current location
function setCurUserMarker(pos) {
    var crd = pos.coords;
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



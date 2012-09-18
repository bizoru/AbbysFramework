/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */




/* 
 * Cargador del Mapa 
 */

$(document).ready(init);


function loadMapa(){
    
    var map,capa;
    
    map = new OpenLayers.Map('mapa');
    capa = new OpenLayers.Layer.OSM();
    
    var lonLat = new OpenLayers.LonLat(46,-74);
          
 
    var zoom=5;
 
    var markers = new OpenLayers.Layer.Markers("Markers");
    
    map.addLayer(capa);
    map.addLayer(markers);
 
    markers.addMarker(new OpenLayers.Marker(lonLat));
 
    map.setCenter (lonLat, zoom);
        
    
  
}

function init() {
        map = new OpenLayers.Map("mapa");
        var mapnik         = new OpenLayers.Layer.OSM();
        var fromProjection = new OpenLayers.Projection("EPSG:4326");   // Transform from WGS 1984
        var toProjection   = map.getProjectionObject(); // to Spherical Mercator Projection
        var markers        = new OpenLayers.Layer.Markers("Markers");
        //var position       = new OpenLayers.LonLat(,).transform( fromProjection, toProjection);
        
        var MylonLat = new OpenLayers.LonLat(4.60906667,-74.1819)
        .transform(
        new OpenLayers.Projection("EPSG:4326"), // transform from WGS 1984
        map.getProjectionObject() // to Spherical Mercator ProjectionojectionObject() // to Spherical Mercator Projection
        );
        var zoom           = 15; 
 
        map.addLayer(mapnik);
        
        map.setCenter(MylonLat, zoom );
      }
/* 
 * Cargador del Mapa 
 */

$(document).ready(init);

    function init(){
        
                var lonLat;
                map = new OpenLayers.Map("mapa");
                map.addLayer(new OpenLayers.Layer.OSM());
                
                var lat = $("#lat").val();
                var lon = $("#lon").val();
                var marker = $("#marker").val();
                
                lonLat = new OpenLayers.LonLat(lon,lat).transform(new OpenLayers.Projection("EPSG:4326"),map.getProjectionObject());
                    
                                                   
                //var lonLat = new OpenLayers.LonLat( 4.60906667 ,-74.1819 )
                //var lonLat = new OpenLayers.LonLat( -74.1819 , 4.6090666)
                // to Spherical Mercator Projection
            
 
                var zoom=16;
 
                var markers = new OpenLayers.Layer.Markers( "Markers" );
                map.addLayer(markers);
                
                
                var size = new OpenLayers.Size(32,37);
                var offset = new OpenLayers.Pixel(-(size.w/2), -size.h);
                var icon = new OpenLayers.Icon(marker, size, offset);
                markers.addMarker(new OpenLayers.Marker(lonLat,icon));
                
 
                
 
                map.setCenter (lonLat, zoom);
            
            }
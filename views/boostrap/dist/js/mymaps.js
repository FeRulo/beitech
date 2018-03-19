/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 var map, lat, lng, ini;
    $(document).ready(function(){
  
      geolocalizar();

    });
    
//      $('#reini').on('click', reiniciar());
//      $('#compact').on('click', compactar());
    
     function compactar(){
        //borramos ruta y marcadores
        map.cleanRoute();
        map.removeMarkers();
        
        //pintamos marcador inicial
        map.addMarker({lat: ini[0], lng: ini[1],infoWindow: {content: 'Usted está aquí'}}); //marcador en ini =[lat, lng]

        //mostramos la ruta
        map.drawRoute({
          origin: ini,  // origen en coordenadas
          // destino en coordenadas del click o toque actual
          destination: [lat, lng], //ultimo marcador guardado en lat y lng
          strokeColor: '#000000',
          strokeOpacity: 0.6,
          strokeWeight: 5
        });

        //mostramos el marcador final
        map.addMarker({lat: lat, lng: lng});

      }
      
      function reiniciar(){
        //borramos ruta y marcadores
        map.cleanRoute();
        map.removeMarkers();

        //volvemos a pintar el mapa centrado en nuestra posicion
        geolocalizar();

      }

      function enlazarMarcador(e){

       // muestra ruta entre marcas anteriores y actuales
        map.drawRoute({
          origin: [lat, lng],  // origen en coordenadas anteriores
          // destino en coordenadas del click o toque actual
          destination: [e.latLng.lat(), e.latLng.lng()],
          strokeColor: '#000000',
          strokeOpacity: 0.6,
          strokeWeight: 5
        });

        lat = e.latLng.lat();
        lng = e.latLng.lng();

        map.addMarker({ lat: lat, lng: lng});
      };

    function geolocalizar(){
        GMaps.geolocate({
          success: function(position){
            lat = position.coords.latitude;
            lng = position.coords.longitude;
            ini=[lat, lng];
            map = new GMaps({
              el: '#map',
              lat: lat,
              lng: lng,
              click: enlazarMarcador,
              tap: enlazarMarcador
            });
            map.addMarker({ lat: lat, lng: lng});
          },
          error: function(error) { alert('Geolocalización falla: '+error.message); },
          not_supported: function(){ alert("Su navegador no soporta geolocalización"); }
        });
      };      
  

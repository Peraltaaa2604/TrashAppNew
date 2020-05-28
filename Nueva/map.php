<?php include 'header_usuario.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <style>
   /* Set the size of the div element that contains the map */
   #map {
    height: 400px;  /* The height is 400 pixels */
    width: 100%;  /* The width is the width of the web page */
  }
</style>
</head>
<body>
  <div id="map" align="center" class="container"></div>
  <input type="text" id="latitud" style="display:none">
  <input type="text" id="longitud" style="display:none">
  <script>
var marker;          //variable del marcador
var coords = {};    //coordenadas obtenidas con la geolocalización
//Funcion principal
initMAP = function () 
{
    //usamos la API para geolocalizar el usuario
    navigator.geolocation.getCurrentPosition(
      function (position){
        coords =  {
          lng: position.coords.longitude,
          lat: position.coords.latitude
        };
        document.getElementById("latitud").value = coords.lat;
        document.getElementById("longitud").value = coords.lng;
            setMAPA(coords);  //pasamos las coordenadas al metodo para crear el mapa
          },function(error){console.log(error);});
  }
  function setMAPA (coords)
  {   
      //Se crea una nueva instancia del objeto mapa
      var map = new google.maps.Map(document.getElementById('map'),
      {
        zoom: 17,
        center:new google.maps.LatLng(coords.lat,coords.lng),
      });
      //Creamos el marcador en el mapa con sus propiedades
      //para nuestro obetivo tenemos que poner el atributo draggable en true
      //position pondremos las mismas coordenas que obtuvimos en la geolocalización
      marker = new google.maps.Marker({
        map: map,
        draggable: true,
        animation: google.maps.Animation.DROP,
        position: new google.maps.LatLng(coords.lat,coords.lng),
      });
      //agregamos un evento al marcador junto con la funcion callback al igual que el evento dragend que indica 
      //cuando el usuario a soltado el marcador
      marker.addListener('click', toggleBounce);
      marker.addListener( 'dragend', function (event)
      {
        //escribimos las coordenadas de la posicion actual del marcador dentro del input #coords
        document.getElementById("latitud").value = this.getPosition().lat();
        document.getElementById("longitud").value = this.getPosition().lng();

      });
    }
//callback al hacer clic en el marcador lo que hace es quitar y poner la animacion BOUNCE
function toggleBOUNCE() {
  if (marker.getAnimation() !== null) {
    marker.setAnimation(null);
  } else {
    marker.setAnimation(google.maps.Animation.BOUNCE);
  }
}
function animarMAPA()//funcion crea un nuevo marcador en el mapa
{
  navigator.geolocation.getCurrentPosition(function(position) 
  {

    var pos = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);

    map.panTo(pos);

    var goldStar = {
      path: google.maps.SymbolPath.CIRCLE,
      strokeColor: '#FF4E51',
      fillColor: '#FF4E51',
      fillOpacity: .9,
      strokeWeight: 1,
      scale: 5,
    };
    var marker = new google.maps.Marker({
      position: pos,
      icon: goldStar,
      draggable: true,
      map: map
    });   
    
   var options = {//opciones de la nueva pocision
    map: map,
    position: pos,
  };
    //enviamos al socket la nueva pocision    
    //var infowindow = new google.maps.InfoWindow(options);ventana con informacion
    map.setCenter(options.position);//pocisionamos el mapa al centro de la nueva locacion

  });
}
// Carga de la libreria de google maps 
</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBkXg3bABW8Xm-Ee0OM_t4n0k4zVgPX4ek&callback=initMAP">
</script>
<div></div>
<button class="form-control btn btn-primary" name="solicitar" id="solicitar" onclick="enviarDATOS();">Solicitar</button>
<input class="form-control btn btn-success" type="button"  name="cancelar" id="cancelar" value="Cancelar" onClick="location.href='Panel_control.php'"> 
<div class="col-8" align="center" id="res"></div>
<input class="form-control btn btn-success" type="button"  name="aceptar" id="aceptar" value="Aceptar" onClick="location.href='Panel_control.php'" style="display:none"> 
<script type="text/javascript">
    //Constructor de Objeto Ajax
    function objetoAJAX(){
      var xmlhttp=false;
      try{
        xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
      }catch(e){
        try{
          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }catch(E){
          xmlhttp=false;
        }
      }
      if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
        xmlhttp=new XMLHttpRequest();
      }
      return xmlhttp;
    }
    //------------------
    
    //Funcion para poder enviar los datos por medio de metodo Ajax
    function enviarDATOS(){
      document.getElementById("solicitar").style.display = "none";
      document.getElementById("cancelar").style.display = "none";
      document.getElementById("aceptar").style.display = "block";

      ajax=objetoAJAX();
      ajax.open("POST", "sql_map_cliente.php", true);
      ajax.onreadystatechange=function(){
        if (ajax.readyState==4) {
          document.getElementById("res").innerHTML=ajax.responseText;
        }
      }
      var lat=document.getElementById("latitud").value;
      var lng=document.getElementById("longitud").value;

      ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
      ajax.send("latitud="+lat+"&longitud="+lng);
    }

  </script>
</body>
</html>
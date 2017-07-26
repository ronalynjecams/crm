<link href="../plugins/select2/css/select2.min.css" rel="stylesheet">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3&amp;sensor=false&amp;key=AIzaSyCkob67AYCZcbn189xLtuZMt8OLNbsvYZQ&amp;callback=loadmap" defer></script>
<script src="../plugins/select2/js/select2.min.js"></script> 
<!--===================================================-->
<div id="content-container" >
   
    
   <div id="page-title">
      <h1 class="page-header text-overflow"> 
                  <?php 
                  if($this->params['url']['type'] == 'bill_ship'){
                      echo 'Billing and Shipping Address'; 
                  }else if($this->params['url']['type'] == 'bill'){
                      echo 'Billing Address';
                  }else if($this->params['url']['type'] == 'ship'){
                      echo 'Shipping Address';
                  }  
                  ?>
     </h1>
   </div>
    
    <div class="row"  id="billmap_div">
         <div class="col-lg-12">
            <div class="panel">
               <div class="panel-heading">
                  <div class="panel-control">
                     <button class="btn btn-info" id="saveMap"><i class="fa fa-save fa-lg "> Save </i></button>
                  </div>
                  <h3 class="panel-title">
                  </h3>
                      <input type="hidden" id="quotation_id" value="<?php echo $this->params['url']['id']; ?>">
                      <input type="hidden" id="address_type" value="<?php echo $this->params['url']['type']; ?>">
               </div>
               <div id="billing-panel-collapse" class="collapse in">
                  <div class="panel-body">
                     <div class="form-group col-sm-6" align="center">
                        <input type="text" class="form-control" placeholder="Building No. / Room No. / Floor No. / Street No. / Block No. / Phase No." id="bill_address"> 
                     </div>
                     <div class="form-group col-sm-6" align="center"> 
                         <input type="text" class="form-control" placeholder="Address here" id="bill_geolocation" readonly>
                     </div>
                     <div class="form-group col-sm-9" align="center">
                        <input id="search-txt" type="text" class="form-control" placeholder="Search for location">
                     </div>
                     <div class="form-group col-sm-3" align="center">
                        <input id="search-btn" type="button" value="Search" class="btn btn-primary">
                        <!--<input id="detect-btn" type="button" value="My Location" disabled class="btn btn-info">-->
                        <span id="map-output"></span>
                     </div>
                     <center>
                        <div id="map-canvas" style="width:90%;height:400px;"></div>
                     </center>
                     <input id="bill_latitude" type="hidden">   
                     <input id="bill_longitude" type="hidden">   
                  </div>
               </div>
            </div>
         </div>
      </div>
      </div> 
    
    
    
    
    
</div>
<!--===================================================-->
<!--END CONTENT CONTAINER--> 
<script type="text/javascript">
   /*
    * Google Maps: Latitude-Longitude Finder Tool
    * http://salman-w.blogspot.com/2009/03/latitude-longitude-finder-tool.html
    */
   function loadmap() {
       ///////////////////////////////////////////////////////////////////
      ///// google map for billing address ////////////////////////////
      // initialize map
      var map = new google.maps.Map(document.getElementById("map-canvas"), {
          center: new google.maps.LatLng(14.71599, 121.042779),
          zoom: 13,
          mapTypeId: google.maps.MapTypeId.ROADMAP
      });
      // initialize marker
      var marker = new google.maps.Marker({
          position: map.getCenter(),
          draggable: true,
          map: map
      });
      // intercept map and marker movements
      google.maps.event.addListener(map, "idle", function() {
          marker.setPosition(map.getCenter());
          //				document.getElementById("map-output").innerHTML = "Latitude:  " + map.getCenter().lat().toFixed(6) + "<br>Longitude: " + map.getCenter().lng().toFixed(6) + "  <a href='https://www.google.com/maps?q=" + encodeURIComponent(map.getCenter().toUrlValue()) + "' target='_blank'>    View Map</a>";
          document.getElementById("map-output").innerHTML = "<a href='https://www.google.com/maps?q=" + encodeURIComponent(map.getCenter().toUrlValue()) + "' target='_blank' class='btn btn-warning'>View Map Directions</a>";

          $("#bill_latitude").val(map.getCenter().lat().toFixed(6));
          $("#bill_longitude").val(map.getCenter().lng().toFixed(6));

          /////////////////////////////////////////  

          var lat = map.getCenter().lat().toFixed(6);
          var lng = map.getCenter().lng().toFixed(6);

          var latlng = new google.maps.LatLng(lat, lng);
          // This is making the Geocode request
          var geocoder = new google.maps.Geocoder();
          geocoder.geocode({
              'latLng': latlng
          }, function(results, status) {
              if (status !== google.maps.GeocoderStatus.OK) {
                  alert(status);
              }
              // This is checking to see if the Geoeode Status is OK before proceeding
              if (status == google.maps.GeocoderStatus.OK) {
                  //            console.log(results);
                  var address = (results[0].formatted_address);
                  $("#bill_geolocation").val(address);
                  //                                                console.log(address);
              }
          });
          /////////////////////////////////////////////////////

      });
      google.maps.event.addListener(marker, "dragend", function(mapEvent) {
          map.panTo(mapEvent.latLng);
      });
      //   	// initialize geocoder
      var geocoder = new google.maps.Geocoder();
      google.maps.event.addDomListener(document.getElementById("search-btn"), "click", function() {
          geocoder.geocode({
              address: document.getElementById("search-txt").value
          }, function(results, status) {
              if (status == google.maps.GeocoderStatus.OK) {
                  var result = results[0];
                  document.getElementById("search-txt").value = result.formatted_address;
                  $("#address").val(result.formatted_address);
                  if (result.geometry.viewport) {
                      map.fitBounds(result.geometry.viewport);
                  } else {
                      map.setCenter(result.geometry.location);
                  }
              } else if (status == google.maps.GeocoderStatus.ZERO_RESULTS) {
                  alert("Sorry, geocoder API failed to locate the address.");
              } else {
                  alert("Input Address to search.");
              }
          });
      });
      //   	google.maps.event.addDomListener(document.getElementById("search-txt"), "keydown", function(domEvent) {
      //   		if (domEvent.which === 13 || domEvent.keyCode === 13) {
      //   			google.maps.event.trigger(document.getElementById("search-btn"), "click");
      //   		}
      //   	});
      // initialize geolocation
      if (navigator.geolocation) {
          google.maps.event.addDomListener(document.getElementById("detect-btn"), "click", function() {
              navigator.geolocation.getCurrentPosition(function(position) {
                  map.setCenter(new google.maps.LatLng(position.coords.latitude, position.coords.longitude));
              }, function() {
                  alert("Sorry, geolocation API failed to detect your location.");
              });
          });
          document.getElementById("detect-btn").disabled = false;
      }
 
   }
    
    
$(document).ready(function() {
    $("#saveMap").click(function() {
        var id = $("#quotation_id").val();
        var address_type = $("#address_type").val();
        var address = $("#bill_address").val();
        var geolocation = $("#bill_geolocation").val();
        var latitude = $("#bill_latitude").val();
        var longitude = $("#bill_longitude").val();
        
        var data = { "id": id,
                "address":address,
                "geolocation":geolocation,
                "latitude":latitude,
                "longitude":longitude,
                "address_type":address_type,
            } 

            $.ajax({
                url: "/quotations/saveAddressQuotation",
                type: 'POST', 
                data: {'data': data},
                dataType: 'json',
                success: function(dd){ 
                    window.close();
                },
                error: function(dd){
                    console.log(dd);
                }
            }); 
    });
});
</script> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Current Location on Map</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
    integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
    crossorigin=""/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script>
    <link rel="stylesheet" href="../home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.min.css" />
    <style>
      @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
      
      /* Add some basic styling to the map container */
      #map-container {
        width: auto;
        height: 300px;
        margin: auto;
        margin: 10px 20px;
        z-index: 2;
      }
      
      #contain {
        font-family: 'Poppins', sans-serif;
        margin: auto;
        align-items: center;
        text-align: center;
      }
      
      .nav-bar a {
        background: #06C167;
      }

      .logout-button {
        display: inline-block;
        padding: 10px 20px;
        background-color: #D9534F; /* Red color */
        color: white;
        text-decoration: none;
        border: none;
        cursor: pointer;
        margin-left: 10px;
      }

      .logout-button:hover {
        background-color: #C9302C; /* Darker red on hover */
      }

      @media screen and (max-width: 600px) {
        #map-container {
          height: 200px;
        }
      }
    </style>
</head>
<body>
<header>
    <div class="logo">Food <b style="color: #06C167;">Donate</b></div>
    <div class="hamburger">
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
    </div>
    <nav class="nav-bar">
        <ul>
            <li><a href="delivery.php">Home</a></li>
            <li><a href="#" class="active">Map</a></li>
            <li><a href="deliverymyord.php">My Orders</a></li>
            <li><a href="logout.php" class="logout-button">Logout</a></li>
        </ul>
    </nav>
</header>
<br>
<script>
    hamburger = document.querySelector(".hamburger");
    hamburger.onclick = function() {
        navBar = document.querySelector(".nav-bar");
        navBar.classList.toggle("active");
    }
</script>
<div id="contain">
    <h3>Current Location</h3>
    <div id="map-container"></div>
    <div id="city-name"></div>
    <div id="address"></div>
    <br>
</div>

<script>
    // Initialize the map and user's location marker
    function initMap() {
        var mapContainer = document.getElementById("map-container");
        
        navigator.geolocation.getCurrentPosition(function(position) {
            var userLocation = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            
            var map = L.map(mapContainer).setView(userLocation, 15);
            
            // Add the OpenStreetMap tile layer to the map
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
                maxZoom: 18,
                tileSize: 512,
                zoomOffset: -1
            }).addTo(map);
            
            // Add a marker at the user's location
            var marker = L.marker(userLocation).addTo(map);
            marker.bindPopup("<b>You are here!</b>").openPopup();

            // Retrieve the city name using OpenStreetMap API
            var url = "https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=" + userLocation.lat + "&lon=" + userLocation.lng;
            fetch(url)
                .then(function (response) {
                    return response.json();
                })
                .then(function (data) {
                    var cityName = data.address.city || data.address.town;
                    var cityNameElement = document.getElementById("city-name");
                    cityNameElement.innerHTML = "You are in " + cityName;
                });

            // Use reverse geocoding to get the user's address
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    document.getElementById("address").innerHTML = `You are at ${data.display_name}`;
                });
        }, function() {
            alert("Error: The Geolocation service failed.");
        });
    }
</script>

<script>
    function getVisitorLocation() {
        fetch("https://ipapi.co/json/")
            .then(response => response.json())
            .then(data => {
                var country = data.country;
                var ip = data.ip;

                document.getElementById("country").innerHTML = country; 
                document.getElementById("ip").innerHTML = ip;
            })
            .catch(error => {
                console.log("Error retrieving location data: " + error);
            });
    }

    getVisitorLocation();
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap"></script>
</body>
</html>

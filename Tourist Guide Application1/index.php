<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Home Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="indexStyle.css">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
    
    <!-- Leaflet JavaScript -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
    crossorigin=""></script>
    <style>
        #map {
            height: 30rem;
            width: 90%;
            margin-top: 5rem;
            margin-top: 1rem;
            margin-bottom: -1rem;
        }
    </style>
</head>
<body>
    <nav>
        <label for="check" class="checkbtn">&#9776;</label>
        <label class="logo"><span class="logoText">T</span><span class="logoText">G</span>
        <span class="logoText">A</span></label>
        <label class="logo1"><span class="logoText">Tourist</span>
        <span class="logoText">Guide</span>
        <span class="logoText">Application</span></label>
        <input type="checkbox" id="check">
        <ul>
            <li><a class="active" href="index.php">Home</a></li>
            <li><a href="AddPlacesFinal.html">Add Places</a></li>
            <li><a href="Review.html">Write Review</a></li>
            <?php if (isset($_SESSION['username'])) : ?>
                <li><a href="login signup/Logout.php" class="logout-btn">Logout</a></li>
            <?php else : ?>
                <li><a href="login signup/login.html" class="login-btn">Login</a></li>
            <?php endif; ?>
            <li class="closebtn" onclick="hideMenu()">&#10006;</li>
        </ul>
    </nav>
    <center>
        <div id="search-container">
            </div><br><br>
        <div id="search-results" class="ab"></div>
    </center>
    
    <div id="content-container">
        <section class="abc"> 
            <div class="abc-image">
                <img src="image/Homepage.jpg" alt="abc image" />
            </div>
            <div class="abc-content">
                <?php if (isset($_SESSION['username'])) : ?>
                    <h1 class="user-greeting"><?php echo $_SESSION['username']; ?>! Welcome to Our Tourist guide
                        application</h1>
                <?php else : ?>
                    <h1 class="user-greeting"> Welcome to Our Tourist guide application</h1>
                <?php endif; ?>
            </div>
        </section>
        <section id="destinations" class="destinations">
            <h2 class="left">Popular Destinations...</h2><br><br>
            <div class="card-container">
                <!-- Repeat the following block for each card -->
                <a href="placeadd.php?city=kathmandu">
                    <div class="card">
                        <img src="image/kathmanduu.jpg" alt="Card Image">
                        <div class="card-content">
                            <h2>Kathmandu</h2>
                        </div>
                    </div>
                </a>
                <a href="placeadd.php?city=Bhaktapur">
                    <div class="card">
                        <img src="image/p1.jpg" alt="Card Image">
                        <div class="card-content">
                            <h2>Bhaktapur</h2>
                        </div>
                    </div>
                </a>
                <a href="placeadd.php?city=Dharan">
                    <div class="card">
                        <img src="image/dharan.jpg" alt="Card Image">
                        <div class="card-content">
                            <h2>Dharan</h2>  
                        </div>
                    </div>
                </a>
                <a href="placeadd.php?city=Grkha">
                    <div class="card">
                        <img src="image/gorkha.jpg" alt="Card Image">
                        <div class="card-content">
                            <h2>Gorkha</h2>
                        </div>
                    </div>
                </a>
                <a href="placeadd.php?city=Lamjung">
                    <div class="card">
                        <img src="image/lamjungg.jpg" alt="Card Image">
                        <div class="card-content">
                            <h2>Lamjung</h2>
                        </div>
                    </div>
                </a>
                <a href="placeadd.php?city=Lamjung">
                    <div class="card">
                        <img src="image/lamjungg.jpg" alt="Card Image">
                        <div class="card-content">
                            <h2>Lamjung</h2>
                        </div>
                    </div>
                </a>
                 <a href="placeadd.php?city=Lamjung">
                    <div class="card">
                        <img src="image/lamjungg.jpg" alt="Card Image">
                        <div class="card-content">
                            <h2>Lamjung</h2>
                        </div>
                    </div>
                </a>
                <!-- Repeat the above block for each card up to Card 8 -->
            </div>
            
        </section>
        
       <section class="destinations">
       <h2>Maps</h2>
         <center><div id="map"></div></center>
    </section>
        <footer>
            <p>&copy; 2024 Tourist Guide Application. All rights reserved.</p>
        </footer>

    </div>
    <script>
        function hideMenu() {
            document.getElementById("check").checked = false;
        }
        function scrollCards(direction) {
            const container = document.querySelector('.scroll-content');
            const scrollAmount = 300; // Adjust this value based on how much you want to scroll

            if (direction === 'left') {
                container.scrollBy({
                    left: -scrollAmount,
                    behavior: 'smooth'
                });
            } else if (direction === 'right') {
                container.scrollBy({
                    left: scrollAmount,
                    behavior: 'smooth'
                });
            }
        }

        
    </script>
     <script>
        var map = L.map('map', {
            zoomControl: false, // Disable default zoom control
            
            minZoom: 6, // Set minimum zoom level
            maxZoom: 18 // Set maximum zoom level
        }).setView([27.700769, 85.300140], 7.2); // Set initial view to Kathmandu

        // Add OpenStreetMap tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        }).addTo(map);

        // Add custom zoom control
        L.control.zoom({
            position: 'topleft' // Position the zoom control in the top left corner
        }).addTo(map);

        var redIcon = new L.Icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
            
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.1/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });


//KATHMANDU

        var kathmanduMarker = L.marker([27.700769, 85.300140], { icon: redIcon }).addTo(map);
        kathmanduMarker.bindPopup("<b>Kathmandu</b>").on('click', function() {
            map.removeLayer(kathmanduMarker);
            removeMarkers(['pokharaMarker', 'ChitwanMarker', 'BhaktapurMarker']);
            addSwayambhuMarker();
            addBouddhaMarker();
            addPatanMarker();
            addGardenOfDreamsMarker();
        });

        var PatanMarker, BouddhaMarker, GardenOfDreamsMarker, SwayambhuMarker;
        function addSwayambhuMarker() {
            var swayambhuIcon = new L.Icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.1/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
            SwayambhuMarker = L.marker([27.7146, 85.2899], { icon: swayambhuIcon }).addTo(map);
            SwayambhuMarker.bindPopup("<b>Swayambhu</b>").on('click',function(){
                map.removeLayer(SwayambhuMarker);
                removeMarkers(['BouddhaMarker', 'PatanMarker', 'GardenOfDreamsMarker']);
                addHotelMysticBuddhaMarker();
                addYulokoGuestHouseMarker();
            })

            // Hover feature for Swayambhu marker
            SwayambhuMarker.on('mouseover', function (e) {
                this.openPopup();
            });
            SwayambhuMarker.on('mouseout', function (e) {
                this.closePopup();
            });
        }

        function addHotelMysticBuddhaMarker(){
            var HotelMysticBuddhaMarkerIcon = new L.Icon({
                iconUrl: 'hotel-icon.png',
                
                iconSize: [25, 25],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
            var HotelMysticBuddhaMarker = L.marker([27.7124463814849, 85.28271181711729], { icon: HotelMysticBuddhaMarkerIcon }).addTo(map);
            HotelMysticBuddhaMarker.bindPopup("<b>Hotel Mystic Buddha</b><br>Rs.5,217");

            HotelMysticBuddhaMarker.on('mouseover', function (e) {
                this.openPopup();
            });
            HotelMysticBuddhaMarker.on('mouseout', function (e) {
                this.closePopup();
            });
         }

         function addYulokoGuestHouseMarker(){
            var YulokoGuestHouseMarkerIcon = new L.Icon({
                iconUrl: 'hotel-icon.png',
                
                iconSize: [25, 25],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
            var YulokoGuestHouseMarker = L.marker([27.715637716312678, 85.28429968479185], { icon: YulokoGuestHouseMarkerIcon }).addTo(map);
            YulokoGuestHouseMarker.bindPopup("<b>Yuloko Guest House</b><br>Rs.4,777");

            YulokoGuestHouseMarker.on('mouseover', function (e) {
                this.openPopup();
            });
            YulokoGuestHouseMarker.on('mouseout', function (e) {
                this.closePopup();
            });
         }

        
        function addBouddhaMarker() {
            var BouddhaIcon = new L.Icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-yellow.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.1/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
            BouddhaMarker = L.marker([27.721716307612486, 85.36197062246308], { icon: BouddhaIcon }).addTo(map);
            BouddhaMarker.bindPopup("<b>Bouddha</b>").on('click',function(){
                map.removeLayer(BouddhaMarker);
                removeMarkers(['SwayambhuMarker', 'PatanMarker', 'GardenOfDreamsMarker']);
                addHotelClaireInnMarker();
                addHotelLotusGemsMarker();
            })

            // Hover feature for Bouddha marker
            BouddhaMarker.on('mouseover', function (e) {
                this.openPopup();
            });
            BouddhaMarker.on('mouseout', function (e) {
                this.closePopup();
            });
        }
        function addHotelClaireInnMarker(){
            var HotelClaireInnMarkerIcon = new L.Icon({
                iconUrl: 'hotel-icon.png',
                
                iconSize: [25, 25],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
            var HotelClaireInnMarker = L.marker([27.722030661813196, 85.36007505813457], { icon: HotelClaireInnMarkerIcon }).addTo(map);
            HotelClaireInnMarker.bindPopup("<b>Hotel Claire Inn</b><br>Rs.2,654");

            HotelClaireInnMarker.on('mouseover', function (e) {
                this.openPopup();
            });
            HotelClaireInnMarker.on('mouseout', function (e) {
                this.closePopup();
            });
         }
         function addHotelLotusGemsMarker(){
            var HotelLotusGemsMarkerIcon = new L.Icon({
                iconUrl: 'hotel-icon.png',
                
                iconSize: [25, 25],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
            var HotelLotusGemsMarker = L.marker([27.722837931411394, 85.36228519827617], { icon: HotelLotusGemsMarkerIcon }).addTo(map);
            HotelLotusGemsMarker.bindPopup("<b>Hotel Lotus Gems</b><br>Rs.8,153");

            HotelLotusGemsMarker.on('mouseover', function (e) {
                this.openPopup();
            });
            HotelLotusGemsMarker.on('mouseout', function (e) {
                this.closePopup();
            });
         }




        function addPatanMarker() {
            var PatanIcon = new L.Icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-blue.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.1/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
            PatanMarker = L.marker([27.67526155690441, 85.32477920168469], { icon: PatanIcon }).addTo(map);
            PatanMarker.bindPopup("<b>Patan</b>").on('click',function(){
                map.removeLayer(PatanMarker);
                removeMarkers(['SwayambhuMarker', 'BouddhaMarker', 'GardenOfDreamsMarker']);
                addHotelpatanMarker();
                addLalitHeritageHomeMarker();
            })

            // Hover feature for Patan marker
            PatanMarker.on('mouseover', function (e) {
                this.openPopup();
            });
            PatanMarker.on('mouseout', function (e) {
                this.closePopup();
            });
        }
        function addHotelpatanMarker(){
            var HotelpatanMarkerIcon = new L.Icon({
                iconUrl: 'hotel-icon.png',
                
                iconSize: [25, 25],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
            var HotelpatanMarker = L.marker([27.67228347146426, 85.32719009674278], { icon: HotelpatanMarkerIcon }).addTo(map);
            HotelpatanMarker.bindPopup("<b>Hotel patan</b><br>Rs.4,929");

            HotelpatanMarker.on('mouseover', function (e) {
                this.openPopup();
            });
            HotelpatanMarker.on('mouseout', function (e) {
                this.closePopup();
            });
         }

         function addLalitHeritageHomeMarker(){
            var LalitHeritageHomeMarkerIcon = new L.Icon({
                iconUrl: 'hotel-icon.png',
                
                iconSize: [25, 25],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
            var LalitHeritageHomeMarker = L.marker([27.672573271536095, 85.32472782896366], { icon: LalitHeritageHomeMarkerIcon }).addTo(map);
            LalitHeritageHomeMarker.bindPopup("<b>LalitHeritageHome</b><br>Rs.8,153");

            LalitHeritageHomeMarker.on('mouseover', function (e) {
                this.openPopup();
            });
            LalitHeritageHomeMarker.on('mouseout', function (e) {
                this.closePopup();
            });
         }






        function addGardenOfDreamsMarker() {
            var GardenOfDreamsIcon = new L.Icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-orange.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.1/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
            GardenOfDreamsMarker = L.marker([27.713578749206405, 85.31503901431864], { icon: GardenOfDreamsIcon }).addTo(map);
            GardenOfDreamsMarker.bindPopup("<b>Garden Of Dreams</b>").on('click',function(){
                map.removeLayer(GardenOfDreamsMarker);
                removeMarkers(['SwayambhuMarker', 'BouddhaMarker', 'PatanMarker']);
                addHotelBarahiKathmanduMarker();
                addHotelDreamsConnectMarker();
            })

            // Hover feature for Swayambhu marker
            GardenOfDreamsMarker.on('mouseover', function (e) {
                this.openPopup();
            });
            GardenOfDreamsMarker.on('mouseout', function (e) {
                this.closePopup();
            });
        }

        function addHotelBarahiKathmanduMarker(){
            var HotelBarahiKathmanduMarkerIcon = new L.Icon({
                iconUrl: 'hotel-icon.png',
                
                iconSize: [25, 25],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
            var HotelBarahiKathmanduMarker = L.marker([27.672573271536095, 85.32472782896366], { icon: HotelBarahiKathmanduMarkerIcon }).addTo(map);
            HotelBarahiKathmanduMarker.bindPopup("<b>Hotel Barahi Kathmandu</b><br>Rs.18,470");

            HotelBarahiKathmanduMarker.on('mouseover', function (e) {
                this.openPopup();
            });
            HotelBarahiKathmanduMarker.on('mouseout', function (e) {
                this.closePopup();
            });
         }

         function addHotelDreamsConnectMarker(){
            var HotelDreamsConnectMarkerIcon = new L.Icon({
                iconUrl: 'hotel-icon.png',
                
                iconSize: [25, 25],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
            var HotelDreamsConnectMarker = L.marker([27.714661516846967, 85.31333372878576], { icon: HotelDreamsConnectMarkerIcon }).addTo(map);
            HotelDreamsConnectMarker.bindPopup("<b>Hotel Dreams Connect</b><br>Rs.5,307");

            HotelDreamsConnectMarker.on('mouseover', function (e) {
                this.openPopup();
            });
            HotelDreamsConnectMarker.on('mouseout', function (e) {
                this.closePopup();
            });
         }

//POKHARA

        var pokharaMarker = L.marker([28.2096, 83.9856], { icon: redIcon }).addTo(map);
        pokharaMarker.bindPopup("<b>Pokhara</b>").on('click', function() {
            map.removeLayer(pokharaMarker);
            removeMarkers(['kathmanduMarker', 'ChitwanMarker', 'BhaktapurMarker']);
            addBasundharaparkMarker();
            addDevidfallsMarker();
            addPhewalakeMarker();
            addSarankotMarker();
            
        });
        var BasundharaparkMarker,DevidfallsMarker,SarankotMarker,PhewalakeMarker;


        function addBasundharaparkMarker() {
            var BasundharaparkIcon = new L.Icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.1/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
            BasundharaparkMarker = L.marker([28.20302640159188, 83.96482404171265], { icon: BasundharaparkIcon }).addTo(map);
            BasundharaparkMarker.bindPopup("<b>Basundharapark</b>").on('click',function(){
                map.removeLayer(BasundharaparkMarker);
                removeMarkers(['PhewalakeMarker', 'DevidfallsMarker', 'SarankotMarker']);
                addMingtangGardenCottageMarker();
                addHotelMountKailashResortMarker();
            })
            // Hover feature for Basundharapark marker
            BasundharaparkMarker.on('mouseover', function (e) {
                this.openPopup();
            });
            BasundharaparkMarker.on('mouseout', function (e) {
                this.closePopup();
            });
        }

        function addMingtangGardenCottageMarker(){
            var MingtangGardenCottageMarkerIcon = new L.Icon({
                iconUrl: 'hotel-icon.png',
                
                iconSize: [25, 25],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
            var MingtangGardenCottageMarker = L.marker([28.203848943288374, 83.96595056930367], { icon: MingtangGardenCottageMarkerIcon }).addTo(map);
            MingtangGardenCottageMarker.bindPopup("<b>Mingtang Garden Cottage (名堂)</b><br>Rs.8,624");

            MingtangGardenCottageMarker.on('mouseover', function (e) {
                this.openPopup();
            });
            MingtangGardenCottageMarker.on('mouseout', function (e) {
                this.closePopup();
            });
         }

         function addHotelMountKailashResortMarker(){
            var HotelMountKailashResortMarkerIcon = new L.Icon({
                iconUrl: 'hotel-icon.png',
                
                iconSize: [25, 25],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
            var HotelMountKailashResortMarker = L.marker([28.204786333996783, 83.96276526134494], { icon: HotelMountKailashResortMarkerIcon }).addTo(map);
            HotelMountKailashResortMarker.bindPopup("<b>Hotel Mount Kailash Resort</b><br>Rs.9,178");

            HotelMountKailashResortMarker.on('mouseover', function (e) {
                this.openPopup();
            });
            HotelMountKailashResortMarker.on('mouseout', function (e) {
                this.closePopup();
            });
         }



        function addDevidfallsMarker() {
            var DevidfallsIcon = new L.Icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-blue.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.1/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
            DevidfallsMarker = L.marker([28.189772213948807, 83.95862078015129], { icon: DevidfallsIcon }).addTo(map);
            DevidfallsMarker.bindPopup("<b>Devis Falls</b>").on('click',function(){
                map.removeLayer(DevidfallsMarker);
                removeMarkers(['PhewalakeMarker', 'BasundharaparkMarker', 'SarankotMarker']);
                addhoteldavisMarker();
                addHotelDevisFallMarker();
            })

            // Hover feature for Devidfalls marker
            DevidfallsMarker.on('mouseover', function (e) {
                this.openPopup();
            });
            DevidfallsMarker.on('mouseout', function (e) {
                this.closePopup();
            });
        }

        function addhoteldavisMarker(){
            var hoteldavisMarkerIcon = new L.Icon({
                iconUrl: 'hotel-icon.png',
                
                iconSize: [25, 25],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
            var hoteldavisMarker = L.marker([28.190590495532934, 83.95946897412519], { icon: hoteldavisMarkerIcon }).addTo(map);
            hoteldavisMarker.bindPopup("<b>hotel davis</b><br>");

            hoteldavisMarker.on('mouseover', function (e) {
                this.openPopup();
            });
            hoteldavisMarker.on('mouseout', function (e) {
                this.closePopup();
            });
         }

         function addHotelDevisFallMarker(){
            var HotelDevisFallMarkerIcon = new L.Icon({
                iconUrl: 'hotel-icon.png',
                
                iconSize: [25, 25],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
            var HotelDevisFallMarker = L.marker([28.18941464842808, 83.95919595129331], { icon: HotelDevisFallMarkerIcon }).addTo(map);
            HotelDevisFallMarker.bindPopup("<b>HotelDevisFall</b><br>");

            HotelDevisFallMarker.on('mouseover', function (e) {
                this.openPopup();
            });
            HotelDevisFallMarker.on('mouseout', function (e) {
                this.closePopup();
            });
         }


        function addPhewalakeMarker() {
            var PhewalakeIcon = new L.Icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-yellow.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.1/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
            PhewalakeMarker = L.marker([28.216618128053394, 83.9452561908648], { icon: PhewalakeIcon }).addTo(map);
            PhewalakeMarker.bindPopup("<b>Phewa Lake</b>").on('click',function(){
                map.removeLayer(PhewalakeMarker);
                removeMarkers(['DevidfallsMarker', 'BasundharaparkMarker', 'SarankotMarker']);
                addThePavilionsHimalayasLakeViewMarker();
                addSadhanaYogaRetreatCentreMarker();
            })


            // Hover feature for Phewalake marker
            PhewalakeMarker.on('mouseover', function (e) {
                this.openPopup();
            });
            PhewalakeMarker.on('mouseout', function (e) {
                this.closePopup();
            });
        }

        function addThePavilionsHimalayasLakeViewMarker(){
            var ThePavilionsHimalayasLakeViewMarkerIcon = new L.Icon({
                iconUrl: 'hotel-icon.png',
                
                iconSize: [25, 25],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
            var ThePavilionsHimalayasLakeViewMarker = L.marker([28.212742366954462, 83.9300537094432], { icon: ThePavilionsHimalayasLakeViewMarkerIcon }).addTo(map);
            ThePavilionsHimalayasLakeViewMarker.bindPopup("<b>The Pavilions Himalayas Lake View</b><br>Rs.36,488");

            ThePavilionsHimalayasLakeViewMarker.on('mouseover', function (e) {
                this.openPopup();
            });
            ThePavilionsHimalayasLakeViewMarker.on('mouseout', function (e) {
                this.closePopup();
            });
         }

         function addSadhanaYogaRetreatCentreMarker(){
            var SadhanaYogaRetreatCentreMarkerIcon = new L.Icon({
                iconUrl: 'hotel-icon.png',
                
                iconSize: [25, 25],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
            var SadhanaYogaRetreatCentreMarker = L.marker([28.228624296158777, 83.9477348315824], { icon: SadhanaYogaRetreatCentreMarkerIcon }).addTo(map);
            SadhanaYogaRetreatCentreMarker.bindPopup("<b>Sadhana Yoga Retreat Centre</b><br>Rs.19,638");

            SadhanaYogaRetreatCentreMarker.on('mouseover', function (e) {
                this.openPopup();
            });
            SadhanaYogaRetreatCentreMarker.on('mouseout', function (e) {
                this.closePopup();
            });
         }




        function addSarankotMarker() {
            var SarankotIcon = new L.Icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-orange.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.1/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
            SarankotMarker = L.marker([28.244149218973345, 83.94865405423279], { icon: SarankotIcon }).addTo(map);
            SarankotMarker.bindPopup("<b>Sarankot</b>").on('click',function(){
                map.removeLayer(SarankotMarker);
                removeMarkers(['DevidfallsMarker', 'BasundharaparkMarker', 'PhewalakeMarker']);
                addNayaGaunResortMarker();
                addPanoramicViewGuesthouseSarangkotMarker();
            })

            function addNayaGaunResortMarker(){
                var NayaGaunResortMarkerIcon = new L.Icon({
                    iconUrl: 'hotel-icon.png',
                    
                    iconSize: [25, 25],
                    iconAnchor: [12, 41],
                    popupAnchor: [1, -34],
                    shadowSize: [41, 41]
                });
                var NayaGaunResortMarker = L.marker([28.24210553806556, 83.94566282592693], { icon: NayaGaunResortMarkerIcon }).addTo(map);
                NayaGaunResortMarker.bindPopup("<b>NayaGaunResort</b><br>Rs.4,929");
    
                NayaGaunResortMarker.on('mouseover', function (e) {
                    this.openPopup();
                });
                NayaGaunResortMarker.on('mouseout', function (e) {
                    this.closePopup();
                });
             }


             function addPanoramicViewGuesthouseSarangkotMarker(){
                var PanoramicViewGuesthouseSarangkotMarkerIcon = new L.Icon({
                    iconUrl: 'hotel-icon.png',
                    
                    iconSize: [25, 25],
                    iconAnchor: [12, 41],
                    popupAnchor: [1, -34],
                    shadowSize: [41, 41]
                });
                var PanoramicViewGuesthouseSarangkotMarker = L.marker([28.24288056905221, 83.94817337346645], { icon: PanoramicViewGuesthouseSarangkotMarkerIcon }).addTo(map);
                PanoramicViewGuesthouseSarangkotMarker.bindPopup("<b>Panoramic View Guesthouse Sarangkot</b><br>Rs.3,795");
    
                PanoramicViewGuesthouseSarangkotMarker.on('mouseover', function (e) {
                    this.openPopup();
                });
                PanoramicViewGuesthouseSarangkotMarker.on('mouseout', function (e) {
                    this.closePopup();
                });
             }
    


            // Hover feature for Pashupatinath marker
            SarankotMarker.on('mouseover', function (e) {
                this.openPopup();
            });
            SarankotMarker.on('mouseout', function (e) {
                this.closePopup();
            });
        }

//CHITWAN
        var ChitwanMarker = L.marker([27.559288088414736, 84.3547902705659], { icon: redIcon }).addTo(map);
        ChitwanMarker.bindPopup("<b>Chitwan</b>").on('click', function() {
            map.removeLayer(ChitwanMarker);
            removeMarkers(['kathmanduMarker', 'pokharaMarker', 'BhaktapurMarker']);
            addBharatpurMarker();
            addDevghatMarker();
            addChitwanNationalParkMarker();
            addSaurahaMarker();
        });


        var DevghatMarker,BharatpurMarker,ChitwanNationalParkMarker,SaurahaMarker;

        function addBharatpurMarker() {
            var BharatpurMarkerIcon = new L.Icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.1/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
            BharatpurMarker = L.marker([27.684691209679933, 84.43721232374318], { icon: BharatpurMarkerIcon }).addTo(map);
            BharatpurMarker.bindPopup("<b>Bharatpur</b>").on('click',function(){
                map.removeLayer(BharatpurMarker);
                removeMarkers(['DevghatMarker', 'ChitwanNationalParkMarker', 'SaurahaMarker']);
                addHotelsureshMarker();
                addHOTELPANCHAMPALACEMarker();
            })

            // Hover feature for Bharatpur marker
            BharatpurMarker.on('mouseover', function (e) {
                this.openPopup();
            });
            BharatpurMarker.on('mouseout', function (e) {
                this.closePopup();
            });
        }

        function addHotelsureshMarker(){
            var HotelsureshMarkerIcon = new L.Icon({
                iconUrl: 'hotel-icon.png',
                
                iconSize: [25, 25],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
            var HotelsureshMarker = L.marker([27.22077743754433, 77.4818891768063], { icon: HotelsureshMarkerIcon }).addTo(map);
            HotelsureshMarker.bindPopup("<b>Hotel suresh</b><br>Rs.4,283");

            HotelsureshMarker.on('mouseover', function (e) {
                this.openPopup();
            });
            HotelsureshMarker.on('mouseout', function (e) {
                this.closePopup();
            });
         }

         function addHOTELPANCHAMPALACEMarker(){
            var HOTELPANCHAMPALACEMarkerIcon = new L.Icon({
                iconUrl: 'hotel-icon.png',
                
                iconSize: [25, 25],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
            var HOTELPANCHAMPALACEMarker = L.marker([27.21402247148997, 77.47944300228066], { icon: HOTELPANCHAMPALACEMarkerIcon }).addTo(map);
            HOTELPANCHAMPALACEMarker.bindPopup("<b>HOTEL PANCHAM PALACE</b><br>Rs.5,371");

            HOTELPANCHAMPALACEMarker.on('mouseover', function (e) {
                this.openPopup();
            });
            HOTELPANCHAMPALACEMarker.on('mouseout', function (e) {
                this.closePopup();
            });
         }


        function addDevghatMarker() {
            var DevghatIcon = new L.Icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-yellow.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.1/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
            DevghatMarker = L.marker([27.807089279258697, 84.40580563083235], { icon: DevghatIcon }).addTo(map);
            DevghatMarker.bindPopup("<b>Dev Ghat</b>").on('click',function(){
                map.removeLayer(DevghatMarker);
                removeMarkers(['BharatpurMarker', 'ChitwanNationalParkMarker', 'SaurahaMarker']);
                addBagaichaAdventureResortPvtLtdMarker();
                addTheGlasshousehotelMarker();
            })

            // Hover feature for Devghat marker
            DevghatMarker.on('mouseover', function (e) {
                this.openPopup();
            });
            DevghatMarker.on('mouseout', function (e) {
                this.closePopup();
            });
        }
        function addBagaichaAdventureResortPvtLtdMarker(){
            var BagaichaAdventureResortPvtLtdMarkerIcon = new L.Icon({
                iconUrl: 'hotel-icon.png',
                
                iconSize: [25, 25],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
            var BagaichaAdventureResortPvtLtdMarker = L.marker([27.675984286159245, 84.12512540223584], { icon: BagaichaAdventureResortPvtLtdMarkerIcon }).addTo(map);
            BagaichaAdventureResortPvtLtdMarker.bindPopup("<b>Bagaicha Adventure Resort Pvt. Ltd.</b><br>Rs.4,621");

            BagaichaAdventureResortPvtLtdMarker.on('mouseover', function (e) {
                this.openPopup();
            });
            BagaichaAdventureResortPvtLtdMarker.on('mouseout', function (e) {
                this.closePopup();
            });
         }

         function addTheGlasshousehotelMarker(){
            var TheGlasshousehotelMarkerIcon = new L.Icon({
                iconUrl: 'hotel-icon.png',
                
                iconSize: [25, 25],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
            var TheGlasshousehotelMarker = L.marker([27.22077743754433, 77.4818891768063], { icon: TheGlasshousehotelMarkerIcon }).addTo(map);
            TheGlasshousehotelMarker.bindPopup("<b>The Glasshouse hotel</b><br>Rs.1,417");

            TheGlasshousehotelMarker.on('mouseover', function (e) {
                this.openPopup();
            });
            TheGlasshousehotelMarker.on('mouseout', function (e) {
                this.closePopup();
            });
         }




        function addChitwanNationalParkMarker() {
            var ChitwanNationalParkIcon = new L.Icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-blue.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.1/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
            ChitwanNationalParkMarker = L.marker([27.51942770009097, 84.31353179546967], { icon: ChitwanNationalParkIcon }).addTo(map);
            ChitwanNationalParkMarker.bindPopup("<b>Chitwan National Park</b>").on('click',function(){
                map.removeLayer(ChitwanNationalParkMarker);
                removeMarkers(['BharatpurMarker', 'DevghatMarker', 'SaurahaMarker']);
                addJagatpurLodgebyAnnapurnaMarker();
                addTigerWildlifeResortMarker();
            })

            // Hover feature for ChitwanNationalPark marker
            ChitwanNationalParkMarker.on('mouseover', function (e) {
                this.openPopup();
            });
            ChitwanNationalParkMarker.on('mouseout', function (e) {
                this.closePopup();
            });
        }

        function addJagatpurLodgebyAnnapurnaMarker(){
            var JagatpurLodgebyAnnapurnaMarkerIcon = new L.Icon({
                iconUrl: 'hotel-icon.png',
                
                iconSize: [25, 25],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
            var JagatpurLodgebyAnnapurnaMarker = L.marker([27.610842751369056, 84.3182654183054], { icon: JagatpurLodgebyAnnapurnaMarkerIcon }).addTo(map);
            JagatpurLodgebyAnnapurnaMarker.bindPopup("<b>Jagatpur Lodge by Annapurna</b><br>Rs.28,371");

            JagatpurLodgebyAnnapurnaMarker.on('mouseover', function (e) {
                this.openPopup();
            });
            JagatpurLodgebyAnnapurnaMarker.on('mouseout', function (e) {
                this.closePopup();
            });
         }

         function addTigerWildlifeResortMarker(){
            var TigerWildlifeResortMarkerIcon = new L.Icon({
                iconUrl: 'hotel-icon.png',
                
                iconSize: [25, 25],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
            var TigerWildlifeResortMarker = L.marker([27.5677485939411, 84.26423549057073], { icon: TigerWildlifeResortMarkerIcon }).addTo(map);
            TigerWildlifeResortMarker.bindPopup("<b>Tiger Wildlife Resort</b><br>Rs.3,791");

            TigerWildlifeResortMarker.on('mouseover', function (e) {
                this.openPopup();
            });
            TigerWildlifeResortMarker.on('mouseout', function (e) {
                this.closePopup();
            });
         }



        function addSaurahaMarker() {
            var SaurahaIcon = new L.Icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-orange.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.1/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
            SaurahaMarker = L.marker([27.585976424561842, 84.50381008958209], { icon: SaurahaIcon }).addTo(map);
            SaurahaMarker.bindPopup("<b>Sauraha</b>").on('click',function(){
                map.removeLayer(SaurahaMarker);
                removeMarkers(['BharatpurMarker', 'DevghatMarker', 'ChitwanNationalParkMarker']);
                addHotelSaurahaGaidaHouseMarker();
                addCenterParkResortMarker();
            })

            // Hover feature for Pashupatinath marker
            SaurahaMarker.on('mouseover', function (e) {
                this.openPopup();
            });
            SaurahaMarker.on('mouseout', function (e) {
                this.closePopup();
            });
        }

        function addHotelSaurahaGaidaHouseMarker(){
            var HotelSaurahaGaidaHouseMarkerIcon = new L.Icon({
                iconUrl: 'hotel-icon.png',
                
                iconSize: [25, 25],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
            var HotelSaurahaGaidaHouseMarker = L.marker([27.58135075612676, 84.50727750187728], { icon: HotelSaurahaGaidaHouseMarkerIcon }).addTo(map);
            HotelSaurahaGaidaHouseMarker.bindPopup("<b>HotelSaurahaGaidaHouse</b><br>Rs.4,379");

            HotelSaurahaGaidaHouseMarker.on('mouseover', function (e) {
                this.openPopup();
            });
            HotelSaurahaGaidaHouseMarker.on('mouseout', function (e) {
                this.closePopup();
            });
         }
         function addCenterParkResortMarker(){
            var CenterParkResortMarkerIcon = new L.Icon({
                iconUrl: 'hotel-icon.png',
                
                iconSize: [25, 25],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
            var CenterParkResortMarker = L.marker([27.591402741969045, 84.50672650557429], { icon: CenterParkResortMarkerIcon }).addTo(map);
            CenterParkResortMarker.bindPopup("<b>CenterParkResort</b><br>Rs.6,625");

            CenterParkResortMarker.on('mouseover', function (e) {
                this.openPopup();
            });
            CenterParkResortMarker.on('mouseout', function (e) {
                this.closePopup();
            });
         }

//BHAKTAPUR

        var BhaktapurMarker = L.marker([27.67817248266414, 85.42954291533611], { icon: redIcon }).addTo(map);
        BhaktapurMarker.bindPopup("<b>Bhaktapur</b>").on('click', function() {
            map.removeLayer(BhaktapurMarker);
            removeMarkers(['kathmanduMarker', 'pokharaMarker', 'ChitwanMarker']);
            addPachpannaJhyaleMarker();
            addChaguNarayanMarker();
            addNyatapolaMarker();
            addBhaktapurDurbarSquareMarker();
        });

        function addPachpannaJhyaleMarker() {
            var PachpannaJhyaleIcon = new L.Icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.1/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
            var PachpannaJhyaleMarker = L.marker([27.672431362820912, 85.42854618390203], { icon: PachpannaJhyaleIcon }).addTo(map);
            PachpannaJhyaleMarker.bindPopup("<b>55 Window Palace</b>");

            // Hover feature for Swayambhu marker
            PachpannaJhyaleMarker.on('mouseover', function (e) {
                this.openPopup();
            });
            PachpannaJhyaleMarker.on('mouseout', function (e) {
                this.closePopup();
            });
        }

        function addChaguNarayanMarker() {
            var ChaguNarayanIcon = new L.Icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-yellow.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.1/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
            var ChaguNarayanMarker = L.marker([27.718570853148453, 85.42760971231957], { icon: ChaguNarayanIcon }).addTo(map);
            ChaguNarayanMarker.bindPopup("<b>Changu Narayan</b>");

            // Hover feature for Pashupatinath marker
            ChaguNarayanMarker.on('mouseover', function (e) {
                this.openPopup();
            });
            ChaguNarayanMarker.on('mouseout', function (e) {
                this.closePopup();
            });
        }

        function addNyatapolaMarker() {
            var NyatapolaIcon = new L.Icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-blue.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.1/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
            var NyatapolaMarker = L.marker([27.671587256267646, 85.42926409739489], { icon: NyatapolaIcon }).addTo(map);
            NyatapolaMarker.bindPopup("<b>Nyatapola Temple</b>");

            // Hover feature for Pashupatinath marker
            NyatapolaMarker.on('mouseover', function (e) {
                this.openPopup();
            });
            NyatapolaMarker.on('mouseout', function (e) {
                this.closePopup();
            });
        }

        function addBhaktapurDurbarSquareMarker() {
            var BhaktapurDurbarSquareIcon = new L.Icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-orange.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.1/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
            var BhaktapurDurbarSquareMarker = L.marker([27.67226951115895, 85.42829509547515], { icon: BhaktapurDurbarSquareIcon }).addTo(map);
            BhaktapurDurbarSquareMarker.bindPopup("<b>Bhaktapur Durbar Square</b>");

            // Hover feature for Pashupatinath marker
            BhaktapurDurbarSquareMarker.on('mouseover', function (e) {
                this.openPopup();
            });
            BhaktapurDurbarSquareMarker.on('mouseout', function (e) {
                this.closePopup();
            });
        }
        

        function removeMarkers(markersToRemove) {
            markersToRemove.forEach(marker => {
                if (window[marker]) {
                    map.removeLayer(window[marker]);
                }
            });
        }




        // Hover feature for Kathmandu marker
        kathmanduMarker.on('mouseover', function (e) {
            this.openPopup();
        });
        kathmanduMarker.on('mouseout', function (e) {
            this.closePopup();
        });

        // Hover feature for Pokhara marker
        pokharaMarker.on('mouseover', function (e) {
            this.openPopup();
        });
        pokharaMarker.on('mouseout', function (e) {
            this.closePopup();
        });
        // Hover feature for Chitwan marker
        ChitwanMarker.on('mouseover', function (e) {
            this.openPopup();
        });
        ChitwanMarker.on('mouseout', function (e) {
            this.closePopup();
        });
        // Hover feature for Bhaktapur marker
        BhaktapurMarker.on('mouseover', function (e) {
            this.openPopup();
        });
        BhaktapurMarker.on('mouseout', function (e) {
            this.closePopup();
        });

       
    </script>
</body>

</html>

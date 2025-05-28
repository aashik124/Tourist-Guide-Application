// Function to prevent default behavior for drag and drop for places
function allowPlaceDrop(event) {
    event.preventDefault();
}

// Function to handle dropping place images
function dropPlaceImages(event) {
    event.preventDefault();
    var files = event.dataTransfer.files;
    displayPlaceImages(event);
}

// Function to display uploaded place images
function displayPlaceImages(event) {
    console.log("Displaying place images");
    var files = event.target.files || event.dataTransfer.files;
    console.log("Place Files:", files);
    
    // Determine the uploaded files container for place images
    var uploadedFilesContainer = document.getElementById("placeUploadedFiles");
    console.log("Uploaded place files container:", uploadedFilesContainer);
    
    // Clear previous uploaded files
    uploadedFilesContainer.innerHTML = "";

    // Display uploaded images in the corresponding container
    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var img = document.createElement("img");
        img.src = URL.createObjectURL(file);
        img.setAttribute("alt", "Place Image");
        uploadedFilesContainer.appendChild(img);
    }
}

// Function to trigger file input for places
function triggerPlaceFileInput() {
    document.getElementById('placePicture').click();
}

// Event listener for dropping place images
document.getElementById('placeDragDropArea').addEventListener('drop', dropPlaceImages);

// Event listener for dragging over the place drag and drop area
document.getElementById('placeDragDropArea').addEventListener('dragover', allowPlaceDrop);

// Event listener for clicking on the place drag and drop area to trigger file input
document.getElementById('placeDragDropArea').addEventListener('click', triggerPlaceFileInput);

// Function to prevent default behavior for drag and drop for hotels
function allowDrop(event) {
    event.preventDefault();
}

// Function to handle dropping images for hotels
function dropImages(event, area, hotelId) {
    event.preventDefault();
    var files = event.dataTransfer.files;
    displayImages(event, area, hotelId);
}

// Function to display uploaded images for hotels
function displayImages(event, area, hotelId) {
    console.log("Displaying images for area:", area, "with hotelId:", hotelId);
    var files = event.target.files || event.dataTransfer.files;
    console.log("Files:", files);
    
    // Determine the uploaded files container based on the area and hotelId
    var uploadedFilesContainer = document.getElementById(`hotelUploadedFiles${hotelId}`);
    console.log("Uploaded files container:", uploadedFilesContainer);
    
    // Clear previous uploaded files
    uploadedFilesContainer.innerHTML = "";

    // Display uploaded images in the corresponding container
    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var img = document.createElement("img");
        img.src = URL.createObjectURL(file);
        img.setAttribute("alt", "Image");
        uploadedFilesContainer.appendChild(img);
    }
}

// Function to trigger file input for hotels
function triggerFileInput(area, hotelId) {
    document.getElementById(`hotelPicture_${hotelId}`).click();
}

// Define hotel facilities
const facilities = [
    "Free parking", "Swimming Pool", "Free WiFi", "Spa", "Restaurant", "Bar / Lounge",
    "Room Service", "Airport Shuttle", "Laundry Service", "Conference Facilities",
    "Business Center", "Fitness Center", "Concierge", "Childcare Services", "Car Rental",
    "Pet Friendly", "Wheelchair Accessible", "Elevator", "Safety Deposit Box",
    "Air conditioning", "Flat-screen TV", "Private Bathroom", "Kitchenette", "Balcony",
    "Minibar", "In-room Safe", "Coffee/Tea Maker", "Desk", "Telephone", "Hair Dryer",
    "Iron/Ironing Board", "Daily Housekeeping"
];

// Function to move addHotelButton
function moveAddHotelButton() {
    const container = document.getElementById("hotelsContainer");
    const addHotelButton = container.querySelector('.addHotel');
    container.appendChild(addHotelButton);
}

// Function to generate checkboxes for hotel facilities
function generateFacilityCheckboxes(container) {
    const facilityCheckboxes = document.createElement("div");
    facilityCheckboxes.classList.add("facilityCheckboxes");
    container.appendChild(facilityCheckboxes);

    // Add "Select All" checkbox on a separate line
    const selectAllContainer = document.createElement("div");
    selectAllContainer.classList.add("selectAllContainer");
    facilityCheckboxes.appendChild(selectAllContainer);

    const selectAllCheckbox = document.createElement("input");
    selectAllCheckbox.type = "checkbox";
    selectAllCheckbox.id = "selectAllFacilities";
    selectAllCheckbox.classList.add("selectAllFacilities");
    selectAllCheckbox.onclick = function() { toggleSelectAllFacilities(); };
    
    const selectAllLabel = document.createElement("label");
    selectAllLabel.htmlFor = "selectAllFacilities";
    selectAllLabel.textContent = "Select All";
    selectAllLabel.style.display = "inline-block";

    selectAllContainer.appendChild(selectAllCheckbox);
    selectAllContainer.appendChild(selectAllLabel);

    // Add individual facility checkboxes (excluding empty strings)
    facilities.forEach(function(facility) {
        if (facility !== "") {
            const checkbox = document.createElement("input");
            checkbox.type = "checkbox";
            checkbox.name = "facilities[]";
            checkbox.value = facility;
            
            const label = document.createElement("label");
            label.appendChild(checkbox);
            label.appendChild(document.createTextNode(facility));
            
            facilityCheckboxes.appendChild(label);
            facilityCheckboxes.appendChild(document.createElement("br")); // Add line break after each checkbox
        }
    });
}


// Call the function to generate checkboxes for the initial hotel input
const initialHotelInput = document.querySelector('.hotel-input');
generateFacilityCheckboxes(initialHotelInput);

// Function to toggle all facility checkboxes
function toggleSelectAllFacilities() {
    const checkboxes = document.querySelectorAll('.facilityCheckboxes input[type="checkbox"]');
    const selectAllCheckbox = document.getElementById('selectAllFacilities');
    
    checkboxes.forEach(checkbox => checkbox.checked = selectAllCheckbox.checked);
}

// Function to move "Add Another Hotel" button
function moveAddHotelButton() {
    const container = document.getElementById("hotelsContainer");
    const addHotelButton = container.querySelector('.addHotel');
    container.appendChild(addHotelButton);
}

// Event listener for clicking "Add Another Hotel" button
document.addEventListener("click", function(event) {
    if (event.target.classList.contains("addHotel")) {
        const container = document.getElementById("hotelsContainer");

        // Generate a unique identifier for the new hotel section
        var hotelId = Date.now();

        const newHotelInput = document.createElement("div");
        newHotelInput.classList.add("hotel-input");
        newHotelInput.dataset.hotelId = hotelId; // Set the unique hotel ID as a data attribute

        newHotelInput.innerHTML = `
            <label for="hotelName">Hotel Name:</label><br>
            <input type="text" class="hotelName" name="hotelName[]" required><br>
            <label for="contactNumber">Contact Number:</label><br>
            <input type="text" class="contactNumber" name="contactNumber[]" required><br>
            <label for="email">Email:</label><br>
            <input type="email" class="email" name="email[]" required><br>
            <label for="address">Address:</label><br>
            <input type="text" class="address" name="address[]" required><br>
            <label for="hotelDescription">Hotel Description:</label><br>
            <textarea class="hotelDescription" name="hotelDescription[]" rows="4" cols="50" required></textarea><br>
            <label for="hotelImages">Upload Hotel Pictures:</label><br>
            <!-- Drag and drop area -->
            <div class="drag-drop-area" id="hotelDragDropArea_${hotelId}" ondrop="dropImages(event, 'hotel', ${hotelId})" ondragover="allowDrop(event)" onclick="triggerFileInput('hotel', ${hotelId})">
                Drag & Drop or Click to Select Pictures
            </div>
            <input type="file" id="hotelPicture_${hotelId}" name="hotelPicture[]" accept="image/*" multiple style="display: none;" onchange="displayImages(event, 'hotel', ${hotelId})">
            <!-- Uploaded images container -->
            <div class="uploaded-files" id="hotelUploadedFiles${hotelId}" name="hotelUploadFiles[]"></div>
            
            <label for="hotelFacilities">Facilities:</label><br>
            <div class="facilityCheckboxes" id="facilityCheckboxes_${hotelId}"></div>
        `;
        container.appendChild(newHotelInput);
        generateFacilityCheckboxes(newHotelInput); // Generate checkboxes for hotel facilities in the new hotel input section
        moveAddHotelButton(); // Move the "Add Another Hotel" button to the bottom
    }
});

// Move the "Add Another Hotel" button initially to the bottom
moveAddHotelButton();

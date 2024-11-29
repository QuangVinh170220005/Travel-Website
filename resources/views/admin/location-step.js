// Handle Step 2 Location Details
document.addEventListener('DOMContentLoaded', function() {
    // Initialize variables
    const destinationsContainer = document.getElementById('destinations-container');
    const addDestinationBtn = document.getElementById('add-destination');
    let map;
    let marker;

    // Handle dynamic destinations
    addDestinationBtn.addEventListener('click', function() {
        const newDestination = document.createElement('div');
        newDestination.className = 'destination-entry flex gap-2 mb-2';
        newDestination.innerHTML = `
            <input type="text" 
                name="destinations[]" 
                class="form-input-field flex-1"
                placeholder="Enter destination name"
                required>
            <button type="button" class="remove-destination px-2 py-1 text-red-500 hover:text-red-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        `;
        destinationsContainer.appendChild(newDestination);
    });

    // Remove destination
    destinationsContainer.addEventListener('click', function(e) {
        if (e.target.closest('.remove-destination')) {
            const destinationEntry = e.target.closest('.destination-entry');
            if (destinationsContainer.children.length > 1) {
                destinationEntry.remove();
            } else {
                // If it's the last destination, just clear the input
                const input = destinationEntry.querySelector('input');
                input.value = '';
            }
        }
    });

    // Initialize map
    function initMap() {
        // Initialize map centered on Vietnam
        map = L.map('map').setView([16.047079, 108.206230], 12);

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Add draggable marker
        marker = L.marker([16.047079, 108.206230], {
            draggable: true
        }).addTo(map);

        // Update coordinates when marker is dragged
        marker.on('dragend', function(event) {
            const position = marker.getLatLng();
            document.getElementById('latitude').value = position.lat.toFixed(6);
            document.getElementById('longitude').value = position.lng.toFixed(6);
            updateLocationInfo(position.lat, position.lng);
        });
    }

    // Search location function
    async function searchLocation() {
        const searchInput = document.getElementById('map-search');
        const query = searchInput.value;

        if (!query) return;

        // Show loading state
        const searchBtn = document.getElementById('search-location');
        const originalText = searchBtn.innerHTML;
        searchBtn.innerHTML = 'Searching...';
        searchBtn.disabled = true;

        try {
            const response = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}`);
            const data = await response.json();

            if (data.length > 0) {
                const location = data[0];
                const lat = parseFloat(location.lat);
                const lng = parseFloat(location.lon);

                // Update map and marker
                map.setView([lat, lng], 15);
                marker.setLatLng([lat, lng]);

                // Update form fields
                document.getElementById('latitude').value = lat.toFixed(6);
                document.getElementById('longitude').value = lng.toFixed(6);

                // Update location info
                updateLocationInfo(lat, lng);
            } else {
                showError('Location not found. Please try a different search term.');
            }
        } catch (error) {
            console.error('Error searching location:', error);
            showError('Error searching location. Please try again.');
        } finally {
            // Restore button state
            searchBtn.innerHTML = originalText;
            searchBtn.disabled = false;
        }
    }

    // Update location information based on coordinates
    async function updateLocationInfo(lat, lng) {
        try {
            const response = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`);
            const data = await response.json();

            if (data.address) {
                // Auto-fill province if empty
                const provinceInput = document.getElementById('province');
                if (!provinceInput.value && data.address.state) {
                    provinceInput.value = data.address.state;
                }

                // Update location description if empty
                const descriptionTextarea = document.getElementById('location_description');
                if (!descriptionTextarea.value) {
                    let description = '';
                    if (data.address.city || data.address.town) {
                        description += `Located in ${data.address.city || data.address.town}, `;
                    }
                    if (data.address.state) {
                        description += `${data.address.state}, `;
                    }
                    if (data.address.country) {
                        description += data.address.country;
                    }
                    descriptionTextarea.value = description;
                }
            }
        } catch (error) {
            console.error('Error updating location info:', error);
        }
    }

    // Show error message
    function showError(message) {
        const errorDiv = document.createElement('div');
        errorDiv.className = 'bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-2';
        errorDiv.role = 'alert';
        errorDiv.innerHTML = `
            <span class="block sm:inline">${message}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <title>Close</title>
                    <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                </svg>
            </span>
        `;
        
        // Remove error after 5 seconds
        setTimeout(() => {
            errorDiv.remove();
        }, 5000);

        // Add to form
        document.querySelector('#step2').insertBefore(errorDiv, document.querySelector('#step2 .space-y-8'));
    }

    // Validate Step 2
    function validateStep2() {
        const requiredFields = [
            { id: 'start_location', message: 'Starting location is required' },
            { id: 'latitude', message: 'Please select a location on the map' },
            { id: 'longitude', message: 'Please select a location on the map' }
        ];

        let isValid = true;
        const errors = [];

        // Check required fields
        requiredFields.forEach(field => {
            const element = document.getElementById(field.id);
            if (!element.value.trim()) {
                isValid = false;
                errors.push(field.message);
                element.classList.add('border-red-500');
            } else {
                element.classList.remove('border-red-500');
            }
        });

        // Check if at least one destination is entered
        const destinations = document.querySelectorAll('input[name="destinations[]"]');
        let hasValidDestination = false;
        destinations.forEach(dest => {
            if (dest.value.trim()) {
                hasValidDestination = true;
            }
        });

        if (!hasValidDestination) {
            isValid = false;
            errors.push('At least one destination is required');
        }

        // Show errors if any
        if (!isValid) {
            errors.forEach(error => showError(error));
        }

        return isValid;
    }

    // Event Listeners
    const searchBtn = document.getElementById('search-location');
    const searchInput = document.getElementById('map-search');

    searchBtn.addEventListener('click', searchLocation);
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            searchLocation();
        }
    });

    // Initialize map
    initMap();

    // Export validation function for use in main form handling
    window.validateStep2 = validateStep2;
});
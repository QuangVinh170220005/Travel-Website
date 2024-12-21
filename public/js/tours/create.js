// Định nghĩa các route
const routes = {
    getFormData: '/tours/get-form-data',
    validateStep: '/tours/validate-step',  // URL base, step sẽ được append sau
    tempStore: '/tours/temp-store',
    finalStore: '/tours/final-store'
};

// Định nghĩa CSRF token
const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

document.addEventListener('DOMContentLoaded', function () {
    let currentStep = 1;
    const totalSteps = 4;
    const form = document.getElementById('tourForm');
    const prevBtn = document.getElementById('prev-step');
    const nextBtn = document.getElementById('next-step');
    const submitBtn = document.getElementById('submit-form');

    // Error display container
    const errorContainer = document.createElement('div');
    errorContainer.className = 'error-container mt-4 text-red-500';
    form.appendChild(errorContainer);

    // Initialize form with saved data if any
    initializeForm();

    async function initializeForm() {
        try {
            const response = await fetch(routes.getFormData);
            const data = await response.json();
            if (data.success && data.formData) {
                populateFormData(data.formData);
            }
        } catch (error) {
            console.error('Error loading form data:', error);
        }
    }

    function populateFormData(data) {
        Object.keys(data).forEach(key => {
            const element = form.elements[key];
            if (element) {
                if (element.type === 'checkbox') {
                    element.checked = data[key];
                } else {
                    element.value = data[key];
                }
            }
        });
    }

    async function validateStep(step) {
        const formData = new FormData(form);
        
        try {
            console.log('Validating step:', step);
            console.log('Form data:', Object.fromEntries(formData));
    
            // Kiểm tra step hiện tại và thêm validation
            switch(step) {
                case 1:
                    if (!formData.get('title')?.trim()) {
                        displayErrors({title: ['Tour title is required']});
                        return false;
                    }
                    if (!formData.get('description')?.trim()) {
                        displayErrors({description: ['Tour description is required']});
                        return false;
                    }
                    break;
                
                case 2:
                    if (!formData.get('price') || isNaN(formData.get('price'))) {
                        displayErrors({price: ['Valid price is required']});
                        return false;
                    }
                    break;
                
                case 3:
                    // Thêm validation cho step 3 nếu cần
                    break;
                
                case 4:
                    // Thêm validation cho step 4 nếu cần
                    break;
            }
    
            const response = await fetch(`${routes.validateStep}/${step}`, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
    
            // Kiểm tra response status
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
    
            // Kiểm tra content type
            const contentType = response.headers.get('content-type');
            if (!contentType || !contentType.includes('application/json')) {
                throw new Error('Server returned non-JSON response');
            }
    
            const data = await response.json();
            console.log('Validation response:', data);
    
            if (!data.success) {
                displayErrors(data.errors);
                return false;
            }
    
            // Nếu validation thành công
            clearErrors();
            
            // Lưu dữ liệu tạm thời
            try {
                await saveTempData(step);
            } catch (error) {
                console.error('Error saving temporary data:', error);
                displayErrors({
                    general: ['Failed to save progress. Please try again.']
                });
                return false;
            }
    
            return true;
    
        } catch (error) {
            console.error('Validation error:', error);
            displayErrors({
                general: ['An error occurred during validation. Please try again.']
            });
            return false;
        }
    }
    
    // Hàm hiển thị lỗi
    function displayErrors(errors) {
        clearErrors();
        const errorContainer = document.getElementById('error-container');
        
        if (!errorContainer) {
            console.error('Error container not found');
            return;
        }
    
        if (typeof errors === 'string') {
            // Nếu errors là string
            const errorMessage = document.createElement('p');
            errorMessage.textContent = errors;
            errorMessage.className = 'text-red-500';
            errorContainer.appendChild(errorMessage);
        } else if (Array.isArray(errors)) {
            // Nếu errors là array
            errors.forEach(error => {
                const errorMessage = document.createElement('p');
                errorMessage.textContent = error;
                errorMessage.className = 'text-red-500';
                errorContainer.appendChild(errorMessage);
            });
        } else if (typeof errors === 'object') {
            // Nếu errors là object
            Object.keys(errors).forEach(key => {
                const errorMessages = Array.isArray(errors[key]) ? errors[key] : [errors[key]];
                errorMessages.forEach(message => {
                    const errorMessage = document.createElement('p');
                    errorMessage.textContent = message;
                    errorMessage.className = 'text-red-500';
                    
                    // Nếu có field cụ thể, highlight field đó
                    const field = document.querySelector(`[name="${key}"]`);
                    if (field) {
                        field.classList.add('border-red-500');
                        errorMessage.classList.add('mt-1');
                        field.parentElement.appendChild(errorMessage);
                    } else {
                        errorContainer.appendChild(errorMessage);
                    }
                });
            });
        }
    }
    
    // Hàm xóa lỗi
    function clearErrors() {
        const errorContainer = document.getElementById('error-container');
        if (errorContainer) {
            errorContainer.innerHTML = '';
        }
        
        // Xóa highlight các field lỗi
        document.querySelectorAll('.border-red-500').forEach(field => {
            field.classList.remove('border-red-500');
        });
        
        // Xóa các message lỗi bên dưới các field
        document.querySelectorAll('.text-red-500').forEach(message => {
            message.remove();
        });
    }
    
    // Hàm lưu dữ liệu tạm thời
    async function saveTempData(step) {
        const formData = new FormData(form);
        formData.append('current_step', step);
    
        const response = await fetch(routes.tempStore, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        });
    
        if (!response.ok) {
            throw new Error('Failed to save temporary data');
        }
    
        const data = await response.json();
        if (!data.success) {
            throw new Error(data.message || 'Failed to save temporary data');
        }
    
        return data;
    }
    

    function clearErrors() {
        errorContainer.innerHTML = '';
    }

    async function saveFormData() {
        const formData = new FormData(form);
        try {
            await fetch(routes.tempStore, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });
        } catch (error) {
            console.error('Error saving form data:', error);
        }
    }

    function updateStepVisibility() {
        // Hide all steps
        document.querySelectorAll('.step-content').forEach(step => {
            step.classList.add('hidden');
        });

        // Show current step
        document.getElementById(`step${currentStep}`).classList.remove('hidden');

        // Update buttons
        prevBtn.style.display = currentStep === 1 ? 'none' : 'block';
        nextBtn.style.display = currentStep === totalSteps ? 'none' : 'block';

        // Update submit button visibility
        if (currentStep === totalSteps) {
            submitBtn.style.display = 'block';
            nextBtn.style.display = 'none';
        } else {
            submitBtn.style.display = 'none';
            nextBtn.style.display = 'block';
        }

        // Update progress indicators
        updateProgressIndicators();
    }

    function updateProgressIndicators() {
        document.querySelectorAll('.step-item div').forEach((indicator, index) => {
            if (index + 1 <= currentStep) {
                indicator.classList.remove('bg-gray-300', 'text-gray-600');
                indicator.classList.add('bg-blue-600', 'text-white');
            } else {
                indicator.classList.remove('bg-blue-600', 'text-white');
                indicator.classList.add('bg-gray-300', 'text-gray-600');
            }
        });
    }

    // Next button click handler
    nextBtn.addEventListener('click', async function (e) {
        e.preventDefault();
        const isValid = await validateStep(currentStep);

        if (isValid) {
            await saveFormData();
            if (currentStep < totalSteps) {
                currentStep++;
                updateStepVisibility();
                window.scrollTo(0, 0);
            }
        }
    });

    // Previous button click handler
    prevBtn.addEventListener('click', function (e) {
        e.preventDefault();
        if (currentStep > 1) {
            currentStep--;
            updateStepVisibility();
            window.scrollTo(0, 0);
        }
    });

    // Form submission handler
    form.addEventListener('submit', async function (e) {
        e.preventDefault();

        Swal.fire({
            title: 'Processing...',
            text: 'Creating your tour...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        const formData = new FormData(this);

        try {
            const response = await fetch(routes.store, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            const contentType = response.headers.get('content-type');
            if (!contentType || !contentType.includes('application/json')) {
                throw new Error('Server returned non-JSON response');
            }

            const data = await response.json();

            if (data.success) {
                Swal.fire({
                    title: 'Success!',
                    text: 'Tour has been created successfully.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = data.redirect_url;
                    }
                });
            } else {
                Swal.fire({
                    title: 'Error!',
                    text: data.message || 'There was an error creating the tour.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        } catch (error) {
            console.error('Submission error:', error);
            Swal.fire({
                title: 'Error!',
                text: 'An unexpected error occurred. Please try again.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    });

    // File upload preview
    const imageInput = document.querySelector('input[type="file"]');
    const imagePreview = document.getElementById('imagePreview');

    if (imageInput && imagePreview) {
        imageInput.addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    imagePreview.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        });
    }

    // Dynamic fields handling
    const addFieldBtn = document.getElementById('addField');
    const fieldsContainer = document.getElementById('fieldsContainer');

    if (addFieldBtn && fieldsContainer) {
        addFieldBtn.addEventListener('click', function () {
            const fieldDiv = document.createElement('div');
            fieldDiv.className = 'flex items-center space-x-2 mt-2';
            fieldDiv.innerHTML = `
                <input type="text" name="additional_fields[]" 
                    class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                <button type="button" class="remove-field px-2 py-1 bg-red-500 text-white rounded-md">
                    Remove
                </button>
            `;
            fieldsContainer.appendChild(fieldDiv);
        });

        // Event delegation for remove buttons
        fieldsContainer.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-field')) {
                e.target.parentElement.remove();
            }
        });
    }

    // Itinerary handling
    const itineraryContainer = document.getElementById('itinerary-container');
    const addDayButton = document.getElementById('add-day');
    let dayCount = 1;

    if (addDayButton) {
        addDayButton.addEventListener('click', function () {
            addNewDay();
        });
    }

    function addNewDay() {
        const newDay = document.createElement('div');
        newDay.className = 'itinerary-day bg-gray-50 p-6 rounded-lg';
        newDay.innerHTML = `
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">Day ${dayCount + 1}</h3>
                <button type="button" class="remove-day text-gray-400 hover:text-gray-500">
                    <span class="sr-only">Remove day</span>
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            
            <div class="space-y-4">
                <!-- Title -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Day Title</label>
                    <input type="text" name="itinerary[${dayCount}][title]" 
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        placeholder="e.g., Arrival and City Tour">
                </div>

                <!-- Activities -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Activities</label>
                    <textarea name="itinerary[${dayCount}][activities]" rows="3" 
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        placeholder="Describe the day's activities"></textarea>
                </div>

                <!-- Meals Included -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Meals Included</label>
                    <div class="mt-2 space-x-4">
                        <label class="inline-flex items-center">
                            <input type="hidden" name="itinerary[${dayCount}][meals][breakfast]" value="0">
                            <input type="checkbox" 
                                name="itinerary[${dayCount}][meals][breakfast]" 
                                value="1"
                                class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-600">Breakfast</span>
                        </label>
                        
                        <label class="inline-flex items-center">
                            <input type="hidden" name="itinerary[${dayCount}][meals][lunch]" value="0">
                            <input type="checkbox" 
                                name="itinerary[${dayCount}][meals][lunch]" 
                                value="1"
                                class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-600">Lunch</span>
                        </label>
                        
                        <label class="inline-flex items-center">
                            <input type="hidden" name="itinerary[${dayCount}][meals][dinner]" value="0">
                            <input type="checkbox" 
                                name="itinerary[${dayCount}][meals][dinner]" 
                                value="1"
                                class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-600">Dinner</span>
                        </label>
                    </div>
                </div>

                <!-- Accommodation -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Accommodation</label>
                    <input type="text" name="itinerary[${dayCount}][accommodation]"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        placeholder="Hotel/Accommodation name">
                </div>
            </div>
        `;

        itineraryContainer.appendChild(newDay);
        dayCount++;
        updateDayNumbers();

        // Add event listener for remove button
        const removeButton = newDay.querySelector('.remove-day');
        removeButton.addEventListener('click', function () {
            newDay.remove();
            updateDayNumbers();
        });
    }

    // Add event listener for first day remove button
    const firstDayRemoveButton = document.querySelector('.itinerary-day .remove-day');
    if (firstDayRemoveButton) {
        firstDayRemoveButton.addEventListener('click', function () {
            if (itineraryContainer.children.length > 1) {
                firstDayRemoveButton.closest('.itinerary-day').remove();
                updateDayNumbers();
            }
        });
    }

    function updateDayNumbers() {
        const days = itineraryContainer.querySelectorAll('.itinerary-day');
        days.forEach((day, index) => {
            const dayTitle = day.querySelector('h3');
            dayTitle.textContent = `Day ${index + 1}`;

            // Update name attributes
            const inputs = day.querySelectorAll('input[name^="itinerary["], textarea[name^="itinerary["]');
            inputs.forEach(input => {
                const currentName = input.getAttribute('name');
                const newName = currentName.replace(/itinerary\[\d+\]/, `itinerary[${index}]`);
                input.setAttribute('name', newName);
            });
        });
        dayCount = days.length;
    }

    // Price calculation handling
    const priceInputs = document.querySelectorAll('.price-input');
    const totalPriceDisplay = document.getElementById('total-price');

    priceInputs.forEach(input => {
        input.addEventListener('input', calculateTotalPrice);
    });

    function calculateTotalPrice() {
        let total = 0;
        priceInputs.forEach(input => {
            const value = parseFloat(input.value) || 0;
            total += value;
        });
        if (totalPriceDisplay) {
            totalPriceDisplay.textContent = total.toLocaleString('en-US', {
                style: 'currency',
                currency: 'USD'
            });
        }
    }

    // Location selection handling
    const locationSelect = document.getElementById('location_id');
    if (locationSelect) {
        locationSelect.addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const locationInfo = {
                province: selectedOption.getAttribute('data-province'),
                region: selectedOption.getAttribute('data-region')
            };

            // Auto-fill related fields
            const provinceInput = document.getElementById('province');
            const regionInput = document.getElementById('region');

            if (provinceInput && locationInfo.province) {
                provinceInput.value = locationInfo.province;
            }
            if (regionInput && locationInfo.region) {
                regionInput.value = locationInfo.region;
            }
        });
    }

    // Date range picker initialization
    const dateRangeInput = document.getElementById('date-range');
    if (dateRangeInput) {
        const picker = new DateRangePicker(dateRangeInput, {
            format: 'yyyy-mm-dd',
            minDate: new Date(),
            maxSpan: {
                days: 30
            }
        });

        dateRangeInput.addEventListener('changeDate', function (e) {
            const startDate = picker.getDates()[0];
            const endDate = picker.getDates()[1];

            if (startDate && endDate) {
                // Calculate duration
                const duration = Math.ceil((endDate - startDate) / (1000 * 60 * 60 * 24));
                const durationInput = document.getElementById('duration_days');
                if (durationInput) {
                    durationInput.value = duration;
                }
            }
        });
    }

    // Image gallery handling
    const galleryContainer = document.getElementById('gallery-container');
    const addImageBtn = document.getElementById('add-image');

    if (galleryContainer && addImageBtn) {
        addImageBtn.addEventListener('click', function () {
            const imageInput = document.createElement('div');
            imageInput.className = 'gallery-item relative border rounded p-4 mt-2';
            imageInput.innerHTML = `
                <input type="file" name="gallery_images[]" accept="image/*" class="gallery-upload">
                <img class="gallery-preview hidden w-full h-32 object-cover mt-2">
                <button type="button" class="remove-image absolute top-2 right-2 text-red-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            `;
            galleryContainer.appendChild(imageInput);

            // Add preview functionality
            const fileInput = imageInput.querySelector('.gallery-upload');
            const preview = imageInput.querySelector('.gallery-preview');

            fileInput.addEventListener('change', function () {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        preview.src = e.target.result;
                        preview.classList.remove('hidden');
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });

            // Add remove functionality
            const removeBtn = imageInput.querySelector('.remove-image');
            removeBtn.addEventListener('click', function () {
                imageInput.remove();
            });
        });
    }

    // Initialize first step visibility
    updateStepVisibility();

    // Save draft functionality
    const saveDraftBtn = document.getElementById('save-draft');
    if (saveDraftBtn) {
        saveDraftBtn.addEventListener('click', async function (e) {
            e.preventDefault();

            try {
                const formData = new FormData(form);
                formData.append('is_draft', '1');

                const response = await fetch(routes.tempStore, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();

                if (data.success) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Draft saved successfully',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });
                } else {
                    throw new Error(data.message || 'Error saving draft');
                }
            } catch (error) {
                Swal.fire({
                    title: 'Error!',
                    text: error.message || 'Failed to save draft',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    }

    // Form validation helper
    function validateField(field) {
        const value = field.value.trim();
        const isRequired = field.hasAttribute('required');

        if (isRequired && !value) {
            return {
                valid: false,
                message: `${field.name} is required`
            };
        }

        if (field.type === 'email' && value) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(value)) {
                return {
                    valid: false,
                    message: 'Invalid email format'
                };
            }
        }

        if (field.type === 'number' && value) {
            const min = field.getAttribute('min');
            const max = field.getAttribute('max');

            if (min && parseFloat(value) < parseFloat(min)) {
                return {
                    valid: false,
                    message: `Value must be greater than or equal to ${min}`
                };
            }

            if (max && parseFloat(value) > parseFloat(max)) {
                return {
                    valid: false,
                    message: `Value must be less than or equal to ${max}`
                };
            }
        }

        return { valid: true };
    }
});

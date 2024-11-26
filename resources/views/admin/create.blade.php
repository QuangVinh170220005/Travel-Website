@extends('admin.layouts.app')

@section('content')
@section('content')
<style>
    .form-input-field {
        height: 3rem; /* h-12 */
        padding: 0.75rem 1rem; /* px-4 py-3 */
        font-size: 1rem; /* text-base */
        border-radius: 0.5rem; /* rounded-lg */
        border: 1px solid #D1D5DB; /* border-gray-300 */
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05); /* shadow-sm */
        transition: all 0.2s ease-in-out;
    }

    .form-input-field:hover {
        border-color: #60A5FA; /* hover:border-blue-400 */
    }

    .form-input-field:focus {
        border-color: #3B82F6; /* focus:border-blue-500 */
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5); /* focus:ring-2 focus:ring-blue-500 */
        outline: none;
    }

    .form-select-field {
        height: 3rem;
        padding: 0.75rem 1rem;
        font-size: 1rem;
        border-radius: 0.5rem;
        border: 1px solid #D1D5DB;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        transition: all 0.2s ease-in-out;
        cursor: pointer;
        background-color: white;
        appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236B7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 0.5rem center;
        background-repeat: no-repeat;
        background-size: 1.5em 1.5em;
        padding-right: 2.5rem;
    }

    .form-textarea-field {
        padding: 0.75rem 1rem;
        font-size: 1rem;
        border-radius: 0.5rem;
        border: 1px solid #D1D5DB;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        transition: all 0.2s ease-in-out;
        min-height: 120px;
    }

    .form-checkbox-field {
        width: 1.25rem;
        height: 1.25rem;
        border-radius: 0.25rem;
        border: 1px solid #D1D5DB;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        transition: all 0.2s ease-in-out;
        cursor: pointer;
    }

    .form-checkbox-field:checked {
        background-color: #3B82F6;
        border-color: #3B82F6;
    }

    .form-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 500;
        color: #374151;
        margin-bottom: 0.5rem;
    }

    .input-group {
        margin-bottom: 1.5rem;
    }

    /* Hover effects for form groups */
    .checkbox-group {
        padding: 0.75rem;
        border-radius: 0.5rem;
        transition: background-color 0.2s ease;
    }

    .checkbox-group:hover {
        background-color: #F9FAFB;
    }
</style>

<div class="bg-gray-50 py-8">
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Create New Tour Package</h1>
            <p class="mt-2 text-sm text-gray-600">Fill in the information below to create a new tour package</p>
        </div>

        <!-- Progress Tracker -->
        <div class="mb-8">
            <div class="relative">
                <!-- Progress Bar Background -->
                <div class="absolute top-1/2 transform -translate-y-1/2 h-1 w-full bg-gray-200"></div>
                
                <!-- Progress Bar -->
                <div class="relative flex justify-between">
                    <!-- Step 1 -->
                    <div class="step-item relative" data-step="1">
                        <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-semibold">
                            1
                        </div>
                        <p class="absolute -bottom-8 left-1/2 transform -translate-x-1/2 text-sm font-medium text-blue-600 whitespace-nowrap">
                            Basic Info
                        </p>
                    </div>

                    <!-- Step 2 -->
                    <div class="step-item relative" data-step="2">
                        <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-gray-600 font-semibold">
                            2
                        </div>
                        <p class="absolute -bottom-8 left-1/2 transform -translate-x-1/2 text-sm font-medium text-gray-500 whitespace-nowrap">
                            Location
                        </p>
                    </div>

                    <!-- Step 3 -->
                    <div class="step-item relative" data-step="3">
                        <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-gray-600 font-semibold">
                            3
                        </div>
                        <p class="absolute -bottom-8 left-1/2 transform -translate-x-1/2 text-sm font-medium text-gray-500 whitespace-nowrap">
                            Itinerary
                        </p>
                    </div>

                    <!-- Step 4 -->
                    <div class="step-item relative" data-step="4">
                        <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-gray-600 font-semibold">
                            4
                        </div>
                        <p class="absolute -bottom-8 left-1/2 transform -translate-x-1/2 text-sm font-medium text-gray-500 whitespace-nowrap">
                            Review
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Container -->
        <div class="bg-white rounded-xl shadow-sm mt-16">
            <form id="tourForm" method="POST" action="{{ route('tours.store') }}" class="space-y-8">
                @csrf
                <!-- Step 1: Basic Information -->
                <div id="step1" class="step-content p-8">
                    <div class="space-y-8">
                        <div class="border-b border-gray-200 pb-4">
                            <h2 class="text-xl font-semibold text-gray-900">Basic Information</h2>
                            <p class="mt-1 text-sm text-gray-500">Please provide the basic details of the tour package.</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Tour Name -->
                            <div class="input-group">
                                <label for="tour_name" class="form-label">Tour Name <span class="text-red-500">*</span></label>
                                <input type="text" 
                                    name="tour_name" 
                                    id="tour_name" 
                                    required
                                    maxlength="200"
                                    class="form-input-field w-full"
                                    placeholder="Enter tour name">
                            </div>
                            
                            <!-- Duration Days -->
                            <div class="input-group">
                                <label for="duration_days" class="form-label">Duration (Days) <span class="text-red-500">*</span></label>
                                <input type="number" 
                                    name="duration_days" 
                                    id="duration_days" 
                                    required
                                    min="1"
                                    class="form-input-field w-full"
                                    placeholder="Number of days">
                            </div>

                            <!-- Description -->
                            <div class="input-group col-span-2">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" 
                                        id="description" 
                                        class="form-input-field w-full"
                                        rows="4"
                                        placeholder="Enter tour description"></textarea>
                            </div>

                            <!-- Max Participants -->
                            <div class="input-group">
                                <label for="max_participants" class="form-label">Maximum Participants</label>
                                <input type="number" 
                                    name="max_participants" 
                                    id="max_participants" 
                                    min="1"
                                    class="form-input-field w-full"
                                    placeholder="Maximum number of participants">
                            </div>

                            <!-- Category -->
                            <div class="input-group">
                                <label for="category" class="form-label">Category</label>
                                <select name="category" id="category" class="form-input-field w-full">
                                    <option value="">Select Category</option>
                                    <option value="adventure">Adventure</option>
                                    <option value="cultural">Cultural</option>
                                    <option value="nature">Nature</option>
                                    <option value="urban">Urban</option>
                                </select>
                            </div>

                            <!-- Transportation -->
                            <div class="input-group">
                                <label for="transportation" class="form-label">Transportation</label>
                                <input type="text" 
                                    name="transportation" 
                                    id="transportation" 
                                    maxlength="100"
                                    class="form-input-field w-full"
                                    placeholder="Transportation details">
                            </div>

                            <!-- Location -->
                            <div class="input-group">
                                <label for="location_id" class="form-label">Location</label>
                                <select name="location_id" id="location_id" class="form-input-field w-full">
                                    <option value="">Select Location</option>
                                    @foreach($locations as $location)
                                        <option value="{{ $location->location_id }}">{{ $location->location_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Highlight Places -->
                            <div class="input-group col-span-2">
                                <label for="highlight_places" class="form-label">Highlight Places</label>
                                <textarea name="highlight_places" 
                                        id="highlight_places" 
                                        class="form-input-field w-full"
                                        rows="3"
                                        placeholder="Enter highlight places"></textarea>
                            </div>

                            <!-- Additional Options -->
                            <div class="input-group col-span-2">
                                <label class="form-label">Package Options</label>
                                <div class="grid grid-cols-2 gap-4">
                                    <!-- Include Hotel -->
                                    <label class="checkbox-group flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                                        <input type="hidden" name="include_hotel" value="0">
                                        <input type="checkbox" 
                                            name="include_hotel" 
                                            id="include_hotel" 
                                            value="1"
                                            checked
                                            class="form-checkbox-field">
                                        <span class="text-base text-gray-700">Include Hotel</span>
                                    </label>
                                    
                                    <!-- Include Meal -->
                                    <label class="checkbox-group flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                                        <input type="hidden" name="include_meal" value="0">
                                        <input type="checkbox" 
                                            name="include_meal" 
                                            id="include_meal" 
                                            value="1"
                                            checked
                                            class="form-checkbox-field">
                                        <span class="text-base text-gray-700">Include Meals</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Tour Status -->
                            <div class="input-group col-span-2">
                                <label class="form-label">Tour Status</label>
                                <div class="grid grid-cols-2 gap-4">
                                    <label class="checkbox-group flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                                        <input type="hidden" name="is_active" value="0">
                                        <input type="checkbox" 
                                            name="is_active" 
                                            id="is_active" 
                                            value="1"
                                            checked
                                            class="form-checkbox-field">
                                        <span class="text-base text-gray-700">Active Tour</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Tour Inclusions -->
                            <div class="input-group col-span-2">
                                <label class="form-label">Tour Inclusions</label>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                    <label class="checkbox-group flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                                        <input type="hidden" name="inclusions[accommodation]" value="0">
                                        <input type="checkbox" 
                                            name="inclusions[accommodation]" 
                                            value="1"
                                            class="form-checkbox-field">
                                        <span class="text-base text-gray-700">Accommodation</span>
                                    </label>
                                    
                                    <label class="checkbox-group flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                                        <input type="hidden" name="inclusions[meals]" value="0">
                                        <input type="checkbox" 
                                            name="inclusions[meals]" 
                                            value="1"
                                            class="form-checkbox-field">
                                        <span class="text-base text-gray-700">Meals</span>
                                    </label>

                                    <label class="checkbox-group flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                                        <input type="hidden" name="inclusions[transportation]" value="0">
                                        <input type="checkbox" 
                                            name="inclusions[transportation]" 
                                            value="1"
                                            class="form-checkbox-field">
                                        <span class="text-base text-gray-700">Transportation</span>
                                    </label>

                                    <label class="checkbox-group flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                                        <input type="hidden" name="inclusions[guide]" value="0">
                                        <input type="checkbox" 
                                            name="inclusions[guide]" 
                                            value="1"
                                            class="form-checkbox-field">
                                        <span class="text-base text-gray-700">Tour Guide</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Step 2: Location Details -->
                <div id="step2" class="step-content p-8 hidden">
                    <div class="space-y-8">
                        <div class="border-b border-gray-200 pb-4">
                            <h2 class="text-xl font-semibold text-gray-900">Location Details</h2>
                            <p class="mt-1 text-sm text-gray-500">Specify the tour locations and destinations.</p>
                        </div>

                        <div class="grid grid-cols-1 gap-6">
                            <!-- Starting Point -->
                            <div>
                                <label for="start_location" class="block text-sm font-medium text-gray-700">Starting Point</label>
                                <div class="mt-1">
                                    <input type="text" name="start_location" id="start_location" 
                                        class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        placeholder="Tour starting location">
                                </div>
                            </div>

                            <!-- Destination Points -->
                            <div>
                                <label for="destinations" class="block text-sm font-medium text-gray-700">Key Destinations</label>
                                <div class="mt-1">
                                    <textarea name="destinations" id="destinations" rows="4" 
                                        class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        placeholder="List main destinations (one per line)"></textarea>
                                </div>
                            </div>

                            <!-- Map Preview (Placeholder) -->
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                                <div class="space-y-1">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                                    </svg>
                                    <div class="text-sm text-gray-600">
                                        Map preview will be available soon
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 3: Itinerary -->
                <div id="step3" class="step-content p-8 hidden">
                    <div class="space-y-8">
                        <div class="border-b border-gray-200 pb-4">
                            <h2 class="text-xl font-semibold text-gray-900">Tour Itinerary</h2>
                            <p class="mt-1 text-sm text-gray-500">Create a detailed day-by-day itinerary for the tour.</p>
                        </div>

                        <div id="itinerary-container" class="space-y-6">
                            <!-- Day 1 Template -->
                            <div class="itinerary-day bg-gray-50 p-6 rounded-lg">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-lg font-medium text-gray-900">Day 1</h3>
                                    <button type="button" class="text-gray-400 hover:text-gray-500">
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
                                        <input type="text" name="itinerary[0][title]" 
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                            placeholder="e.g., Arrival and City Tour">
                                    </div>

                                    <!-- Activities -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Activities</label>
                                        <textarea name="itinerary[0][activities]" rows="3" 
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                            placeholder="Describe the day's activities"></textarea>
                                    </div>

                                    <!-- Meals Included -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Meals Included</label>
                                        <div class="mt-2 space-x-4">
                                            <label class="inline-flex items-center">
                                                <input type="hidden" name="itinerary[0][meals][breakfast]" value="0">
                                                <input type="checkbox" 
                                                    name="itinerary[0][meals][breakfast]" 
                                                    value="1"
                                                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                                <span class="ml-2 text-sm text-gray-600">Breakfast</span>
                                            </label>
                                            
                                            <label class="inline-flex items-center">
                                                <input type="hidden" name="itinerary[0][meals][lunch]" value="0">
                                                <input type="checkbox" 
                                                    name="itinerary[0][meals][lunch]" 
                                                    value="1"
                                                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                                <span class="ml-2 text-sm text-gray-600">Lunch</span>
                                            </label>
                                            
                                            <label class="inline-flex items-center">
                                                <input type="hidden" name="itinerary[0][meals][dinner]" value="0">
                                                <input type="checkbox" 
                                                    name="itinerary[0][meals][dinner]" 
                                                    value="1"
                                                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                                <span class="ml-2 text-sm text-gray-600">Dinner</span>
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Accommodation -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Accommodation</label>
                                        <input type="text" name="itinerary[0][accommodation]"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                            placeholder="Hotel/Accommodation name">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Add Day Button -->
                        <button type="button" id="add-day" 
                            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Add Another Day
                        </button>
                    </div>
                </div>

                <!-- Step 4: Review -->
                <div id="step4" class="step-content p-8 hidden">
                    <div class="space-y-8">
                        <div class="border-b border-gray-200 pb-4">
                            <h2 class="text-xl font-semibold text-gray-900">Review Tour Details</h2>
                            <p class="mt-1 text-sm text-gray-500">Please review all information before submitting.</p>
                        </div>

                        <div class="space-y-6">
                            <!-- Basic Information Review -->
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Basic Information</h3>
                                <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-4">
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Tour Name</dt>
                                        <dd class="mt-1 text-sm text-gray-900" id="review-tour-name"></dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Duration</dt>
                                        <dd class="mt-1 text-sm text-gray-900" id="review-duration"></dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Price per Person</dt>
                                        <dd class="mt-1 text-sm text-gray-900" id="review-price"></dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Tour Type</dt>
                                        <dd class="mt-1 text-sm text-gray-900" id="review-type"></dd>
                                    </div>
                                </dl>
                            </div>

                            <!-- Location Review -->
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Location Details</h3>
                                <dl class="space-y-4">
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Starting Point</dt>
                                        <dd class="mt-1 text-sm text-gray-900" id="review-start-location"></dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Key Destinations</dt>
                                        <dd class="mt-1 text-sm text-gray-900" id="review-destinations"></dd>
                                    </div>
                                </dl>
                            </div>

                            <!-- Itinerary Summary -->
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Itinerary Summary</h3>
                                <div id="review-itinerary" class="space-y-4">
                                    <!-- Itinerary days will be populated here -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="flex justify-between items-center px-8 py-4 bg-gray-50 border-t rounded-b-xl">
                    <button type="button" id="prev-step"
                        class="form-navigation inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Previous
                    </button>
                    <button type="button" id="next-step"
                        class="form-navigation inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Next
                    </button>

                    <button type="submit" id="submit-form" 
                        class="form-navigation inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" style="display: none;">
                        Create Tour
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- Add SweetAlert2 CSS and JS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    
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
            const response = await fetch("{{ route('tours.get.form.data') }}");
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
            console.log('Sending request for step:', step); // Log step number
            console.log('Form data being sent:', Object.fromEntries(formData)); // Log form data

            const response = await fetch(`{{ route('tours.validate.step', '') }}${step}`, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            });

            console.log('Response status:', response.status); // Log response status

            const data = await response.json();
            console.log('Complete response data:', data); // Log complete response

            if (!data.success) {
                console.log('Validation failed:', data.errors); // Log validation errors
                displayErrors(data.errors);
                return false;
            }

            clearErrors();
            return true;
        } catch (error) {
            console.error('Error details:', error); // Log detailed error
            return false;
        }
    }


    function displayErrors(errors) {
        clearErrors();
        Object.keys(errors).forEach(key => {
            const errorMessage = document.createElement('p');
            errorMessage.textContent = errors[key][0];
            errorContainer.appendChild(errorMessage);
        });
    }

    function clearErrors() {
        errorContainer.innerHTML = '';
    }

    async function saveFormData() {
        const formData = new FormData(form);
        try {
            await fetch("{{ route('tours.temp.store') }}", {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
        } catch (error) {
            alert(error)
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

    nextBtn.addEventListener('click', async function(e) {
        e.preventDefault();
        // Validate current step
        const isValid = await validateStep(currentStep);
        
        if (isValid) {
            // Save form data
            await saveFormData();
            
            // Move to next step
            if (currentStep < totalSteps) {
                currentStep++;
                updateStepVisibility();
                window.scrollTo(0, 0);
            }
        }
    });

    prevBtn.addEventListener('click', function(e) {
        e.preventDefault();
        
        if (currentStep > 1) {
            currentStep--;
            updateStepVisibility();
            window.scrollTo(0, 0);
        }
    });

    // Form submission handler
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        // Show loading state
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
            const response = await fetch("{{ route('tours.store') }}", {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'  // Add this header to indicate AJAX request
                }
            });

            // Check if response is JSON
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



    // File upload preview (if you have image uploads)
    const imageInput = document.querySelector('input[type="file"]');
    const imagePreview = document.getElementById('imagePreview');

    if (imageInput && imagePreview) {
        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        });
    }

    // Dynamic field handling (if you have dynamic fields)
    const addFieldBtn = document.getElementById('addField');
    const fieldsContainer = document.getElementById('fieldsContainer');
    
    if (addFieldBtn && fieldsContainer) {
        addFieldBtn.addEventListener('click', function() {
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
        fieldsContainer.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-field')) {
                e.target.parentElement.remove();
            }
        });
    }

    const itineraryContainer = document.getElementById('itinerary-container');
    const addDayButton = document.getElementById('add-day');
    let dayCount = 1;

    // Thêm event listener cho nút "Add Day"
    addDayButton.addEventListener('click', function() {
        addNewDay();
    });

    // Hàm thêm ngày mới
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

        // Thêm event listener cho nút remove của ngày mới
        const removeButton = newDay.querySelector('.remove-day');
        removeButton.addEventListener('click', function() {
            newDay.remove();
            updateDayNumbers();
        });
    }

    // Thêm event listener cho nút remove của ngày đầu tiên
    const firstDayRemoveButton = document.querySelector('.itinerary-day .remove-day');
    if (firstDayRemoveButton) {
        firstDayRemoveButton.addEventListener('click', function() {
            if (itineraryContainer.children.length > 1) {
                firstDayRemoveButton.closest('.itinerary-day').remove();
                updateDayNumbers();
            }
        });
    }

    // Hàm cập nhật số thứ tự ngày
    function updateDayNumbers() {
        const days = itineraryContainer.querySelectorAll('.itinerary-day');
        days.forEach((day, index) => {
            const dayTitle = day.querySelector('h3');
            dayTitle.textContent = `Day ${index + 1}`;
            
            // Cập nhật lại các name attribute
            const inputs = day.querySelectorAll('input[name^="itinerary["], textarea[name^="itinerary["]');
            inputs.forEach(input => {
                const currentName = input.getAttribute('name');
                const newName = currentName.replace(/itinerary\[\d+\]/, `itinerary[${index}]`);
                input.setAttribute('name', newName);
            });
        });
    }


    // Price calculation (if needed)
    const adultPrice = document.querySelector('input[name="adult_price"]');
    const childPrice = document.querySelector('input[name="child_price"]');
    const totalPrice = document.getElementById('totalPrice');

    if (adultPrice && childPrice && totalPrice) {
        function calculateTotal() {
            const adult = parseFloat(adultPrice.value) || 0;
            const child = parseFloat(childPrice.value) || 0;
            totalPrice.textContent = `Total: $${(adult + child).toFixed(2)}`;
        }

        adultPrice.addEventListener('input', calculateTotal);
        childPrice.addEventListener('input', calculateTotal);
    }

    // Form validation helper functions
    function validateRequired(value) {
        return value.trim() !== '';
    }

    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    function validateNumber(value) {
        return !isNaN(value) && parseFloat(value) > 0;
    }

    // Custom date validation
    function validateDate(dateString) {
        const date = new Date(dateString);
        return date instanceof Date && !isNaN(date);
    }

    // Error handling helper functions
    function showError(element, message) {
        const errorDiv = document.createElement('div');
        errorDiv.className = 'text-red-500 text-sm mt-1';
        errorDiv.textContent = message;
        element.parentElement.appendChild(errorDiv);
    }

    function clearAllErrors() {
        document.querySelectorAll('.text-red-500').forEach(error => error.remove());
    }

    // Initialize the form
    updateStepVisibility();

    // Add loading state to buttons
    function setLoadingState(button, isLoading) {
        if (isLoading) {
            button.disabled = true;
            button.innerHTML = `
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Processing...
            `;
        } else {
            button.disabled = false;
            button.innerHTML = button.getAttribute('data-original-text');
        }
    }

    // Save original button text
    document.querySelectorAll('button').forEach(button => {
        button.setAttribute('data-original-text', button.innerHTML);
    });

    // Handle browser back/forward buttons
    window.addEventListener('popstate', function(e) {
        if (e.state && e.state.step) {
            currentStep = e.state.step;
            updateStepVisibility();
        }
    });

    // Update URL with step number
    function updateURL(step) {
        const url = new URL(window.location);
        url.searchParams.set('step', step);
        window.history.pushState({ step }, '', url);
    }
});
</script>
@endsection
@extends('admin.layouts.app')

@section('content')
<link href="{{ asset('css/tours/create.css') }}" rel="stylesheet">
<!-- Thêm vào phần head -->
<script src="https://cdn.jsdelivr.net/npm/@goongmaps/goong-js@1.0.9/dist/goong-js.js"></script>
<link href="https://cdn.jsdelivr.net/npm/@goongmaps/goong-js@1.0.9/dist/goong-js.css" rel="stylesheet">
<style>
    .suggestion-item:hover {
        background-color: #374151;
        cursor: pointer;
    }

    .marker {
        background-image: url('https://docs.goong.io/assets/markers/marker-red.png');
        background-size: cover;
        width: 32px;
        height: 32px;
        cursor: pointer;
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

                            <!-- Highlight Places -->
                            <div class="input-group col-span-2">
                                <label for="highlight_places" class="form-label">Highlight Places</label>
                                <textarea name="highlight_places"
                                    id="highlight_places"
                                    class="form-input-field w-full"
                                    rows="3"
                                    placeholder="Enter highlight places"></textarea>
                            </div>

                            <!-- Tour Images -->
                            <div class="input-group col-span-2">
                                <label class="form-label">Tour Images</label>
                                <div class="mt-2">
                                    <!-- Upload Container -->
                                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-500 transition-colors cursor-pointer"
                                        id="dropZone">
                                        <input type="file"
                                            name="tour_images[]"
                                            id="tourImages"
                                            multiple
                                            accept="image/*"
                                            class="hidden">
                                        <div class="space-y-2">
                                            <div class="mx-auto flex justify-center">
                                                <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                </svg>
                                            </div>
                                            <div class="text-gray-600">
                                                <span class="text-blue-500 hover:text-blue-700">Drag and drop</span> or
                                                <span class="text-blue-500 hover:text-blue-700">Choose file</span> to upload
                                            </div>
                                            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                                        </div>
                                    </div>

                                    <!-- Preview Container -->
                                    <div id="imagePreviewContainer" class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4">
                                        <!-- Preview images will be inserted here -->
                                    </div>
                                </div>
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
                            <h2 class="text-xl font-semibold text-gray-900">Thông tin địa điểm</h2>
                            <p class="mt-1 text-sm text-gray-500">Vui lòng cung cấp thông tin chi tiết về địa điểm du lịch</p>
                        </div>

                        <div class="grid grid-cols-1 gap-6">
                            <!-- Tên địa điểm -->
                            <div class="input-group">
                                <label for="location_name" class="form-label">Tên địa điểm <span class="text-red-500">*</span></label>
                                <input type="text"
                                    name="location_name"
                                    id="location_name"
                                    required
                                    maxlength="100"
                                    class="form-input-field w-full"
                                    placeholder="Nhập tên địa điểm">
                            </div>

                            <!-- Địa chỉ với Auto Complete -->
                            <div class="input-group relative">
                                <label for="location_address" class="form-label">Địa chỉ <span class="text-red-500">*</span></label>
                                <input type="text"
                                    name="location_address"
                                    id="location_address"
                                    required
                                    class="form-input-field w-full"
                                    placeholder="Nhập địa chỉ...">
                                <div id="suggestions"
                                    class="absolute z-10 w-full mt-1 bg-gray-700 border border-gray-600 rounded-lg shadow-lg hidden">
                                </div>
                            </div>

                            <!-- Map Container -->
                            <div id="mapContainer" class="mt-4 hidden">
                                <div id="map" class="w-full h-[400px] rounded-lg"></div>
                            </div>

                            <!-- Hidden input for coordinates -->
                            <input type="hidden" name="coordinates" id="coordinates">


                            <!-- Mô tả -->
                            <div class="input-group">
                                <label for="description" class="form-label">Mô tả</label>
                                <textarea
                                    name="description"
                                    id="description"
                                    rows="4"
                                    class="form-input-field w-full"
                                    placeholder="Nhập mô tả về địa điểm"></textarea>
                            </div>

                            <!-- Thời điểm tốt nhất để ghé thăm -->
                            <div class="input-group">
                                <label for="best_time_to_visit" class="form-label">Thời điểm tốt nhất để ghé thăm</label>
                                <input type="text"
                                    name="best_time_to_visit"
                                    id="best_time_to_visit"
                                    maxlength="100"
                                    class="form-input-field w-full"
                                    placeholder="VD: Mùa xuân, tháng 3-4">
                            </div>

                            <!-- Thông tin thời tiết -->
                            <div class="input-group">
                                <label for="weather_notes" class="form-label">Thông tin thời tiết</label>
                                <textarea
                                    name="weather_notes"
                                    id="weather_notes"
                                    rows="3"
                                    class="form-input-field w-full"
                                    placeholder="Nhập thông tin về thời tiết"></textarea>
                            </div>

                            <!-- Địa điểm nổi tiếng -->
                            <div class="input-group">
                                <label class="form-label mb-2">Trạng thái địa điểm</label>
                                <div class="flex items-center gap-3">
                                    <input type="hidden" name="is_popular" value="0">
                                    <input type="checkbox"
                                        name="is_popular"
                                        id="is_popular"
                                        value="1"
                                        class="form-checkbox-field">
                                    <label for="is_popular" class="text-sm text-gray-700">Đây là địa điểm nổi tiếng</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- Step 3: Schedule -->
                <div id="step3" class="step-content p-8 hidden">
                    <div class="space-y-8">
                        <div class="border-b border-gray-200 pb-4">
                            <h2 class="text-xl font-semibold text-gray-900">Tour Schedules</h2>
                            <p class="mt-1 text-sm text-gray-500">Set up departure schedules and meeting points for the tour.</p>
                        </div>

                        <div id="schedule-container" class="space-y-6">
                            <!-- Schedule Template -->
                            <div class="schedule-item border border-gray-200 rounded-lg p-6">
                                <div class="space-y-6">
                                    <!-- Header with Remove Button -->
                                    <div class="flex items-center justify-between border-b border-gray-200 pb-4">
                                        <h3 class="text-lg font-medium text-gray-900">Schedule #1</h3>
                                        <input type="hidden" name="schedules[0][day_number]" value="1">
                                        <button type="button" class="remove-schedule text-gray-400 hover:text-red-500 transition-colors">
                                            <span class="sr-only">Remove schedule</span>
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>

                                    <!-- Schedule Form Fields -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <!-- Departure Date -->
                                        <div class="input-group">
                                            <label class="form-label">Departure Date <span class="text-red-500">*</span></label>
                                            <input type="datetime-local"
                                                name="schedules[0][departure_date]"
                                                class="form-input-field w-full"
                                                required>
                                        </div>

                                        <!-- Meeting Time -->
                                        <div class="input-group">
                                            <label class="form-label">Meeting Time <span class="text-red-500">*</span></label>
                                            <input type="time"
                                                name="schedules[0][meeting_time]"
                                                class="form-input-field w-full"
                                                required>
                                        </div>

                                        <!-- Meeting Point with Autocomplete -->
                                        <div class="input-group col-span-2">
                                            <label class="form-label">Meeting Point <span class="text-red-500">*</span></label>
                                            <div class="relative">
                                                <input type="text"
                                                    name="schedules[0][meeting_point]"
                                                    class="schedule-meeting-point form-input-field w-full"
                                                    placeholder="Enter meeting location..."
                                                    required>
                                                <div class="suggestions absolute z-10 w-full mt-1 bg-gray-700 border border-gray-600 rounded-lg shadow-lg hidden"></div>
                                            </div>
                                        </div>

                                        <!-- Map Container -->
                                        <div class="schedule-map-container col-span-2 hidden">
                                            <div class="schedule-map w-full h-[300px] rounded-lg"></div>
                                        </div>

                                        <!-- Description -->
                                        <div class="input-group col-span-2">
                                            <label class="form-label">Description</label>
                                            <textarea
                                                name="schedules[0][description]"
                                                rows="3"
                                                class="form-input-field w-full"
                                                placeholder="Additional information about this schedule"></textarea>
                                        </div>

                                        <!-- Hidden Coordinates Input -->
                                        <input type="hidden" name="schedules[0][coordinates]" class="schedule-coordinates">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Add Schedule Button -->
                        <div class="flex justify-center pt-4">
                            <button type="button" id="add-schedule"
                                class="inline-flex items-center px-6 py-3 border border-transparent shadow-sm text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Add New Schedule
                            </button>
                        </div>
                    </div>
                </div>




                <!-- Step 4: Review -->
                <div id="step4" class="step-content p-8 hidden">
                    <div class="space-y-8">
                        <div class="border-b border-gray-200 pb-4">
                            <h2 class="text-xl font-semibold text-gray-900">Review Tour Details</h2>
                            <p class="mt-1 text-sm text-gray-500">Please review all information before submitting.</p>
                        </div>

                        <!-- Basic Information Review (Step 1) -->
                        <div class="bg-gray-50 rounded-lg p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Basic Information</h3>
                            <dl class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Tour Name</dt>
                                    <dd class="mt-1 text-sm text-gray-900" id="review-tour-name"></dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Duration (Days)</dt>
                                    <dd class="mt-1 text-sm text-gray-900" id="review-duration"></dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Category</dt>
                                    <dd class="mt-1 text-sm text-gray-900" id="review-category"></dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Max Participants</dt>
                                    <dd class="mt-1 text-sm text-gray-900" id="review-max-participants"></dd>
                                </div>
                                <div class="col-span-2">
                                    <dt class="text-sm font-medium text-gray-500">Description</dt>
                                    <dd class="mt-1 text-sm text-gray-900" id="review-description"></dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Transportation</dt>
                                    <dd class="mt-1 text-sm text-gray-900" id="review-transportation"></dd>
                                </div>
                                <div class="col-span-2">
                                    <dt class="text-sm font-medium text-gray-500">Highlight Places</dt>
                                    <dd class="mt-1 text-sm text-gray-900" id="review-highlight-places"></dd>
                                </div>
                                <div class="col-span-2">
                                    <dt class="text-sm font-medium text-gray-500">Tour Images</dt>
                                    <dd class="mt-2 grid grid-cols-2 md:grid-cols-4 gap-4" id="review-images">
                                        <!-- Images will be populated here -->
                                    </dd>
                                </div>
                            </dl>
                        </div>

                        <!-- Location Details Review (Step 2) -->
                        <div class="bg-gray-50 rounded-lg p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Location Details</h3>
                            <dl class="grid grid-cols-1 gap-6">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Location Name</dt>
                                    <dd class="mt-1 text-sm text-gray-900" id="review-location-name"></dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Address</dt>
                                    <dd class="mt-1 text-sm text-gray-900" id="review-location-address"></dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Best Time to Visit</dt>
                                    <dd class="mt-1 text-sm text-gray-900" id="review-best-time"></dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Weather Notes</dt>
                                    <dd class="mt-1 text-sm text-gray-900" id="review-weather-notes"></dd>
                                </div>
                            </dl>
                        </div>

                        <!-- Schedule Review (Step 3) -->
                        <div class="bg-gray-50 rounded-lg p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Tour Schedules</h3>
                            <div id="review-schedules" class="space-y-6">
                                <!-- Schedules will be populated here -->
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
            const isValid = await validateStep(currentStep);

            if (isValid) {
                await saveFormData();
                if (currentStep < totalSteps) {
                    currentStep++;
                    if (currentStep === 4) {
                        updateReview(); // Cập nhật review khi chuyển đến step 4
                    }
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

            const fileInput = document.getElementById('tourImages');
            if (fileInput.files) {
                Array.from(fileInput.files).forEach(file => {
                    formData.append('tour_images[]', file);
                });
            }

            try {
                const response = await fetch("{{ route('tours.store') }}", {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest' // Add this header to indicate AJAX request
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
            window.history.pushState({
                step
            }, '', url);
        }
        const addressInput = document.getElementById('location_address');
        const suggestionsContainer = document.getElementById('address-suggestions');

        // Debounce function
        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        // Hàm tìm kiếm địa chỉ
        async function searchAddress(query) {
            if (query.length < 2) {
                suggestionsContainer.classList.add('hidden');
                return;
            }

            try {
                const response = await fetch("{{ route('tours.search.address') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        query
                    })
                });

                const data = await response.json();

                if (data.predictions) {
                    suggestionsContainer.innerHTML = '';
                    suggestionsContainer.classList.remove('hidden');

                    data.predictions.forEach(prediction => {
                        const div = document.createElement('div');
                        div.className = 'p-3 hover:bg-gray-100 cursor-pointer text-sm';
                        div.textContent = prediction.description;

                        div.addEventListener('click', () => {
                            addressInput.value = prediction.description;
                            suggestionsContainer.classList.add('hidden');
                        });

                        suggestionsContainer.appendChild(div);
                    });
                }
            } catch (error) {
                console.error('Error searching address:', error);
            }
        }

        // Thêm event listeners
        const debouncedSearch = debounce((query) => searchAddress(query), 300);

        addressInput.addEventListener('input', (e) => {
            debouncedSearch(e.target.value);
        });

        // Ẩn suggestions khi click ngoài
        document.addEventListener('click', (e) => {
            if (!addressInput.contains(e.target) && !suggestionsContainer.contains(e.target)) {
                suggestionsContainer.classList.add('hidden');
            }
        });

        // Image Upload Handling
        const dropZone = document.getElementById('dropZone');
        const fileInput = document.getElementById('tourImages');
        const previewContainer = document.getElementById('imagePreviewContainer');

        function handleFiles(files) {
            [...files].forEach(previewFile);
        }
        
        // Prevent default drag behaviors
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, preventDefaults, false);
            document.body.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }


        // Highlight drop zone when item is dragged over it

        function handleFiles(files) {
            Array.from(files).forEach(previewFile);
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, unhighlight, false);
        });

        function highlight(e) {
            dropZone.classList.add('border-blue-500', 'bg-blue-50');
        }

        function unhighlight(e) {
            dropZone.classList.remove('border-blue-500', 'bg-blue-50');
        }

        // Handle dropped files
        dropZone.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            handleFiles(files);
        }

        // Handle file input change
        dropZone.addEventListener('click', () => fileInput.click());
        fileInput.addEventListener('change', function(e) {
            handleFiles(this.files);
        });
        
        function previewFile(file) {
            // Validate file type
            if (!file.type.startsWith('image/')) {
                alert('Please upload only image files.');
                return;
            }

            // Validate file size (10MB)
            if (file.size > 10 * 1024 * 1024) {
                alert('File size should not exceed 10MB.');
                return;
            }

            const reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onloadend = function() {
                const preview = document.createElement('div');
                preview.className = 'relative group';
                preview.innerHTML = `
            <img src="${reader.result}" 
                class="w-full h-32 object-cover rounded-lg" 
                alt="Preview">
            <button type="button" 
                class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        `;

                // Add remove button functionality
                const removeBtn = preview.querySelector('button');
                removeBtn.addEventListener('click', () => {
                    preview.remove();
                });

                previewContainer.appendChild(preview);
            }
        }

    });

    // Thêm vào phần script
    const API_KEY = '{{ config("services.goong.key") }}';
    const MAPTILES_KEY = '{{ config("services.goong.maptiles_key") }}';

    let map = null;
    let currentMarker = null;

    // Khởi tạo map
    const initializeMap = (lngLat) => {
        if (map) {
            addMarker(lngLat);
            return;
        }

        const mapContainer = document.getElementById('mapContainer');
        mapContainer.classList.remove('hidden');

        goongjs.accessToken = MAPTILES_KEY;
        map = new goongjs.Map({
            container: 'map',
            style: 'https://tiles.goong.io/assets/goong_map_web.json',
            center: lngLat,
            zoom: 15
        });

        map.addControl(new goongjs.NavigationControl());
        map.addControl(new goongjs.FullscreenControl());

        addMarker(lngLat);
    };

    const addMarker = (lngLat) => {
        if (currentMarker) {
            currentMarker.remove();
        }

        const el = document.createElement('div');
        el.className = 'marker';

        currentMarker = new goongjs.Marker(el)
            .setLngLat(lngLat)
            .addTo(map);

        map.flyTo({
            center: lngLat,
            zoom: 15
        });

        // Cập nhật giá trị coordinates
        document.getElementById('coordinates').value = `${lngLat[0]},${lngLat[1]}`;
    };

    // Xử lý tìm kiếm địa chỉ
    const addressInput = document.getElementById('location_address');
    const suggestionsContainer = document.getElementById('suggestions');

    const searchPlaces = async (query) => {
        if (query.length < 2) {
            suggestionsContainer.classList.add('hidden');
            return;
        }

        try {
            const response = await fetch(
                `https://rsapi.goong.io/Place/AutoComplete?api_key=${API_KEY}&input=${encodeURIComponent(query)}`
            );
            const data = await response.json();

            if (data.status === 'OK') {
                suggestionsContainer.innerHTML = '';
                suggestionsContainer.classList.remove('hidden');

                data.predictions.forEach(prediction => {
                    const div = document.createElement('div');
                    div.className = 'suggestion-item p-3 text-sm text-gray-200';
                    div.textContent = prediction.description;

                    div.addEventListener('click', async () => {
                        addressInput.value = prediction.description;
                        suggestionsContainer.classList.add('hidden');

                        // Lấy chi tiết địa điểm
                        const placeDetail = await getPlaceDetail(prediction.place_id);
                        if (placeDetail && placeDetail.result) {
                            const location = placeDetail.result.geometry.location;
                            initializeMap([location.lng, location.lat]);
                        }
                    });

                    suggestionsContainer.appendChild(div);
                });
            }
        } catch (error) {
            console.error('Lỗi khi tìm kiếm:', error);
        }
    };

    const getPlaceDetail = async (placeId) => {
        try {
            const response = await fetch(
                `https://rsapi.goong.io/Place/Detail?place_id=${placeId}&api_key=${API_KEY}`
            );
            const data = await response.json();
            return data;
        } catch (error) {
            console.error('Lỗi khi lấy chi tiết địa điểm:', error);
            return null;
        }
    };

    // Debounce function
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    const debouncedSearch = debounce((query) => searchPlaces(query), 300);

    addressInput.addEventListener('input', (e) => {
        debouncedSearch(e.target.value);
    });

    // Ẩn gợi ý khi click ra ngoài
    document.addEventListener('click', (e) => {
        if (!addressInput.contains(e.target) && !suggestionsContainer.contains(e.target)) {
            suggestionsContainer.classList.add('hidden');
        }
    });

    const scheduleContainer = document.getElementById('schedule-container');
    const addScheduleButton = document.getElementById('add-schedule');
    let scheduleCount = 1;

    // Add new schedule
    addScheduleButton.addEventListener('click', function() {
        const newSchedule = document.createElement('div');
        newSchedule.className = 'schedule-item border border-gray-200 rounded-lg p-6';
        newSchedule.innerHTML = `
            <div class="space-y-6">
                <!-- Header with Remove Button -->
                <div class="flex items-center justify-between border-b border-gray-200 pb-4">
                    <h3 class="text-lg font-medium text-gray-900">Schedule #${scheduleCount + 1}</h3>
                    <button type="button" class="remove-schedule text-gray-400 hover:text-red-500 transition-colors">
                        <span class="sr-only">Remove schedule</span>
                        <input type="hidden" name="schedules[${scheduleCount}][day_number]" value="${scheduleCount + 1}">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Schedule Form Fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Departure Date -->
                    <div class="input-group">
                        <label class="form-label">Departure Date <span class="text-red-500">*</span></label>
                        <input type="datetime-local" 
                            name="schedules[${scheduleCount}][departure_date]"
                            class="form-input-field w-full"
                            required>
                    </div>

                    <!-- Meeting Time -->
                    <div class="input-group">
                        <label class="form-label">Meeting Time <span class="text-red-500">*</span></label>
                        <input type="time" 
                            name="schedules[${scheduleCount}][meeting_time]"
                            class="form-input-field w-full"
                            required>
                    </div>

                    <!-- Meeting Point with Autocomplete -->
                    <div class="input-group col-span-2">
                        <label class="form-label">Meeting Point <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <input type="text"
                                name="schedules[${scheduleCount}][meeting_point]"
                                class="schedule-meeting-point form-input-field w-full"
                                placeholder="Enter meeting location..."
                                required>
                            <div class="suggestions absolute z-10 w-full mt-1 bg-gray-700 border border-gray-600 rounded-lg shadow-lg hidden"></div>
                        </div>
                    </div>

                    <!-- Map Container -->
                    <div class="schedule-map-container col-span-2 hidden">
                        <div class="schedule-map w-full h-[300px] rounded-lg"></div>
                    </div>

                    <!-- Description -->
                    <div class="input-group col-span-2">
                        <label class="form-label">Description</label>
                        <textarea 
                            name="schedules[${scheduleCount}][description]"
                            rows="3"
                            class="form-input-field w-full"
                            placeholder="Additional information about this schedule"></textarea>
                    </div>

                    <!-- Hidden Coordinates Input -->
                    <input type="hidden" name="schedules[${scheduleCount}][coordinates]" class="schedule-coordinates">
                </div>
            </div>
        `;

        scheduleContainer.appendChild(newSchedule);
        scheduleCount++;
        initializeGoongPlacesForElement(newSchedule.querySelector('.schedule-meeting-point'));

        // Add remove button handler
        newSchedule.querySelector('.remove-schedule').addEventListener('click', function() {
            if (document.querySelectorAll('.schedule-item').length > 1) {
                newSchedule.remove();
                updateScheduleNumbers();
            } else {
                // Show error message if trying to remove the last schedule
                Swal.fire({
                    title: 'Cannot Remove',
                    text: 'At least one schedule is required.',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
            }
        });
    });

    // Initialize Goong Places for meeting points
    function initializeGoongPlacesForElement(input) {
        const suggestionsDiv = input.closest('.input-group').querySelector('.suggestions');
        const mapContainer = input.closest('.schedule-item').querySelector('.schedule-map-container');
        const mapDiv = mapContainer.querySelector('.schedule-map');
        const coordinatesInput = input.closest('.schedule-item').querySelector('.schedule-coordinates');
        let scheduleMap = null;
        let marker = null;

        input.addEventListener('input', debounce(async (e) => {
            const query = e.target.value;
            if (query.length < 2) {
                suggestionsDiv.classList.add('hidden');
                return;
            }

            try {
                const response = await fetch(
                    `https://rsapi.goong.io/Place/AutoComplete?api_key=${API_KEY}&input=${encodeURIComponent(query)}`
                );
                const data = await response.json();

                if (data.status === 'OK') {
                    suggestionsDiv.innerHTML = '';
                    suggestionsDiv.classList.remove('hidden');

                    data.predictions.forEach(prediction => {
                        const div = document.createElement('div');
                        div.className = 'suggestion-item p-3 text-sm text-gray-200';
                        div.textContent = prediction.description;

                        div.addEventListener('click', async () => {
                            input.value = prediction.description;
                            suggestionsDiv.classList.add('hidden');

                            // Get place details and show map
                            const placeDetails = await getPlaceDetail(prediction.place_id);
                            if (placeDetails && placeDetails.result) {
                                const location = placeDetails.result.geometry.location;
                                showMap(location.lng, location.lat);
                                coordinatesInput.value = `${location.lng},${location.lat}`;
                            }
                        });

                        suggestionsDiv.appendChild(div);
                    });
                }
            } catch (error) {
                console.error('Error searching places:', error);
            }
        }, 300));

        function showMap(lng, lat) {
            mapContainer.classList.remove('hidden');

            if (!scheduleMap) {
                scheduleMap = new goongjs.Map({
                    container: mapDiv,
                    style: 'https://tiles.goong.io/assets/goong_map_web.json',
                    center: [lng, lat],
                    zoom: 15
                });

                scheduleMap.addControl(new goongjs.NavigationControl());
            } else {
                scheduleMap.setCenter([lng, lat]);
            }

            if (marker) {
                marker.remove();
            }

            // Add marker
            const el = document.createElement('div');
            el.className = 'marker';
            marker = new goongjs.Marker(el)
                .setLngLat([lng, lat])
                .addTo(scheduleMap);
        }

        // Hide suggestions when clicking outside
        document.addEventListener('click', (e) => {
            if (!input.contains(e.target) && !suggestionsDiv.contains(e.target)) {
                suggestionsDiv.classList.add('hidden');
            }
        });
    }

    // Initialize Goong Places for initial meeting point input
    initializeGoongPlacesForElement(document.querySelector('.schedule-meeting-point'));

    // Update schedule numbers
    function updateScheduleNumbers() {
        document.querySelectorAll('.schedule-item').forEach((item, index) => {
            const dayNumber = index + 1;
            item.querySelector('h3').textContent = `Schedule #${dayNumber}`;
            // Thêm dòng này
            item.querySelector('input[name$="[day_number]"]').value = dayNumber;

            // Phần cập nhật name các field khác giữ nguyên
            item.querySelectorAll('[name^="schedules["]').forEach(input => {
                const fieldName = input.name.match(/\[([^\]]+)\]$/)[1];
                input.name = `schedules[${index}][${fieldName}]`;
            });
        });
        scheduleCount = document.querySelectorAll('.schedule-item').length;
    }

    function updateReview() {
        // Basic Information Review
        document.getElementById('review-tour-name').textContent = document.getElementById('tour_name').value;
        document.getElementById('review-duration').textContent = document.getElementById('duration_days').value + ' days';
        document.getElementById('review-category').textContent = document.getElementById('category').value;
        document.getElementById('review-max-participants').textContent = document.getElementById('max_participants').value;
        document.getElementById('review-description').textContent = document.getElementById('description').value;
        document.getElementById('review-transportation').textContent = document.getElementById('transportation').value;
        document.getElementById('review-highlight-places').textContent = document.getElementById('highlight_places').value;

        // Location Details Review
        document.getElementById('review-location-name').textContent = document.getElementById('location_name').value;
        document.getElementById('review-location-address').textContent = document.getElementById('location_address').value;
        document.getElementById('review-best-time').textContent = document.getElementById('best_time_to_visit').value;
        document.getElementById('review-weather-notes').textContent = document.getElementById('weather_notes').value;

        // Schedule Review
        const reviewSchedules = document.getElementById('review-schedules');
        reviewSchedules.innerHTML = '';

        document.querySelectorAll('.schedule-item').forEach((schedule, index) => {
            const departureDate = schedule.querySelector('[name$="[departure_date]"]').value;
            const meetingTime = schedule.querySelector('[name$="[meeting_time]"]').value;
            const meetingPoint = schedule.querySelector('[name$="[meeting_point]"]').value;
            const description = schedule.querySelector('[name$="[description]"]').value;

            const scheduleReview = document.createElement('div');
            scheduleReview.className = 'border border-gray-200 rounded-lg p-4';
            scheduleReview.innerHTML = `
            <h4 class="font-medium text-gray-900 mb-2">Schedule #${index + 1}</h4>
            <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Departure Date</dt>
                    <dd class="mt-1 text-sm text-gray-900">${departureDate}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Meeting Time</dt>
                    <dd class="mt-1 text-sm text-gray-900">${meetingTime}</dd>
                </div>
                <div class="col-span-2">
                    <dt class="text-sm font-medium text-gray-500">Meeting Point</dt>
                    <dd class="mt-1 text-sm text-gray-900">${meetingPoint}</dd>
                </div>
                <div class="col-span-2">
                    <dt class="text-sm font-medium text-gray-500">Description</dt>
                    <dd class="mt-1 text-sm text-gray-900">${description}</dd>
                </div>
            </dl>
        `;
            reviewSchedules.appendChild(scheduleReview);
        });

        // Image Review
        const reviewImages = document.getElementById('review-images');
        reviewImages.innerHTML = '';
        document.querySelectorAll('#imagePreviewContainer img').forEach(img => {
            const imgDiv = document.createElement('div');
            imgDiv.innerHTML = `
            <img src="${img.src}" class="w-full h-32 object-cover rounded-lg" alt="Tour image">
        `;
            reviewImages.appendChild(imgDiv);
        });
    }
</script>
@endsection
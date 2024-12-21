<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Location;
use App\Models\PriceList;
use App\Models\PriceDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

use function Laravel\Prompts\alert;

class TourController extends Controller
{
    public function create()
    {
        $locations = Location::all();
        
        if (request()->ajax()) {
            return view('admin.create', compact('locations'))->render();
        }
        
        return view('admin.create', compact('locations'));
    }

    public function getFormData()
    {
        try {
            $locations = Location::all();
            return response()->json([
                'success' => true,
                'formData' => [
                    'locations' => $locations,
                    // Thêm data khác nếu cần
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function tempStore(Request $request)
    {
        try {
            // Validate dữ liệu tạm thời
            $validated = $request->validate([
                'tour_name' => 'nullable|string',
                'duration_days' => 'nullable|integer', // Sửa từ duration thành duration_days
                'max_participants' => 'nullable|integer', // Sửa từ group_size thành max_participants
                'price' => 'nullable|numeric',
                'category' => 'nullable|string', // Sửa từ tour_type thành category
                'difficulty_level' => 'nullable|string', // Sửa từ difficulty thành difficulty_level
                'inclusions' => 'nullable|array',
                'start_location' => 'nullable|string',
                'destination' => 'nullable|string', // Sửa từ destinations thành destination
                'transportation' => 'nullable|string', // Thêm field transportation
                'description' => 'nullable|string', // Thêm field description
                'highlight_places' => 'nullable|string', // Thêm field highlight_places
                'include_hotel' => 'nullable|boolean', // Thêm field include_hotel
                'include_meal' => 'nullable|boolean', // Thêm field include_meal
                'is_active' => 'nullable|boolean', // Thêm field is_active
                'itinerary' => 'nullable|array', // Thêm validation cho itinerary
                'itinerary.*.title' => 'nullable|string',
                'itinerary.*.activities' => 'nullable|string',
                'itinerary.*.accommodation' => 'nullable|string',
                'itinerary.*.meals' => 'nullable|array',
                'itinerary.*.meals.breakfast' => 'nullable|boolean',
                'itinerary.*.meals.lunch' => 'nullable|boolean',
                'itinerary.*.meals.dinner' => 'nullable|boolean'
            ]);

            // Lưu vào session
            $request->session()->put('tour_form_data', $validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Data temporarily stored',
                'data' => $validated
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 422);
        }
    }


    public function validateStep(Request $request, $step)
    {
        try {
            $rules = $this->getValidationRules($step);
            $validated = $request->validate($rules);

            return response()->json([
                'success' => true,
                'message' => 'Step validation successful'
            ]);
        } catch (ValidationException $e) { 
            return response()->json([
                'success' => false,
                'errors' => $e->errors()
            ], 422);
        }
    }

    private function getValidationRules($step)
    {
        switch ($step) {
            case 1:
                return [
                    'tour_name' => 'required|string|max:200',
                    'duration_days' => 'required|integer|min:1',
                    'max_participants' => 'nullable|integer|min:1',
                    'category' => 'nullable|string|max:50',
                    'transportation' => 'nullable|string|max:100',
                    'description' => 'nullable|string'
                ];
            case 2:
                return [
                    'location_id' => 'nullable|exists:locations,location_id',
                    'highlight_places' => 'nullable|string',
                    'include_hotel' => 'boolean',
                    'include_meal' => 'boolean'
                ];
            case 3:
                return [
                    'is_active' => 'boolean',
                    'itinerary' => 'nullable|array',
                    'itinerary.*.title' => 'required|string',  // Thay đổi từ day thành title
                    'itinerary.*.activities' => 'required|string', // Thay đổi từ description thành activities
                    'itinerary.*.accommodation' => 'nullable|string',
                    'itinerary.*.meals' => 'nullable|array',
                    'itinerary.*.meals.breakfast' => 'nullable|boolean',
                    'itinerary.*.meals.lunch' => 'nullable|boolean',
                    'itinerary.*.meals.dinner' => 'nullable|boolean'
                ];
            default:
                return [];
        }
    }



    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'tour_name' => 'required|string|max:200',
                'description' => 'nullable|string',
                'duration_days' => 'required|integer|min:1',
                'max_participants' => 'nullable|integer|min:1',
                'category' => 'nullable|string|max:50',
                'transportation' => 'nullable|string|max:100',
                'include_hotel' => 'boolean',
                'include_meal' => 'boolean',
                'highlight_places' => 'nullable|string',
                'is_active' => 'boolean',
                'location_id' => 'nullable|exists:locations,location_id'
            ]);

            DB::beginTransaction();
            
            // Convert checkbox values
            $validated['include_hotel'] = $request->has('include_hotel');
            $validated['include_meal'] = $request->has('include_meal');
            $validated['is_active'] = $request->has('is_active');
            
            $tour = Tour::create($validated);
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Tour created successfully',
                'data' => $tour,
                'redirect_url' => route('tours.create')
            ]);

        } catch (ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }





    public function finalStore(Request $request)
    {
        DB::beginTransaction();
        try {
            // Lưu tour
            $tour = Tour::create($request->tour);
            
            // Lưu location nếu cần
            if ($request->has('location')) {
                $location = Location::create($request->location);
                $tour->location()->associate($location);
                $tour->save();
            }
            
            // Lưu price list
            $priceList = PriceList::create([
                'tour_id' => $tour->tour_id,
                'price_list_name' => 'Default Price List',
                'is_default' => true
            ]);
            
            // Lưu price details
            if ($request->has('prices')) {
                foreach($request->prices as $price) {
                    PriceDetail::create([
                        'price_list_id' => $priceList->price_list_id,
                        'customer_type' => $price['type'],
                        'price' => $price['amount']
                    ]);
                }
            }
            
            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'redirect_url' => route('tours.create'),
                    'message' => 'Tour created successfully'
                ]);
            }

            return redirect()->route('tours.create')
                           ->with('success', 'Tour created successfully');

        } catch (\Exception $e) {
            echo ('lỗi').$e->getMessage();
        }
    }

    // Lấý danh sách tourtour
    public function explore()
    {
        try {
            $tours = Tour::with(['priceLists.priceDetails' => function ($query) {
                $query->where('customer_type', 'ADULT');
            }])->get();

            return view('user.explore', compact('tours'));
        } catch (\Exception $e) {
            dd($e->getMessage()); 
        }
    }

    // lịch trình
    public function scheduleTour($tour_id)
    {
        try {
            $tour = Tour::with(['schedules','location'])->findOrFail($tour_id);
            
            Log::info('Tour data:', ['tour' => $tour->toArray()]);
            
            return view('user.trip-details', compact('tour'));
        } catch (\Exception $e) {
            Log::error('Error in scheduleTour: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Không tìm thấy tour: ' . $e->getMessage());
        }
    }
    
}


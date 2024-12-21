<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\TourImage;
use App\Models\TourSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
<<<<<<< Updated upstream
=======
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
>>>>>>> Stashed changes



class TourController extends Controller
{
    public function store(Request $request){

<<<<<<< Updated upstream
           
            try{
                $validated = $request->validate([
                    'tour_name' => 'required|max:200',
                    'category' => 'required',
                    'description' => 'nullable',
=======
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
>>>>>>> Stashed changes
                    'duration_days' => 'required|integer|min:1',
                    'max_participants' => 'nullable|integer|min:1',
                    'transportation' => 'nullable|max:100',
                    'highlight_places' => 'nullable',
                    'include_hotel' => 'required|boolean',
                    'include_meal' => 'required|boolean',
                    'is_active' => 'required|boolean'
                ]);
<<<<<<< Updated upstream
                DB::beginTransaction();
                $tour = Tour::create([
                    'tour_name' => $request->tour_name,
                    'category' => $request->category,
                    'description' => $request->description,
                    'duration_days' => $request->duration_days,
                    'max_participants' => $request->max_participants,
                    'transportation' => $request->transportation,
                    'include_hotel' => $request->include_hotel,
                    'include_meal' => $request->include_meal,
                    'highlight_places' => $request->highlight_places,
                    'is_active' => $request->is_active
                ]);
                DB::commit();
    
                return redirect()->back()->with('success', 'Tour đã được tạo thành công!');
            } catch (\Exception $e) {
                DB::rollBack();
                return back()->with('error', 'Có lỗi xảy ra khi tạo tour: ' . $e->getMessage())->withInput();
            }
            
    }
    public function showAdmin(){
        return view('admin.addTour');
    }
    

=======
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
    
>>>>>>> Stashed changes
}


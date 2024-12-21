<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Location;
use App\Models\PriceList;
use App\Models\PriceDetail;
use App\Models\TourImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

use function Laravel\Prompts\alert;

class TourController extends Controller
{
    public function create()
    {
        $locations = Location::all();

        if (request()->ajax()) {
            return view('admin.tours.create', compact('locations'))->render();
        }

        return view('admin.tours.create', compact('locations'));
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

    public function searchAddress(Request $request)
    {
        $query = $request->input('query');

        $response = Http::get('https://rsapi.goong.io/Place/AutoComplete', [
            'api_key' => config('services.goong.key'),
            'input' => $query
        ]);

        return response()->json($response->json());
    }

    public function getPlaceDetail(Request $request)
    {
        $placeId = $request->input('place_id');

        $response = Http::get('https://rsapi.goong.io/Place/Detail', [
            'place_id' => $placeId,
            'api_key' => config('services.goong.key')
        ]);

        return response()->json($response->json());
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
                    'description' => 'nullable|string',
                    'highlight_places' => 'nullable|string',
                    'tour_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:10240',
                    'include_hotel' => 'boolean',
                    'include_meal' => 'boolean'
                ];
            case 2:
                return [
                    'location_id' => 'nullable|exists:locations,location_id'

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
                'location_id' => 'nullable|exists:locations,location_id',
                'tour_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:10240', // max 10MB
            ]);

            DB::beginTransaction();

            // Convert checkbox values
            $validated['include_hotel'] = $request->has('include_hotel');
            $validated['include_meal'] = $request->has('include_meal');
            $validated['is_active'] = $request->has('is_active');

            $tour = Tour::create($validated);

            // Xử lý upload ảnh
            if ($request->hasFile('tour_images')) {  // Giữ nguyên tên field 'tour_images' nếu form đang dùng name="tour_images[]"
                foreach ($request->file('tour_images') as $index => $image) {
                    // Sửa cách lưu file và đường dẫn
                    $path = $image->store('tours', 'public');  // Lưu vào storage/app/public/tours
                    
                    TourImage::create([
                        'tour_id' => $tour->tour_id,  // Đảm bảo dùng đúng tên cột primary key của bảng tours
                        'image_path' => $path,  // Không cần str_replace vì store() đã trả về đường dẫn tương đối
                        'is_main' => $index === 0
                    ]);
                }
            }            


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
                foreach ($request->prices as $price) {
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
            DB::rollback();

            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage()
                ], 500);
            }

            return back()->with('error', $e->getMessage())
                ->withInput();
        }
    }
}

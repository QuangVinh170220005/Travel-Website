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
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

use function Laravel\Prompts\alert;

class TourController extends Controller
{
    public function index()
    {
        $tours = Tour::with(['images', 'location'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        $locations = Location::all();

        if (request()->ajax()) {
            return view('admin.tours.index', compact('tours', 'locations'))->render();
        }

        return view('admin.tours.index', compact('tours', 'locations'));
    }

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
                'destination' => 'nullable|string', // Sửa từ destinations thành destination
                'transportation' => 'nullable|string', // Thêm field transportation
                'description' => 'nullable|string', // Thêm field description
                'highlight_places' => 'nullable|string', // Thêm field highlight_places
                'include_hotel' => 'nullable|boolean', // Thêm field include_hotel
                'include_meal' => 'nullable|boolean', // Thêm field include_meal
                'is_active' => 'nullable|boolean', // Thêm field is_active
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
                    'location_id' => 'nullable|exists:locations,location_id',
                    'location_name' => 'required|string|max:100',
                    'location_address' => 'required|string|max:100',
                    'coordinates' => 'required|string',
                    'description' => 'nullable|string',
                    'best_time_to_visit' => 'nullable|string',
                    'weather_notes' => 'nullable|string',
                    'is_popular' => 'boolean'
                ];
            case 3:
                return [
                    'schedules' => 'required|array|min:1',
                    'schedules.*.day_number' => 'required|integer|min:1',
                    'schedules.*.departure_date' => 'required|date',
                    'schedules.*.meeting_time' => 'required',
                    'schedules.*.meeting_point' => 'required|string|max:200',
                    'schedules.*.description' => 'nullable|string'
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


                'location_name' => 'required|string|max:100',
                'location_address' => 'required|string|max:100',
                'coordinates' => 'required|string',
                'is_popular' => 'boolean',
                'best_time_to_visit' => 'nullable|string',
                'weather_notes' => 'nullable|string',
            ]);

            $location = Location::create([
                'location_name' => $validated['location_name'],
                'location_address' => $validated['location_address'],
                'coordinates' => $validated['coordinates'], // Lưu trực tiếp string coordinates
                'description' => $validated['description'],
                'is_popular' => $validated['is_popular'] ?? false,
                'best_time_to_visit' => $validated['best_time_to_visit'],
                'weather_notes' => $validated['weather_notes'],
            ]);


            DB::beginTransaction();

            // Convert checkbox values
            $validated['include_hotel'] = $request->has('include_hotel');
            $validated['include_meal'] = $request->has('include_meal');
            $validated['is_active'] = $request->has('is_active');

            $validated['location_id'] = $location->location_id;

            $tour = Tour::create($validated);
            // Xử lý upload ảnh
            if ($request->hasFile('tour_images')) {
                // Tạo mảng lưu các hash của ảnh để kiểm tra trùng lặp
                $processedImageHashes = [];

                foreach ($request->file('tour_images') as $index => $image) {
                    // Tạo hash từ nội dung file
                    $imageHash = md5_file($image->getRealPath());

                    // Kiểm tra nếu ảnh đã được xử lý
                    if (in_array($imageHash, $processedImageHashes)) {
                        continue; // Bỏ qua nếu ảnh trùng lặp
                    }

                    $path = $image->store('tours', 'public');
                    TourImage::create([
                        'tour_id' => $tour->tour_id,
                        'image_path' => $path,
                        'is_main' => $index === 0
                    ]);

                    // Thêm hash vào mảng đã xử lý
                    $processedImageHashes[] = $imageHash;
                }
            }

            if ($request->has('schedules')) {
                foreach ($request->schedules as $schedule) {
                    $tour->schedules()->create([
                        'departure_date' => $schedule['departure_date'],
                        'day_number' => $schedule['day_number'],
                        'meeting_time' => $schedule['meeting_time'],
                        'meeting_point' => $schedule['meeting_point'],
                        'description' => $schedule['description'] ?? null
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
    public function explore()
    {
        try {
            $tours = Tour::with(['priceLists.priceDetails' => function ($query) {
                $query->where('customer_type', 'ADULT');
            }, 'mainImage'])
            ->orderBy('created_at', 'desc')
            ->paginate(12);

            return view('user.explore', compact('tours'));
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    // lịch trình
    public function scheduleTour($tour_id)
    {
        try {
            $tour = Tour::with(['schedules', 'location', 'images'])->findOrFail($tour_id);
            Log::info('Tour data:', ['tour' => $tour->toArray()]);
            return view('user.trip-details', compact('tour'));
        } catch (\Exception $e) {
            Log::error('Error in scheduleTour: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Không tìm thấy tour');
        }
    }
    



// Tour phổ biến
// Thêm method mới trong TourController
public function getPopularLocationTours()
{
    try {
        $popularTours = Tour::with(['location', 'mainImage', 'priceLists.priceDetails' => function ($query) {
            $query->where('customer_type', 'ADULT');
        }])
        ->whereHas('location', function($query) {
            $query->where('is_popular', true);
        })
        ->orderBy('created_at', 'desc')
        ->get();

        return view('user.home', compact('popularTours'));
    } catch (\Exception $e) {
        Log::error('Error in getPopularLocationTours: ' . $e->getMessage());
        return view('user.home')->with('error', 'Không thể tải dữ liệu tour');
    }
}



}

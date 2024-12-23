<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WishlistController extends Controller
{
    public function addToWishlist(Request $request)
{
    $userId = Auth::id();

    // Lấy tour_id từ request
    $tourId = $request->input('tour_id');

    // Kiểm tra xem tour đã tồn tại trong wishlist chưa
    $exists = DB::table('wishlists')
        ->where('user_id', $userId)
        ->where('tour_id', $tourId)
        ->exists();

    if (!$exists) {
        DB::table('wishlists')->insert([
            'user_id' => $userId,
            'tour_id' => $tourId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['success' => true, 'message' => 'Tour đã được thêm vào danh sách yêu thích.']);
    }
    return response()->json(['success' => false, 'message' => 'Tour đã có trong danh sách yêu thích.']);
}

    public function getWishlist()
    {
        $userId = Auth::id();  // lấy user của người dùng đăng nhập

        $wishlistedTours = DB::table('wishlists')
        ->where('wishlists.user_id', $userId)
        ->join('tours', 'wishlists.tour_id', '=', 'tours.tour_id')
        ->leftJoin('price_lists', 'tours.tour_id', '=', 'price_lists.tour_id')
        ->leftJoin('price_details', 'price_lists.price_list_id', '=', 'price_details.price_list_id')
        ->leftJoin('tour_images', function ($join) {
            $join->on('tour_images.tour_id', '=', 'tours.tour_id')
                ->where('tour_images.is_main', '=', 1); 
        })
        ->orderBy('wishlists.created_at', 'desc') 

        // lấy dữ liệu muốn lấy tử các bảng đã joinjoin
        ->select(
            'tours.tour_id',
            'tours.tour_name',
            'tours.description',
            'tour_images.image_path as image', 
            'price_details.customer_type',
            'price_details.price'
        )
        ->get()
        ->groupBy('tour_id');

        // duyệt qua từng nhóm để đingj dạng lại dữ liệuliệu
        $formattedTours = $wishlistedTours->map(function ($tourGroup) {
            $adults = 1; // Số lượng người lớn mặc định
            $children = 0; // Số lượng trẻ em mặc định

            $adultPrice = $tourGroup->where('customer_type', 'ADULT')->first()->price ?? 0;
            $childPrice = $tourGroup->where('customer_type', 'CHILD')->first()->price ?? 0;
            // định dạng lại để trả về
            return [
                'tour_id' => $tourGroup->first()->tour_id,
                'tour_name' => $tourGroup->first()->tour_name,
                'description' => $tourGroup->first()->description,
                'image' => $tourGroup->first()->image, // Đường dẫn ảnh chính
                'adult_price' => $adultPrice,
                'child_price' => $childPrice,
                'adults' => $adults,
                'children' => $children,
                'total_price' => $adults * $adultPrice + $children * $childPrice,
            ];
        });
        return view('user.wishlist', ['tours' => $formattedTours]);
    }
    public function removeFromWishlist(Request $request)
    {
        $userId = Auth::id();
        $tourId = $request->input('tour_id'); // Lấy tour_id từ request

        // Kiểm tra xem tour có tồn tại trong wishlist của người dùng không
        $exists = DB::table('wishlists')
            ->where('user_id', $userId)
            ->where('tour_id', $tourId)
            ->exists();

        if ($exists) {
            // Nếu tồn tại, xóa tour khỏi wishlist
            DB::table('wishlists')
                ->where('user_id', $userId)
                ->where('tour_id', $tourId)
                ->delete();

            return response()->json(['success' => true, 'message' => 'Tour đã được xóa khỏi danh sách yêu thích.']);
        }

        return response()->json(['success' => false, 'message' => 'Tour không tồn tại trong danh sách yêu thích.']);
    }
}

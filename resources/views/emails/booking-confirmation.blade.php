<!DOCTYPE html>
<html>
<head>
    <title>Xác nhận đặt tour</title>
</head>
<body>
    <h2>Xác nhận đặt tour thành công</h2>
    
    <p>Xin chào {{ $booking->bookingDetail->name }},</p>
    
    <p>Cảm ơn bạn đã đặt tour của chúng tôi. Dưới đây là thông tin chi tiết đơn đặt tour của bạn:</p>
    
    <h3>Chi tiết đặt tour:</h3>
    <ul>
        <li>Mã đặt tour: {{ $booking->booking_id }}</li>
        <li>Tour: {{ $booking->tour->tour_name }}</li>
        <li>Ngày khởi hành: {{ $booking->schedule->departure_date->format('d/m/Y') }}</li>
        <li>Số lượng người lớn: {{ $booking->bookingDetail->adult_count }}</li>
        <li>Số lượng trẻ em: {{ $booking->bookingDetail->child_count }}</li>
        <li>Tổng tiền: {{ number_format($booking->total_amount) }}đ</li>
    </ul>

    @if($booking->need_pickup)
    <p>Địa điểm đón: {{ $booking->pickup_location }}</p>
    @endif

    <p>Trạng thái: Chờ xác nhận</p>
    
    <p>Chúng tôi sẽ liên hệ với bạn sớm nhất để xác nhận đơn đặt tour.</p>
    
    <p>Mọi thắc mắc xin vui lòng liên hệ:</p>
    <p>Hotline: 1900 xxxx</p>
    <p>Email: support@example.com</p>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Xác nhận tour từ admin</title>
</head>
<body>
    <h2>Tour của bạn đã được xác nhận!</h2>
    
    <p>Xin chào {{ $booking->bookingDetail->name }},</p>
    
    <p>Chúng tôi xin vui mừng thông báo tour của bạn đã được xác nhận thành công.</p>
    
    <h3>Chi tiết tour:</h3>
    <ul>
        <li>Mã đặt tour: {{ $booking->booking_id }}</li>
        <li>Tour: {{ $booking->tour->tour_name }}</li>
        <li>Ngày khởi hành: {{ $booking->schedule->departure_date->format('d/m/Y') }}</li>
        <li>Số lượng người lớn: {{ $booking->bookingDetail->adult_count }}</li>
        <li>Số lượng trẻ em: {{ $booking->bookingDetail->child_count }}</li>
        <li>Tổng tiền: {{ number_format($booking->total_amount) }}đ</li>
    </ul>

    @if($booking->need_pickup)
    <p><strong>Địa điểm đón:</strong> {{ $booking->pickup_location }}</p>
    @endif

    <p><strong>Trạng thái:</strong> <span style="color: #28a745;">Đã xác nhận</span></p>
    
    <div style="margin-top: 20px; padding: 15px; background-color: #f8f9fa; border-left: 4px solid #28a745;">
        <p><strong>Lưu ý quan trọng:</strong></p>
        <ul>
            <li>Vui lòng có mặt tại điểm khởi hành đúng giờ</li>
            <li>Mang theo giấy tờ tùy thân</li>
            <li>Liên hệ ngay với chúng tôi nếu có thay đổi</li>
        </ul>
    </div>
    
    <p style="margin-top: 20px;">Mọi thắc mắc xin vui lòng liên hệ:</p>
    <p>Hotline: 1900 xxxx</p>
    <p>Email: support@example.com</p>

    <p>Cảm ơn bạn đã lựa chọn dịch vụ của chúng tôi!</p>
</body>
</html>

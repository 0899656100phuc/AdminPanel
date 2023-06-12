<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Booking</title>
    @vite(['resources/css/style/styles.css', 'resources/js/scripts.js', 'resources/js/bootstrap.bundle.min.js'])
    <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">

    <style>

    </style>
</head>


<body class="d-flex justify-content-center">

    <div>
        <p>Cảm ơn! Đặt phòng của bạn ở Kyo Hotel đã được xác nhận.</p>
        <p class="fw-bold">Chi tiết đặt phòng</p>

        <table class="card-table table   table-bordered">
            <tbody>
                <tr>
                    <td>Nhận phòng</td>
                    <td>Thứ 6, ngày 9 tháng 6 năm 2023 (từ 14:00)</td>
                </tr>
                <tr>
                    <td>Trả phòng</td>
                    <td>Thứ 7, ngày 10 tháng 6 năm 2023 (tới 11:30)</td>
                </tr>
                <tr>
                    <td>Đặt phòng của bạn</td>
                    <td>1 đêm, 1 Phòng</td>
                </tr>
                <tr>
                    <td>Bạn đã đặt cho</td>
                    <td>2 người lớn</td>
                </tr>
                <tr>
                    <td>Địa điểm</td>
                    <td>72 Vo Thi Sau, Vũng Tàu, Việt Nam</td>
                </tr>
                <tr>
                    <td>Điện thoại</td>
                    <td>+84869813401</td>
                </tr>
                <tr>
                    <td>Trả trước</td>
                    <td>Chưa thanh toán</td>
                </tr>
            </tbody>
        </table>

        <p class="fw-bold">Chi tiết giá</p>


        <table class="card-table table   table-bordered">
            <tbody>
                <tr>
                    <td>
                        Phòng Deluxe (2 Người lớn + 1 Trẻ em)</td>
                    <td>VND 321.300</td>
                </tr>
                <tr>
                    <td>Trả phòng</td>
                    <td>Thứ 7, ngày 10 tháng 6 năm 2023 (tới 11:30)</td>
                </tr>

                <tr class="table-primary">
                    <td class="fw-bold">
                        Tổng giá phòng
                    </td>
                    <td class="fw-bold">VND 353.430</td>
                </tr>

        </table>




        <p>Thank You.</p>
    </div>
    <!-- <p>Dear {{ $mailData['customer']->username }},</p>

    <p>Cảm ơn! Đặt phòng của bạn ở {{ $mailData['hotel']->name }} đã được xác nhận:</p>

    <ul>
        <li>Booking ID: {{ $mailData['booking']->id }}</li>
        <li>Start Date: {{ $mailData['booking']->start_date }}</li>
        <li>End Date: {{ $mailData['booking']->end_date }}</li>
     
    </ul> -->
</body>


</html>
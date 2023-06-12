<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Booking</title>
    <style>
    .table-border,
    td,
    th {
        border: 1px solid;
        padding: 10px
    }

    .table-border {

        border-collapse: collapse;
    }


    .bold-text {
        font-weight: bold;
    }
    </style>
</head>

<body>
    <div>
        <h2>Dear {{ $mailData['customer']->username }}</h2>
        <h2>Cảm ơn! Đặt phòng của bạn ở {{ $mailData['hotel']->name }} đã được xác nhận.</h2>
        <p> Xác nhận: {{ $mailData['booking']->id }}</p>

        <h3>Chi tiết đặt phòng</h3>
        <table class="table-border">
            <tbody>
                <tr>
                    <td>Nhận phòng</td>
                    <td> {{ $mailData['booking']->start_date  }} (từ 14:00)</td>
                </tr>
                <tr>
                    <td>Trả phòng</td>
                    <td> {{ $mailData['booking']->end_date  }} (tới 11:30)</td>
                </tr>
                <tr>
                    <td>Đặt phòng của bạn</td>
                    <td>{{ $mailData['booking']->number_of_room  }} Phòng</td>
                </tr>

                <tr>
                    <td>Bạn đã đặt cho</td>
                    <td>{{ $mailData['people']->elder  }} người lớn và {{ $mailData['people']->children  }} Trẻ em</td>
                </tr>
                <tr>
                    <td>Địa điểm</td>
                    <td>{{ $mailData['hotel']->address }}</td>
                </tr>
                <tr>
                    <td>Điện thoại</td>
                    <td>{{ $mailData['hotel']->phone }}</td>
                </tr>
                <tr>
                    <td>Trả trước</td>
                    <td>Chưa thanh toán</td>
                </tr>
            </tbody>
        </table>

        <h3>Chi tiết giá</h3>


        <table class="table-border">
            <tbody>
                <tr>
                    <td>
                        {{ $mailData['typeRoom']->name }} ({{ $mailData['people']->elder  }} Người lớn +
                        {{ $mailData['people']->children  }} Trẻ em)
                    </td>
                    <td>VND {{ $mailData['booking']->total_price  }}</td>
                </tr>
                <tr>
                    <td>được bao gồm 10 % Thuế GTGT</td>
                    <td>VND {{ $mailData['booking']->total_price *0.1 }}</td>
                </tr>
                <tr style="background-color: #f5f5f5;">
                    <td class="bold-text">Tổng giá phòng</td>
                    <td class="bold-text">VND
                        {{ $mailData['booking']->total_price +  ($mailData['booking']->total_price * 0.1)}}
                    </td>
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
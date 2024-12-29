@extends('client.layouts.master')
@section('title', 'cảm ơn')
@section('content')


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Spectral:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.21.11/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.21.11/dist/js/uikit-icons.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.21.11/dist/css/uikit.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @vite(['resources/css/app.css','resources/scss/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div class="payment-success uk-container uk-container-large">
        <!-- <h1>Đặt hàng thành công</h1> -->

        <div class="payment-success-body">
            <img src="https://shop.sandisk.com/content/dam/spinco/en-us/assets/support/home/icon-productregistration.svg" alt="" width="150px">

            <div class="info-success">
                <h2 class="thankyou-success">Cảm ơn bạn đã đặt hàng</h2>
                <div class="order-info">
                    <div class="info-item border-b border-black border-opacity-10 pb-[15px]">
                        <span class="info-label !text-[17px]">Mã đơn hàng:</span>
                        <span class="info-value">{{ session('order_success.code') }}</span>
                    </div>
                    <div class="info-group !mt-0">
                        <h3>Thông tin giao hàng:</h3>
                        <div class="info-item">
                            <span class="info-label">Người nhận:</span>
                            <span class="info-value">{{ session('order_success.name') }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Số điện thoại:</span>
                            <span class="info-value">{{ session('order_success.phone') }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Địa chỉ:</span>
                            <span class="info-value">{{ session('order_success.address') }}</span>
                        </div>
                    </div>

                    <div class="info-group">
                        <h3>Thông tin thanh toán:</h3>
                        <div class="info-item">
                            <span class="info-label mr-4">Phương thức thanh toán:</span>
                            <span class="info-value">{{ session('order_success.payment_method') }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Tổng tiền sản phẩm:</span>
                            <span class="info-value">{{ number_format(session('order_success.subtotal')) }}đ</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Phí vận chuyển:</span>
                            <span class="info-value">{{ number_format(session('order_success.shipping_fee')) }}đ</span>
                        </div>
                    </div>

                    <div class="info-group !border-b-0 !py-0">
                        <div class="info-item">
                            <span class="info-label !text-[22px] mr-5">Tổng thanh toán:</span>
                            <span class="info-value !text-[22px]">{{ number_format(session('order_success.total')) }}đ</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="payment-success-direction">
                <a href="{{ route('home') }}" class="payment-success-btn">Về trang chủ <i class="fa-solid fa-arrow-right"></i></a>
                <a href="{{ route('account', ['activeTab' => 'orders']) }}" class="payment-success-btn">Xem đơn hàng <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>


    </div>


    </div>
</body>

</html>

@endsection
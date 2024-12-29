@extends('Admin.layouts.master')

@section('title', 'Danh sách sản phẩm')

@section('style')
    <style>
        body {
            background-color: #f8f9fa;
        }

        .page-content {
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        ul > li {
            margin-bottom: 15px;
        }

        b {
            font-weight: bold;
        }

        .form-control {
            width: 300px;
            display: inline-block;
            margin-left: 10px;
        }

        .btn-primary {
            margin-left: 10px;
        }

        #statusInput {
    width: 100%;
    padding: 0.47rem 0.75rem;
    font-size: .875rem;
    font-weight: 400;
    line-height: 1.5;
    color: var(--vz-body-color);
    background-color: 262A2F;
    background-clip: padding-box;
    border: 1px solid #2A2F34;
    border-radius: 0.25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}

#statusInput:focus {
    border-color: #86b7fe;
   
    outline: 0;
}
        
    </style>
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                @if($order->orderDetails->isNotEmpty())
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Thông tin người nhận</h4>
                        </div>
                        <div class="card">

                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Thông tin người nhận</h4>
                            </div>
                            <div class="card-body">
                                <ul>
                                    <li>Họ và tên: <b>{{ $order->name }}</b></li>
                                    <li>Số điện thoại: <b>{{ $order->phone }}</b></li>
                                    <li>Địa chỉ: <b>{{ $order->address }}</b></li>
                                    <li>Tiền hàng: <b>{{ number_format($totalProduct, 0, ',', '.') }} đ</b></li>
                                    <li>Tiền ship: <b>{{ number_format($order->shipping_fee, 0, ',', '.') }} đ</b></li>
                                    <li style="font-size: 18px">Tổng tiền: <b>{{ number_format($totalProduct + $order->shipping_fee, 0, ',', '.') }} đ</b></li>
                                </ul>
                                <h5 class="mt-4">Chi tiết đơn hàng:</h5>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Sản phẩm</th>
                                            <th>Giá</th>
                                            <th>Số lượng</th>
                                            <th>Tổng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->orderDetails as $key => $detail)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $detail->product->name }}</td>
                                                <td>{{ number_format($detail->price, 0, ',', '.') }} đ</td>
                                                <td>{{ $detail->quantity }}</td>
                                                <td>{{ number_format($detail->price * $detail->quantity, 0, ',', '.') }} đ</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                             
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Trạng thái</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.orders.update', $order->id) }}">
                                @csrf
                                @method('PATCH')
                                <div class="mb-3">
                                    <label for="statusInput" class="form-label">Trạng thái đơn hàng:</label>
                                    <select id="statusInput" name="status" class="form-control">
                                        {{-- @if($order->status == 'Chờ xác nhận')
                                            <option value="Chờ xác nhận" selected>Chờ xác nhận</option>
                                            <option value="Đã xác nhận">Đã xác nhận</option>
                                            <option value="Đang giao"disabled>Đang giao</option>
                                            <option value="Giao hàng thất bại"disabled>Giao hàng thất bại</option>
                                            <option value="Giao hàng thành công"disabled>Giao hàng thành công</option>
                                            <option value="Đã hủy"disabled>Đã hủy</option>
                                            <option value="Hoàn thành"disabled>Hoàn thành</option>
                                        @elseif($order->status == 'Đã xác nhận')
                                            <option value="Chờ xác nhận" disabled>Chờ xác nhận</option>
                                            <option value="Đã xác nhận"selected>Đã xác nhận</option>
                                            <option value="Đang giao">Đang giao</option>
                                            <option value="Giao hàng thất bại"disabled>Giao hàng thất bại</option>
                                            <option value="Giao hàng thành công"disabled>Giao hàng thành công</option>
                                            <option value="Đã hủy"disabled>Đã hủy</option>
                                            <option value="Hoàn thành"disabled>Hoàn thành</option>
                                        @elseif($order->status == 'Đang giao')
                                            <option value="Chờ xác nhận" disabled>Chờ xác nhận</option>
                                            <option value="Đã xác nhận"disabled>Đã xác nhận</option>
                                            <option value="Đang giao"selected>Đang giao</option>
                                            <option value="Giao hàng thất bại">Giao hàng thất bại</option>
                                            <option value="Giao hàng thành công">Giao hàng thành công</option>
                                            <option value="Đã hủy"disabled>Đã hủy</option>
                                            <option value="Hoàn thành"disabled>Hoàn thành</option>
                                        @elseif($order->status == 'Giao hàng thành công')
                                            <option value="Chờ xác nhận" disabled>Chờ xác nhận</option>
                                            <option value="Đã xác nhận"disabled>Đã xác nhận</option>
                                            <option value="Đang giao"disabled>Đang giao</option>
                                            <option value="Giao hàng thất bại"disabled>Giao hàng thất bại</option>
                                            <option value="Giao hàng thành công"selected>Giao hàng thành công</option>
                                            <option value="Đã hủy"disabled>Đã hủy</option>
                                            <option value="Hoàn thành"disabled>Hoàn thành</option>
                                        @elseif($order->status == 'Giao hàng thất bại')
                                            <option value="Chờ xác nhận"disabled >Chờ xác nhận</option>
                                            <option value="Đã xác nhận"disabled>Đã xác nhận</option>
                                            <option value="Đang giao">Đang giao</option>
                                            <option value="Giao hàng thất bại"selected>Giao hàng thất bại</option>
                                            <option value="Giao hàng thành công"disabled>Giao hàng thành công</option>
                                            <option value="Đã hủy"disabled>Đã hủy</option>
                                            <option value="Hoàn thành"disabled>Hoàn thành</option>
                                        @elseif($order->status == 'Đã hủy')
                                            <option value="Chờ xác nhận" disabled>Chờ xác nhận</option>
                                            <option value="Đã xác nhận"disabled>Đã xác nhận</option>
                                            <option value="Đang giao"disabled>Đang giao</option>
                                            <option value="Giao hàng thất bại"disabled>Giao hàng thất bại</option>
                                            <option value="Giao hàng thành công"disabled>Giao hàng thành công</option>
                                            <option value="Đã hủy"selected>Đã hủy</option>
                                            <option value="Hoàn thành"disabled>Hoàn thành</option>
                                        @elseif($order->status == 'Hoàn thành')
                                            <option value="Chờ xác nhận"disabled >Chờ xác nhận</option>
                                            <option value="Đã xác nhận"disabled>Đã xác nhận</option>
                                            <option value="Đang giao"disabled>Đang giao</option>
                                            <option value="Giao hàng thất bại"disabled>Giao hàng thất bại</option>
                                            <option value="Giao hàng thành công"disabled>Giao hàng thành công</option>
                                            <option value="Đã hủy"disabled>Đã hủy</option>
                                            <option value="Hoàn thành"selected>Hoàn thành</option>
                                        @endif --}}
                                      
                                     
                                    </select>
                                </div>
                            
                                <div class="mb-3">
                                    <label for="payment_status">Trạng thái thanh toán:</label>
                                    <select id="payment_status" name="payment_status" class="form-control">
                                        <option value="Chưa thanh toán" 
                                            {{ $order->payment_status == 'Chưa thanh toán' ? 'selected' : '' }}>
                                            Chưa thanh toán
                                        </option>
                                        <option value="Đã thanh toán" 
                                            {{ $order->payment_status == 'Đã thanh toán' ? 'selected' : '' }}
                                            {{ $order->status !== 'Giao hàng thành công' ? 'disabled' : '' }}>
                                            Đã thanh toán
                                        </option>
                                    </select>
                                </div>
                            
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                                <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Quay lại</a>
                            </form>
                            
                            
                            
                           

                        </div>
                    </div>
                </div>
                @else
                    <div class="alert alert-warning text-center">
                        <b>{{ '!Không có đơn hàng nào!' }}</b>
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Quay lại</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection



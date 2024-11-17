@extends('client.layouts.master')
@section('title', 'Chi tiết sản phẩm')
@section()
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>

    <link href="https://fonts.googleapis.com/css2?family=Marcellus&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Spectral:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="../src/styles/css/uikit-rtl.css"> -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.21.11/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.21.11/dist/js/uikit-icons.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.21.11/dist/css/uikit.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @vite(['resources/css/app.css','resources/scss/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div class="uk-container uk-container-large breadcrumb mt-10 mb-10">
        <nav aria-label="Breadcrumb">
            <ul class="uk-breadcrumb">
                <li><a href="#" class="breadcrumb-a">Trang chủ</a></li>
                <li><a href="#" class="breadcrumb-a">Danh mục</a></li>
                <li><span aria-current="page" class="text-base">Sản phẩm</span></li>
            </ul>
        </nav>
    </div>

    <section class="product-detail uk-container uk-container-large">
        <form class="form-addToCart" action="{{ route('addToCart', ['id' => $data['product']->id]) }}" method="post">
            @csrf
            <input type="hidden" class="productId" value="{{ $data['product']->id }}">
            <div class="product-detail-body uk-grid" uk-grid>
                <div class="product-detail-left uk-width-1-2">
                    <img alt="{{ $data['product']->name }}" class="w-full mb-4" height="500"
                        src="{{ $data['product']->image }}" width="500" />
                    <div class="product-detail-image-slide">
                        @if (!empty($data['product']->images))
                            @foreach ($data['product']->images as $image)
                                <img class="swiper-slide" alt=""
                                src="{{ $image->image_url }}" />
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="product-detail-right uk-width-1-2">
                    <div class="product-detail-right-top">
                        <h3 class="text-3xl">
                            {{ $data['product']->name }}
                        </h3>
                        <div class="stock">
                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded">
                                Còn hàng
                            </span>
                        </div>
                    </div>

                    <div class="flex items-center my-2 review">
                        <div class="flex items-center gap-1">
                            <i class="fas fa-star text-yellow-400">
                            </i>
                            <i class="fas fa-star text-yellow-400">
                            </i>
                            <i class="fas fa-star text-yellow-400">
                            </i>
                            <i class="fas fa-star text-yellow-400">
                            </i>
                            <i class="fas fa-star text-yellow-400">
                            </i>
                        </div>
                        <p class="text-sm ml-2">
                            5.0 (121 Reviews)
                        </p>
                    </div>

                    <div class="flex items-center my-4 price">
                        <span class="text-2xl font-bold text-red-500">
                            {{ number_format($data['product']->price, 0, ',', '.') }} ₫
                        </span>
                        @if (!empty($data['product']->price_old))
                            <span class="text-base text-gray-500 line-through ml-2">
                                {{ number_format($data['product']->price_old, 0, ',', '.') }} ₫
                            </span>
                        @endif
                    </div>

                    <div class="product-info">
                        <p class="text-gray-600 mb-2 product-info-sku">
                            <strong>Mã sản phẩm:</strong>
                            <a href="#" id="sku">Muckbang</a>
                        </p>
                        <p class="text-gray-600 mb-2 product-info-category">
                            <strong>Danh mục:</strong>
                            <a href="#" id="category">{{ $data['product']->category->name }}</a>
                        </p>
                        <p class="text-gray-600 mb-4 product-info-tag">
                            <strong>Tags:</strong>
                            <a href="#" id="tags">Mucbang ASMR, Mucbang</a>
                        </p>
                        <p class="text-gray-600 mb-4 product-info-vendor">
                            <strong>Thương hiệu:</strong>
                            <a href="#" id="vendor">Jordan</a>
                        </p>

                    </div>

                    <p class=" mb-4 desc">
                        {{ $data['product']->description }}
                    </p>

                    <div class="mb-4 color">
                        <p class="text-lg font-bold">
                            Màu sắc
                        </p>
                        <div class="flex space-x-2">
                            <div class="product-color-options">
                                @foreach ($data['groupedColors'] as $color => $variants)
                                    <span class="product-sw-select-item">
                                        <input type="radio" name="product-choose-color" value="{{ $color }}"
                                            id="color-{{ $loop->index }}" class="trigger-option-sw">
                                        <label for="color-{{ $loop->index }}" style="background-color: #fff"
                                            class="sw-color-label">{{ $color }}</label>
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="mb-14 size">
                        <p class="text-lg font-semibold mb-2 text-[#222]">
                            Size
                        </p>
                        <div class="flex space-x-2 product-size-options" id="sizeOptions">
                            <!-- Hiển thị tất cả các size mặc định -->
                            @foreach ($data['allSizes'] as $size)
                                <span class="product-sw-select-item all-sizes">
                                    <input type="radio" name="product-choose-size" value="{{ $size }}"
                                        id="product-choose-size-{{ $loop->index }}" class="trigger-option-sw">
                                    <label for="product-choose-size-{{ $loop->index }}"
                                        class="sw-size-label">{{ $size }}</label>
                                </span>
                            @endforeach

                            <!-- Hiển thị các size theo từng màu (ẩn mặc định) -->
                            @foreach ($data['groupedColors'] as $color => $variants)
                                <div class="size-group flex space-x-2 product-size-options"
                                    data-color="{{ $color }}" style="display: none;">
                                    @foreach ($variants['sizes'] as $size)
                                        <span class="product-sw-select-item">
                                            <input type="radio" name="product-choose-size" value="{{ $size }}"
                                                id="product-choose-size-{{ $color }}-{{ $loop->index }}"
                                                class="trigger-option-sw">
                                            <label for="product-choose-size-{{ $color }}-{{ $loop->index }}"
                                                class="sw-size-label">{{ $size }}</label>
                                        </span>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>



                    <div class="product-detail-add">
                        <div class="quantity">
                            <div class="quantity-selector">
                                <button type="button" aria-label="Giảm số lượng"
                                    class="quantity-selector-button-minus">-</button>
                                <input class="quantity-selector-input" type="number" step="1" min="1"
                                    max="9999" aria-label="Số lượng sản phẩm" name="quantity" value="1"
                                    readonly="">
                                <button type="button" aria-label="Tăng số lượng"
                                    class="quantity-selector-button-plus">+</button>
                            </div>
                        </div>
                        <div class="add-cart">
                            <p class="mini-cart-button">
                                {{-- <a href="#" class="pay-money" title="Tiếp tục mua hàng">Thêm Vào Giỏ Hàng</a> --}}
                                <button class="pay-money" title="Tiếp tục mua hàng">Thêm Vào Giỏ Hàng</button>
                            </p>
                        </div>
                        <div class="icon-heart-detail">
                            <input type="checkbox" id="hong" class="icon-toggle-checkbox">
                            <label for="hong" uk-icon="heart" class="sw-icon-heart-color"></label>
                        </div>


                    </div>

                    <div class="mb-4 product-extra-content">
                        <p class="mb-1 free-deliver">
                            Miễn phí vận chuyển trên toàn thế giới cho tất cả các đơn hàng của Hiếu
                        </p>
                        <p class=" mb-1 date-time-extra">
                            <i class="fas fa-check-circle fa-sm text-red-500">
                            </i>
                            30 ngày trả hàng dễ dàng
                        </p>
                        <p class="date-time-extra">
                            <i class="fas fa-check-circle fa-sm text-red-500">
                            </i>
                            Đặt hàng trước 00:00 khuya để được giao hàng trong ngày
                        </p>
                    </div>
                </div>
            </div>
        </form>

        <div class="tab-product-detail">
            <ul class="uk-flex-center tab-product-detail-top" uk-tab>
                <li class="uk-active"><a class="tab-product-detail-title" href="#">Mô tả</a></li>
                <li><a class="tab-product-detail-title" href="#">Thông tin bổ sung</a></li>
                <li><a class="tab-product-detail-title" href="#">Đánh giá (1)</a></li>
            </ul>

            <!-- Nội dung của tab -->
            <ul class="uk-switcher uk-margin tab-product-detail-bt">
                <!-- Tab des -->
                <div class="tab-des">
                    <p class="text-[#222]">{{ $data['product']->description }}</p>
                </div>

                <!-- Tab Info -->
                <div class="tab-info">
                    <div class="flex gap-10 pb-4">
                        <span class="text-[#222] font-bold text-lg">Color</span>
                        <p class="text-[#555]"> voluptatum ullam fugit, atque vitae assumenda maxime voluptatem ipsam ad!
                            Molestias enim dolorem ipsa neque sunt repellat!</p>
                    </div>
                    <div class="flex gap-10 pb-4">
                        <span class="text-[#222] font-bold text-lg">Size</span>
                        <p class="text-[#555]"> voluptatum ullam fugit, atque vitae assumenda maxime voluptatem ipsam ad!
                            Molestias enim dolorem ipsa neque sunt repellat!</p>
                    </div>
                </div>

                <!-- Tab review -->
                <div class="tab-review">

                    <div class="flex items-start gap-x-8 pb-8 pt-8 tab-review-warp">
                        <img alt="" class="w-16 h-16 rounded-full" height="60"
                            src="https://storage.googleapis.com/a1aa/image/O7wLlOJVDnb5LBKc40Mw6jm10eUtoOpXp3VAMcG01y7e8ZwTA.jpg"
                            width="60" />
                        <div class="tab-review-body">
                            <div class="tab-review-meta">
                                <div>
                                    <div class="text-sm text-gray-500">
                                        02/07/2004
                                    </div>
                                    <div class="text-lg font-semibold pt-1 mb-1 text-[#222]">
                                        Nguyễn Minh Hiếu
                                    </div>
                                </div>

                                <div class="ml-auto flex items-center adfadf">
                                    <div class="text-yellow-400">
                                        <i class="fas fa-star ">
                                        </i>
                                        <i class="fas fa-star ">
                                        </i>
                                        <i class="fas fa-star ">
                                        </i>
                                        <i class="fas fa-star ">
                                        </i>
                                        <i class="fas fa-star ">
                                        </i>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-review-desc">
                                <div class="mt-2 text-[#555]">
                                    Hayflower blends with fresh moss on this wine’s gentle nose. The palate adds a ripe
                                    lemon freshness that is mouth-filling, smooth, and textured with the yeasty richness
                                    that is aligned to chalky depth.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-start gap-x-8 pb-8 pt-8 tab-review-warp">
                        <img alt="" class="w-16 h-16 rounded-full" height="60"
                            src="https://storage.googleapis.com/a1aa/image/O7wLlOJVDnb5LBKc40Mw6jm10eUtoOpXp3VAMcG01y7e8ZwTA.jpg"
                            width="60" />
                        <div class="tab-review-body">
                            <div class="tab-review-meta">
                                <div>
                                    <div class="text-sm text-gray-500">
                                        02/07/2004
                                    </div>
                                    <div class="text-lg font-semibold pt-1 mb-1 text-[#222]">
                                        Nguyễn Minh Hiếu
                                    </div>
                                </div>

                                <div class="ml-auto flex items-center adfadf">
                                    <div class="text-yellow-400">
                                        <i class="fas fa-star ">
                                        </i>
                                        <i class="fas fa-star ">
                                        </i>
                                        <i class="fas fa-star ">
                                        </i>
                                        <i class="fas fa-star ">
                                        </i>
                                        <i class="fas fa-star ">
                                        </i>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-review-desc">
                                <div class="mt-2 text-[#555]">
                                    Hayflower blends with fresh moss on this wine’s gentle nose. The palate adds a ripe
                                    lemon freshness that is mouth-filling, smooth, and textured with the yeasty richness
                                    that is aligned to chalky depth.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 comment-reply">
                        <h2 class="text-[28px] font-semibold mt-16 comment-reply-title">
                            Thêm đánh giá
                        </h2>
                        <form action="" class="mt-4 space-y-4">

                            <div class="rating">
                                <label class="block text-base font-medium text-[#555] ">
                                    Your rating
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="flex gap-2 items-center mt-1">
                                    <a href="#" class="star" data-value="1"><i
                                            class="fa-solid fa-star text-gray-400 text-lg"></i></a>
                                    <a href="#" class="star" data-value="2"><i
                                            class="fa-solid fa-star text-gray-400 text-lg"></i></a>
                                    <a href="#" class="star" data-value="3"><i
                                            class="fa-solid fa-star text-gray-400 text-lg"></i></a>
                                    <a href="#" class="star" data-value="4"><i
                                            class="fa-solid fa-star text-gray-400 text-lg"></i></a>
                                    <a href="#" class="star" data-value="5"><i
                                            class="fa-solid fa-star text-gray-400 text-lg"></i></a>
                                </div>
                            </div>

                            <div class="comment-reply-review pb-10">
                                <label class="block text-base font-medium text-[#555] pb-3 pt-3">
                                    Your review
                                    <span class="text-red-500">
                                        *
                                    </span>
                                </label>
                                <textarea class="mt-1 block w-full h-32 p-2 input-info"></textarea>
                            </div>

                            <div class="uk-grid comment-reply-review-info pb-5" uk-grid>
                                <div class="comment-reply-name uk-width-1-2">
                                    <label class="block text-base font-medium text-[#555] pb-3">
                                        Name
                                        <span class="text-red-500">
                                            *
                                        </span>
                                    </label>
                                    <input class="mt-1 block w-full p-2 input-info" type="text" />
                                </div>
                                <div class="comment-reply-email uk-width-1-2">
                                    <label class="block text-base font-medium text-[#555] pb-3">
                                        Email
                                        <span class="text-red-500">
                                            *
                                        </span>
                                    </label>
                                    <input class="mt-1 block w-full p-2 input-info" type="email" />
                                </div>
                            </div>

                            <div class="flex items-center pb-8">
                                <input class="h-4 w-4 text-red-500 border-gray-300 rounded" id="save-info"
                                    type="checkbox" />
                                <label class="ml-2 block text-base text-[#555]" for="save-info">
                                    Lưu tên, email và trang web của tôi trên trình duyệt này cho lần bình luận kế tiếp.
                                </label>
                            </div>

                            <button class="comment-reply-button " type="submit">
                                Submit
                            </button>

                        </form>
                    </div>
                </div>
            </ul>
        </div>

        <div class="product-list uk-container uk-container-large uk-position-relative uk-visible-toggle uk-light"
            uk-slider="autoplay: true; autoplay-interval: 3000;">
            <div class=" uk-position-relative uk-visible-toggle uk-light" tabindex="-1">
                <div class="title-related">
                    <h2>Sản phẩm liên quan</h2>
                </div>

                <div class="home-product-list-wrapper uk-grid uk-slider-items" uk-grid="true">
                    @if (!empty($data['productRelated']))
                        @foreach ($data['productRelated'] as $key => $item)
                            <div class="product-item uk-width-1-4@m">
                                <div class="product-image">
                                    <a href="{{ route('productDetail', $item->id) }}">
                                        <img src="{{ $item->image }}" alt="{{ $item->name }}" />
                                    </a>
                                    <span>-10%</span>
                                    <i class="fas fa-heart icon-heart" style="color: #c90d0d; font-size: 1.25rem;"></i>
                                    <div class="product-button">
                                        <button>Thêm vào giỏ </button>
                                        <button uk-toggle="target: #modal-container">Xem nhanh</button>
                                    </div>
                                </div>
                                <div class="product-review">
                                    <a href="{{ route('categories', $item->category->id) }}">
                                        <span>{{ $item->category->name }}</span>
                                    </a>
                                    <div class="icon">
                                        <i class="fa-regular fa-star icon-review" style="color: #fdb5b9;"></i>
                                        <i class="fa-regular fa-star icon-review" style="color: #fdb5b9;"></i>
                                        <i class="fa-regular fa-star icon-review" style="color: #fdb5b9;"></i>
                                        <i class="fa-regular fa-star icon-review" style="color: #fdb5b9;"></i>
                                        <i class="fa-regular fa-star icon-review" style="color: #fdb5b9;"></i>
                                    </div>
                                </div>
                                <a href="{{ route('productDetail', $item->id) }}"
                                    class="product-name">{{ $item->name }}</a>
                                <div class="product-price">
                                    <strong>{{ number_format($item->price, 0, ',', '.') }} ₫</strong>
                                    @if (!empty($item->price_old))
                                        <del>{{ number_format($item->price_old, 0, ',', '.') }} ₫</del>
                                    @endif
                                </div>
                                <div class="product-item-detail-gallery-items">
                                    @if (!empty($item->images))
                                        @foreach ($collection as $item)
                                            <div class="product-item-detail-gallery-item">
                                                <img src="{{ $item->image_url }}"
                                                    alt="">
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <button class="icon-left-product-detail uk-position-center-left uk-position-small uk-hidden-hover" href
                    uk-slider-item="previous">
                    <i>‹</i>
                </button>
                <button class="icon-right-product-detail uk-position-center-right uk-position-small uk-hidden-hover" href
                    uk-slider-item="next">
                    <i>›</i>
                </button>
            </div>
            <ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin"></ul>
        </div>

    </section>

    <script>
        $(document).ready(function() {
            $('input[name="product-choose-color"]').on('change', function() {
                const selectedColor = $(this).val();

                $('.size-group').hide();
                $('.all-sizes').hide();

                if (selectedColor) {
                    $(`.size-group[data-color="${selectedColor}"]`).show();
                } else {
                    $('.all-sizes').show();
                }
            });

            $('.all-sizes').show();
            $('.size-group').hide();
        });

        $('.quantity-selector-button-minus').on('click', function() {
            var currentValue = parseInt($('.quantity-selector-input').val());
            if (currentValue > 1) {
                $('.quantity-selector-input').val(currentValue - 1);
            }
        });

        $('.quantity-selector-button-plus').on('click', function() {
            var currentValue = parseInt($('.quantity-selector-input').val());
            $('.quantity-selector-input').val(currentValue + 1);
        });

        $('.quantity-selector-input').on('input', function() {
            var value = parseInt($(this).val());
            if (isNaN(value) || value < 1) {
                $(this).val(1);
            } else if (value > 9999) {
                $(this).val(9999);
            }
        });


        $('.form-addToCart').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            var productId = form.find('.productId').val();
            var color = form.find('input[name="product-choose-color"]:checked').val();
            var size = form.find('input[name="product-choose-size"]:checked').val();
            var quantity = form.find('input[name="quantity"]').val();

            if (color == null) {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Vui lòng chọn màu sắc',
                    showConfirmButton: true,
                })

                return false;
            }

            if (size == null) {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Vui lòng chọn size',
                    showConfirmButton: true,
                })

                return false;
            }

            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    id: productId,
                    color: color,
                    size: size,
                    quantity: quantity
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: true,
                        })
                    } else {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: response.message,
                            showConfirmButton: true,
                        })
                    }
                },
                error: function() {
                    alert('Lỗi khi thêm vào giỏ hàng');
                }
            });
        });


        document.querySelectorAll('.star').forEach(star => {
            star.addEventListener('click', (event) => {
                event.preventDefault(); // k chuyển trang click vào sao

                //lấy giá trị rating data-value
                const ratingValue = parseInt(star.dataset.value);
                //update màu sắc
                document.querySelectorAll('.star').forEach((s) => {
                    const currentValue = parseInt(s.dataset.value);
                    const icon = s.querySelector('i');
                    // sửa màu
                    icon.classList.toggle('text-yellow-400', currentValue <= ratingValue);
                    icon.classList.toggle('text-gray-400', currentValue > ratingValue);
                });

                //lưu vào ứng dụng, gửi lên backend
                console.log("Rating value:", ratingValue);

            });
        });


        const minusButton = document.querySelector('.quantity-selector-button-minus');
        const plusButton = document.querySelector('.quantity-selector-button-plus');
        const quantityInput = document.querySelector('.quantity-selector-input');

        //giảm số lượng
        minusButton.addEventListener('click', () => {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        });

        //tăng số lượng
        plusButton.addEventListener('click', () => {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue < 9999) {
                quantityInput.value = currentValue + 1;
            }
        });
    </script>
@endsection

@section('js')
@endsection

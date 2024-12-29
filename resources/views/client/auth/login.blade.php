<!DOCTYPE html>
<html lang="en">


<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng nhập</title>
    {{-- <link rel="stylesheet" href="{{ asset('register.css') }}"> --}}
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/sneakers/assets/images/favicon.ico') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.0/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.0/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Spectral:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.21.11/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.21.11/dist/js/uikit-icons.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.21.11/dist/css/uikit.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/scss/app.scss', 'resources/js/app.js'])


    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
    </style>
</head>


<body>
    {{-- <section> --}}
        <a href="{{ route('home') }}" class="icon-home-register">
            <span uk-icon="icon: home">
            </span>
            <div> Quay lại trang chủ </div>
        </a>


        <div class="wrapper-login uk-grid" uk-grid>
            <div class="uk-width-1-2 login-left">
                <img src="https://heins.websitesbykarlo.com/wp-content/uploads/2024/04/banner-01-1.jpg"
                    alt="" width="100%">
            </div>

            <div class="uk-width-1-2 login-right">
                {{-- @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif --}}
                <form action="{{ route('postLogin') }}" method="POST">
                    @csrf
                    <h2>Xin chào 👋</h2>
                    <span>Vui lòng đăng nhập tại đây</span>
                    <div class="input-field">
                        <label for="" class="block text-base font-medium text-[#222] pb-1 mt-5">Email</label>
                        <input class="mt-1 block w-full p-2 input-info input-account-profile" type="email"
                            name="email" value="{{ old('email') }}" required>
                    </div>
                    @error('email')
                        <span style="color:red">{{ $message }}</span>
                    @enderror

                    <div class="input-field">
                        <label class="block text-base font-medium text-[#222] pb-1 mt-5" for="">Mật khẩu</label>
                        <input class="mt-1 block w-full p-2 input-info input-account-profile" type="password"
                            name="password" value="{{ old('password') }}" required>
                    </div>
                    @error('password')
                        <span style="color:red">{{ $message }}</span>
                    @enderror

                    <div class="forget">
                        <div for="remember">
                            <input type="checkbox" name="" id="remember">
                            <label for="remember">Ghi nhớ tôi</label>
                        </div>

                        <a href="{{ route('password.forgotPassword') }}">Quên mật khẩu?</a>
                    </div>

                    <button type="submit" class="btn-login">Đăng nhập</button>

                    <div class="register">
                        <p>Bạn chưa có tài khoản?
                            <a href="{{ route('postRegister') }}">Đăng ký</a>
                        </p>
                    </div>
                </form>
            </div>

        </div>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.0/dist/sweetalert2.min.js"></script>

        @if (session()->has('status'))
            <script>
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: '{{ session('status') }}',
                    showConfirmButton: true
                }).then(result => {
                    if (result.isConv
                    nfirmed) {
                        window.location.href = "{{ route('home') }}";
                    }
                });
            </script>
        @endif

        @if (session('error'))
            <script>
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: '{{ session('error') }}',
                    showConfirmButton: true
                }).then(result => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('login.form') }}";
                    }
                });
            </script>
        @endif
    {{-- </section> --}}
</body>
</html>
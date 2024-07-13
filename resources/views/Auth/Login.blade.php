<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('Image/SIPS.png') }}" type="image/png"/>
    <title>Login SIPS</title>
    @include('Layouts.styles')
    <style>
        .login-card {
            max-width: 500px;
            margin: auto;
            margin-top: 50px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
        }
        .social-icons a {
            margin: 0 10px;
            color: #333;
        }
        .img-logo{
            width: 50px;
            height: 50px;
        }
        .logo-header{
            width: 400px;
            height: 200px;
            margin: auto;
        }
        .text-header{
            font: bold;
            font-size: 50px;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <div class="container justify-content-center align-items-center">
        <div class="card login-card">
            <img src="{{ asset('Image/sps.png') }}" alt="Logo" class="logo-header img-fluid" >
            <h3 class="text-center fw-bold  text-header">Login</h3>
            <form id="formAuthentication" method="POST">
                @csrf
                <div class="form-group">
                    <label for="username"><i class="fas fa-user pr-2"></i>Username</label>
                    <input type="username" class="form-control" name="username" id="username" placeholder="Enter username">
                    <small id="username-error" class="text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="password"><i class="fas fa-lock pr-2"></i>Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    <small id="password-error" class="text-danger"></small>
                </div>
                <div class="pt-2">
                    <button type="submit" class="btn btn-block" style="background-color: #FB6447;color :white;">Login</button>
                </div>
            </form>
            <div class="social-icons text-center mt-4">
                <a href="#"><img src="{{ asset('Image/logo-palu.png') }}" alt="Logo" class="img-fluid  img-logo" ></a>
                <a href="#"><img src="{{ asset('Image/stmikadhigunaicon.svg') }}" alt="Logo" class="img-fluid img-logo" ></a>
                <a href="#"><img src="{{ asset('Image/pena.png') }}" alt="Logo" class="img-fluid img-logo" ></a>
            </div>
            <div class="login-footer d-flex justify-content-center align-items-center pt-3">
                <p>&copy; 2024 Sistem Informasi Pengaduan Aplikasi SRIKANDI</p>
            </div>
        </div>
    </div>
    </div>

    @include('Layouts.scripts')
    <script>
        const apiUrl = 'v1/login';
        function successAlert(message) {
            Swal.fire({
                title: 'Berhasil!',
                text: message,
                icon: 'success',
                showConfirmButton: false,
                timer: 1000,
            })
        }

        // alert error message
        function errorAlert() {
            Swal.fire({
                title: 'Error',
                text: 'Terjadi kesalahan!',
                icon: 'error',
                showConfirmButton: false,
                timer: 1000,
            });
        }


        // funtion reload
        function reloadBrowsers() {
            setTimeout(function() {
                location.reload();
            }, 1500);
        }

        function loadingAllert(){
            Swal.fire({
                title: 'Loading...',
                text: 'Please wait',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        }

        $(document).ready(function () {
            let formInput = $('#formAuthentication');

            formInput.on('submit', function (e) {
                e.preventDefault();

                $('.text-danger').text('');

                let formData = new FormData(this);
                loadingAllert();

                $.ajax({
                    type: 'POST',
                    url: `{{ url('${apiUrl}') }}`,
                    data: formData,
                    dataType: 'JSON',
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        Swal.close();
                        if (response.code === 422) {
                            let errors = response.errors;
                            $.each(errors, function(key, value) {
                                $('#' + key + '-error').text(value[0]);
                            });
                        } else {
                            successAlert();
                            if (response.user && response.user.role) {
                                switch (response.user.role.toLowerCase()) {
                                    case 'user':
                                        window.location.href = '/';
                                        break;
                                    case 'admin':
                                        window.location.href = '/cms-dashboard';
                                        break;
                                    default:
                                        window.location.href = '/';
                                        break;
                                }
                            } else {
                                console.error('User role not found in response.');
                                window.location.href = '/';
                            }
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        Swal.close();
                        if (xhr.status === 401) {
                            errorAlert();
                        }
                    }
                });
            });
        });

    </script>
</body>
</html>

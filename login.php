<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <title>
        Đăng nhập
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
</head>

<body class="">
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                <!-- Navbar -->
                <nav
                    class="navbar navbar-expand-lg blur border-radius-lg top-0 z-index-3 shadow position-absolute mt-4 py-2 start-0 end-0 mx-4">
                    <div class="container-fluid">
                        <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="#">
                            Hieu's Inventory Management
                        </a>
                        <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon mt-2">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </span>
                        </button>
                        <div class="collapse navbar-collapse" id="navigation">
                            <ul class="navbar-nav mx-auto">
                                <li class="nav-item">
                                    <a class="nav-link me-2" href="signup.php">
                                        <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
                                        Đăng ký
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link me-2" href="login.php">
                                        <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
                                        Đăng nhập
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link me-2" href="forgot_password.php">
                                        <i class="fas fa-key opacity-6 text-dark me-1"></i>
                                        Quên mật khẩu
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <!-- End Navbar -->
            </div>
        </div>
    </div>
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-start">
                                    <h4 class="font-weight-bolder">Đăng nhập</h4>
                                    <p class="mb-0">Nhập tên đăng nhập và mật khẩu của bạn để đăng nhập</p>
                                </div>
                                <div class="card-body">
                                    <form role="form" method="POST" action="./main/index.php?act=login"
                                        onsubmit="return validateLoginForm()" name="loginForm">
                                        <div class="mb-3">
                                            <input type="text" class="form-control form-control-lg"
                                                placeholder="Tên đăng nhập" name="username" aria-label="username"
                                                autocomplete="username">
                                        </div>
                                        <div class="mb-3">
                                            <input type="password" class="form-control form-control-lg"
                                                placeholder="Mật khẩu" name="password" aria-label="password"
                                                autocomplete="current-password">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0"
                                                name="login">Đăng nhập</button>
                                        </div>
                                        <span id="loginMessage" class="text-danger mb-3"></span>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-sm mx-auto">
                                        Bạn chưa có tài khoản?
                                        <a class="text-primary text-gradient font-weight-bold" href="signup.php">Đăng
                                            ký</a>
                                    </p>
                                    <p class="mb-4 text-sm mx-auto">
                                        Bạn không nhớ mật khẩu?
                                        <a class="text-primary text-gradient font-weight-bold"
                                            href="forgot_password.php">Quên
                                            mật khẩu</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                            <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden"
                                style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signin-ill.jpg');
          background-size: cover;">
                                <span class="mask bg-gradient-primary opacity-6"></span>
                                <h4 class="mt-5 text-white font-weight-bolder position-relative">"Quản lý kho, kết nối
                                    thành công mọi chiều hướng."</h4>
                                <p class="text-white position-relative">Càng mượt mà quá trình quản lý kho, càng
                                    nhiều nỗ lực mà người quản lý đã đầu tư vào quá trình đó.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!--   Core JS Files   -->
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="assets/js/argon-dashboard.min.js?v=2.0.4"></script>
    <script>
        function validateLoginForm() {
            var username = document.forms["loginForm"]["username"].value;
            var password = document.forms["loginForm"]["password"].value;
            var messageElement = document.getElementById("loginMessage");

            if (username === "" || password === "") {
                messageElement.innerHTML = "Vui lòng điền đầy đủ tên đăng nhập và mật khẩu.";
                return false;
            }

            if (password.length < 8) {
                messageElement.innerHTML = "Mật khẩu phải có ít nhất 8 ký tự.";
                return false;
            }
            return true;
        } 
    </script>
</body>

</html>
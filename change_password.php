<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <title>
        Thay đổi mật khẩu
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
                                <a class="nav-link me-2" href="signup.php">
                                    <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
                                    Đăng ký
                                </a>
                                <li class="nav-item">
                                    <a class="nav-link me-2" href="login.php">
                                        <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
                                        Đăng nhập
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
                                    <h4 class="font-weight-bolder">Thay đổi mật khẩu</h4>
                                    <p class="mb-0">Nhập mật khẩu cũ và mật khẩu mới của bạn để thay đổi mật khẩu</p>
                                </div>
                                <div class="card-body">
                                    <form role="form" method="post" action="./main/index.php?act=change_password_submit"
                                        onsubmit="return validateChangePasswordForm()">
                                        <div class="mb-3">
                                            <input type="password" class="form-control form-control-lg"
                                                placeholder="Mật khẩu hiện tại" name="old_password"
                                                aria-label="old_password">
                                        </div>
                                        <div class="mb-3">
                                            <input type="password" class="form-control form-control-lg"
                                                placeholder="Mật khẩu mới" name="password" aria-label="password">
                                        </div>
                                        <div class="mb-3">
                                            <input type="password" class="form-control form-control-lg"
                                                placeholder="Nhập lại mật khẩu mới" name="confirm_password"
                                                aria-label="Password">
                                        </div>
                                        <div class="text-center">
                                            <button type="button" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0"
                                                name="submit">Xác nhận</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                            <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden"
                                style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signin-ill.jpg');
          background-size: cover;">
                                <span class="mask bg-gradient-primary opacity-6"></span>
                                <h4 class="mt-5 text-white font-weight-bolder position-relative">"Attention is the new
                                    currency"</h4>
                                <p class="text-white position-relative">The more effortless the writing looks, the more
                                    effort the
                                    writer actually put into the process.</p>
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
        function validateChangePasswordForm() {
            var oldPassword = document.getElementsByName("old_password")[0].value;
            var newPassword = document.getElementsByName("password")[0].value;
            var confirmPassword = document.getElementsByName("conf_pass")[0].value;

            var isValid = true;

            // Reset thông báo lỗi
            document.getElementById("oldPasswordError").innerHTML = "";
            document.getElementById("newPasswordError").innerHTML = "";
            document.getElementById("confirmPasswordError").innerHTML = "";

            // Kiểm tra mật khẩu cũ
            if (oldPassword === "") {
                document.getElementById("oldPasswordError").innerHTML = "Vui lòng nhập mật khẩu cũ";
                isValid = false;
            }

            // Kiểm tra mật khẩu mới
            if (newPassword === "") {
                document.getElementById("newPasswordError").innerHTML = "Vui lòng nhập mật khẩu mới";
                isValid = false;
            }

            // Kiểm tra nhập lại mật khẩu
            if (newPassword !== confirmPassword) {
                document.getElementById("confirmPasswordError").innerHTML = "Mật khẩu mới và nhập lại không khớp";
                isValid = false;
            }

            return isValid;
        }
    </script>
</body>

</html>
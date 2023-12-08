<?php
session_start();

include './model/account.php';
include './model/pdo.php';

if (isset($_SESSION['user'])) {
    if ($_SESSION['user']['position_id'] == 0) {
        header("location: ./main/index.php?act=dashboard");
    } else if ($_SESSION['user']['position_id'] == 1) {
        header("location: main/index.php?act=dashboard");
    }
} else {
    header("location:login.php");
}

switch (isset($_GET['act'])) {
    case 'login':
        if (isset($_POST['login'])) {
            $username = htmlspecialchars($_POST['username']);
            $password = htmlspecialchars($_POST['password']);
            $user = login($username, $password);
            if ($user) {
                // Đăng nhập thành công
                $_SESSION['user'] = $user;
                session_regenerate_id(true);
                header('Location: index.php');
                exit;
            } else {
                // Đăng nhập không thành công
                echo "Tên đăng nhập hoặc mật khẩu không đúng.";
            }
        }
        break;
    case 'change_password_submit':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_SESSION['user']['id'];
            $old_password = htmlspecialchars($_POST['old_password']);
            $password = htmlspecialchars($_POST['password']);
            $confirm_password = htmlspecialchars($_POST['confirm_password']);

            if ($password === $confirm_password) {
                if (changePassword($id, $old_password, $password)) {
                    unset($_SESSION['user']);
                    header('Location: /login.php');
                    exit;
                } else {
                    header('Location: /change_password.php');
                    exit;
                }
            } else {
                header('Location: /change_password.php');
                exit;
            }
        }
        break;
    case 'forgot_password':

        include 'dashboard.php';
        break;

}
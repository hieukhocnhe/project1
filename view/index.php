<?php

include './model/pdo.php';
include '.model/account.php';

pdo_connect();

if (isset($_GET['act']) && $_GET['act'] !== '') {
    switch ($_GET['act']) {
        case 'login':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $username = $_POST['username'];
                $password = $_POST['password'];
                $user = login($username, $password);
                if ($user) {
                    $_SESSION['user'] = $user;
                    header('Location: ../index.php');
                } else {
                    header('Location: ../views/login.php');
                }
            } else {
                echo 1;
            }
            break;
        case 'change_password':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $id = $_SESSION['user']['id'];
                $old_password = $_POST['old_password'];
                $password = $_POST['password'];
                $conf_pass = $_POST['conf_pass'];
                if ($password === $conf_pass) {
                    changePassword($id, $old_password, $password);
                    unset($_SESSION['user']);
                    header('Location: ../views/login.php');
                } else {
                    header('Location: ../views/login.php');
                }
            }
            break;

        default:
            header('Location: ../views/login.php');
            break;
    }
}
?>
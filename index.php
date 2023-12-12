<?php
session_start();

if (isset($_SESSION['user'])) {
    header("location: main/index.php?act=dashboard");
} else {
    header("location: login.php");
}

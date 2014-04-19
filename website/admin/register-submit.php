<?php defined('BASEPATH') || exit('No direct script access allowed');

require_once '../config/security.php';
require_once '../config/database.php';

if (!isset($_POST['csrfToken']) && strcmp($_POST['csrfToken'], CSRFToken()) !== 0) {
    setSessionVars($_POST);
    redirect($_SERVER['HTTP_REFERER']);
} else {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $color = $_POST['color'];

    $username = filter_var($username, FILTER_SANITIZE_STRING);
    $password = filter_var($password, FILTER_SANITIZE_STRING);
    $color = filter_var($color, FILTER_SANITIZE_STRING);

    // function to save user to database
}
<?php

function errorMessage($str) {
    return '<div style="width:50%; margin:0 auto; margin-top:10px; text-align:center;">' . $str . '</div>';
}

function successMessage($str) {
    return '<div style="width:50%; margin:0 auto; margin-top:10px; text-align:center;">' . $str . '</div>';
}

function redirect($url) {
    echo '<script type="text/javascript">window.location = "' . $url . '";</script>';
}
function verify($password) {
    return password_verify($pass, $row['password']);
}
?>
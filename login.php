<?php
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        include 'pdo.php';
    $newMember = new Member();
    $newMember->my_constructor();
    $newMember->check_login($pdo);
} else {
    echo 'mail+pw';
}
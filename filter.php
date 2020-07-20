<?php
if (!empty($_POST['get_mail'])) {
    include 'pdo.php';
    $newMember = new Member();
    $newMember->my_constructor();
    $newMember->my_research($pdo);
} 

else {
    echo 'error';
}
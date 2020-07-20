<?php

$password = password_hash("coucou", PASSWORD_DEFAULT);
// $password2 = password_hash("coucou", PASSWORD_DEFAULT);
$mdp_db = "$2y$10$7sZCEZD7m4bDfQZ7CGIIv.mfArQMn9hUCvhRgwXGuo.Ht2uqDkVMS";
$mdp_code = "$2y$10$7sZCEZD7m4bDfQZ7CGIIv.mfArQMn9hUCvhRgwXGuo.Ht2uqDkVMS";

if ($mdp_db == $mdp_code) {
    echo "ps are the same";
}
else {
    echo "not working mdp";
}
// echo "passw.: " . $password . PHP_EOL;
// // echo $password2 . PHP_EOL;

// if (password_verify('coucou', $password) == true) {
//     echo 'good';
// }
// else {
//     echo 'bad';
// }
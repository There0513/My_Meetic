<?php
if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['date']) && !empty($_POST['genre']) && !empty($_POST['ville']) && !empty($_POST['email']) && !empty($_POST['password1']) && !empty($_POST['password2']) && !empty($_POST['loisir'])) {
    if ($_POST['password1'] == $_POST['password2']) {
        include 'pdo.php';
        $newMember = new Member();
        $newMember->my_constructor();
        // $newMember = new Member($_POST['nom'], $_POST['prenom'], $_POST['date'], $_POST['ville'], $_POST['email'], $_POST['password1'], $_POST['loisir']); //with new values of inscriptions
        $newMember->insert($pdo, $_POST['nom'], $_POST['prenom'], $_POST['date'], $_POST['genre'], $_POST['ville'], $_POST['email'], password_hash($_POST['password1'], PASSWORD_DEFAULT), $_POST['loisir']);
        echo 'good';
    }
} else {
    echo 'bad';
    // echo json_encode(array("Bad" => 'bad'));
}

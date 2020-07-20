<?php
$mail = $_POST['mail']; //= hidden input with mail actuel
if (isset($_POST['mail'])) {

    if (isset($_POST['nom']) && !empty($_POST['nom'])) {
        //modif nom
        $modif_nom = $_POST['nom'];
        include 'modif_in_DB.php';
        // echo 'done';
    }
    if (isset($_POST['prenom']) && !empty($_POST['prenom'])) {
        //modif prenom
        $modif_prenom = $_POST['prenom'];
        include 'modif_in_DB.php';
        // echo 'done';
    }
    if (isset($_POST['ville']) && !empty($_POST['ville'])) {
        //modif ville
        $modif_ville = $_POST['ville'];
        include 'modif_in_DB.php';
        // echo 'done';
    }
    if (isset($_POST['newmail']) && !empty($_POST['newmail'])) {
        //modif mail
        $modif_mail = $_POST['newmail'];
        include 'modif_in_DB.php';
        // echo 'done'; 
    }
    if (isset($_POST['hobby1']) && !empty($_POST['hobby1'])) {
        //modif hobby
        $modif_hobby1 = $_POST['hobby1'];
        include 'modif_in_DB.php';
        // echo 'done';
    }
    echo 'done';
}
if (isset($_POST['get_mail'])) {
    if (!empty($_POST['mdp_new']) && !empty($_POST['mdp_new_2'])) {
        if ($_POST['mdp_new'] == $_POST['mdp_new_2']) {
            include 'pdo.php';
            $mdp_new = $_POST['mdp_new'];
            $newMember = new Member();
            $newMember->my_constructor();
            $newMember->set_pw($pdo, $new_pw);
            return;
            // include 'modif_in_DB.php';
        }
        echo "not_same";
    }
    echo "enter_mdp";
} else {
    echo 'bad';
}

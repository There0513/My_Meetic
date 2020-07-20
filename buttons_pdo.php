<?php
try {
    $user = 'Theresa';
    $password = "mysql123";
    $pdo = new PDO(
        'mysql:host=localhost;dbname=meetic',
        $user,
        $password
    );
    $mail = $_POST['mail'];
    $pdo->query("UPDATE fiche_personne SET active='N' WHERE mail='$mail'");

} catch (PDOException $error) {
    echo "Error : " . $error->getMessage() . PHP_EOL;
}

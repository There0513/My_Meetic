<?php
try {
    $user = 'Theresa';
    $password = "mysql123";
    $pdo = new PDO(
        'mysql:host=localhost;dbname=meetic',
        $user,
        $password
    );
    if (isset($modif_nom)) {
        $pdo->query("UPDATE fiche_personne SET nom='$modif_nom' WHERE mail='$mail'");
    }
    if (isset($modif_prenom)) {
        $pdo->query("UPDATE fiche_personne SET prenom='$modif_prenom' WHERE mail='$mail'");
    }
    if (isset($modif_ville)) {
        $pdo->query("UPDATE fiche_personne SET ville='$modif_ville' WHERE mail='$mail'");
    }
    if (isset($modif_mail)) {
        $pdo->query("UPDATE fiche_personne SET mail='$modif_mail' WHERE mail='$mail'");
    }
    if (isset($modif_hobby1)) {
        foreach ($pdo->query("SELECT id_perso FROM fiche_personne WHERE mail='$mail'") as $id) {
            $id_perso = $id['id_perso'];
        }
        $pdo->query("UPDATE loisir SET hobby1='$modif_hobby1' WHERE id_perso='$id_perso'");
    }
} catch (PDOException $error) {
    echo "Error : " . $error->getMessage() . PHP_EOL;
}

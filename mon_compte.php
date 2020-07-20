<?php session_start();
include 'pdo.php';
$_SESSION['username'] = $_GET['mail']; ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <title>My Meetic</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>
    <nav>
        <ul>
            <li><a href="index.php">Bienvenue</a></li>
            <li class="deroulant"><a href="#">Mon Compte &ensp;</a>
                <ul class="sous">
                    <li><a href="ma_recherche.php?mail=<?php echo $_GET['mail']; ?>">Ma recherche</a></li>
                </ul>
            </li>
            <li><a id="logout" onclick="logout();" href="index.php">Logout</a></li>


        </ul>
    </nav>
    <!-- <div class="menu">
        <ul>
            <li><a href="index.php">Bienvenue</a></li>
            <li><a href="#" class="active">Mon Compte</a></li>
            <li><a href="ma_recherche.php?mail=<?php echo $_GET['mail']; ?>">Ma Recherche</a></li>
            <li><a id="logout" onclick="logout();" href="index.php">Logout</a></li>
        </ul>
    </div> -->
    <h2>Bienvenue <?php echo $_GET['mail']; ?> </h2>
    <div class="container_2">
        <h3>Changer mot de passe ici</h3>
        <form action="" method="post">
            <input type="hidden" id="get_mail" value="<?php echo $_GET['mail']; ?>">
            <p>Mot de passe actuel : <input id="mdp_old" type="password"></p>
            <p>Nouveau mot de passe : <input id="mdp_new" type="password"></p>
            <p>Confirmation <br> nouveau mot de passe : <input id="mdp_new_2" type="password"></p>
            <input type="submit" id="modif_mdp" value="Changer">
            <input type="submit" class="cancel" value="Cancel">

        </form>
    </div>
    <div class="container">
        <h3>Infos from database</h3>
        <?php
        $get_values = 'go';
        include 'pdo.php';
        ?>
        <br>
        <input type="button" id="modifier" onclick="show_input();" value="Modifier data">
        <input type="button" class=cancel value="Cancel" style="display: none;" onclick="cancel();">

        <br><br>

        <p class="modif_mdp" style="color: grey;display: none;">Modifier mdp -> <input style="color: grey; display: none;" type="button" onclick="hide_container();" class="modif_mdp" value="modifier"></p>
        <p style="color: grey;">Supprimer le compte définitivement -> <input style="color: grey;" type="button" id="supprimer" value="supprimer"></p>
    </div>
    <script src="modify_compte.js"></script>
    <script src="modif_ajax.js"></script>
    <script src="delete.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
</body>

</html>
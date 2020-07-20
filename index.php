<?php session_start();
include 'pdo.php' ?>
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
    <div class="menu">
        <ul>
            <li><a href="#" class="active">Bienvenue</a></li>
            <li><a href="#">Mon Compte</a></li>
            <li><a href="#">Ma Recherche</a></li>
        </ul>
    </div>
    <div class="container">
        <h3>Pas encore inscrit ?</h3>
        <h3>Inscrivez-vous ici :</h3>
        <div class="grid">
            <p><span class="needed">* champs requis</span></p>
            <form id="formulaire" method="POST">
                <p>Nom : <input type="text" id="nom" name="nom"><span class="needed"> *</span></p>
                <p>Prénom : <input type="text" id="prenom" name="prenom"><span class="needed"> *</span></p>
                <p>Date de naissance : <input id="date" type="date" max="2002-01-28" name="date"><span class="needed"> *</span></p>

                <p>Genre :
                    <select name="genre" id="genre">
                        <option name="genre" value=""> Genre</option>
                        <option name="genre" value="autres"> Autres</option>
                        <option name="genre" value="femme"> Femme </option>
                        <option name="genre" value="homme">Homme</option>
                    </select><span class="needed"> *</span></p>
                <p>Ville : <input type="text" id="ville" name="ville" value=""><span class="needed"> *</span></p>
                <p>E-mail : <input type="email" id="mail" name="email"><span class="needed"> *</span></p>
                <p>Mot de passe : <input type="password" id="mdp1" name="password1" value=""><span class="needed"> *</span></p>
                <p>Confirmation mot de passe : <input type="password" id="mdp2" name="password2" value=""><span class="needed"> *</span></p>
                <p>Loisir : <input type="text" id="loisir" name="loisir"><span class="needed"> * </span></p>
                <input type="submit" id="subscribe" name="subscribe" value="Subscribe">
            </form>
        </div>
        <div class="error">
            <!-- echo from .php -->
        </div>
    </div>
    <div id="resultat">
        <!-- echo from .php -->
    </div>
    <div class="container">
        <h3>Connectez vous :</h3>
        <div class="grid">
            <form id="login" method="POST">
                Nom d'utilisateur : <input type="text" name="username" id="username"><br><br>
                Mot de passe : <input type="password" name="password" id="password">
                <input type="submit" id="submit" value="Se connecter !">
            </form>
        </div>
    </div>
    <script src="subscribe.js"></script>
    <script src="login.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
</body>

</html>
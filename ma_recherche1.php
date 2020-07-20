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
            <li><a href="index.php">Bienvenue <? echo $_SESSION['username']; ?> </a></li>
            <li><a href="mon_compte.php?mail=<?php echo $_GET['mail']; ?>">Mon Compte</a></li>
            <li><a href="ma_recherche.php?mail=<?php echo $_GET['mail']; ?>" class="active">Nouvelle Recherche</a></li>
            <li><a id="logout" onclick="logout();" href="index.php">Logout</a></li>
        </ul>
    </div>
    <h2>Bienvenue <?php echo $_GET['mail']; ?> </h2>
    <script>
        $(document).ready(function() {
            $("#final_filter").click(function(e) {
                e.preventDefault();
                $.post(
                    'filter.php', {
                        get_mail: $("#get_mail").val(),
                        autre: $('#autre').val(),
                        femme: $('#femme').val(),
                        homme: $('#homme').val(),
                        paris: $('#paris').val(),
                        marseille: $('#marseille').val(),
                        lyon: $('#lyon').val(),
                        coder: $('#coder').val(),
                        danser: $('#danser').val(),
                        lecture: $('#lecture').val(),
                        cinema: $('#cinema').val(),
                        age1: $('#age1').val(),
                        age2: $('#age2').val(),
                        age3: $('#age3').val(),
                        age4: $('#age4').val()
                    },
                    function(data, status) {

                        if (data == 'working') {
                            console.log("working data = " + data, status);
                            return;
                        }
                        if (data == 'go_show_results') {
                            console.log("data = " + data, status);
                            alert("yesss");
                        }
                        if (data == 'error') {
                            alert("Error");
                            console.log("data = " + data, status);
                        } else {
                            console.log("else data = " + data);
                            $('.go_show_results').html(data);

                        }
                    },
                    'text'
                );
            });
        });
    </script>
    <div class="container">
        <h3>Je cherche :</h3>
        <div id="result">
            <form id="conf_search" action="" method="POST">
                <input type="hidden" id="get_mail" value="<?php echo $_GET['mail']; ?>">
                <?php
                if (isset($_GET['genre1'])) {
                    echo 'Genre : ' . '<input id="autre" type="text" value="autre" readonly><br><br>';
                }
                if (isset($_GET['genre2'])) {
                    echo 'une ' . '<input id="femme" type="text" value="Femme" readonly>' . ' , ' . '<br><br>';
                }
                if (isset($_GET['genre3'])) {
                    echo 'un ' . '<input id="homme" type="text" value="Homme" readonly>' . ' , ' . '<br><br>';
                }
                if (isset($_GET['ville1'])) {
                    echo 'qui habite à ' . '<input id="paris" type="text" value="Paris" readonly>' . ' , ' . '<br><br>';
                }
                if (isset($_GET['ville2'])) {
                    echo 'qui habite à ' . '<input id="marseille" type="text" value="Marseille" readonly>' . ' , ' . '<br><br>';
                }
                if (isset($_GET['ville3'])) {
                    echo 'qui habite à ' . '<input id="lyon" type="text" value="Lyon" readonly>' . ' , ' . '<br><br>';
                }
                // if (isset($_GET['ville4'])) {
                //     echo 'qui habite à Hubuhui, <br><br>';
                // }
                if (isset($_GET['loisir1'])) {
                    echo 'et qui aime bien ' . '<input id="coder" type="text" value="coder" readonly>' . ' , ' . '<br><br>';
                }
                if (isset($_GET['loisir2'])) {
                    echo 'et qui aime bien ' . '<input id="danser" type="text" value="danser" readonly>' . ' , ' . '<br><br>';
                }
                if (isset($_GET['loisir3'])) {
                    echo 'et qui aime bien la ' . '<input id="lecture" type="text" value="lecture" readonly>' . ' , ' . '<br><br>';
                }
                if (isset($_GET['loisir4'])) {
                    echo 'et qui aime bien le ' . '<input id="cinema" type="text" value="cinema" readonly>' . ' , ' . '<br><br>';
                }
                if (isset($_GET['age1'])) {
                    echo 'La personne devrait avoir l\'age ' . '<input id="age1" type="text" value="18-25" readonly>' . ' , ' . '<br><br>';
                }
                if (isset($_GET['age2'])) {
                    echo 'La personne devrait avoir l\'age ' . '<input id="age2" type="text" value="25-35" readonly>' . ' , ' . '<br><br>';
                }
                if (isset($_GET['age3'])) {
                    echo 'La personne devrait avoir l\'age ' . '<input id="age3" type="text" value="35-45" readonly>' . ' , ' . '<br><br>';
                }
                if (isset($_GET['age4'])) {
                    echo 'La personne devrait avoir l\'age ' . '<input id="age4" type="text" value="45+" readonly>' . ' , ' . '<br><br>';
                }; ?>
                <button id="final_filter">C'est bien ça ?!</button>
                <a href="ma_recherche.php?mail=<?php echo $_GET['mail']; ?>">Sinon -> Nouvelle recherche</a>
            </form>
        </div>
    </div>
    <div class="container">
        <h3>Resultat :</h3>
        <div class="slider_out">
            <button class="prev" onclick="prev();">Prev</button>
            <div class="go_show_results">
            </div>
            <button class="next" onclick="next();">Next</button>
        </div>
    </div>
    <script src="modify_compte.js"></script>
    <script src="modif_ajax.js"></script>
    <script src="delete.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
</body>

</html>











<!-- // === START: Logout without confirmation ===
add_action('check_admin_referer', 'logout_without_confirm', 10, 2);
function logout_without_confirm($action, $result) {
    if ($action == "log-out" && !isset($_GET['_wpnonce'])) {
        $redirect_to = isset($_REQUEST['redirect_to'])?$_REQUEST['redirect_to']:'';
        $location = str_replace('&amp;', '&', wp_logout_url($redirect_to));
        header("Location: $location");
        die;
    }
}
// === END: Logout without confirmation === -->
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
            <li><a href="" class="active">Ma Recherche</a></li>
            <li><a id="logout" onclick="logout();" href="index.php">Logout</a></li>
        </ul>
    </div>
    <h2>Bienvenue <?php echo $_GET['mail']; ?> </h2>
    <div class="container">
        <h3>Commence ta recherche maitenant !</h3>


        <form id="recherche" action="" method="post">
            <input type="hidden" id="get_mail" value="<?php echo $_GET['mail']; ?>">
            <p>Genre :<br><br>
                <!-- $('#genre option:selected').text() -->
                <select name="genre" id="genre">
                    <option name="genre" value=""> Genre</option>
                    <option name="genre1" value="autres"> Autres</option>
                    <option name="genre2" value="femme"> Femme </option>
                    <option name="genre3" value="homme">Homme</option>
                </select></p>
            <p>Ville :
                <div id="ville" name="ville">
                    Paris <input name="ville1" value="paris" type="checkbox">
                    Marseille <input name="ville2" value="marseille" type="checkbox">
                    Lyon <input name="ville3" value="lyon" type="checkbox">
                    <input id="ville4" name="ville4" class="ville" type="text" placeholder="autre Ville">
                    <!-- ______ Autre <input type="text" placeholder="autre"> -->
                </div>
                <!-- $("#ville").children("input:checked").val() -->
                <!-- $('.ville').val() -->
            </p>
            <p>Loisir :
                <!-- $("#loisir").children("input:checked").val() -->
                <div id="loisir" name="loisir">
                    Coder <input name="loisir1" value="coder" type="checkbox">
                    Danser <input name="loisir2" value="danser" type="checkbox">
                    Lécture <input name="loisir3" value="lecture" type="checkbox">
                    Cinéma <input name="loisir4" value="cinema" type="checkbox"><br>
                    <!-- ______ Autre <input type="text" placeholder="autre"> -->
                </div>
            </p>
            <p>Age :<br><br>
                <!-- $('#age option:selected').text() -->
                <select name="age" id="age">
                    <option name="age" value=""> Age</option>
                    <option name="age1" value="1">18-25</option>
                    <option name="age2" value="2">25-35</option>
                    <option name="age3" value="3">35-45</option>
                    <option name="age4" value="4">45+</option>
                </select>
            </p><br><br><br>
            <input type="submit" id="start_search" value="Find match">
        </form>


        <script>
            $(document).ready(function() {
                $("#start_search").click(function(e) {
                    var filter = "";
                    $('#recherche input:checked, #recherche option:selected').each(
                        function(index) {
                            var input = $(this);
                            var var_name = $(this).attr('name')
                            filter += '&' + var_name + '=' + input.val();
                            //     checked_ville.push($(this).val());
                            // $('#result').html('Value: ' + input.val());
                            // alert('Value: ' + input.val()); //+$('.ville').val() for 'autre ville'
                        },
                    );
                    // $("#result").html(filter);
                    location.href = 'ma_recherche1.php?mail=' + get_mail.value + filter;
                    // ->/ma_recherche.php?mail=johann@gmail.comundefinedfemmepariscoder1
                    e.preventDefault();
                    $.post(
                        'filter.php', {
                            genre: $('#genre option:selected').text(),
                            age: $('#age option:selected').text()
                        },
                        function(data, status) {

                            if (data == 'done') {
                                console.log("done data = " + data, status);
                                return;
                            } else {
                                console.log("data = " + data);
                            }
                        },
                        'text'
                    );
                });
            });
        </script>
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
$(document).ready(function () {
    $("#formulaire").submit(function (e) {
        e.preventDefault();
        $.post(
            'subscribe.php',
            {
                nom: $("#nom").val(),
                prenom: $("#prenom").val(),
                date: $("#date").val(),
                genre: $("#genre").val(),
                ville: $("#ville").val(),
                email: $("#mail").val(),
                password1: $("#mdp1").val(),
                password2: $("#mdp2").val(),
                loisir: $("#loisir").val(),
            },
            function (data, status) {
                // alert("Data: " + data + "\nStatus: " + status)
                // JsonData = JSON.parse(data)
                if (data == 'already_existgood') {
                    console.log("data = " + data, status);
                    $(".error").html("Il existe déjà un compte avec votre adresse mail.");
                    return;
                }
                if (data != 'already_existgood' && data != 'bad' && data != "" && status === 'success') {
                    //       already_existgood
                    console.log("data = " + data);
                    'pdo.php';
                    $("#resultat").html("connexion en cours");
                    alert("Bienvenue sur my_meetic.fr");
                    location.href = 'mon_compte.php?mail=' + mail.value;
                }
                else if (data == 'bad' || data == "") {
                    console.log("data = " + data);
                    $(".error").html("Veuillez remplir tous les champs requis. Attention au mot de passe !");
                }
                else {
                    console.log("fail");
                    console.log("data = " + data);
                    $(".error").html("Something went wrong. Please try again!");
                }
            },
            'text' //success or failed
        );
    });
});
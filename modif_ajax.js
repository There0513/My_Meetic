$(document).ready(function () {
    $("#modif").submit(function (e) {
        e.preventDefault();
        $.post(
            'modif_ajax_next.php',
            {
                nom: $("#nom").val(),
                prenom: $("#prenom").val(),
                ville: $("#ville").val(),
                mail: $("#mail").val(),
                newmail: $("#newmail").val(),
                hobby1: $("#hobby1").val()
            },
            function (data, status) {

                if (data == 'done') {
                    console.log("data = " + data, status);
                    location.href = 'mon_compte.php?mail=' + newmail.value;
                    return;
                }
                else {
                    location.href = 'mon_compte.php?mail=' + newmail.value;
                    console.log("data = " + data);
                }
            },
            'text'
        );
    });
    $("#modif_mdp").click(function (e) {
        e.preventDefault();
        $.post(
            'modif_ajax_next.php',
            {
                get_mail: $("#get_mail").val(),
                mdp_old: $("#mdp_old").val(),
                mdp_new: $("#mdp_new").val(),
                mdp_new_2: $("#mdp_new_2").val()
            },
            function (data, status) {

                if (data == 'pw_changed') {
                    console.log("data = " + data, status);
                    alert("Votre mdp a été changé !")
                    location.href = 'mon_compte.php?mail=' + get_mail.value;
                    return;
                }
                if (data == 'not_same') {
                    alert("MDP 1 != mdp de confirmation. please try again");
                }
                if (data == 'wrong_pw') {
                    alert("MDP actuel n'est pas correct !");
                }
                if (data == 'enter_mdp') {
                    alert("Please enter a pw.");
                }
                else {
                    console.log("data = " + data);
                }
            },
            'text'
        );
    });
});
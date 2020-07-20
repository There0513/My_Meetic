$(document).ready(function () {
    $("#login").submit(function (e) {
        e.preventDefault();
        $.post(
            'login.php',
            {
                username: $("#username").val(),
                password: $("#password").val()
            },
            function (data, status) {
                if (data == 'session_start') {
                    alert("Bienvenue " + username.value + 'session_start');
                    console.log(data, status);
                    location.href = 'mon_compte.php?mail=' + username.value;
                    return;
                    // header("location: mon_compte.php"); // Redirecting To Other Page
                }
                if (data == 'wrong_pw') {
                    $("#resultat").html("wrong password");
                }
                if (data == 'inactive') {
                    var activate = confirm("Account not active. You want to reactivate your account?");
                    if (activate == true) {
                        location.href = 'mon_compte.php?mail=' + username.value;
                    }
                    else {
                        $("#resultat").html("account not active");
                    }
                }
                else if (data == 'not_in_DB') {
                    $("#resultat").html("Not found in database");
                    console.log(data);
                }
                else if (data == 'mail+pw') {
                    $("#resultat").html("Please enter email + password.");
                    console.log(data);
                }
                else {
                    console.log("else-data = " + data + "status = " + status);
                }
            },
            'text'
        );
    });
});
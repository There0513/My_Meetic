$(document).ready(function () {
    $("#supprimer").click(function (e) {
        e.preventDefault();
        $.post(
            'buttons.php',
            {
                mail: $("#mail").val()
            },
            function (data, status) {
                if (data == 'done') {
                    alert('Votre compte est desactivé. A bientôt !');
                    location.href = 'index.php';
                    console.log(data, status);
                }
                else {
                    console.log("data = " + data);
                }
            },
            'text'
        );
    });
});
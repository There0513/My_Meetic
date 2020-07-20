function show_input() {
    $('.input').show();
    $('#save').show();
    $('.modif_mdp').show();
    $('#modifier').hide();
    $('.cancel').show();
}
function reload() {
    $('#save').on('click', function () {
        location.reload();
    })
}
function hide_container() {
    $('.container').hide();
    $('.container_2').show();
}
function logout() {
    alert("A bientôt");
}
function cancel() {
    $('.cancel').on('click', function () {
        location.reload();
    })
}
function messages() {
    alert("Transfer to chatbox...");
}
function next() {
    $('.slide1').hide();
    $('.slide2').show();
}
function prev() {
    $('.slide2').hide();
    $('.slide1').show();
}
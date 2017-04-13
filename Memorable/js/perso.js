/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    $('#datat').DataTable();

});

//permet de valider sa réponse lors d'un test grâce à la touche entrée
function validation(event) {
    if (event.keyCode == 13) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'index.php?page=valider');
        xhr.send(null);
        $('#form1').submit();
    }
    return false;
}

//permet à l'admin de promouvoir un test en page d'accueil après un clic
function promouvoir(id) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'index.php?page=promouvoir&id='+id);
    xhr.send(null);
}

//permet à l'admin de supprimer un test après un clic
function supprimer(id) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'index.php?page=supprimer&id='+id);
    xhr.send(null);
    window.location.reload();
}
$(document).ready(function() {

    var sestavine = "";


    $('#btnAdd').click(function () {
        if ($('#sestavine_ime')[0].checkValidity() && $('#sestavine_kol')[0].checkValidity()) {
            var ime = $('#sestavine_ime').val();
            var kolicina = $('#sestavine_kol').val();
            var enota = $('#sestavine_e').val();
            sestavine = sestavine + ime + ";;" + kolicina + ";;" + enota + ";;";
            $('#sest').attr("value", sestavine);
            $('#sestavinels').append("<li>" + " " +
            ime + " " +
            kolicina + " " +
            enota + "</li>");
        } else {
            $('#subbtn').click();
        }
    });
});
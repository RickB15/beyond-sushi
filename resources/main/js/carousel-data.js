$(document).ready(function () {

    // We gaan asynchroon data ophalen van een php pagina
    $.post("./data.php",
        {},
        function (data) {

            /* Plaats hier de code om de gegevens in de carousel te krijgen */


        },
        "json");
});
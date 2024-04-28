$(document).ready(function () {
    $("#searchForm").submit(function (event) {
        event.preventDefault();

        var searchValue = $("#searchInput").val();

        $.ajax({
            type: "POST",
            url: "eventa.php",
            data: { search: searchValue },
            dataType: "json", 
            success: function (data) {
                // La réponse de l'API est déjà un objet JSON, pas besoin de le parser
                displayResults(data); // Utilisez la fonction displayResults pour afficher les résultats
            },
            error: function (xhr, status, error) {
                console.error("Erreur AJAX:", xhr);
                console.error("Statut:", status);
                console.error("Erreur:", error);
            }
        });
    });

    function displayResults(results) {
        // Afficher les résultats dans la page (vous devrez adapter cette partie selon vos besoins)
        var resultsContainer = $("#searchResults");
        resultsContainer.empty(); // Efface les résultats précédents

        if (results.length > 0) {
            for (var i = 0; i < results.length; i++) {
                var row = results[i];
                var resultHtml = "<h1 class='alert alert-primary'>" + row['obj'] + " est en stock. <button class='btn btn-danger' id='btn-delete' data-id='" + row['ide'] + "'>Supprimer </button> <button class='btn btn-success' id='btn-update' data-id='" + row['ide'] + "' >Mettre à jour </button></h1>";
                resultsContainer.append(resultHtml);
            }
        } else {
            resultsContainer.append("<p>Aucun résultat trouvé.</p>");
        }
    }
});

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["search"])) {
    require_once('mo/event.php');
    require_once('c/eventC.php');

    $connection = mysqli_connect("localhost", "root", "", "ajax");

    $search = $_POST["search"];

    if (!empty($search)) {
        $event = new event($connection);
        $eventC = new eventC($eventC);

        $results = $eventC>searchEvent($search);

        // Convertir les résultats en JSON pour AJAX
        echo json_encode($results);
        exit;
    }
}
?>
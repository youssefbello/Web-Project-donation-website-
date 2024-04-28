<?php
include "../config.php";
include "../controller/publicationc.php";

$publicationC = new publicationC();
$tab = $publicationC->listepublications();

?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Publications</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        table {
            width: 100%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        h1, h2 {
            text-align: center;
        }

        a {
            text-decoration: none;
            color: #3498db;
        }

        a:hover {
            color: #1e70bf;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="../assets/js/dashboard-1.js"></script>
</head>
<center>
    <h1>List of publication</h1>
    <h2>
        <a href="add_pub.php">Add publication</a>
    </h2>
    <h2>
       <a href="searchcom.php">Afficher commentaire</a>
    </h2>
</center>
<table border="1" align="center" width="100%">
    <tr>
        <th>Id pub</th>
        <th>Image</th>
        <th>titre</th>
        <th>contenu</th>
        <th>detail</th>
        <th>date_pub</th>
        <th>auteur</th>
        <th>Update</th>
        <th>Delete</th>
    </tr>


    <?php
      foreach ($tab as $publication) {
    ?>
        <tr>
            <td><?= $publication['id']; ?></td>
            <td><?= $publication['img']; ?></td>
            <td><?= $publication['titre']; ?></td>
            <td><?= $publication['contenu']; ?></td>
            <td><?= $publication['detail']; ?></td>
            <td><?= $publication['date_pub']; ?></td>
            <td><?= $publication['auteur']; ?></td>
            <td align="center">
                <form method="POST" action="update_pub.php">
                    <input type="submit" name="update" value="Update">
                    <input type="hidden" value=<?PHP echo $publication['id']; ?> name="id">
                </form>
            </td>
            <td>
                <a href="delatepub.php?id=<?php echo $publication['id']; ?>">Delete</a>
            </td>
        </tr>
    <?php
    }
    ?>
</table>

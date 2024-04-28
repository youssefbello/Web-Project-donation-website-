<?php
include "../controller/sponsorC.php";

$c = new sponsorC();
$tab = $c->listsponsor();

?>
<style>
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f5f5f5;
        }

        a.update-button, a.delete-button {
            padding: 8px 12px;
            text-decoration: none;
            background-color: #4CAF50;
            color: white;
            border-radius: 4px;
            margin-right: 5px;
        }

        a.delete-button {
            background-color: #ff3333;
        }
        a.add-button {
        display: inline-block;
        padding: 10px 20px;
        text-decoration: none;
        background-color: #008CBA;
        color: white;
        border-radius: 4px;
        margin-top: 15px;
    }

    a.add-button:hover {
        background-color: #005A7F;
    }

    h1 {
        text-align: center;
    }
    </style>
<center>
    <h1>Sponsors list </h1>
    <h2>
        <a href="form1.php" class="add-button">Add </a>
    </h2>
</center>
<table border="1" align="center" width="70%">
    <tr>
        <th>id</th>
        <th>nom</th>
        <th>type</th>
        <th>ide</th>
        <th>delete</th> 
       
    </tr>


    <?php
    foreach ($tab as $sponsor) {
    ?>




        <tr>
            <td><?php echo $sponsor['ids']; ?></td>
            <td><?php echo $sponsor['noms']; ?></td>
            <td><?php echo $sponsor['typs']; ?></td>
            <td><?php echo $sponsor['ide']; ?></td>
            <td>
            <a href="deleteS.php?ids=<?= htmlspecialchars($sponsor["ids"]) ?>" class="delete-button">Delete</a>
             
            </td>
            
        </tr>
    <?php
    }
    ?>
</table>
<?php
include "../config.php";
include '../controller/publicationc.php';
include '../model/publication.php';
$error = "";

// create client
$publication = null;
// create an instance of the controller
$publicationC = new publicationc();


if (
    isset($_POST["img"]) &&
    isset($_POST["titre"]) &&
    isset($_POST["contenu"]) &&
    isset($_POST["detail"]) &&
    isset($_POST["date_pub"]) &&
    isset($_POST["auteur"])
) {
    if (
        !empty($_POST['img']) &&
        !empty($_POST['titre']) &&
        !empty($_POST["contenu"]) &&
        !empty($_POST["detail"]) &&
        !empty($_POST["date_pub"]) &&
        !empty($_POST["auteur"])
    ) {
        foreach ($_POST as $key => $value) {
            echo "Key: $key, Value: $value<br>";
        }
        $publication = new publication(
            null,
            $_POST['img'],
            $_POST['titre'],
            $_POST['contenu'],
            $_POST['detail'],
            $_POST['date_pub'],
            $_POST['auteur']
        );
        
        $publicationC->updatepublication($publication, $_POST['id']);

        header('Location:admin.php');
    } else
        $error = "Missing information";
}



?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Display</title>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('date_pub').addEventListener('input', function () {
                var inputDate = new Date(this.value);
                var currentDate = new Date();

                if (inputDate > currentDate) {
                    document.getElementById('erreurdate_pub').textContent = 'La date de publication ne peut pas être dans le futur.';
                    this.setCustomValidity('La date de publication ne peut pas être dans le futur.');
                } else {
                    document.getElementById('erreurdate_pub').textContent = '';
                    this.setCustomValidity('');
                }
            });
        });
    </script>
</head>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Display</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="date"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
        }

        input[type="submit"],
        input[type="reset"] {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: #45a049;
        }

        #error {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <button><a href="admin.php">Back to list</a></button>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php
    if (isset($_POST['id'])) {
        $publication = $publicationC->showpublication($_POST['id']);
        
    ?>

        <form action="" method="POST">
                <table>
                <tr>
                    <td><label for="id">idpub :</label></td>
                    <td>
                        <input type="text" id="id" name="id" value="<?php echo $_POST['id'] ?>" readonly />
                        <span id="erreurtitre" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                  <td><label for="img">Image :</label></td>
                  <td>
                    <input type="file" id="img" name="img" accept=" .jpg, .jpeg, .png"  value="<?php echo $publication['img'] ?>" />
                    <span id="erreurimg" style="color: red"></span>
                  </td>
                </tr>
                <tr>
                    <td><label for="titre">titre :</label></td>
                    <td>
                        <input type="text" id="titre" name="titre" value="<?php echo $publication['titre'] ?>" />
                        <span id="erreurtitre" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="contenu">contenu :</label></td>
                    <td>
                        <textarea id="contenu" name="contenu" ><?php echo $publication['contenu'] ?></textarea>
                        <span id="erreurcontenu" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="detail">Detail :</label></td>
                    <td>
                        <textarea id="detail" name="detail" ><?php echo $publication['detail'] ?></textarea>
                        <span id="erreurdetail" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="date_pub">date_pub :</label></td>
                    <td>
                        <input type="text" id="date_pub" name="date_pub" value="<?php echo $publication['date_pub'] ?>" />
                        <span id="erreurdate_pub" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="auteur">auteur :</label></td>
                    <td>
                        <input type="text" id="auteur" name="auteur" value="<?php echo $publication['auteur'] ?>" />
                        <span id="erreurauteur" style="color: red"></span>
                    </td>
                </tr>


                <td>
                    <input type="submit" value="Save">
                </td>
                <td>
                    <input type="reset" value="Reset">
                </td>
            </table>

        </form>
    <?php
    }
    ?>
</body>

</html>
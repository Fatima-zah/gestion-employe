<?php
    include "conexion.php";
    include "includes\header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <?php
        // Réecriture des variables
     if(isset($_REQUEST['Matricule'])) {
     $matricule = $_REQUEST['Matricule'];
     $sqlSelect = "SELECT * FROM employe WHERE Matricule = '$matricule' ";
     $result = $conn->query($sqlSelect);
     $row = $result -> fetch_array(MYSQLI_ASSOC);
     }
     if(isset($_POST['submit']))
     {
         $id = $_REQUEST['Matricule'];
         $nom = $_POST['nom'];
         $prenom = $_POST['prénom'];
         $dateN = $_POST['date_N'];
         $depa = $_POST['depar'];
         $salaire = $_POST['salaire'];
         $func = $_POST['fonction'];

         $fileName = $_FILES["uploadfile"]["name"];
         $tempName = $_FILES["uploadfile"]["tmp_name"];
         $folder = "photo/" . $fileName;
         
         // Requête de modification d'enregistrement
         $sql = "UPDATE employe
          SET Nom='$nom',Prénom='$prenom',Date_N='$dateN',Département='$depa',Salaire=$salaire,Fonction='$func', Photo='$fileName'
           WHERE Matricule='$matricule';";
          echo $sql;

         //   move the uploaded image into the folder: images
         if (move_uploaded_file($tempName, $folder))  {
             $msg = "Image uploaded successfully";
         }else{
             $msg = "Failed to upload image";
         } 

         if (mysqli_query($conn, $sql)) {
             echo "New record has been added successfully !";
         }
         else {
             echo "Error: " . $sql . ":-" . mysqli_error($conn);
         }
         mysqli_close($conn);

         header("location: index.php");

     }
     ?>

<div class="container mt-3">
        <h2>Modifier un Employé</h2>
        <form action="modifier.php?Matricule=<?php echo $matricule ?>" method ="POST" enctype="multipart/form-data">

            <div class="mb-3">
            <label >Nom:</label>
            <input type="text" class="form-control" id="nom" placeholder=" nom" name="nom" value="<?php echo $row["Nom"] ?>">
            </div>

            <div class="mb-3 mt-3">
            <label >Prénom:</label>
            <input type="text" class="form-control" id="prénom" placeholder=" prénom" name="prénom" value="<?php echo $row["Prénom"] ?>" >
            </div>

            <div class="mb-3">
            <label >Date de naissance:</label>
            <input type="date" class="form-control" id="date_N" placeholder=" date-de-naissance" name="date_N" value="<?php echo $row["Date_N"] ?>" >
            </div>

            <div class="mb-3 mt-3">
            <label >Département:</label>
            <input type="text" class="form-control" id="depar" placeholder="Enter département" name="depar" value="<?php echo $row["Département"] ?>" >
            </div>

            <div class="mb-3">
            <label >Salaire:</label>
            <input type="number" class="form-control" id="salaire" placeholder="Enter salaire" name="salaire" value="<?php echo $row["Salaire"] ?>" >
            </div>

            <div class="mb-3 mt-3">
            <label >Fonction:</label>
            <input type="text" class="form-control" id="fonction" placeholder="Enter fonction" name="fonction" value="<?php echo $row["Fonction"] ?>" >
            </div>

            <div class="mb-3 mt-3">
            <label >Photo:</label>
            <?php echo "<img src=photo/" . $row["Photo"] . ">"?>
            <input type="file" name="uploadfile" >
            </div>

            <button type="submit" value="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>

<?php include "includes/footer.php";?>

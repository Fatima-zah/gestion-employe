<?php
    include "nav.php"; 
    include "includes\header.php";
    if(isset($_POST['Submit'])){
    $matricule = $_POST['matricule'];
    $nom = $_POST['nom'];
    $prénom =$_POST['prénom'];
    $date =$_POST['Date_N'];
    $salaire =$_POST['salaire'];
    $fonction = $_POST['fonction'];
    $département = $_POST['département'];
    $fileName = $_FILES["uploadfile"]["name"];
    $tempName = $_FILES["uploadfile"]["tmp_name"];
    $folder = "photo/" . $fileName;

    $sql = "INSERT INTO employe (Matricule,Nom, Prénom, Date_N, Département, Salaire, Fonction ,Photo )
             VALUES ('$matricule', '$nom', '$prénom', '$date','$département', '$salaire', '$fonction' ,'$fileName' );";
           
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
        }
?>
  <body  style="background-color:#FBFFE2;>
   <div class="container">
       <div class="row" >
           <div class="col-md-6  mx-auto mt-4">
               <div class="card"  style="background-color:#FF9999;" >
                   <h3 class="card-title p-3 pt-2 px-3 text-center mb-0">Ajouter un employé</h3>
                  <div class="card-body"  >
                     <form action="add.php" method="post" enctype="multipart/form-data" >
                         <div class="form-group">
                             <label for="nom">Matricule*</label>
                            </div><br>
                            <input type="text" class="form-control" placeholder="Matricule" name="matricule" id="matricule" >
                         <div class="form-group">
                             <label for="nom">Nom*</label>
                             <input type="text" class="form-control" placeholder="Nom" name="nom" id="nom" >
                         </div><br>
                         <div class="form-group">
                             <label for="prénom">Prénom*</label>
                             <input type="text" class="form-control" placeholder="Prénom" name="prénom" id="prénom" >
                         </div><br>
                         <div class="form-group">
                             <label for="nom">Date de naissance*</label>
                             <input type="date" class="form-control"  name="Date_N" id="Date_N" >
                         </div><br>
                         <div class="form-group">
                             <label for="nom">Salaire*</label>
                             <input type="number" class="form-control" placeholder="Salaire" name="salaire" id="salaire" >
                         </div><br>
                         <div class="form-group">
                             <label for="nom">Fonction*</label>
                             <input type="text" class="form-control" placeholder="Fonction" name="fonction" id="fonction" >
                         </div><br>
                         <div class="form-group">
                             <label for="nom">Département*</label>
                             <input type="text" class="form-control" placeholder="Département" name="département" id="département" >
                         </div><br>
                         <div class="form-group">
                             <button type="Submit" class="btn btn-success" name="Submit">Valider</button>
                         </div><br>
                         <div class="form-group ">
                             <input type="file"  name="uploadfile">
                         </div>
                     <hr>
                  </div> 
               </div>
           </div>
       </div>
   </div>
   
   <?php include "includes/footer.php";?>
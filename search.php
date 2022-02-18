
<?php
include "conexion.php";
include "nav.php"; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Document</title>
    
</head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
#search{
    display: grid;
    grid-template-columns: auto auto auto;
    gap: 20px;
    padding: 20px;
}

</style>
</head>
<body>
<?php 

  if(isset($_POST['search'])){
    $search = $_POST['search'];
    
    $sql = "SELECT * FROM employe WHERE Nom LIKE '%$search%' OR Matricule LIKE '%$search%'   OR Département LIKE '%$search%'";
  } 
  else{
    $sql="SELECT * FROM employe";
    $search ="";
  }
  $result = mysqli_query($conn,$sql);

?>
<section>

<form  method="POST">
  <div>
    <input style="width: 20%; "  type="text" name="search"
     placeholder="search by matr/name/depar"  value="<?php echo $search;?>">
    <button>search</button>
    
  </div>
</form>


</section>
<table>
  <tr>
    <th>Matricule</th>
    <th>Nom</th>
    <th>Prénom</th>
    <th>Date de naissance</th>
    <th>Département</th>
    <th>Salaire</th>
    <th>Fonction</th> 
  </tr>
  <tbody>
  
    <?php  
     if($result){
      foreach($result as $row){
      echo '<tr>
      <td>'.$row['Matricule'].'</td>
        <td> '.$row['Nom']. '</td>
        <td>'.$row['Prénom'].'</td>
        <td>'.$row['Date_N'].'</td>
        <td>'.$row['Département'].'</td>
        <td>'.$row['Salaire'].'</td>
        <td>'.$row['Fonction'].'</td>
      </tr>';
    

  }}?> </tbody>
</table>
</body>
</html>
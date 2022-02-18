<?php
    include "includes\header.php"; 
    include "nav.php"; 
?>
  <body style="background-color:#FBFFE2;">
   <div class="container">
       <div class="row"  >
           <div class="col-md-12  mx-auto mt-4" style="background-color:#FF9999;">
               <div class="card"  >
                  <div class="card-body" >
                      <table class="table">
                          <thead>           
                              <tr>
                                  <th>Photo</th>
                                  <th>Matricule</th>
                                  <th>Nom</th>
                                  <th>Prénom</th>
                                  <th>Date de naissance</th>
                                  <th>Salaire</th>
                                  <th>Fonction</th>
                                  <th>Département</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                         
                                 
                          <?php 
                            if(isset($_GET['rn']))
                            {
                            $matricule = $_GET['rn'];
                            $query = "DELETE FROM employe WHERE Matricule='" . $matricule . "'";
                            $res = mysqli_query($conn, $query);
                            if($res) {
                           //  echo json_encode($res);
                            }
                             else {
                            echo "Error: " . $sql . "" . mysqli_error($conn);
                            }
                           }

                            $sql = "SELECT * FROM `employe`";
                            $result = mysqli_query($conn, $sql);
                            $resultCheck =mysqli_num_rows($result);

                            if($resultCheck >0){
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    // echo "<tr>";
                                    // echo $row["Nom"];
                                    // echo "</tr>"; 
                                    echo "<tr>";
                                    echo "<td><img src=photo/" . $row["Photo"] . "></td>";
                                    echo "<td>".$row["Matricule"]."</td>";
                                    echo "<td>".$row["Nom"]."</td>";
                                    echo "<td>".$row["Prénom"]."</td>";
                                    echo "<td>".$row["Date_N"]."</td>";
                                    echo "<td>".$row["Salaire"]."</td>";
                                    echo "<td>".$row["Fonction"]."</td>";
                                    echo "<td>".$row["Département"]."</td>";
                                    echo "<td> <a href='modifier.php?Matricule=$row[Matricule]'>✎</a></td>";
                                    echo "<td><a href='index.php?rn=$row[Matricule]' onClick=\"return confirm('confirmer lA supression !!')\">🗑️</a></td>";
                                    echo "</tr>";
                                       
                                  }
                                }
                      
                            ?>  
                      </table>
                  </div> 
               </div>
           </div>
       </div>
   </div>
   
   <?php include "includes/footer.php";?>
<?php
require('layout/header.html');
include("./db/connection.php");
session_start();

$session = $_SESSION['user'];

$user = $session['user'];
$role = $session['role'];

if(empty($user)){
  header('Location: auth.php');
}

$conn = new Connexion();
$db_connexion = $conn->getCONN();

$sql = "SELECT * FROM projects";
$result = $db_connexion->query($sql);


?> 



<div style="margin: 100px auto;border: 1px solid lightgray;" class="container p-3 container-fluid">

<div class="container">

<h2 class="text-left">back-office</h2>
<p><strong>current user :</strong> <?php echo $user; ?></p>
<p><strong>role :</strong> <?php echo '('.$role.')'; ?></p>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Description</th>
      <th scope="col">visibility</th>
      <th scope="col">completion period</th>
      <th scope="col">thumbnail</th>
      <th scope="col">project_link</th>
      <th scope="col">github_link</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
   
    <?php
    
    if ($result->num_rows > 0) {

        //adding data to data rray from database
        while($row = $result->fetch_assoc()) {
            
           echo '<tr>';
            echo '<th scope="row">'.$row["id"].'</th>';
            echo '<td>'.$row["description_projects"].'</dt>';
            echo '<td>'.$row["visibility"].'</dt>';
            echo '<td>'.$row["completion_period"].'</dt>';
            echo '<td><img style="width: 100px;" src="'.$row["thumbnail"].'" /></dt>';
            echo '<td><a href="'.$row["project_link"].'">project link </a></dt>';
            echo '<td><a href="'.$row["github_link"].'">project link </a></dt>';

             echo '<td style="display:flex">';
                echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'" ><i class="far fa-trash-alt"></i></a>';
                echo '<a class="btn btn-warning ml-3" href="edit.php?id='.$row['id'].'"><i class="far fa-edit"></i></a>';
             echo '</td>';
           echo '<tr>';
        }
    }
    
    ?>
  </tbody>
</table>

<form action="logout.php" method="post" >

    <button type="submit" class="btn btn-info">Logout</button>
</form>
</div>

<?php 
require('layout/footer.html');
?>
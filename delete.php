<?php 
require("layout/header.html");
include("./DB/connection.php");
$conn = new Connexion();
session_start();

$db_connexion = $conn->getCONN();

$deleteId = $_GET['id'];
$referrer = $_SERVER['HTTP_REFERER'];

$session = $_SESSION['user'];

$user = $session['user'];
$role = $session['role'];


if(isset($_GET['id']) && !empty($_GET['id']) && $session['role'] == 'admin') {
    
  $sql = "DELETE FROM projects WHERE id=".$deleteId;

  echo $sql;

  if ($db_connexion->query($sql) === TRUE) {
    
      header('Location:'.$referrer);
  }else {

      echo '<div class="alert alert-danger" role="alert">something went wronge</div>';
      header('Refresh: 10; '.$referrer.'');
  }

}else{

  echo "<div class='customAlert alert alert-danger' role='alert'>you don't have the required permission to delete</div>";

  header('Refresh: 5; '.$referrer.'');
}




?>
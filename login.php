<?php   
include('./DB/connection.php');

$conn = new Connexion();
$dbConnection = $conn->getCONN();


$email = @$_POST['email'];
$password = @$_POST['password'];


if(!empty($email) && !empty($password)) {


  //login 
  $hashed = md5($password);
  $result = $dbConnection->query('select * from users where email="'.$email.'" and password="'.$hashed.'"');
  if ($result->num_rows > 0) {

    session_start();
    $user = $result->fetch_assoc();

    $userName = $user["userName"];
    $role = $user["role"];
    
    echo $role;
    $_SESSION["user"] = array('user'=> $userName, 'role'=> $role);
    
    var_dump($_SESSION['user']);
    header('Location: admin.php');

  }else {
    echo 'something went wrong please try again later';
    
    //header('Location: admin.php');
  }

} else {

  echo 'all fields are requried !';
  //header('Location: admin.php');
}








?>
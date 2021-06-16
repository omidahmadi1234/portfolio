<?php
include("layout/header.html");
include("DB/connection.php");

session_start();
$session = $_SESSION['user'];

$user = $session['user'];
$role = $session['role'];



if($session['role'] != 'admin'){

echo '<div class="alert alert-danger" role="alert">
you don\'t have the required permission to edit
</div>';
header('Refresh: 3; admin.php');
die();

}
$conn = new Connexion();
$db_connexion = $conn->getCONN();
$modifyId = $_GET['id'];

$data = Array();
if($modifyId){

$sql = "SELECT * FROM projects where id=". $modifyId;
$result = $db_connexion->query($sql);
$data = $result->fetch_assoc();


}

$completion_period = '2021-05-13';
$description = "";
$visibility = 0;
$thumbnail = '';
$project_link = '';
$github_link = '';

if(isset($_POST['description_projects']) &&
isset($_POST['completion_period']) &&
isset($_POST['thumbnail']) &&
isset($_POST['project_link']) &&
isset($_POST['github_link'])

){

$completion_period = $_POST['completion_period'] ;
$description = $_POST['description_projects'];
$visibility = $_POST['visibility'];
$thumbnail = $_POST['thumbnail'];
$project_link = $_POST['project_link'];
$github_link = $_POST['github_link'];
}



if($completion_period && $description && $thumbnail && $project_link && $github_link){

$visibility = ($visibility == 'on')? 1: 0;
$visibility = intval($visibility);
$sql = "UPDATE projects SET github_link='$github_link', project_link='$project_link', completion_period='$completion_period', description_projects='$description', visibility='$visibility', thumbnail='$thumbnail' WHERE id=$modifyId";

if ($db_connexion->query($sql) === TRUE) {
echo '<div class="alert alert-success" role="alert">
recored updated successfully!
</div>';

header('Refresh: 3; admin.php');

} else {
echo '<div class="alert alert-danger" role="alert">
something went wronge
</div>';

echo $sql;
echo $db_connexion->error;

header('Refresh: 3; admin.php');
}
}


?>


<div class="custom_container cotnainer-fluid container mt-3">
<h2 class="h2">Modify Project</h2>
<form action="" method="post">
<div class="mb-3">
<label for="description_projects" class="form-label">Project Description</label>
<input type="text" name="description_projects" value="<?php echo $data['description_projects'];?>"class="form-control" id="description_projects">
</div>


<div class="mb-3">
<label for="completion_period" class="form-label">Completion Period</label>
<input type="date" name="completion_period" value="<?php echo $data['completion_period'];?>" class="form-control" id="completion_period">
</div>


<div class="mb-3">
<label for="visibility" class="form-label">Visibility</label>
<input type="checkbox" name="visibility" id="visibility" <?php echo ($data['visibility'] == '1')? 'checked': ''?>>
</div>


<div class="mb-3">
<label for="thumbnail" class="form-label">Thumbnail</label>
<input type="url" name="thumbnail" value="<?php echo $data['thumbnail'];?>" class="form-control" id="thumbnail">
</div>

<div class="mb-3">
<label for="project_link" class="form-label">Project Link</label>
<input type="url" name="project_link" value="<?php echo $data['project_link'];?>" class="form-control" id="project_link">
</div>


<div class="mb-3">
<label for="github_link" class="form-label">Github Link</label>
<input type="url" name="github_link" value="<?php echo $data['github_link'];?>" class="form-control" id="github_link">
</div>

<input type="hidden" name="id">
<button type="submit" class="btn btn-info">update</button>
</form>

</div>


<?php include("./layout/footer.html");?>
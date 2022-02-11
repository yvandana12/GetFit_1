<?php
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', 'Add Buyer');
define('PAGE', 'buyers');
include('./adminInclude/header.php'); 
include('../dbConnection.php');

 if(isset($_SESSION['is_admin_login'])){
  $adminEmail = $_SESSION['adminLogEmail'];
 } else {
  echo "<script> location.href='../index.php'; </script>";
 }
 if(isset($_REQUEST['newBuyerSubmitBtn'])){
  // Checking for Empty Fields
  if(($_REQUEST['buyer_name'] == "") || ($_REQUEST['buyer_email'] == "") || ($_REQUEST['buyer_pass'] == "") || ($_REQUEST['buyer_occ'] == "")){
   // msg displayed if required field missing
   $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
  } else {
   // Assigning User Values to Variable
   $buyer_name = $_REQUEST['buyer_name'];
   $buyer_email = $_REQUEST['buyer_email'];
   $buyer_pass = $_REQUEST['buyer_pass'];
   $buyer_occ = $_REQUEST['buyer_occ'];

    $sql = "INSERT INTO buyer (buyer_name, buyer_email, buyer_pass, buyer_occ) VALUES ('$buyer_name', '$buyer_email', '$buyer_pass', '$buyer_occ')";
    if($conn->query($sql) == TRUE){
     // below msg display on form submit success
     $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Buyer Added Successfully </div>';
    } else {
     // below msg display on form submit failed
     $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Add Buyer </div>';
    }
  }
  }
 ?>
<div class="col-sm-6 mt-5  mx-3 jumbotron">
  <h3 class="text-center">Add New Student</h3>
  <form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="buyer_name">Name</label>
      <input type="text" class="form-control" id="buyer_name" name="buyer_name">
    </div>
    <div class="form-group">
      <label for="buyer_email">Email</label>
      <input type="text" class="form-control" id="buyer_email" name="buyer_email">
    </div>
    <div class="form-group">
      <label for="buyer_pass">Password</label>
      <input type="text" class="form-control" id="buyer_pass" name="buyer_pass">
    </div>
    <div class="form-group">
      <label for="buyer_occ">Occupation</label>
      <input type="text" class="form-control" id="buyer_occ" name="buyer_occ">
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-danger" id="newBuyerSubmitBtn" name="newBuyerSubmitBtn">Submit</button>
      <a href="buyers.php" class="btn btn-secondary">Close</a>
    </div>
    <?php if(isset($msg)) {echo $msg; } ?>
  </form>
</div>
</div>  <!-- div Row close from header -->
</div>  <!-- div Conatiner-fluid close from header -->

<?php
include('./adminInclude/footer.php'); 
?>
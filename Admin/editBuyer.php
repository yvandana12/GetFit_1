<?php 
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', 'Edit Buyer');
define('PAGE', 'buyers');
include('./adminInclude/header.php'); 
include('../dbConnection.php');

 if(isset($_SESSION['is_admin_login'])){
  $adminEmail = $_SESSION['adminLogEmail'];
 } else {
  echo "<script> location.href='../index.php'; </script>";
 }
 // Update
 if(isset($_REQUEST['requpdate'])){
  // Checking for Empty Fields
  if(($_REQUEST['buyer_id'] == "") || ($_REQUEST['buyer_name'] == "") || ($_REQUEST['buyer_email'] == "") || ($_REQUEST['buyer_pass'] == "") || ($_REQUEST['buyer_occ'] == "")){
   // msg displayed if required field missing
   $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
  } else {
    // Assigning User Values to Variable
    $bid = $_REQUEST['buyer_id'];
    $bname = $_REQUEST['buyer_name'];
    $bemail = $_REQUEST['buyer_email'];
    $bpass = $_REQUEST['buyer_pass'];
    $bocc = $_REQUEST['buyer_occ'];
    
   $sql = "UPDATE buyer SET buyer_id = '$bid', buyer_name = '$bname', buyer_email = '$bemail', buyer_pass='$bpass', buyer_occ='$bocc' WHERE buyer_id = '$bid'";
    if($conn->query($sql) == TRUE){
     // below msg display on form submit success
     $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Updated Successfully </div>';
    } else {
     // below msg display on form submit failed
     $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Update </div>';
    }
  }
  }
 ?>
<div class="col-sm-6 mt-5  mx-3 jumbotron">
  <h3 class="text-center">Update Buyer Details</h3>
  <?php
 if(isset($_REQUEST['view'])){
  $sql = "SELECT * FROM buyer WHERE buyer_id = {$_REQUEST['id']}";
 $result = $conn->query($sql);
 $row = $result->fetch_assoc();
 }
 ?>
  <form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="buyer_id">ID</label>
      <input type="text" class="form-control" id="buyer_id" name="buyer_id" value="<?php if(isset($row['buyer_id'])) {echo $row['buyer_id']; }?>"readonly>
    </div>
    <div class="form-group">
      <label for="buyer_name">Name</label>
      <input type="text" class="form-control" id="buyer_name" name="buyer_name" value="<?php if(isset($row['buyer_name'])) {echo $row['buyer_name']; }?>">
    </div>

    <div class="form-group">
      <label for="buyer_email">Email</label>
      <input type="text" class="form-control" id="buyer_email" name="buyer_email" value="<?php if(isset($row['buyer_email'])) {echo $row['buyer_email']; }?>">
    </div>

    <div class="form-group">
      <label for="buyer_pass">Password</label>
      <input type="text" class="form-control" id="buyer_pass" name="buyer_pass" value="<?php if(isset($row['buyer_pass'])) {echo $row['buyer_pass']; }?>">
    </div>
    <div class="form-group">
      <label for="buyer_occ">Occupation</label>
      <input type="text" class="form-control" id="buyer_occ" name="buyer_occ" value="<?php if(isset($row['buyer_occ'])) {echo $row['buyer_occ']; }?>">
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-danger" id="requpdate" name="requpdate">Update</button>
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
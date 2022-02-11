<?php
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', 'Change Password');
define('PAGE', 'buyerChangePswd');
include('./buyerInclude/header.php'); 
include_once('../dbConnection.php');

 if(isset($_SESSION['is_login'])){
  $buyerEmail = $_SESSION['buyerLogEmail'];
 } else {
  echo "<script> location.href='../index.php'; </script>";
 }

 if(isset($_REQUEST['buyerPassUpdateBtn'])){
  if(($_REQUEST['buyerNewPass'] == "")){
   // msg displayed if required field missing
   $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
  } else {
    $sql = "SELECT * FROM buyer WHERE buyer_email='$buyerEmail'";
    $result = $conn->query($sql);
    if($result->num_rows == 1){
     $buyerPass = $_REQUEST['buyerNewPass'];
     $sql = "UPDATE buyer SET buyer_pass = '$buyerPass' WHERE buyer_email = '$buyerEmail'";
      if($conn->query($sql) == TRUE){
       // below msg display on form submit success
       $passmsg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Updated Successfully </div>';
      } else {
       // below msg display on form submit failed
       $passmsg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Update </div>';
      }
    }
   }
}

?>

<div class="col-sm-9 col-md-10">
  <div class="row">
    <div class="col-sm-6">
      <form class="mt-5 mx-5" method="POST">
        <div class="form-group">
          <label for="inputEmail">Email</label>
          <input type="email" class="form-control" id="inputEmail" value=" <?php echo $buyerEmail ?>" readonly>
        </div>
        <div class="form-group">
          <label for="inputnewpassword">New Password</label>
          <input type="password" class="form-control" id="inputnewpassword" placeholder="New Password" name="buyerNewPass">
        </div>
        <button type="submit" class="btn btn-primary mr-4 mt-4" name="buyerPassUpdateBtn">Update</button>
        <button type="reset" class="btn btn-secondary mt-4">Reset</button>
        <?php if(isset($passmsg)) {echo $passmsg; } ?>
      </form>

    </div>

  </div>
</div>

 </div> <!-- Close Row Div from header file -->

<?php
include('./buyerInclude/footer.php'); 
?>
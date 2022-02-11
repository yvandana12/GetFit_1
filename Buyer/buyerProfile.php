<?php
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', 'Buyer Profile');
define('PAGE', 'profile');
include('./buyerInclude/header.php'); 
include_once('../dbConnection.php');

 if(isset($_SESSION['is_login'])){
  $buyerEmail = $_SESSION['buyerLogEmail'];
 } else {
  echo "<script> location.href='../index.php'; </script>";
 }

 $sql = "SELECT * FROM buyer WHERE buyer_email='$buyerEmail'";
 $result = $conn->query($sql);
 if($result->num_rows == 1){
 $row = $result->fetch_assoc();
 $buyerId = $row["buyer_id"];
 $buyerName = $row["buyer_name"]; 
 $buyerOcc = $row["buyer_occ"];
 $buyerImg = $row["buyer_img"];

}

 if(isset($_REQUEST['updatebuyerNameBtn'])){
  if(($_REQUEST['buyerName'] == "")){
   // msg displayed if required field missing
   $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
  } else {
   $buyerName = $_REQUEST["buyerName"];
   $buyerOcc = $_REQUEST["buyerOcc"];
   $buyer_image = $_FILES['buyerImg']['name']; 
   $buyer_image_temp = $_FILES['buyerImg']['tmp_name'];
   $img_folder = '../image/buyer/'. $buyer_image; 
   move_uploaded_file($buyer_image_temp, $img_folder);
   $sql = "UPDATE buyer SET buyer_name = '$buyerName', buyer_occ = '$buyerOcc', buyer_img = '$img_folder' WHERE buyer_email = '$buyerEmail'";
   if($conn->query($sql) == TRUE){
   // below msg display on form submit success
   $passmsg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Updated Successfully </div>';
   } else {
   // below msg display on form submit failed
   $passmsg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Update </div>';
      }
    }
 }

?>
 <div class="col-sm-6 mt-5">
  <form class="mx-5" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="buyerId">buyer ID</label>
      <input type="text" class="form-control" id="buyerId" name="buyerId" value=" <?php if(isset($buyerId)) {echo $buyerId;} ?>" readonly>
    </div>
    <div class="form-group">
      <label for="buyerEmail">Email</label>
      <input type="email" class="form-control" id="buyerEmail" value=" <?php echo $buyerEmail ?>" readonly>
    </div>
    <div class="form-group">
      <label for="buyerName">Name</label>
      <input type="text" class="form-control" id="buyerName" name="buyerName" value=" <?php if(isset($buyerName)) {echo $buyerName;} ?>">
    </div>
    <div class="form-group">
      
      <label for="buyerOcc">Occupation</label>
      <input type="text" class="form-control" id="buyerOcc" name="buyerOcc" value=" <?php if(isset($buyerOcc)) {echo $buyerOcc;} ?>">
    </div>
    <div class="form-group">
      <label for="buyerImg">Upload Image</label>
      <input type="file" class="form-control-file" id="buyerImg" name="buyerImg">
    </div>
    <button type="submit" class="btn btn-primary" name="updatebuyerNameBtn">Update</button>
    <?php if(isset($passmsg)) {echo $passmsg; } ?>
  </form>
 </div>

 </div> <!-- Close Row Div from header file -->

 <?php
include('./buyerInclude/footer.php'); 
?>
<?php 
if(!isset($_SESSION)){ 
  session_start(); 
}
include_once('../dbConnection.php');

// setting header type to json, We'll be outputting a Json data
header('Content-type: application/json');

// Checking Email already Registered
if(isset($_POST['buyeremail']) && isset($_POST['checkemail'])){
  $stuemail = $_POST['buyeremail'];
  $sql = "SELECT buyer_email FROM buyer WHERE buyer_email='".$buyeremail."'";
  $result = $conn->query($sql);
  $row = $result->num_rows;
  echo json_encode($row);
  }
 
  // Inserting or Adding New Student
  if(isset($_POST['buyersignup']) && isset($_POST['buyername']) && isset($_POST['buyeremail']) && isset($_POST['buyerpass'])){
    $buyername = $_POST['buyername'];
    $buyeremail = $_POST['buyeremail'];
    $buyerpass = $_POST['buyerpass'];
    $sql = "INSERT INTO buyer(buyer_name, buyer_email, buyer_pass) VALUES ('$buyername', '$buyeremail', '$buyerpass')";
    if($conn->query($sql) == TRUE){
      echo json_encode("OK");
    } else {
      echo json_encode("Failed");
    }
  }

  // Student Login Verification
  if(!isset($_SESSION['is_login'])){
    if(isset($_POST['checkLogemail']) && isset($_POST['buyerLogEmail']) && isset($_POST['buyerLogPass'])){
      $stuLogEmail = $_POST['buyerLogEmail'];
      $stuLogPass = $_POST['buyerLogPass'];
      $sql = "SELECT buyer_email, buyer_pass FROM buyer WHERE buyer_email='".$buyerLogEmail."' AND buyer_pass='".$buyerLogPass."'";
      $result = $conn->query($sql);
      $row = $result->num_rows;
      
      if($row === 1){
        $_SESSION['is_login'] = true;
        $_SESSION['buyerLogEmail'] = $buyerLogEmail;
        echo json_encode($row);
      } else if($row === 0) {
        echo json_encode($row);
      }
    }
  }

?>
<?php 
  include('./dbConnection.php');
  // Header Include from mainInclude 
  include('./mainInclude/header.php'); 
?>
    <div class="container-fluid bg-dark"> <!-- Start Course Page Banner -->
      <div class="row">
        <img src="./image/coursebanner.jpg" alt="courses" style="height:300px; width:100%; object-fit:cover; box-shadow:10px;"/>
      </div> 
    </div> <!-- End Course Page Banner -->


    <div class="container jumbotron mb-5">
     <div class="row">
      <div class="col-md-4">    
        <h5 class="mb-3">If Already Registered !! Login</h5>
       <form role="form" id="buyerLoginForm">
         <div class="form-group">
           <i class="fas fa-envelope"></i><label for="buyerLogEmail" class="pl-2 font-weight-bold">Email</label><small id="statusLogMsg1"></small><input type="email"
               class="form-control" placeholder="Email" name="buyerLogEmail" id="buyerLogEmail">
           </div>
           <div class="form-group">
            <i class="fas fa-key"></i><label for="buyerLogPass" class="pl-2 font-weight-bold">Password</label><input type="password" class="form-control" placeholder="Password" name="buyerLogPass" id="buyerLogPass">
         </div>
         <button type="button" class="btn btn-primary" id="buyerLoginBtn" onclick="checkBuyerLogin()">Login</button>
       </form><br/>
       <small id="statusLogMsg"></small>
      </div>
      <div class="col-md-6 offset-md-1">
      <h5 class="mb-3">New User !! Sign Up</h5>
        <form role="form" id="buyerRegForm">
           <div class="form-group">
             <i class="fas fa-user"></i><label for="buyername" class="pl-2 font-weight-bold">Name</label><small id="statusMsg1"></small><input type="text"
               class="form-control" placeholder="Name" name="buyername" id="buyername">
           </div>
           <div class="form-group">
           <i class="fas fa-envelope"></i><label for="buyeremail" class="pl-2 font-weight-bold">Email</label><small id="statusMsg2"></small><input type="email"
               class="form-control" placeholder="Email" name="buyeremail" id="buyeremail">
             <small class="form-text">We'll never share your email with anyone else.</small>
           </div>
           <div class="form-group">
             <i class="fas fa-key"></i><label for="buyerpass" class="pl-2 font-weight-bold">New
               Password</label><small id="statusMsg3"></small><input type="password" class="form-control" placeholder="Password" name="buyerpass" id="buyerpass">
           </div>
           <button type="button" class="btn btn-primary" id="signup" onclick="addBuyer()">Sign Up</button>
        </form> <br/>
        <small id="successMsg"></small>
      </div>
     </div>
    </div>
    <hr/>

<?php 
// Contact Us
include('./contact.php'); 
?> 

<?php 
  // Footer Include from mainInclude 
  include('./mainInclude/footer.php'); 
?> 
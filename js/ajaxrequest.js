$(document).ready(function() {
  // Ajax Call for Already Exists Email Verification
  $("#buyeremail").on("keypress blur", function() {
    var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    var buyeremail = $("#buyeremail").val();
    $.ajax({
      url: "Buyer/addBuyer.php",
      type: "post",
      data: {
        checkemail: "checkmail",
        buyeremail: buyeremail
      },
      success: function(data) {
        console.log(data);
        if (data != 0) {
          $("#statusMsg2").html(
            '<small style="color:red;"> Email ID Already Registered ! </small>'
          );
          $("#signup").attr("disabled", true);
        } else if (data == 0 && reg.test(buyeremail)) {
          $("#statusMsg2").html(
            '<small style="color:green;"> There you go ! </small>'
          );
          $("#signup").attr("disabled", false);
        } else if (!reg.test(buyeremail)) {
          $("#statusMsg2").html(
            '<small style="color:red;"> Please Enter Valid Email e.g. example@mail.com </small>'
          );
          $("#signup").attr("disabled", false);
        }
        if (buyeremail == "") {
          $("#statusMsg2").html(
            '<small style="color:red;"> Please Enter Email ! </small>'
          );
        }
      }
    });
  });
  // Checking name on keypress
  $("#buyername").keypress(function() {
    var buyername = $("#buyername").val();
    if (buyername !== "") {
      $("#statusMsg1").html(" ");
    }
  });
  // Checking Password on keypress
  $("#buyerpass").keypress(function() {
    var buyerpass = $("#buyerpass").val();
    if (buyerpass !== "") {
      $("#statusMsg3").html(" ");
    }
  });
});

// Ajax Call for Adding New Student
function addStu() {
  var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
  var buyername = $("#buyername").val();
  var buyeremail = $("#buyeremail").val();
  var buyerpass = $("#buyerpass").val();
  // checking fields on form submission
  if (buyername.trim() == "") {
    $("#statusMsg1").html(
      '<small style="color:red;"> Please Enter Name ! </small>'
    );
    $("#buyername").focus();
    return false;
  } else if (buyeremail.trim() == "") {
    $("#statusMsg2").html(
      '<small style="color:red;"> Please Enter Email ! </small>'
    );
    $("#buyeremail").focus();
    return false;
  } else if (buyeremail.trim() != "" && !reg.test(buyeremail)) {
    $("#statusMsg2").html(
      '<small style="color:red;"> Please Enter Valid Email e.g. example@mail.com </small>'
    );
    $("#buyeremail").focus();
    return false;
  } else if (buyerpass.trim() == "") {
    $("#statusMsg3").html(
      '<small style="color:red;"> Please Enter Password ! </small>'
    );
    $("#buyerpass").focus();
    return false;
  } else {
    $.ajax({
      url: "Buyer/addBuyer.php",
      type: "post",
      data: {
        // assigned stusignup value just to check all iz well
        buyersignup: "buyersignup",
        buyername: buyername,
        buyeremail: buyeremail,
        buyerpass: buyerpass
      },
      success: function(data) {
        console.log(data);
        if (data == "OK") {
          $("#successMsg").html(
            '<span class="alert alert-success"> Registration Successful ! </span>'
          );
          // making field empty after signup
          clearBuyerRegField();
        } else if (data == "Failed") {
          $("#successMsg").html(
            '<span class="alert alert-danger"> Unable to Register ! </span>'
          );
        }
      }
    });
  }
}

// Empty All Fields and Status Msg
function clearBuyerRegField() {
  $("#buyerRegForm").trigger("reset");
  $("#statusMsg1").html(" ");
  $("#statusMsg2").html(" ");
  $("#statusMsg3").html(" ");
}

function clearAllBuyerReg() {
  $("#successMsg").html(" ");
  clearBuyerRegField();
}

// Ajax Call for Buyer Login Verification
function checkBuyerLogin() {
  var buyerLogEmail = $("#buyerLogEmail").val();
  var buyerLogPass = $("#buyerLogPass").val();
  $.ajax({
    url: "Buyer/addBuyer.php",
    type: "post",
    data: {
      checkLogemail: "checklogmail",
      buyerLogEmail: buyerLogEmail,
      buyerLogPass: buyerLogPass
    },
    success: function(data) {
      console.log(data);
      if (data == 0) {
        $("#statusLogMsg").html(
          '<small class="alert alert-danger"> Invalid Email ID or Password ! </small>'
        );
      } else if (data == 1) {
        $("#statusLogMsg").html(
          '<div class="spinner-border text-success" role="status"></div>'
        );
        // Empty Login Fields
        clearBuyerLoginField();
        setTimeout(() => {
          window.location.href = "index.php";
        }, 1000);
      }
    }
  });
}

// Empty Login Fields
function clearBuyerLoginField() {
  $("#buyerLoginForm").trigger("reset");
}

// Empty Login Fields and Status Msg
function clearBuyerLoginWithStatus() {
  $("#statusLogMsg").html(" ");
  clearBuyerLoginField();
}

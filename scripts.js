  $(document).ready(function () {
    $("#registerForm").on("submit", function (e) {
      e.preventDefault();

      $.ajax({
        url: "submit.php",
        method: "POST",
        data: $(this).serialize(),  
        dataType: "json",
        success: function (data) {
          if (data.status_code == 400) {
            $("#err_fullname").text("Please enter your full name");
            $("#err_email").text("Please enter your email");
            $("#err_password").text("Please enter your password");
            $("#err_mobile").text("Please enter your mobile number");
            $("#err_dob").text("Please enter your date of birth");
          } else if (data.status_code == 200) {
            $("#success").text("Successfully registered");
            var f_model = new bootstrap.Modal(
              document.getElementById("new_user")
            );
            f_model.show();
            $("#dashboard").on("click", function () {
              window.location.href = "dashboard.php";
            });
            $(".text-danger").text(" ");  
          } else if (data.status_code == 409) {
            $("#success").text("Already registered");
            var s_model = new bootstrap.Modal(
              document.getElementById("new_user")
            );
            
            $(".text-danger").text(" ");
          } else if (data.status_code == 500) {
            $("#success").text(data.error || "SQL error");
            var sq_model = new bootstrap.Modal(
              document.getElementById("new_user")
            );
            sq_model.show();

            $(".text-danger").text(" ");
          }
          $("#registerForm")[0].reset();
  
        },

        error: function (fail) {
          $("#success").text("Database Error");
          var sq_model = new bootstrap.Modal(document.getElementById("new_user"));
          sq_model.show();
          $(".text-danger").text(" ");
        },
      });

    });
  });



















































  // $(document).ready(function () {
  //     $("#registerForm").on("submit", function (e) {
  //       e.preventDefault();

  //       $.ajax({
  //         url: "submit.php",
  //         method: "POST",
  //         data: $(this).serialize(),
  //         dataType: "json",
  //           success: function (data) {

  //             console.log(data.status_code);

  //             if (data.status_code == 400) {
  //               $("#err_fullname").text("Please enter your full name");
  //               $("#err_email").text("Please enter your email");
  //               $("#err_password").text("Please enter your password");
  //               $("#err_mobile").text("Please enter your mobile number");
  //               $("#err_dob").text("Please enter your date of birth");
  //             } else if (data.status_code == 200) {
  //               $("#success").text("Successfully registered");
  //               var f_model = new bootstrap.Modal(
  //                 document.getElementById("new_user")
  //               );
  //               f_model.show();
  //               $(".text-danger").text(" ");
  //             }
  //             else (data.status_code == 409) {
  //               $("#success").text("already registered");
  //               var s_model = new bootstrap.Modal(
  //                 document.getElementById("new_user")
  //               );
  //               s_model.show();
  //               $(".text-danger").text(" ");
  //             }
  //             $("#registerForm")[0].reset();

  //         },

  //         error: function (fail) {
  //           $("#success").text("DataBase Error");
  //           var sq_model = new bootstrap.Modal(document.getElementById("new_user"));
  //           sq_model.show();
  //           $(".text-danger").text(" ");
  //         },
  //       });
  //     });
  //   });

  // console.log(data);
  // console.log(data.status_code);

  // if(data.status == false){

  //     if (data.error_var){
  //           $('#err_fullname').text(data.error_var.fullname);
  //           $('#err_email').text(data.error_var.email);
  //           $('#err_password').text(data.error_var.password);
  //           $('#err_mobile').text(data.error_var.mobile);
  //           $('#err_dob').text(data.error_var.dob);

  //     } else{
  //           $('#success').text(data.message);
  //           var f_model = new bootstrap.Modal(document.getElementById('new_user'));
  //           f_model.show();
  //           $('.text-danger').text('');
  //      }

  // } else{
  //           // console.log("true line",data.status)
  //           $('#success').text(data.message);
  //           var s_model = new bootstrap.Modal(document.getElementById('new_user'));
  //           s_model.show();

  // }
  // $('#registerForm')[0].reset();
  // // $('text-danger').text('');

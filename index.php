<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Registration Form</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #f0f2f5;
    }
    .form-box {
      max-width: 600px;
      margin: auto;
      background: #fff;
      padding: 30px;
      margin-top: 50px;
      border-radius: 15px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="form-box">
      <h3 class="text-center mb-4">Registration Form</h3>

      <form id="registerForm" >    
        <!-- Text -->
        <div class="mb-3">
          <label for="fullname" class="form-label">Full Name</label>
          <input type="text" class="form-control" id="fullname" name="fullname"  placeholder="Enter Full Name">
          <span id="err_fullname" class="text-danger"></span> 

        
        </div>
      
        <!-- Email -->
        <div class="mb-3">
          <label for="email" class="form-label">Email Address</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
          <span id="err_email" class="text-danger"></span> 
         
        </div>

        <!-- Password -->
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" >
          <span id="err_password" class="text-danger"></span> 
        </div>

        <!-- Mobile Number -->
        <div class="mb-3">
            <label for="mobile" class="form-label">Mobile Number</label>
            <input type="tel" class="form-control" id="mobile" name="mobile" pattern="[0-9]{10}"  placeholder="Enter 10-digit number" min="10">
             <span id="err_mobile" class="text-danger"></span> 
             
            <!-- <div class="form-text">Enter a 10-digit mobile number.</div> -->
        </div>


        <!-- Number -->
        <div class="mb-3">
          <label for="age" class="form-label">Age</label>
          <input type="number" class="form-control" id="age" name="age" placeholder="Enter Age">
          <span id="err_age" class="text-danger"></span> 


        <!-- Date -->   
        <div class="mb-3">
          <label for="dob" class="form-label">Date of Birth</label>
          <input type="date" class="form-control" id="dob" name="dob">
          <span id="err_dob" class="text-danger"></span> 
        </div>

        <!-- Radio Buttons -->
        <label class="form-label">Gender</label>
        <div class="mb-3">
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="gender" id="male" value="Male">
            <label class="form-check-label" for="male">Male</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="gender" id="female" value="Female">
            <label class="form-check-label" for="female">Female</label>
          </div>
          <span id="err_gender" class="text-danger"></span> 

        </div>


         <label class="form-label">Languages Known</label>
          <div class="mb-3">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="languages[]" id="lang1" value="English">
              <label class="form-check-label" for="lang1">English</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="languages[]" id="lang2" value="Tamil">
              <label class="form-check-label" for="lang2">Tamil</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="languages[]" id="lang3" value="Hindi">
              <label class="form-check-label" for="lang3">Hindi</label>
            </div>
            <span id="err_languages" class="text-danger"></span> 

          </div>

        <!-- Dropdown -->
        <div class="mb-3">
          <label for="city" class="form-label">Select City</label>
          <select class="form-select" name="city" id="city">
            <option value="">Select City</option>

            <option value="Chennai">Chennai</option>
            <option value="Bangalore">Bangalore</option>
            <option value="Hyderabad">Hyderabad</option>
          </select>
          <span id="err_city" class="text-danger"></span> 

        </div>

        <div class="mb-3">
          <label for="skills" class="form-label">Skills</label>
          <select class="form-select" name="skills[]" id="skills" multiple>
            <option value="HTML">HTML</option>
            <option value="CSS">CSS</option>
            <option value="PHP">PHP</option>
            <option value="JavaScript">JavaScript</option>
          </select>
          <span id="err_skills" class="text-danger"></span> 

        </div>

        <!-- Textarea -->
        <div class="mb-3">
          <label for="message" class="form-label">Message</label>
          <textarea class="form-control" name="message" id="message" rows="4"></textarea>
          <text id="err_message" class="text-danger"></text> 
        </div>  

        <div  class="d-flex justify-content-center">
          <button type="submit" class="btn btn-primary" name="submit" data-bs-toggle="modal" data-bs-target="#myModal">
           submit
          </button>
        </div>

    </div>
        <!-- <text class="praph"></text> -->
        <!-- <text id="response"></text>  -->

      </form>
    </div>
  </div>

<!-- new register -->   
  <div class="modal fade" id="new_user" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h5 class="modal-title">Registration</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body" id="success"> 
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="dashboard">Close</button>
        </div>

      </div>
    </div>
  </div>
  

</div>
</body>
<!-- Bootstrap JS Bundle (with Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="scripts.js"></script>
</html>

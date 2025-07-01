<?php
include 'db.php';

$id = $_GET['id'] ?? 0;

// Step 1: Fetch user details for the form
$stmt = $conn->prepare("SELECT * FROM reg_form WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
  die("User not found.");
}

$user = $result->fetch_assoc();
$selected_languages = explode(',', $user['languages'] ?? '');
$selected_skills = explode(',', $user['skills'] ?? '');

// Step 2: Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $fullname = $_POST['fullname'] ?? '';
  $email    = $_POST['email'] ?? '';
  $password = $_POST['password'] ?? '';
  $mobile   = $_POST['mobile'] ?? '';
  $age      = $_POST['age'] ?? '';
  $dob      = $_POST['dob'] ?? '';
  $gender   = $_POST['gender'] ?? '';
  $languages = isset($_POST['languages']) ? implode(',', $_POST['languages']) : '';
  $city     = $_POST['city'] ?? '';
  $skills   = isset($_POST['skills']) ? implode(',', $_POST['skills']) : '';
  $message  = $_POST['message'] ?? '';

  $update = $conn->prepare("UPDATE reg_form SET fullname=?, email=?, password=?, mobile_number=?, age=?, dob=?, gender=?, languages=?, city=?, skills=?, message=? WHERE id=?");
  $update->bind_param("ssssissssssi", $fullname, $email, $password, $mobile, $age, $dob, $gender, $languages, $city, $skills, $message, $id);

  if ($update->execute()) {
    echo json_encode(["status_code" => "200"]);
    exit;
  } else {
    echo json_encode(["status_code" => "500"]);
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Edit Form</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    .btn-secondary {
      left: 90px;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="form-box">
      <h3 class="text-center mb-4">Registration Form</h3>
      <form id="EditForm">
        <input type="hidden" name="id" value="<?= $user['id'] ?? '' ?>">

        <!-- Full Name -->
        <div class="mb-3">
          <label for="fullname" class="form-label">Full Name</label>
          <input type="text" class="form-control" id="fullname" name="fullname" value="<?= htmlspecialchars($user['fullname'] ?? '') ?>">
          <span id="err_fullname" class="text-danger"></span>
        </div>

        <!-- Email -->
        <div class="mb-3">
          <label for="email" class="form-label">Email Address</label>
          <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>">
          <span id="err_email" class="text-danger"></span>
        </div>

        <!-- Password -->
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" value="<?= htmlspecialchars($user['password'] ?? '') ?>">
          <span id="err_password" class="text-danger"></span>
        </div>

        <!-- Mobile Number -->
        <div class="mb-3">
          <label for="mobile" class="form-label">Mobile Number</label>
          <input type="tel" class="form-control" id="mobile" name="mobile" pattern="[0-9]{10}" value="<?= htmlspecialchars($user['mobile_number'] ?? '') ?>">
          <span id="err_mobile" class="text-danger"></span>
        </div>

        <!-- Age -->
        <div class="mb-3">
          <label for="age" class="form-label">Age</label>
          <input type="number" class="form-control" id="age" name="age" value="<?= htmlspecialchars($user['age'] ?? '') ?>">
          <span id="err_age" class="text-danger"></span>
        </div>

        <!-- Date of Birth -->
        <div class="mb-3">
          <label for="dob" class="form-label">Date of Birth</label>
          <input type="date" class="form-control" id="dob" name="dob" value="<?= htmlspecialchars($user['dob'] ?? '') ?>">
          <span id="err_dob" class="text-danger"></span>
        </div>

        <!-- Gender -->
        <div class="mb-3">
          <label class="form-label">Gender</label>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="gender" value="Male" <?= $user['gender'] == 'Male' ? 'checked' : '' ?>>
            <label class="form-check-label">Male</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="gender" value="Female" <?= $user['gender'] == 'Female' ? 'checked' : '' ?>>
            <label class="form-check-label">Female</label>
          </div>
          <span id="err_gender" class="text-danger"></span>
        </div>

        <!-- Languages -->
        <div class="mb-3">
          <label class="form-label">Languages Known</label>
          <?php
          $langs = ['English', 'Tamil', 'Hindi'];
          foreach ($langs as $lang):
          ?>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="languages[]" value="<?= $lang ?>" <?= in_array($lang, $selected_languages) ? 'checked' : '' ?>>
              <label class="form-check-label"><?= $lang ?></label>
            </div>
          <?php endforeach; ?>
          <span id="err_languages" class="text-danger"></span>
        </div>

        <!-- City -->
        <div class="mb-3">
          <label for="city" class="form-label">Select City</label>
          <select class="form-select" name="city" id="city">
            <option value="">Select City</option>
            <option value="Chennai" <?= $user['city'] == 'Chennai' ? 'selected' : '' ?>>Chennai</option>
            <option value="Bangalore" <?= $user['city'] == 'Bangalore' ? 'selected' : '' ?>>Bangalore</option>
            <option value="Hyderabad" <?= $user['city'] == 'Hyderabad' ? 'selected' : '' ?>>Hyderabad</option>
          </select>
          <span id="err_city" class="text-danger"></span>
        </div>

        <!-- Skills -->
        <div class="mb-3">
          <label for="skills" class="form-label">Skills</label>
          <select class="form-select" name="skills[]" id="skills" multiple>
            <?php foreach (['HTML', 'CSS', 'PHP', 'JavaScript'] as $skill): ?>
              <option value="<?= $skill ?>" <?= in_array($skill, $selected_skills) ? 'selected' : '' ?>><?= $skill ?></option>
            <?php endforeach; ?>
          </select>
          <span id="err_skills" class="text-danger"></span>
        </div>

        <!-- Message -->
        <div class="mb-3">
          <label for="message" class="form-label">Message</label>
          <textarea class="form-control" name="message" id="message" rows="4"><?= htmlspecialchars($user['message'] ?? '') ?></textarea>
          <span id="err_message" class="text-danger"></span>
        </div>

        <div class="d-flex justify-content-center">
          <button type="submit" class="btn btn-success" id="update">Update</button>
          <a href="dashboard.php" class="btn btn-secondary ms-2">Back</a>
        </div>

        <div class="modal fade" id="update_user" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                <h5 class="modal-title">updated</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

              <!-- Modal body -->
              <div class="modal-body" id="update_data">
              </div>

              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="dashboard">Close</button>
              </div>

            </div>
          </div>
        </div>

      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="edit_script.js"></script>
</body>

</html>
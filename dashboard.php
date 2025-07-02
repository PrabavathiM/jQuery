  <?php
  include 'db.php';

  $sql = "SELECT id,fullname, email, password,mobile_number,age ,dob, gender,languages ,city, skills,message FROM reg_form";
  $result = $conn->query($sql);

  if (isset($_POST['submit'])) {
    // filter email
    if (!empty($_POST["filterEmail"])) {
      $filterEmail = $_POST["filterEmail"];
      $sql = $conn->prepare("SELECT * FROM reg_form WHERE email=?");
      $sql->bind_param("s", $filterEmail);
      // print_r($sql); die();
      $sql->execute();
      // print_r($sql); die();
      $result = $sql->get_result();
      if ($result->num_rows > 0) {
        echo $result->num_rows;;
      } else {
        echo "No email found.";
        exit;
      }
      // filter mobile
    } elseif (!empty($_POST["filterMobile"])) {
      $filterMobile = $_POST["filterMobile"];
      if ($filterMobile) {
        $sql = $conn->prepare("SELECT * FROM reg_form WHERE mobile_number=?");
        $sql->bind_param("s", $filterMobile);
        $sql->execute();
        // print_r($sql); die();
        $result = $sql->get_result();
        if ($result->num_rows > 0) {
          echo $result->num_rows;;
        } else {
          echo "No mobile number found.";
          exit;
        }
      }
    }
    // filterDOB
    elseif (!empty($_POST["filterDOB"])) {

      $filterDOB = $_POST["filterDOB"];

      if ($filterDOB) {
        //  print_r($filterDOB); die();
        $sql = $conn->prepare("SELECT * FROM reg_form WHERE dob=?");
        $sql->bind_param("s", $filterDOB);
        $sql->execute();
        $result = $sql->get_result();
        // print_r($result); die();
        if ($result->num_rows > 0) {
          echo $result->num_rows;;
        } else {
          echo "No DOB found ";
          exit;
        }
      }
    }
  }
  ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>


    <link href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.3.2/css/dataTables.jqueryui.css" rel="stylesheet">

  </head>

  <body>
    <br>

    <form action="" method="POST">
      <input type="text" id="filterEmail" name="filterEmail" placeholder="Search by Email">
      <!-- <button type="submit" name="submitEmail">Search Email</button> -->
      <input type="text" id="filterMobile" name="filterMobile" placeholder="Search by Mobile">
      <!-- <button type="submit" name="submitMobile">Search Mobile</button> -->
      <input type="text" id="filterDOB" name="filterDOB" placeholder="Search by DOB (yyyy-mm-dd)">
      <button type="submit" name="submit">Search</button>
    </form>



    <br>
    <table class="table table-bordered table-striped" id="edit_user_data">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Full Name</th>
          <th>Email</th>
          <th>Password</th>
          <th>Mobile Number</th>
          <th>Age</th>
          <th>DOB</th>
          <th>Gender</th>
          <th>Languages</th>
          <th>City</th>
          <th>Skills</th>
          <th>Message</th>
          <th>Actions</th>
          <!-- <th>Actions</th> -->
        </tr>
      </thead>
      <tbody>
        <?php if ($result->num_rows > 0): ?>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= $row['id'] ?></td>
              <td><?= htmlspecialchars($row['fullname']) ?></td>
              <td><?= htmlspecialchars($row['email']) ?></td>
              <td><?= htmlspecialchars($row['password']) ?></td>
              <td><?= htmlspecialchars($row['mobile_number']) ?></td>
              <td><?= htmlspecialchars($row['age']) ?></td>
              <td><?= htmlspecialchars($row['dob']) ?></td>
              <td><?= htmlspecialchars($row['gender']) ?></td>
              <td><?= htmlspecialchars($row['languages']) ?></td>
              <td><?= htmlspecialchars($row['city']) ?></td>
              <td><?= htmlspecialchars($row['skills']) ?></td>
              <td><?= htmlspecialchars($row['message']) ?></td>

              <td>
                <button type="button" class="btn btn-primary editBtn" data-id="<?= $row['id'] ?>">Edit</button>
                <button type="button" class="btn btn-danger deleteBtn" data-id="<?= $row['id'] ?>">Delete</button>
              </td>

            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr>
            <td colspan="8">No users found.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.jqueryui.js"></script>
    <script src="dashboard_script.js"></script>
  </body>

  </html>
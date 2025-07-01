<?php

include 'db.php';


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // print_r($_POST);
    $errors = [];
    if (empty($_POST['fullname'])) {
        $errors['fullname'] = "Please enter your full name.";
    }
    if (empty($_POST['email'])) {
        $errors['email'] = "Please enter your email.";
    }
    if (empty($_POST['password'])) {
        $errors['password'] = "Please enter your password.";
    }
    if (empty($_POST['mobile'])) {
        $errors['mobile'] = "Please enter your mobile number.";
    }
    if (empty($_POST['dob'])) {
        $errors['dob'] = "Please enter your date of birth.";
    }

    if (!empty($errors)) {
        // http_response_code(400); // Bad request
        echo json_encode(["status_code" => "400"]);
        exit;
    }
    if (
        !empty($_POST['fullname']) &&
        !empty($_POST['email']) &&
        !empty($_POST['password']) &&
        !empty($_POST['mobile']) &&
        !empty($_POST['dob'])
    ) {
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $mobile = $_POST['mobile'];
        $dob = $_POST['dob'];

        $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
        $languages = isset($_POST['languages'])
            ? (is_array($_POST['languages']) ? implode(',', $_POST['languages']) : $_POST['languages'])
            : '';
        $city = isset($_POST['city']) ? $_POST['city'] : '';
        $skills = isset($_POST['skills'])
            ? (is_array($_POST['skills']) ? implode(',', $_POST['skills']) : $_POST['skills'])
            : '';
        $message = isset($_POST['message']) ? $_POST['message'] : '';


        $exist_data = $conn->prepare("SELECT id FROM reg_form WHERE email = ? AND mobile_number = ?");
        $exist_data->bind_param("ss", $email, $mobile);
        $exist_data->execute();
        $exist_data->store_result();
        if ($exist_data->num_rows > 0) {
            http_response_code(409);
            echo json_encode(["status_code" => "409"]);
            exit;
        } else {

            try {
              
                    $stmt = $conn->prepare("INSERT INTO reg_form (fullname, email, password, mobile_number, dob, gender, languages, city, skills, message) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("ssssssssss", $fullname, $email, $password, $mobile, $dob, $gender, $languages, $city, $skills, $message);
                    $stmt->execute();
                    echo json_encode(["status_code" => "200"]);
                    exit;
                
            } catch (Exception $e) {
                echo json_encode(["status_code" => "500"]);
                exit;
            }
        }
    }
}


// edit

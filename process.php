<?php
session_start();    
include("config.php");

// register button
if(isset($_POST["registerButton"])){

    $email = $_POST['email'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    $fname = $_POST['fname'];
    $mname = isset($_POST['mname']) ? $_POST['mname'] : '' ;
    $lname = $_POST['lname'];

    $check_email_query = "SELECT * FROM `user` WHERE `email` = '$email'";
    $email_result = mysqli_query($con,$check_email_query);
    $email_count = mysqli_fetch_array($email_result)[0];

    if($email_count > 0){
        $_SESSION['status'] = "Email address already taken";
        $_SESSION['status_code'] = "error";
        header("Location: register.php");
        exit();
    }

    if ($password !== $repassword){
        $_SESSION['status'] = "Password does not match";
        $_SESSION['status_code'] = "error";
        header("Location: register.php");
        exit();
    }


    $query = "INSERT INTO `user`(`email`, `password`, `fname`, `mname`, `lname`) VALUES ('$email','$password','$fname','$mname','$lname')";
    $query_result = mysqli_query( $con, $query );

    if($query_result){
        $_SESSION['status'] = "Registration Sucess!";
        $_SESSION['status_code'] = "success";
        header("Location: login.php");
        exit();
    }
}

// Login Button
if(isset($_POST["loginButton"])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $login_query = "SELECT `id`, `email`, `password`, `fname`, `mname`, `lname` FROM `user` WHERE `email` = '$email' AND `password` = '$password' LIMIT 1 ";
    $login_result = mysqli_query($con, $login_query);

    if(mysqli_num_rows($login_result) == 1){
            $_SESSION['status'] = "Welcome!";
            $_SESSION['status_code'] = "success";
            header("Location: index.php");
            exit();
    }else{
        $_SESSION['status'] = "Invalid Username/Password";
        $_SESSION['status_code'] = "error";
        header("Location: login.php");
        exit();
    }
}

// Insert Button
if(isset($_POST["insertButton"])){
    $student_number = $_POST['student_number'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $date_of_birth = $_POST['date_of_birth'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];

    $query = "INSERT INTO `student_info`(`student_number`,`fname`,`mname`,`lname`,`date_of_birth`,`email`,`phone_number`,`address`) VALUES ('$student_number','$fname','$mname','$lname','$date_of_birth','$email','$phone_number','$address')";
    $query_result = mysqli_query( $con, $query );

    if($query_result){
        $_SESSION['status'] = "Student info added successfully!";
        $_SESSION['status_code'] = "success";
        header("Location: index.php");
        exit();
    }
}


// View Button
if(isset($_POST["viewButton"])){
    $student_number = $_POST['student_number'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $date_of_birth = $_POST['date_of_birth'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];

    $query = "SELECT * FROM `student_info` WHERE `student_number`='$student_number', `fname`='$fname', `mname`='$mname', `lname`='$lname', `date_of_birth`='$date_of_birth', `email`='$email', `phone_number`='$phone_number', `address`='$address'";
    $query_result = mysqli_query( $con, $query );

}


// Update Button
if(isset($_POST["updateButton"])){
    $id = $_POST['id'];
    $student_number = $_POST['student_number'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $date_of_birth = $_POST['date_of_birth'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];

    $query = "UPDATE `student_info` SET `student_number`='$student_number',`fname`='$fname',`mname`='$mname',`lname`='$lname',`date_of_birth`='$date_of_birth',`email`='$email',`phone_number`='$phone_number',`address`='$address' WHERE `id`='$id'";
    $query_result = mysqli_query( $con, $query );

    if($query_result){
        $_SESSION['status'] = "Student info updated successfully!";
        $_SESSION['status_code'] = "success";
        header("Location: index.php");
        exit();
    }
}

// Delete Button
if(isset($_POST["deleteButton"])){
    $id = $_POST['id'];

    $query = "DELETE FROM `student_info` WHERE `id`='$id'";
    $query_result = mysqli_query( $con, $query );

    if($query_result){
        $_SESSION['status'] = "Student info deleted successfully!";
        $_SESSION['status_code'] = "success";
        header("Location: index.php");
        exit();
    }
}

?>
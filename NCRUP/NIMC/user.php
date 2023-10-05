<?php 
include 'connect.php';

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $maritalStatus = $_POST['maritalStatus'];
    $employmentDetails = $_POST['employmentDetails'];
    $nin = $_POST['nin'];
    $ucrNumber = $_POST['ucrNumber'];
    $citizenshipStatus = $_POST['citizenshipStatus'];

    $sql = "INSERT INTO `nimc_db` (`name`, `address`, `phoneNumber`, `email`, `dateOfBirth`, `gender`, `maritalStatus`, `employmentDetails`, `nin`, `ucrNumber`, `citizenshipStatus`) 
    VALUES ('$name', '$address', '$phone', '$email', '$dob', '$gender', '$maritalStatus', '$employmentDetails', '$nin', '$ucrNumber', '$citizenshipStatus')";
    $result = mysqli_query($connection, $sql);

    if($result){
        header('location:display.php');
    }
    else{
        die("Connection Failed: ". mysqli_error($connection));
    }
}

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>NIMC</title>
  </head>
  <body>
    <div class="container">
        <div class="my-5 col-8 center">
        <form method="post"> 
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter your name" autocomplete="off">
        </div>
        <div class="mb-3">
            <label class="form-label">Address</label>
            <input type="text" name="address" class="form-control" placeholder="Enter your address" autocomplete="off">
        </div>
        <div class="mb-3">
            <label class="form-label">Mobile</label>
            <input type="text" name="phone" class="form-control" placeholder="Enter your mobile number" autocomplete="off">
        </div>
        <div class="mb-3">
            <label class="form-label">Email address</label>
            <input type="email" class="form-control" name="email" id="exampleInputEmail1" autocomplete="off">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label class="form-label">Date of birth</label>
            <input type="date" name="dob" class="form-control" autocomplete="off">
        </div>
        <div class="mb-3">
            Gender:  
            <input type="radio" name="gender" class="form-check-input" value="male">
            <label class="form-check-label">Male</label>
            <input type="radio" name="gender" class="form-check-input" value="female">
            <label class="form-check-label">Female</label>
        </div>
        <div class="mb-3">
            <label class="form-label">Marital Status</label>
            <input type="text" name="maritalStatus" class="form-control" placeholder="Enter your marital status" autocomplete="off">
        </div>
        <div class="mb-3">
            <label class="form-label">Employment Details</label>
            <input type="text" name="employmentDetails" class="form-control" placeholder="Enter your employment details" autocomplete="off">
        </div>
        <div class="mb-3">
            <label class="form-label">NIN (National Identification Number)</label>
            <input type="text" name="nin" class="form-control" placeholder="Enter your NIN" autocomplete="off">
        </div>
        <div class="mb-3">
            <label class="form-label">UCR Number (Unique Citizen Record Number)</label>
            <input type="text" name="ucrNumber" class="form-control" placeholder="Enter your UCR number" autocomplete="off">
        </div>
        <div class="mb-3">
            <label class="form-label">Citizenship Status</label>
            <input type="text" name="citizenshipStatus" class="form-control" placeholder="Enter your citizenship status" autocomplete="off">
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>

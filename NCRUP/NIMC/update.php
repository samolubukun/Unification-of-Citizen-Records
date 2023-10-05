<?php 
include 'connect.php';
$id = $_GET['updateid'];
$sql = "SELECT * FROM `nimc_db` WHERE id = $id";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($result);
$name = $row['name'];
$address = $row['address'];
$phone = $row['phoneNumber'];
$email = $row['email'];
$dob = $row['dateOfBirth'];
$gender = $row['gender'];
$nationality = $row['nationality'];
$citizenshipStatus = $row['citizenshipStatus'];
$maritalStatus = $row['maritalStatus'];
$employmentDetails = $row['employmentDetails'];

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $nationality = $_POST['nationality'];
    $citizenshipStatus = $row['citizenshipStatus'];
    $maritalStatus = $_POST['maritalStatus'];
    $employmentDetails = $_POST['employmentDetails'];

    $sql = "UPDATE `nimc_db` SET id = '$id', name = '$name', address = '$address', phoneNumber = '$phone',
    email = '$email', dateOfBirth = '$dob', gender = '$gender', nationality = '$nationality',
    maritalStatus = '$maritalStatus', employmentDetails = '$employmentDetails' WHERE id = '$id' ";
    $result = mysqli_query($connection, $sql);
    if($result){
        // echo "Updated successfully";
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
            <input type="text" name="name" class="form-control" placeholder="Enter your name" autocomplete="off" value="<?php echo $name; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Address</label>
            <input type="text" name="address" class="form-control" placeholder="Enter your address" autocomplete="off" value="<?php echo $address; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Mobile</label>
            <input type="text" name="phone" class="form-control" placeholder="Enter your mobile number" autocomplete="off" value="<?php echo $phone; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Email address</label>
            <input type="email" class="form-control" name="email" id="exampleInputEmail1" autocomplete="off" value="<?php echo $email; ?>">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label class="form-label">Date of birth</label>
            <input type="date" name="dob" class="form-control" autocomplete="off" value="<?php echo $dob; ?>">
        </div>
        Gender:  
            <input type="radio" name="gender" class="form-check-input" value="Male">
            <label class="form-check-label">Male</label>
            <input type="radio" name="gender" class="form-check-input" value="Female">
            <label class="form-check-label">Female</label>
        </div>
        <div class="mb-3">
            <label class="form-label">Nationality</label>
            <input type="text" name="nationality" class="form-control" placeholder="Enter your nationality" autocomplete="off" value="<?php echo $nationality; ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">  Citizenship Status</label>
            <input type="text" name="" class="form-control" placeholder="Enter your citizenship status" autocomplete="off" value="<?php echo $citizenshipStatus; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Marital Status</label>
            <input type="text" name="maritalStatus" class="form-control" placeholder="Enter your marital status" autocomplete="off" value="<?php echo $maritalStatus; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Employment Details</label>
            <input type="text" name="employmentDetails" class="form-control" placeholder="Enter your employment details" autocomplete="off" value="<?php echo $employmentDetails; ?>">
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Update</button>
    </form>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>

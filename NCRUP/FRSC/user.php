<?php
include 'connect.php';

if(isset($_POST['submit'])){
    $ucrNumber = $_POST['ucrNumber'];
    $licenseNumber = $_POST['licenseNumber'];
    $validity = $_POST['validity'];
    $restrictions = $_POST['restrictions'];
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $ownerName = $_POST['ownerName'];
    $vehicleIdentificationNumber = $_POST['vehicleIdentificationNumber'];
    $licensePlate = $_POST['licensePlate'];
    $violationDetails = $_POST['violationDetails'];
    $accidentDetails = $_POST['accidentDetails'];
    $penalties = $_POST['penalties'];

    $sql = "INSERT INTO `frsc_db` (`ucrNumber`, `license_number`, `validity`, `restrictions`, `gender`, `owner_name`, `vehicle_identification_number`, `license_plate`, `violation_details`, `accident_details`, `penalties`) 
    VALUES ('$ucrNumber', '$licenseNumber', '$validity', '$restrictions', '$gender', '$ownerName', '$vehicleIdentificationNumber', '$licensePlate', '$violationDetails', '$accidentDetails', '$penalties')";
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
    <title>FRSC </title>
</head>
<body>
<div class="container">
    <div class="my-5 col-8 center">
        <form method="post">
            <div class="mb-3">
                <label class="form-label">UCR Number</label>
                <input type="text" name="ucrNumber" class="form-control" placeholder="Enter UCR number" autocomplete="off">
            </div>
            <div class="mb-3">
                <label class="form-label">License Number</label>
                <input type="text" name="licenseNumber" class="form-control" placeholder="Enter license number" autocomplete="off">
            </div>
            <div class="mb-3">
                <label class="form-label">Validity</label>
                <input type="date" name="validity" class="form-control" autocomplete="off">
            </div>
            <div class="mb-3">
                <label class="form-label">Restrictions</label>
                <input type="text" name="restrictions" class="form-control" placeholder="Enter restrictions" autocomplete="off">
            </div>
            <div class="mb-3">
            Gender:  
            <input type="radio" name="gender" class="form-check-input" value="male">
            <label class="form-check-label">Male</label>
            <input type="radio" name="gender" class="form-check-input" value="female">
            <label class="form-check-label">Female</label>
        </div>
            <div class="mb-3">
                <label class="form-label">Owner Name</label>
                <input type="text" name="ownerName" class="form-control" placeholder="Enter owner name" autocomplete="off">
            </div>
            <div class="mb-3">
                <label class="form-label">Vehicle Identification Number</label>
                <input type="text" name="vehicleIdentificationNumber" class="form-control" placeholder="Enter vehicle identification number" autocomplete="off">
            </div>
            <div class="mb-3">
                <label class="form-label">License Plate</label>
                <input type="text" name="licensePlate" class="form-control" placeholder="Enter license plate" autocomplete="off">
            </div>
            <div class="mb-3">
                <label class="form-label">Violation Details</label>
                <input type="text" name="violationDetails" class="form-control" placeholder="Enter violation details" autocomplete="off">
            </div>
            <div class="mb-3">
                <label class="form-label">Accident Details</label>
                <input type="text" name="accidentDetails" class="form-control" placeholder="Enter accident details" autocomplete="off">
            </div>
            <div class="mb-3">
                <label class="form-label">Penalties</label>
                <input type="text" name="penalties" class="form-control" placeholder="Enter penalties" autocomplete="off">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>

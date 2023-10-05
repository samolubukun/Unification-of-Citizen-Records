<?php 
include 'connect.php';
$id = $_GET['updateid'];
$sql = "SELECT * FROM `frsc_db` WHERE id = $id";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($result);
$ucrNumber = $row['ucrNumber'];
$licenseNumber = $row['license_number'];
$validity = $row['validity'];
$restrictions = $row['restrictions'];
$gender = $row['gender'];
$ownerName = $row['owner_name'];
$vehicleIdentificationNumber = $row['vehicle_identification_number'];
$licensePlate = $row['license_plate'];
$violationDetails = $row['violation_details'];
$accidentDetails = $row['accident_details'];
$penalties = $row['penalties'];

if(isset($_POST['submit'])){
    $licenseNumber = $_POST['licenseNumber'];
    $validity = $_POST['validity'];
    $restrictions = $_POST['restrictions'];
    $gender = $_POST['gender'];
    $ownerName = $_POST['ownerName'];
    $vehicleIdentificationNumber = $_POST['vehicleIdentificationNumber'];
    $licensePlate = $_POST['licensePlate'];
    $violationDetails = $_POST['violationDetails'];
    $accidentDetails = $_POST['accidentDetails'];
    $penalties = $_POST['penalties'];

    $sql = "UPDATE `frsc_db`SET id = '$id', license_number = '$licenseNumber', validity = '$validity', 
    restrictions = '$restrictions', gender = '$gender', owner_name = '$ownerName', vehicle_identification_number = '$vehicleIdentificationNumber',
    license_plate = '$licensePlate', violation_details = '$violationDetails', accident_details = '$accidentDetails',
    penalties = '$penalties' WHERE id = '$id' ";
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
    <title>FRSC</title>
  </head>
  <body>
    <div class="container">
        <div class="my-5 col-8 center">
        <form method="post"> 
        <div class="mb-3">
            <label class="form-label">License Number</label>
            <input type="text" name="licenseNumber" class="form-control" placeholder="Enter license number" autocomplete="off" value="<?php echo $licenseNumber; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Validity</label>
            <input type="date" name="validity" class="form-control" autocomplete="off" value="<?php echo $validity; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Restrictions</label>
            <input type="text" name="restrictions" class="form-control" placeholder="Enter restrictions" autocomplete="off" value="<?php echo $restrictions; ?>">
        </div>
        Gender:  
            <input type="radio" name="gender" class="form-check-input" value="Male">
            <label class="form-check-label">Male</label>
            <input type="radio" name="gender" class="form-check-input" value="Female">
            <label class="form-check-label">Female</label>
        </div>
        <div class="mb-3">
            <label class="form-label">Owner Name</label>
            <input type="text" name="ownerName" class="form-control" placeholder="Enter owner name" autocomplete="off" value="<?php echo $ownerName; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Vehicle Identification Number</label>
            <input type="text" name="vehicleIdentificationNumber" class="form-control" placeholder="Enter vehicle identification number" autocomplete="off" value="<?php echo $vehicleIdentificationNumber; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">License Plate</label>
            <input type="text" name="licensePlate" class="form-control" placeholder="Enter license plate" autocomplete="off" value="<?php echo $licensePlate; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Violation Details</label>
            <input type="text" name="violationDetails" class="form-control" placeholder="Enter violation details" autocomplete="off" value="<?php echo $violationDetails; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Accident Details</label>
            <input type="text" name="accidentDetails" class="form-control" placeholder="Enter accident details" autocomplete="off" value="<?php echo $accidentDetails; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Penalties</label>
            <input type="text" name="penalties" class="form-control" placeholder="Enter penalties" autocomplete="off" value="<?php echo $penalties; ?>">
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Update</button>
    </form>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>

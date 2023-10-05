<?php 
include 'connect.php';
$id = $_GET['updateid'];
$sql = "SELECT * FROM `immigration_db` WHERE id = $id";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($result);
$ucrNumber = $row['ucrNumber'];
$passportNumber = $row['passportNumber'];
$passportIssueDate = $row['passportIssueDate'];
$passportExpiryDate = $row['passportExpiryDate'];
$visaInformation = $row['visaInformation'];
$travelHistory = $row['travelHistory'];
$name = $row['name'];
$gender = $row['gender'];
$dateOfBirth = $row['dateOfBirth'];
$nationality = $row['nationality'];
$photograph = $row['photograph'];
$fingerprints = $row['fingerprints'];
$entryExitStamps = $row['entryExitStamps'];
$permits = $row['permits'];
$permanentResidencyInfo = $row['permanentResidencyInfo'];

if(isset($_POST['submit'])){
    $passportNumber = $_POST['passportNumber'];
    $passportIssueDate = $_POST['passportIssueDate'];
    $passportExpiryDate = $_POST['passportExpiryDate'];
    $visaInformation = $_POST['visaInformation'];
    $travelHistory = $_POST['travelHistory'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $nationality = $_POST['nationality'];
    $photograph = $_POST['photograph'];
    $fingerprints = $_POST['fingerprints'];
    $entryExitStamps = $_POST['entryExitStamps'];
    $permits = $_POST['permits'];
    $permanentResidencyInfo = $_POST['permanentResidencyInfo'];

    $sql = "UPDATE `immigration_db` SET passportNumber = '$passportNumber', passportIssueDate = '$passportIssueDate', passportExpiryDate = '$passportExpiryDate', visaInformation = '$visaInformation', travelHistory = '$travelHistory', name = '$name',  gender = '$gender', dateOfBirth = '$dateOfBirth', nationality = '$nationality', photograph = '$photograph', fingerprints = '$fingerprints', entryExitStamps = '$entryExitStamps', permits = '$permits', permanentResidencyInfo = '$permanentResidencyInfo' WHERE id = '$id'";
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
    <title>Immigration</title>
  </head>
  <body>
    <div class="container">
        <div class="my-5 col-8 center">
        <form method="post"> 
        <div class="mb-3">
            <label class="form-label">Passport Number</label>
            <input type="text" name="passportNumber" class="form-control" placeholder="Enter passport number" autocomplete="off" value="<?php echo $passportNumber; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Passport Issue Date</label>
            <input type="date" name="passportIssueDate" class="form-control" autocomplete="off" value="<?php echo $passportIssueDate; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Passport Expiry Date</label>
            <input type="date" name="passportExpiryDate" class="form-control" autocomplete="off" value="<?php echo $passportExpiryDate; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Visa Information</label>
            <input type="text" name="visaInformation" class="form-control" placeholder="Enter visa information" autocomplete="off" value="<?php echo $visaInformation; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Travel History</label>
            <input type="text" name="travelHistory" class="form-control" placeholder="Enter travel history" autocomplete="off" value="<?php echo $travelHistory; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" name="fullName" class="form-control" placeholder="Enter full name" autocomplete="off" value="<?php echo $name; ?>">
        </div>
        Gender:  
            <input type="radio" name="gender" class="form-check-input" value="Male">
            <label class="form-check-label">Male</label>
            <input type="radio" name="gender" class="form-check-input" value="Female">
            <label class="form-check-label">Female</label>
        </div>
        <div class="mb-3">
            <label class="form-label">Date of Birth</label>
            <input type="date" name="dateOfBirth" class="form-control" autocomplete="off" value="<?php echo $dateOfBirth; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Nationality</label>
            <input type="text" name="nationality" class="form-control" placeholder="Enter nationality" autocomplete="off" value="<?php echo $nationality; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Photograph</label>
            <input type="text" name="photograph" class="form-control" placeholder="Enter photograph" autocomplete="off" value="<?php echo $photograph; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Fingerprints</label>
            <input type="text" name="fingerprints" class="form-control" placeholder="Enter fingerprints" autocomplete="off" value="<?php echo $fingerprints; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Entry/Exit Stamps</label>
            <input type="text" name="entryExitStamps" class="form-control" placeholder="Enter entry/exit stamps" autocomplete="off" value="<?php echo $entryExitStamps; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Permits</label>
            <input type="text" name="permits" class="form-control" placeholder="Enter permits" autocomplete="off" value="<?php echo $permits; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Permanent Residency Info</label>
            <input type="text" name="permanentResidencyInfo" class="form-control" placeholder="Enter permanent residency info" autocomplete="off" value="<?php echo $permanentResidencyInfo; ?>">
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Update</button>
    </form>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>

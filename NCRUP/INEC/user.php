<?php
include 'connect.php';

if(isset($_POST['submit'])){
    $ucrNumber = $_POST['ucrNumber'];
    $voterRegistrationInfo = $_POST['voterRegistrationInfo'];
    $voterIdentificationNumber = $_POST['voterIdentificationNumber'];
    $name = $_POST['name'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $gender = $_POST['gender'];
    $nationality = $_POST['nationality'];
    $address = $_POST['address'];
    $phoneNumber = $_POST['phoneNumber'];
    $email = $_POST['email'];
    $votingHistory = $_POST['votingHistory'];
    $pollingUnitDetails = $_POST['pollingUnitDetails'];
    $politicalPartyAffiliation = $_POST['politicalPartyAffiliation'];

    $sql = "INSERT INTO inec_db (ucrNumber, voterRegistrationInfo, voterIdentificationNumber, name, dateOfBirth, gender, nationality, address, phoneNumber, email, votingHistory, pollingUnitDetails, politicalPartyAffiliation)
    VALUES ('$ucrNumber', '$voterRegistrationInfo', '$voterIdentificationNumber', '$name', '$dateOfBirth', '$gender', '$nationality', '$address', '$phoneNumber', '$email', '$votingHistory', '$pollingUnitDetails', '$politicalPartyAffiliation')";
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
    <title>INEC</title>
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
                <label class="form-label">Voter Registration Info</label>
                <input type="text" name="voterRegistrationInfo" class="form-control" placeholder="Enter voter registration info" autocomplete="off">
            </div>
            <div class="mb-3">
                <label class="form-label">Voter Identification Number</label>
                <input type="text" name="voterIdentificationNumber" class="form-control" placeholder="Enter voter identification number" autocomplete="off">
            </div>
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter full name" autocomplete="off">
            </div>
            <div class="mb-3">
                <label class="form-label">Date of Birth</label>
                <input type="date" name="dateOfBirth" class="form-control" autocomplete="off">
            </div>
            <div class="mb-3">
                <label class="form-label">Gender</label>
                <input type="text" name="gender" class="form-control" placeholder="Enter gender" autocomplete="off">
            </div>
            <div class="mb-3">
                <label class="form-label">Nationality</label>
                <input type="text" name="nationality" class="form-control" placeholder="Enter nationality" autocomplete="off">
            </div>
            <div class="mb-3">
                <label class="form-label">Address</label>
                <input type="text" name="address" class="form-control" placeholder="Enter address" autocomplete="off">
            </div>
            <div class="mb-3">
                <label class="form-label">Phone Number</label>
                <input type="text" name="phoneNumber" class="form-control" placeholder="Enter phone number" autocomplete="off">
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="text" name="email" class="form-control" placeholder="Enter email" autocomplete="off">
            </div>
            <div class="mb-3">
                <label class="form-label">Voting History</label>
                <input type="text" name="votingHistory" class="form-control" placeholder="Enter voting history" autocomplete="off">
            </div>
            <div class="mb-3">
                <label class="form-label">Polling Unit Details</label>
                <input type="text" name="pollingUnitDetails" class="form-control" placeholder="Enter polling unit details" autocomplete="off">
            </div>
            <div class="mb-3">
                <label class="form-label">Political Party Affiliation</label>
                <input type="text" name="politicalPartyAffiliation" class="form-control" placeholder="Enter political party affiliation" autocomplete="off">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>

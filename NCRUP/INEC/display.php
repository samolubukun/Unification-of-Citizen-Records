<?php
include 'connect.php';

// Function to highlight the search term in the table row
function highlightSearchTerm($text, $searchTerm) {
    $highlightedText = preg_replace("/($searchTerm)/i", '<span class="highlight">$1</span>', $text);
    return $highlightedText;
}

$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INEC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .highlight {
            background-color: yellow;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center">Independent National Electoral Commission (INEC)</h1>
        <form action="" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" placeholder="Enter UCR Number" value="<?php echo $searchTerm; ?>" class="form-control">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>
        <div class="text-end">
            <a href="ucrLogin.php" class="btn btn-primary mb-3">Access Unified Database</a>
            <a href="user.php" class="btn btn-primary mb-3">Add New Citizen</a>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#id</th>
                    <th scope="col">UCR Number</th>
                    <th scope="col">Voter Registration Info</th>
                    <th scope="col">Voter Identification Number</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">Date of Birth</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Nationality</th>
                    <th scope="col">Address</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Email</th>
                    <th scope="col">Voting History</th>
                    <th scope="col">Polling Unit Details</th>
                    <th scope="col">Political Party Affiliation</th>
                    <th scope="col">Photograph</th>
                    <th scope="col">Fingerprints</th>
                    <th scope="col">Operations</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = "SELECT * FROM `inec_db`";
                    $result = mysqli_query($connection, $sql);
                    if($result){
                        while($row = mysqli_fetch_assoc($result)){
                            $id = $row['id'];
                            $ucrNumber = $row['ucrNumber'];
                            $voterRegistrationInfo = $row['voterRegistrationInfo'];
                            $voterIdentificationNumber = $row['voterIdentificationNumber'];
                            $name = $row['name'];
                            $dateOfBirth = $row['dateOfBirth'];
                            $gender = $row['gender'];
                            $nationality = $row['nationality'];
                            $address = $row['address'];
                            $phoneNumber = $row['phoneNumber'];
                            $email = $row['email'];
                            $votingHistory = $row['votingHistory'];
                            $pollingUnitDetails = $row['pollingUnitDetails'];
                            $politicalPartyAffiliation = $row['politicalPartyAffiliation'];
                            $photograph = $row['photograph'];
                            $fingerprints = $row['fingerprints'];

                            // Highlight the row if the UCR number matches the search term
                            if (!empty($searchTerm) && $ucrNumber == $searchTerm) {
                                echo '<tr class="bg-info">';
                            } else {
                                echo '<tr>';
                            }

                            echo '
                                <th scope="row">' . $id . '</th>
                                <td>' . highlightSearchTerm($ucrNumber, $searchTerm) . '</td>
                                <td>' . $voterRegistrationInfo . '</td>
                                <td>' . $voterIdentificationNumber . '</td>
                                <td>' . $name . '</td>
                                <td>' . $dateOfBirth . '</td>
                                <td>' . $gender . '</td>
                                <td>' . $nationality . '</td>
                                <td>' . $address . '</td>
                                <td>' . $phoneNumber . '</td>
                                <td>' . $email . '</td>
                                <td>' . $votingHistory . '</td>
                                <td>' . $pollingUnitDetails . '</td>
                                <td>' . $politicalPartyAffiliation . '</td>
                                <td><img src="' . $photograph . '" width="100" height="100"></td>
                                <td><img src="' . $fingerprints . '" width="100" height="100"></td>
                                <td>
                                    <a href="update.php?updateid=' . $id . '" class="btn btn-secondary">Update</a>
                                    <a href="delete.php?deleteid=' . $id . '" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            ';
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Scroll to the highlighted row on page load
        window.onload = function() {
            var highlightElement = document.querySelector('.bg-info');
            if (highlightElement) {
                highlightElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        };
    </script>
</body>
</html>

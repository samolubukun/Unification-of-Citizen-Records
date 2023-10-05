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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <style>
        .highlight {
            background-color: yellow;
            font-weight: bold;
        }
    </style>
    <title>UNIFIED DATABASE DISPLAY</title>
</head>
<body>
    <h1>UNIFIED CITIZEN RECORDS</h1>
    <div class="container my-5">
        <form action="" method="GET" class="mb-3">
            <input type="text" name="search" placeholder="Enter UCR Number" value="<?php echo $searchTerm; ?>" class="form-control">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#id</th>
                    <th scope="col">UCR Number</th>
                    <th scope="col">Passport Number</th>
                    <th scope="col">Passport Issue Date</th>
                    <th scope="col">Passport Expiry Date</th>
                    <th scope="col">Visa Information</th>
                    <th scope="col">Travel History</th>
                    <th scope="col">Name</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Date of Birth</th>
                    <th scope="col">Nationality</th>
                    <th scope="col">Photograph</th>
                    <th scope="col">Fingerprints</th>
                    <th scope="col">Entry/Exit Stamps</th>
                    <th scope="col">Permits</th>
                    <th scope="col">Permanent Residency Info</th>
                </tr>
            </thead>
            <tbody>

                <?php
                    $sql = "SELECT * FROM `unified_db`";
                    $result = mysqli_query($connection, $sql);
                    if($result){
                        while($row = mysqli_fetch_assoc($result)){
                            $id = $row['id'];
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

                            // Highlight the row if the UCR number matches the search term
                            if (!empty($searchTerm) && stripos($ucrNumber, $searchTerm) !== false) {
                                echo '<tr class="bg-info">';
                            } else {
                                echo '<tr>';
                            }

                            echo '
                            <th scope="row">'.$id.'</th>
                            <td>'.highlightSearchTerm($ucrNumber, $searchTerm).'</td>
                            <td>'.$passportNumber.'</td>
                            <td>'.$passportIssueDate.'</td>
                            <td>'.$passportExpiryDate.'</td>
                            <td>'.$visaInformation.'</td>
                            <td>'.$travelHistory.'</td>
                            <td>'.$name.'</td>
                            <td>'.$gender.'</td>    
                            <td>'.$dateOfBirth.'</td>
                            <td>'.$nationality.'</td>
                            <td><img src="' . $photograph . '" width="100" height="100"></td>
                            <td><img src="' . $fingerprints . '" width="100" height="100"></td>
                            <td>'.$entryExitStamps.'</td>
                            <td>'.$permits.'</td>
                            <td>'.$permanentResidencyInfo.'</td>
                            </tr>
                            ';
                        }
                    }
                ?>

            </tbody>
        </table>
    </div>
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

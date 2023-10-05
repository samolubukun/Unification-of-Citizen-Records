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
                    <th scope="col">License Number</th>
                    <th scope="col">Validity</th>
                    <th scope="col">Name</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Restrictions</th>
                    <th scope="col">Owner Name</th>
                    <th scope="col">Vehicle Identification Number</th>
                    <th scope="col">License Plate</th>
                    <th scope="col">Violation Details</th>
                    <th scope="col">Accident Details</th>
                    <th scope="col">Penalties</th>
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
                            $license_number = $row['license_number'];
                            $validity = $row['validity'];
                            $name = $row['name'];
                            $gender = $row['gender'];
                            $restrictions = $row['restrictions'];
                            $owner_name = $row['owner_name'];
                            $vehicle_identification_number = $row['vehicle_identification_number'];
                            $license_plate = $row['license_plate'];
                            $violation_details = $row['violation_details'];
                            $accident_details = $row['accident_details'];
                            $penalties = $row['penalties'];

                            // Highlight the row if the UCR number matches the search term
                            if (!empty($searchTerm) && stripos($ucrNumber, $searchTerm) !== false) {
                                echo '<tr class="bg-info">';
                            } else {
                                echo '<tr>';
                            }

                            echo '
                            <th scope="row">'.$id.'</th>
                            <td>'.highlightSearchTerm($ucrNumber, $searchTerm).'</td>
                            <td>'.$license_number.'</td>
                            <td>'.$validity.'</td>
                            <td>'.$name.'</td>
                            <td>'.$gender.'</td>
                            <td>'.$restrictions.'</td>
                            <td>'.$owner_name.'</td>
                            <td>'.$vehicle_identification_number.'</td>
                            <td>'.$license_plate.'</td>
                            <td>'.$violation_details.'</td>
                            <td>'.$accident_details.'</td>
                            <td>'.$penalties.'</td>
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

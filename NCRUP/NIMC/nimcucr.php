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
                    <th scope="col">NIN</th>
                    <th scope="col">Name</th>
                    <th scope="col">Date of Birth</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Nationality</th>
                    <th scope="col">Address</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Email</th>
                    <th scope="col">Citizenship Status</th>
                    <th scope="col">Marital Status</th>
                    <th scope="col">Employment Details</th>
                    <th scope="col">Photograph</th>
                    <th scope="col">Fingerprint</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `unified_db`";
                $result = mysqli_query($connection, $sql);
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id'];
                        $ucrNumber = $row['ucrNumber'];
                        $nin = $row['nin'];
                        $name = $row['name'];
                        $dateOfBirth = $row['dateOfBirth'];
                        $gender = $row['gender'];
                        $nationality = $row['nationality'];
                        $address = $row['address'];
                        $phoneNumber = $row['phoneNumber'];
                        $email = $row['email'];
                        $citizenshipStatus = $row['citizenshipStatus'];
                        $maritalStatus = $row['maritalStatus'];
                        $employmentDetails = $row['employmentDetails'];
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
                            <td>' . $nin . '</td>
                            <td>' . $name . '</td>
                            <td>' . $dateOfBirth . '</td>
                            <td>' . $gender . '</td>
                            <td>' . $nationality . '</td>
                            <td>' . $address . '</td>
                            <td>' . $phoneNumber . '</td>
                            <td>' . $email . '</td>
                            <td>' . $citizenshipStatus . '</td>
                            <td>' . $maritalStatus . '</td>
                            <td>' . $employmentDetails . '</td>
                            <td><img src="' . $photograph . '" width="100" height="100"></td>
                            <td><img src="' . $fingerprints . '" width="100" height="100"></td>
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

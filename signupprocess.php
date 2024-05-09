<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include the connection file
    include('connection.php');

    $connection = new Connection();
    $con = $connection->openConnection();

    if ($con) {
        try {
            // Debugging: Check values from the form
            $firstname = $_POST["firstname"];
            $lastname = $_POST["lastname"];
            $email = $_POST["email"];
            $password = $_POST["password"];

            // Convert month name to number
            $monthNames = array(
                'Jan' => '01',
                'Feb' => '02',
                'Mar' => '03',
                'Apr' => '04',
                'May' => '05',
                'Jun' => '06',
                'Jul' => '07',
                'Aug' => '08',
                'Sep' => '09',
                'Oct' => '10',
                'Nov' => '11',
                'Dec' => '12'
            );
            $selectedMonth = $_POST["month"];
            $selectedMonthNumber = $monthNames[$selectedMonth];

            // Construct the birthdate
            $birthdate = $_POST["year"] . "-" . $selectedMonthNumber . "-" . $_POST["day"];
            $gender = $_POST["gender"];

            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Prepare the insert statement
            $stmt = $con->prepare("INSERT INTO users (firstname, lastname, email, password, birthdate, gender) VALUES (:firstname, :lastname, :email, :password, :birthdate, :gender)");

            // Bind parameters
            $stmt->bindParam(':firstname', $firstname);
            $stmt->bindParam(':lastname', $lastname);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword); // Store hashed password
            $stmt->bindParam(':birthdate', $birthdate);
            $stmt->bindParam(':gender', $gender);

            // Execute the statement
            if ($stmt->execute()) {
                echo "New record created successfully";
            } else {
                echo "Error: Unable to execute the statement";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        // Close the connection
        $connection->closeConnection();
    } else {
        echo "Error: Unable to establish a database connection";
    }
}
?>

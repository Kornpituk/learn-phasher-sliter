<?php

$host = "localhost";
$port = "5050";
$dbname = "wrokshop-php";
$user = "postgres";
$password = "1234";

$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    die("Connection failed: " . pg_last_error());
}


$name = "";
$email = "";
$phone = "";
$address = "";

$errorMessage = "";
$successMessage = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = pg_escape_string($_POST['name']);
    $email = pg_escape_string($_POST['email']);
    $phone = pg_escape_string($_POST['phone']);
    $address = pg_escape_string($_POST['address']);

    do {
        if (empty($name) || empty($email) || empty($phone) || empty($address) ) {
            $errorMessage = " Add the field are required";
            break;
        }

        // add new client database
        $sql = "INSERT INTO users (name, email, phone, address)".
                " VALUES ('$name', '$email', '$phone', '$address')";
        $result = pg_query($conn, $sql);

        if (!$result) {
            echo "Error: " . pg_last_error();
        } else {
            echo "Data inserted successfully!";
        }

        $id = pg_last_oid($result);

        // update the client's timestamp in the database
        $sql = "UPDATE users SET create_at = NOW()";
        $result = pg_query($conn, $sql);

        if (!$result) {
            echo "Error: " . pg_last_error();
            break;
        }

        $name = "";
        $email = "";
        $phone = "";
        $address = "";

        $successMessage = "Client Database added successfully";

        header("Location: /code/php/test/index.php");
        exit;


    } while (false);
}


?>
<?php

$host = "localhost";
$port = "5050";
$dbname = "sliter";
$user = "postgres";
$password = "1234";

$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

$id = "";
$name = "";
$score = "";

$errorMessage = "";
$successMessage = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name'])) {
        $name = pg_escape_string($_POST['name']);
        // console_log("Name: " . $name);
    } else {
        $errorMessage = "The name field is missing";
    }
    $name = pg_escape_string($_POST['name']);

    do {
        if (empty($name) ) {
            $errorMessage = " Add the field are required";
            break;
        }

        // add new client database
        $sql = "INSERT INTO snake (name)".
                " VALUES ('$name')";
        $result = pg_query($conn, $sql);

        if (!$result) {
            echo "Error: " . pg_last_error();
        } else {
            echo "Data inserted successfully!";
        }

        $name = "";

        $successMessage = "Client Database added successfully";

        // header("Location: /api/getSnake.php?name=". urlencode($name));
        // console.log("name: ".$name);

        // exit;


    } while (false);
}
   $name = $_GET["name"];

   //read the row of the selected cleint from database tabele
   $sql = "SELECT * FROM snake WHERE name = '$name'";
   $result = pg_query($conn, $sql);
//    $result = $result = pg_query($conn, $sql);
//    $row = $result->pg_fetch_assoc();

if (!$result) {
    echo "Error: " . pg_last_error();
    } else {
        $row = pg_fetch_array($result, null, PGSQL_ASSOC);
        if (!$row) {
            // no row found, handle the error as needed
        } else {
            // read the data from $row and use it as needed
            $id = $row['id'];
            $name = $row['name'];
            $score = $row['score'];


            header("Location: /api/getSnake.php?name=". urlencode($name));
        // console.log("name: ".$name);

        exit;
        }
    
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Player</title>
</head>

<body>
    <div class="container-md ">
        <div class="card text-center">
            <div class="card-header">
                Note
            </div>
            <div class="card-body">
                <h5 class="card-title">Register User Name</h5>
                <p class="card-text">Enter Your User Name here</p>
                <?php if ($errorMessage): ?>
                <div><?php echo $errorMessage; ?></div>
                <?php endif; ?>
                <?php if ($successMessage): ?>
                <div><?php echo $successMessage; ?></div>
                <?php endif; ?>
                <form method="post" action="/api/createSnake.php">
                    <label for="username">Identity Document :</label>
                    <input type="text" name="id" value="<?php echo $id; ?>">
                    <label for="username">User Name :</label>
                    <input type="text" name="name" id="name" value="<?php echo $name; ?>">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </form>

            </div>
            <div class="card-footer text-muted">
                <p style="color:white">Snake.... </p>
            </div>
        </div>
    </div>

</body>

</html>
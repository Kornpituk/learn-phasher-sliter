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

if($_SERVER["REQUEST_METHOD"] == "GET") {
   // GET method : show the data of the client

   if (!isset($_GET["name"])) {
    // header("Location: /code/php/test/index.php");
    //  cconsole_log("no name found, handle the error as needed");
     $errorMessage = "no name found, handle the error as needed";
    // exit;
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
    }
}
} 
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container-md">
        <div class="ranking">
            <div class="card text-center mg-10">
                <div class="card-header">
                    Test ID
                </div>
                <div class="card-body">
                    <h5 class="card-title">Player Snake</h5>
                    <div>
                        <table class="table">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Score</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>
                                        <label for="">ID:<?php echo $id; ?></label>
                                    </th>
                                    <th>
                                        <label for="">Name:<?php echo $name; ?></label>
                                    </th>
                                    <th>
                                        <label for="">Score:<?php echo $score; ?></label>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    <p style="color:white">Snake.... </p>
                    <a class="btn btn-primary btn-lg" href="/code/phaser/learn-phasher-sliter/index.php?name=<?php echo urlencode($name);?>" role="button" aria-disabled="true" href="/index.php">Start Link a</a>
                </div>
            </div>
        </div>

    </div>
</body>

</html>l
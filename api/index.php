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


$name = "";

$errorMessage = "";
$successMessage = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name'])) {
        $name = pg_escape_string($_POST['name']);
        console_log("Name: " . $name);
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

        $id = pg_last_oid($conn);

        // update the client's timestamp in the database
        $sql = "UPDATE users SET create_at = NOW()";
        $result = pg_query($conn, $sql);

        if (!$result) {
            echo "Error: " . pg_last_error();
            break;
        }

        $name = "";

        $successMessage = "Client Database added successfully";

        header("Location: /code/phaser/learn-phasher-sliter/index.html?id=<?php echo $row[id]?>");
        exit;


    } while (false);
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
    <div class="container-md ">
        <div class="card text-center">
            <div class="card-header">
                Note
            </div>
            <div class="card-body">
                <h5 class="card-title">Register User Name</h5>
                <p class="card-text">Enter Your User Name here</p>
                <form method="post">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <label for="username" name="name" id="name" value="<?php echo $name; ?>">UserName :</label>
                    <input type="text">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </form>

            </div>
            <div class="card-footer text-muted">
                <p style="color:white">Snake.... </p>
            </div>
        </div>
    </div>


    <div class="container-md">
        <div class="ranking">
            <div class="card text-center mg-10">
                <div class="card-header">
                    Ranking
                </div>
                <div class="card-body">
                    <h5 class="card-title">Top Score Snake</h5>
                    <p class="card-text">check top score snake here</p>
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

                                    // read all row from database table
                                    $sql = "SELECT * FROM snake";
                                    $result = pg_query($conn, $sql);

                                    if (!$result) {
                                        echo "Error: " . pg_last_error();
                                    } 

                                    //read data of each row
                                    while($row = pg_fetch_assoc($result)) {
                                        echo "
                                        <tr>
                                        <td>$row[id]</td>
                                        <td>$row[name]</td>
                                        <td>$row[score]</td>
                                        ";
                                    }
                                    
                                    // close the database connection
                                    pg_close($conn);

                                    ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    <p style="color:white">Snake.... </p>
                </div>
            </div>
        </div>

    </div>
</body>

</html>l
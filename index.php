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
    echo $id;
    echo $name;
    echo $score;
}
} 
?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Slither.io Clone - Loonride Example</title>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pg/8.6.0/pg.min.js" integrity="sha512-XGsHuyqWE4ODJezVxLhcW9KQ5P+caQP0zgIjVxPmVt4exFrH65/syA2Rg6ozjsg9+QIvQ1JTKTkn6lG0W2UHYQ==" crossorigin="anonymous"></script>

    <script src="lib/phaser.min.js"></script>
    <script src="src/game.js"></script>
    <script src="src/snake.js"></script>
    <script src="src/playerSnake.js"></script>                                             
    <script src="src/botSnake.js"></script>
    <script src="src/eye.js"></script>
    <script src="src/eyePair.js"></script>
    <script src="src/shadow.js"></script>  
    <script src="src/food.js"></script>
    <script src="src/util.js"></script>
    <script src="src/bomb.js"></script>
    <script src="src/enemySnake.js"></script>
    <script src="src/think.js"></script>
    <script src="src/gravestone.js"></script>
    <script src="src/wall.js"></script>
    

</head>
<body>
    <script>
    (function() {
        var game = new Phaser.Game(1900,1000, Phaser.AUTO, null,);
        let nameSnake = "<?php echo $_GET['name']?>";
        console.log("SnakeName: " + nameSnake);
        game.state.add('Game', Game);
        game.state.start('Game');
    })();
    </script>
</body>
</html>

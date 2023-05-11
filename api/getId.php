<?php
  if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    if(!empty($name)) {
      // do something with $name when it's not empty
    } else {
      $name = ""; // set $name to an empty string
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
    <div class="container-md ">
        <div class="card text-center">
            <div class="card-header">
                Note
            </div>
            <div class="card-body">
                <h5 class="card-title">Test Input</h5>
                <p class="card-text">Enter Your User Name here</p>
                <!-- Display the value of $name outside of the form -->
                <?php
                    if ($name != "") {
                        echo "Name entered: " . $name;
                    }
                ?>
                <form method="post">
                    <input type="text" name="name" value="<?php echo $name; ?>">
                    <button type="submit" name="submit">Submit</button>
                </form>

            </div>
            <div class="card-footer text-muted">
                <p style="color:white">Snake.... </p>
            </div>
        </div>
    </div>

</body>
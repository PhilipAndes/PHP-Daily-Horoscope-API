<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Personal Horoscope</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>

<!-- navbar -->
    <nav class="navbar bg-dark navbar-dark">
        <a class="navbar-brand" href="../index.php">Daily Horoscope</a>
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#collapsibleNavbar" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>
        <div class="navbar-collapse collapse" id="collapsibleNavbar" style="">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="../index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0)">Contact</a>
                </li>
            </ul>
        </div>  
    </nav>

    <?php

    $sb = $_GET['sb']; // $sb heeft alleen waarde in onderstaande code, 'sb' is de waarde uit de link na het ?.. 

    $url = "http://sandipbgt.com/theastrologer/api/horoscope/" . $sb . "/today/"; 

    $json = file_get_contents($url);

    // var_dump($json);

    // echo "<br>";
    // echo "<br>";

    $sterrenBeeld = json_decode($json);  

    // var_dump($sterrenBeeld);

    include "../db_connection.php";        

    $sql_querie = "SELECT horo_id, horo_img, horo_date FROM himg WHERE horo_name = '$sb' "; 

    $db_result = $conn->query($sql_querie);  

    foreach ($db_result as $row)
    {            
      echo '<img src="/codegorilla/horoscope/img/' . $row['horo_img'] . '" alt="' . '" style="width:100px; height:100px;>' .
          '<a href="getData.php?id=' . $row['horo_id'] . '">' . '</a>';
      echo '<h2>' . $row['horo_date'] . '</h2>';
  } 

    echo '<h1>' . $sterrenBeeld -> sunsign . '</h1>';
    echo '<h3>' . $sterrenBeeld -> horoscope . '</h3>';
    echo '<h3>' . $sterrenBeeld -> meta -> mood . '</h3>';
    echo '<h3>' . $sterrenBeeld -> meta -> keywords . '</h3>';
    echo '<h3>' . $sterrenBeeld -> meta -> intensity . '</h3>';

    $conn = null;   

  ?>


</body>
</html>
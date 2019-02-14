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
    <!-- icon library -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/horoscopeInfo.css" />
</head>
<body>

    <?php

    $sb = $_GET['sb']; // $sb heeft alleen waarde in onderstaande code, 'sb' is de waarde uit de link na het ?.. 

    if (isset($_GET['day'])){
        $day = $_GET['day'];
    } else {
        $day = 'today';
    }

    $url = "http://sandipbgt.com/theastrologer/api/horoscope/" . $sb . "/" . $day . "/"; 

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
      echo 
        '<div class="horos_card">' .
        '<div class="info_section">' .
        '<div class="horos_header">' .
      
        '<img class="locandina" src="/codegorilla/horoscope/img/' . $row['horo_img'] . '" alt="' . '" >' .
        // '<img class="locandina" src="/img/' . $row['horo_img'] . '" alt="' . '" >' .
        '<a href="getData.php?id=' . $row['horo_id'] . '">' . '</a>' .

        '<h1>' . $sterrenBeeld -> sunsign . '</h1>' .

        '<h4>' . $row['horo_date'] . '</h4>' . 

        '<span class="box">' . 'Mood: ' . $sterrenBeeld -> meta -> mood . '</span>' .
        '<span class="box">' . 'Intensity: ' . $sterrenBeeld -> meta -> intensity . '</span>' .
        // '<p class="type">' . $sterrenBeeld -> meta -> keywords . '</p>' .
        '</div>' . 
        '<div class="horos_desc">' . 
        '<p class="text">' . $sterrenBeeld -> horoscope . '</p>' .
        '</div>' .

        // buttons
        
        '<a href="getData2.php?sb=' . $sb . '&day=yesterday">' . '<button class="button"><i class="fas fa-angle-left"></i> Yesterday </button>' . '</a>' .
        
        '<a href="getData2.php?sb=' . $sb . '&day=today">' . '<button class="button"> Today </button>' . '</a>' .

        '<a href="getData2.php?sb=' . $sb . '&day=tomorrow">' . '<button class="button"> Tomorrow <i class="fas fa-angle-right"></i></button>' . '</a>' .

        //back button
        '<a href="../index.php">' .
        '<button class="backButton"><i class="fas fa-undo"></i> Back </button>' .
        '</a>' .
        

        //background image
        '</div>' .
        '<div class="blur_back bright_back">' . '<img class="card_background" src="/codegorilla/horoscope/img/' . $row['horo_img'] . '" alt="' . '" >' . '</div>' .

        // '<div class="blur_back bright_back">' . '<img class="card_background" src="/img/' . $row['horo_img'] . '" alt="' . '" >' . '</div>' .
        '</div>';
      
  } 

    $conn = null;   

  ?>

</body>
</html>


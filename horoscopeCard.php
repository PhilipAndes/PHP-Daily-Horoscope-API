<?php
    include "db_connection.php";        

    $sql_querie = "SELECT horo_id, horo_name, horo_img, horo_date FROM himg";
    
    $db_result = $conn->query($sql_querie);  

    foreach ($db_result as $row)
    {            
        $HoofdletterEerstString = ucfirst($row['horo_name']);
        
        echo '<div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">';
        echo '<a href="php/getData2.php?sb=' . $row['horo_name'] . '">' . '<img src="/codegorilla/horoscope/img/' . $row['horo_img'] . '" alt="horoscope" class="rounded-circle" style="width:150px; height:150px;">' . '</a>' .

        // echo '<a href="php/getData2.php?sb=' . $row['horo_name'] . '">' . '<img src="/img/' . $row['horo_img'] . '" alt="horoscope" class="rounded-circle" style="width:150px; height:150px;">' . '</a>' .


        // '<div class = "details">' .
        // '<h1>' . $HoofdletterEerstString . '</h1>' .
        // '<p>' . $row['horo_date'] . '</p>' .
        // '</div>';
        
        // '<a href="getData.php?id=' . $row['horo_id'] . '">' . '</a>' .

        '<h2>' . $HoofdletterEerstString . '</h2>'; 

        //'<h5>' . $row['horo_date'] . '</h5>'; 

        echo "</div>";
    }       

    $conn = null;

?>

<?php
session_start();
require 'includes/connection.php';

$method = $_SERVER['REQUEST_METHOD'];
if($method == "GET"){
    $sql = "SELECT * FROM questionjson";
    $result = mysqli_query($con, $sql);
    $rows = array();

    if(mysqli_num_rows($result) > 0) {
        while ($r = mysqli_fetch_assoc($result)) {
            array_push($rows, $r);
        }
        print json_encode($rows);
    }else{
        echo "No data";
    }
}else if($method == "POST"){
    $question1 = $_POST['question1'];
    $question2 = $_POST['question2'];
    $question3 = $_POST['question3'];

    $sql_insert = "INSERT INTO questionjson (questionId, question1, question2, question3)
                    VALUES (NULL, '$question1','$question2', '$question3')";
    if(mysqli_query($con, $sql_insert)){
        echo "Item successfully added to the database";
    }else{
        echo "ERROR: $sql_insert did not run".mysqli_error($con);
    }
}
mysqli_close($con);
?>
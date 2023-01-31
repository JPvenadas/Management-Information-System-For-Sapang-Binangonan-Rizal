<?php
require "db_conn.php";


function inputContent($content){
    if(isset($_SESSION["registration-$content"])){
        echo $_SESSION["registration-$content"];
    }
}

//if the next button is clicked in the step 2 registration. the inputs will be saved
if(isset($_POST['next2'])){
    $_SESSION['registration-firstName'] = $_POST['firstName'];
    $_SESSION['registration-middleName'] = $_POST['middleName'];
    $_SESSION['registration-lastName'] = $_POST['lastName'];
    $_SESSION['registration-extension'] = $_POST['extension'];
    $_SESSION['registration-birthDate'] = $_POST['birthDate'];
}

?>
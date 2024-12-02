<?php

//var_dump($_SERVER["REQUEST_METHOD"])
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $firstName = htmlspecialchars($_POST["firstname"]); //Sanitizes data
    $lastName = htmlspecialchars($_POST["lastname"]);

    header("Location: ../index.php");
} else {
    header("Location: ../index.php");
}
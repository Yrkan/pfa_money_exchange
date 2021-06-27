<?php

function add_client($username, $password, $name, $type) {
    require_once "../db.php";
    $sql = "INSERT INTO client (name, username, password, type) VALUES ('$name', '$username', '$password', '$type');";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
    
        //echo "Error: " . $sql . "<br>" . $conn->error;
        return false;
    }
}

function add_bank($username, $password, $name) {
    require_once "../db.php";
    $sql = "INSERT INTO bank (name, username, password) VALUES ('$name', '$username', '$password');";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
    
        //echo "Error: " . $sql . "<br>" . $conn->error;
        return false;
    }
}
?>
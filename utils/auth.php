<?php

function is_auth_admin() {
    if (isset($_SESSION["is_admin"]) && $_SESSION["is_admin"]) {
        return true;
    }
    return false;
}

function auth_admin($username, $password) {
    require "../db.php";

    $q = "SELECT username, password FROM admin where username = '$username'"; 
    if ($stmt = $conn->prepare($q)){
        $stmt->execute(); 

        $result = $stmt->get_result(); 

        $row=$result->fetch_object();
        
        if ($row && password_verify($password, $row->password)) {
            return true;
        }

        return false;

    } else { 
        echo $conn->error; 
    }
}
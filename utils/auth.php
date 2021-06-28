<?php
function is_auth_admin() {
    if (isset($_SESSION["is_admin"]) && $_SESSION["is_admin"]) {
        return true;
    }
    return false;
}

function is_auth_bank() {
    if (isset($_SESSION["is_bank"]) && $_SESSION["is_bank"]) {
        return true;
    }
    return false;
}

function is_auth_user() {
    if (isset($_SESSION["is_user"]) && $_SESSION["is_user"]) {
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
        return false;
    }
}

function auth_bank($username, $password) {
    require "../db.php";

    $q = "SELECT id, username, password FROM bank where username = '$username'"; 
    if ($stmt = $conn->prepare($q)){
        $stmt->execute(); 

        $result = $stmt->get_result(); 

        $row=$result->fetch_object();
        
        if ($row && password_verify($password, $row->password)) {
            return $row->id;
        }

        return false;

    } else { 
        return false; 
    }
}

function auth_user($username, $password) {
    require "../db.php";

    $q = "SELECT id, username, password FROM client where username = '$username'"; 
    if ($stmt = $conn->prepare($q)){
        $stmt->execute(); 

        $result = $stmt->get_result(); 

        $row=$result->fetch_object();
        
        if ($row && password_verify($password, $row->password)) {
            return $row->id;
        }

        return false;

    } else { 
        return false; 
    }
}
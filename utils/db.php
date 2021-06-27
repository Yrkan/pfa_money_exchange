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

function add_offer($bank_id, $devise_id, $price, $type) {
    require_once "../db.php";
    // Check if offer already exists
    $sql = "SELECT id FROM offer WHERE bank_id = '$bank_id' AND devise_id = '$devise_id' AND type = '$type'";
    if ($stmt = $conn->prepare($sql)){
        //$stmt->bind_param('s',$class);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result->num_rows == 0) {
            // Offer doesn't exist add it
            $sql = "INSERT INTO offer (bank_id, devise_id, price, type) VALUES ('$bank_id', '$devise_id', '$price', '$type');";

            if ($conn->query($sql) === TRUE) {
                return true;
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                return false;
            }
        } else {
            // Offer exits update
            $sql = "UPDATE offer SET price = $price WHERE bank_id = '$bank_id' AND devise_id = '$devise_id' AND type = '$type'";

            if ($conn->query($sql) === TRUE) {
                return true;
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                return false;
            }
        }
    } else{
        echo $conn->error;
    }

}

function add_agency($name, $bank_id, $latitude, $longitude) {
    require_once "../db.php";
    $sql = "INSERT INTO agency (name, bank_id, latitude, longitude) VALUES ('$name', '$bank_id', '$latitude', '$longitude');";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        //echo "Error: " . $sql . "<br>" . $conn->error;
        return false;
    }
}

function delete_agency($agency_id, $bank_id) {
    require_once "../db.php";
    $sql = "DELETE FROM agency WHERE id='$agency_id' AND bank_id='$bank_id'";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        //echo "Error: " . $sql . "<br>" . $conn->error;
        return false;
    }
}
?>
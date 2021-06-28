<?php

function devise_select() {
    require "../db.php";

    $q="SELECT * from devise"; 

    if($stmt = $conn->prepare($q)){
    //$stmt->bind_param('s',$class);
    $stmt->execute();

    $result = $stmt->get_result();
    echo "<select class='form-select' name='devise'>";
    while ($row = $result->fetch_assoc()) {
    echo "<option value=$row[id]>$row[abbrev]</option>";
    }
    echo "</select>";

    }else{
    echo "Internal server error 500";
    }

}

function get_offers_bank($bank_id) {
    require "../db.php";

    $sql = "SELECT t1.id, t2.abbrev, t1.type, t1.price  FROM offer t1 INNER JOIN devise t2 ON t1.devise_id = t2.id WHERE t1.bank_id = '$bank_id'; ";

    if ($stmt = $conn->prepare($sql)){
        //$stmt->bind_param('s',$class);
        $stmt->execute();

        $result = $stmt->get_result();
        echo "No d'offers : ".$result->num_rows;
        echo " <table class='table table-bordered table-striped'>
        <tr class='info'><td>id </td><td>devise </td><td>type </td><td>prix </td></tr>";
        while ($row = $result->fetch_assoc()) {
            $type = $row['type'] == "buy" ? "Achat" : "Vente";
            echo "<tr ><td>$row[id]</td><td>$row[abbrev]</td><td>$type</td><td>$row[price]</td><tr>";
        }
        echo "</table>";

    } else {
        echo "Internal server error 500";
    }

}

function get_offers($devise_id, $type, $amount) {
    require "../db.php";

    $sql = "SELECT o.id, b.id as bank_id, b.name, o.price, d.abbrev  FROM offer o   INNER JOIN bank b ON o.bank_id = b.id INNER JOIN devise d ON o.devise_id = d.id WHERE o.type = '$type' AND o.devise_id = '$devise_id'; ";

    if ($stmt = $conn->prepare($sql)){
        //$stmt->bind_param('s',$class);
        $stmt->execute();

        $result = $stmt->get_result();
        $btn_txt = $type == "Achat" ? "Acheter" : "Vendre";
        echo "No d'offers : ".$result->num_rows;
        echo " <table class='table table-bordered table-striped'>
        <tr class='info'><td>Banque </td><td>Prix</td><td>Action </td></tr>";
        while ($row = $result->fetch_assoc()) {
            //$total = $row['price'] * $amount;
            echo "<tr ><td>$row[name]</td><td>$row[price]</td><td>
                <form action='./transactions.php' method='POST' class='text-center'>
                    <input type='hidden' name='devise' value='$devise_id' /> 
                    <input type='hidden' name='type' value='$type' /> 
                    <input type='hidden' name='bank' value='$row[bank_id]' />
                    <input type='hidden' name='amount' value='$amount' />
                    <input type='hidden' name='price' value='$row[price]' />
                    <input type='submit' value='$btn_txt' class='btn btn-success' />
                    
                </form>
            </td><tr>";
        }
        echo "</table>";

    } else {
        echo "Internal server error 500";
    }

}

function get_agencies_bank($bank_id) {
    require "../db.php";

    $sql = "SELECT * FROM agency WHERE bank_id = '$bank_id'";

    if ($stmt = $conn->prepare($sql)){
        //$stmt->bind_param('s',$class);
        $stmt->execute();

        $result = $stmt->get_result();
        echo "No d'agences : ".$result->num_rows;
        echo " <table class='table table-bordered table-striped text-center'>
        <tr class='info'><td>Id </td><td>Nom </td><td>Latitude </td><td>Logitude </td><td>Action </td></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr ><td>$row[id]</td><td>$row[name]</td><td>$row[latitude]</td><td>$row[longitude]</td><td>
            <form method='POST'>
                <input type='hidden' name='form_role' value='delete' />
                <input type='hidden' name='id' value='$row[id]' />
                <input type='submit' value='supprimer' class='btn btn-danger' />
            </form>
            </td><tr>";
        }
        echo "</table>";

    } else {
        echo "Internal server error 500";
    }
}

function get_agencies_client($bank_name) {
    require "../db.php";

    $sql = "SELECT * FROM agency WHERE bank_id = (SELECT id from bank WHERE name = '$bank_name')";

    if ($stmt = $conn->prepare($sql)){
        //$stmt->bind_param('s',$class);
        $stmt->execute();

        $result = $stmt->get_result();
        echo "No d'agences : ".$result->num_rows;
        echo " <table class='table table-bordered table-striped text-center'>
        <tr class='info'><td>Nom </td><td>Latitude </td><td>Logitude </td><td>Action </td></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr ><td>$row[name]</td><td>$row[latitude]</td><td>$row[longitude]</td><td>
            <form method='GET' action='./map.php' >
                <input type='hidden' name='name' value='$row[name]' />
                <input type='hidden' name='latitude' value='$row[latitude]' />
                <input type='hidden' name='longitude' value='$row[longitude]' />
                <input type='submit' value='Afficher dans la map' class='btn btn-success' />
            </form>
            </td><tr>";
        }
        echo "</table>";

    } else {
        echo "Internal server error 500";
    }
}


function get_transactions_client($client_id) {
    require "../db.php";

    $sql = "SELECT type, price, amount, date, abbrev, b.name as bank FROM `transaction` t INNER JOIN devise d ON t.devise_id = d.id INNER JOIN bank b ON t.bank_id = b.id WHERE client_id = '$client_id'  ORDER BY date DESC";

    if ($stmt = $conn->prepare($sql)){
        //$stmt->bind_param('s',$class);
        $stmt->execute();

        $result = $stmt->get_result();
        echo "No de transactions : ".$result->num_rows;
        echo " <table class='table table-bordered table-striped text-center'>
        <tr class='info'><td>Type </td><td>Montant </td><td>Taux</td><td>Total</td><td>Banque</td><td>Date</td></tr>";
        while ($row = $result->fetch_assoc()) {
            $total = $row['amount'] * $row['price'];
            $type = $row['type'] == "buy" ? "Achat" : "Vente";
            echo "<tr ><td>$type</td><td>$row[amount] $row[abbrev]</td><td>$row[price]</td><td>$total</td><td>$row[bank]</td><td>$row[date]</td><tr>";
        }
        echo "</table>";

    } else {
        echo "Internal server error 500";
    }

}
?>
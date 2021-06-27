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
?>
<?php

$myconn = new mysqli("localhost","root","","bank");

if($myconn->connect_errno > 0){
    die("Unable to fetch");
}

if($_SERVER['REQUEST_METHOD'] =="POST"){

    if(isset($_POST["sender"]) && isset($_POST["receiver"]) && isset($_POST["amount"])){
        $date = Date("d M y");       
        $sender = $_POST["sender"];
        $receiver = $_POST["receiver"];
        $amount = $_POST["amount"];
        $q = "SELECT balance,name FROM customer WHERE id = '$sender' AND balance >= $amount";
        $result = $myconn->query($q);
        if ( $result->num_rows > 0){
            $row = $result->fetch_assoc();
            $balance = $row['balance'];
            $senderName = $row['name'];
            $balance = $balance - $amount;
            $q = "UPDATE customer SET balance = '$balance' WHERE id = '$sender'";
            if($myconn->query($q) == TRUE){
                $q = "UPDATE customer SET balance = balance + $amount WHERE id = '$receiver'";
                if($myconn->query($q) == TRUE){
                    $q = "SELECT name FROM customer WHERE id = '$receiver'";
                    $result = $myconn->query($q);
                    if ( $result->num_rows > 0){
                        $row = $result->fetch_assoc();
                        $receiverName = $row['name'];
                    }
                    $q = "INSERT INTO transactions (sender, receiver, amount,dates) VALUES ('".$senderName."','".$receiverName."','".$amount."','".$date."')";
                    $myconn->query($q);
                    echo "<div style='color:green;'>Transfer Sucessfully ...</div>";
                    exit();
                }
                else{
                    echo "<div style='color:red;'>Transaction Failed</div>";
                    exit();
                }
            }
            else{
                "<div style='color:red;'>Unable to transfer</div>";
                exit();
            }
        }else{
            echo "<div style='color:red;'>Insufficient Amount ...</div>";
            exit();
        }
    }else{
        echo "<div style='color:red;'>Something went wrong</div>";
        exit();
    }

}

if(isset($_GET['id'])){

    $id = $_GET['id'];
        $q = "SELECT * FROM customer WHERE id = '$id'"; 
        $result = $myconn->query($q);
        if ($result->num_rows > 0){
            echo "<form id='transferForm'>";
            while($row = $result->fetch_assoc()) {
               echo "<div class='form-group'>
                  <label for='from'>Transfer From : </label>
                <input type='text' name='from' id='from' data-cid='".$row['id']."' class='form-control' disabled value='".$row['name']."'>
                <br><label for='to'>Transfer To : </label>
                <select class='form-control' name='to' id='to' required>
                <option selected disabled>Select customer</option>
                ";
            }
        }
        $q = "SELECT * FROM customer WHERE id != '$id' ORDER BY name ASC"; 
        $result = $myconn->query($q);
        if ($result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                echo "
                    <option value='".$row['id']."'>".$row['name']."</option>
                ";
            }
        }
        echo"
            </select>
            <br><label for='amount'>Amount : </label>
            <input type='number' name='amount' id='amount' class='form-control' required>
            <br>
            <button type='submit' onclick='transferMoney()' class='btn btn-primary'>Transfer</button>
        </form>";
}
else{
    echo "Please Try Afer Sometime";
}
?>
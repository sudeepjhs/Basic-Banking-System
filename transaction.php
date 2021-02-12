<?php
    if(!isset($_GET['cid'])){
        die("Invalid URL");
    }
    $id = $_GET['cid'];
    $myconn = new mysqli("localhost","root","","bank");
    if($myconn->connect_errno > 0){
        die("Unable to fetch");
    }else{
        $list = array();
        $q = "SELECT name,balance FROM customer WHERE id='$id'"; 
        $result = $myconn->query($q);
        if ($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $name = $row['name'];
            $closeBalance = $row['balance'];
            $q = "SELECT * FROM transactions WHERE sender='$name' OR receiver ='$name' ORDER BY tid DESC"; 
            $result = $myconn->query($q);
            if (!($result->num_rows > 0)){
                $list = array("error"=>"No transaction Found ...");
            }    
        }
        else{
            die("Invalid user Id");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="css/footer.css">
    <title>Transaction</title>
</head>

<body>
    <nav>
        <p>Spark Foundation</p>
    </nav>
    <div class="container">
        <table class="table table-hover main">
            <thead>
                <tr>
                    <th>Transaction Id</th>
                    <th>To / From</th>
                    <th>Date</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(empty($list)){
                    while($list = $result->fetch_assoc()){
                        echo "
                        <tr>
                            <td>".$list['tid']."</td>";
                        if($name == $list['sender']){
                            echo "<td>".$list['receiver']."</td>";
                        }else{
                            echo "<td>".$list['sender']."</td>";
                        }
                            echo "<td>".$list['dates']."</td>";
                        if($name == $list['sender']){
                            echo "<td> - Rs ".$list['amount']."</td>";
                        }else{
                            echo "<td> + Rs ".$list['amount']."</td>";
                        }
                     echo "</tr>";
                    }
                }else{
                        echo "
                        <tr>
                            <td style='text-align:center;color:red;' colspan='4'>".$list['error']."</td>
                        </tr>    
                        ";
                    }
                ?>
                <tr>
                    <td colspan='3'><b>Closed Balance : <b></td>
                    <td><?=$closeBalance?></td>
                </tr>
            </tbody>
        </table>
        <button onclick='history.go(-1)' type="button" class="btn btn-primary">Back</button>
    </div>
    <br><br><br>
    <?php include_once "footer.php"?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
    <script src="js/customer.js"></script>

</body>

</html>
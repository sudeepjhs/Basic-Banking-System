<?php

$myconn = new mysqli("localhost","root","","bank");
if($myconn->connect_errno > 0){
    die("Unable to fetch");
}else{
   $q = "SELECT * FROM customer ORDER BY name ASC"; 
   $result = $myconn->query($q);
   if ($result->num_rows > 0){
        while($row = $result->fetch_assoc()) {
            echo "
                <tr>
                    <td>".$row["name"]."</td>
                    <td>".$row["email"]."</td>
                    <td>".$row["balance"]."</td>
                    <td><button type='button' onclick='openTransfer(this)' data-toggle='modal' data-target='#transferModel' data-cid=".$row['id']." class='btn btn-primary'>Transfer</button>
                    <button type='button' onclick='openTransaction(this)' data-cid=".$row['id']." class='btn btn-info'>Veiw Transaction</button>
                    </td>
                </tr>
            ";
        }
   }
   else{
       echo "   
       <tr>
           <td colspan = '3'>No result found ...</td>
        </tr>
       ";
   }

}

?>
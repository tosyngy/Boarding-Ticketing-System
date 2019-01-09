<?php
error_reporting(0);
//ob_start();
session_start();

// Create connection
function connection() {

     $servername = "localhost";
    $username = "id4144831_brttick";
    $password = "brttick";
    $dbname = "id4144831_brttick";


    $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

if (isset($_GET["save"])) {
    insertIntoDB();
}
if (isset($_POST['ticket'])) {
    if ($_POST['ticket'] == "buy_ticket")
        buy_ticket($_POST['ticket']);
    if ($_POST['ticket'] == "topup")
        topup($_POST['ticket']);
}
if (isset($_POST['process'])) {
    $conn = connection();
    $no = $_POST['acc'];
    $acc = $_POST['use_acc'];
    $tid = $_POST['tick_id'];
    $uid = $_SESSION['id'];
    $aid = $_SESSION['adminid'];
    $rem = $acc + $no;
    $date = date('d-m-Y');
    $sql = "UPDATE  `ticket`
        SET  `last_use_date` =  '$date',
            `use_accumulator` =  '$rem' 
        WHERE  `ticket`.`tick_id` =$tid;";
    $conn->query($sql);
    $sql = "INSERT INTO `log` ( `tick_id`, `user_id`, `agent_id`, `transaction_type`,`rate`) VALUES ( '$tid', '$uid', '$aid', 'use ticket','$no');";
    if ($conn->query($sql) === TRUE)
        return;
}

function insertIntoDB() {

    $conn = connection();
    if ($_GET["save"] == "biodata") {
        $surname = $conn->real_escape_string($_POST["firstname"]);
        $othernames = $conn->real_escape_string($_POST["othernames"]);
        $address = $conn->real_escape_string($_POST["address"]);
        $email = $conn->real_escape_string($_POST["email"]);
        $mobileno = $conn->real_escape_string($_POST["mobileno"]);
        $sql = "INSERT INTO `registration` ( `firstname`, `othernames`, `email`, `mobileno`, `address`) VALUES ( '$surname', '$othernames', '$email', '$mobileno', '$address');";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    $conn->close();
}

function buy_ticket() {
    $conn = connection();
    $name = $conn->real_escape_string($_POST["name"]);
    $user_id = $_SESSION['id'];
    $tick_id = $user_id . time();
    $reg_date = date('d-m-Y');
    $route1 = $conn->real_escape_string($_POST["route1"]);
    $route2 = $conn->real_escape_string($_POST["route2"]);
    $acc = $conn->real_escape_string($_POST["acc"]);
    $amt = $conn->real_escape_string($_POST["net_amt"]);
    $unit_amt = $conn->real_escape_string($_POST["route_amt"]);
    $acc_bal = "0";

    $sql = "SELECT amt FROM card where user_id='$user_id' limit 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $acc_bal = $row['amt'];
            if ($acc_bal - $amt < 0) {
                echo "Insuffiencient Bal. your account bal. is: " . $row['amt'];
                return;
            }
            if (!isset($acc_bal)) {
                echo 'You have not register your card !!!';
                return;
            }
        }
    } else {
        echo 'You have not register your card !!!';
        return;
    }

    $sql = "SELECT amount FROM reg_route where route1='$route1' and route2='$route2' or route1='$route2' and route='$route1' limit 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "route not available";
        return;
    }

    $sql = "INSERT INTO `ticket` 
        ( `user_id`, `tick_owner`, `tick_id`, `tick_start_route`, `tick_end_route`, `tick_start_coord`, `tick_end_coord`, `reg_date`, `last_use_date`, `accumulator`,`use_accumulator`, `amt`,unit_amt) 
        VALUES ( '$user_id', '$name', '$tick_id', '$route1', '$route2', '', '', '$reg_date', '$reg_date', '$acc','0', '$amt', '$unit_amt');";
    if ($conn->query($sql) === TRUE) {
        $sql = "INSERT INTO `log` ( `tick_id`, `user_id`, `agent_id`, `transaction_type`,`rate`) VALUES ( '$tick_id', '$user_id', '0', 'buy ticket', '$amt');";
        $conn->query($sql);
        updateAcc($acc_bal - $amt, $user_id);
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function updateAcc($amt, $id) {
    $conn = connection();
    $sql = "UPDATE  `card`
        SET  `amt` =  '$amt' 
        WHERE  `user_id` =$id;";
    $conn->query($sql);
    echo "successfully";
}

function topup() {
    $conn = connection();
    $card_name = $conn->real_escape_string($_POST["card_name"]);
    $user_id = $_SESSION['id'];
    //   $tick_id = rand(1000000000, 9999999999);
    // $reg_date = date('d-i-Y');
    $card_no = $conn->real_escape_string($_POST["card_no"]);
    $card_security_no = $conn->real_escape_string($_POST["card_security_no"]);
    $exp_date = $conn->real_escape_string($_POST["exp_date"]);
    $card_amt = $conn->real_escape_string($_POST["card_amt"]);
    $pin = $conn->real_escape_string($_POST["pin"]);
    $amt = $conn->real_escape_string($_POST["amt"]);

    $sql = "SELECT amt,cardno,securityno,name,pin FROM `card`  where user_id='$user_id' limit 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            if ($row["cardno"] == $card_no && $row["securityno"] == $card_security_no && $row["name"] == $card_name && $row["pin"] == $pin) {
                $sql = "UPDATE  `card` SET  `amt` =  '$amt' WHERE  `cardno` ='$card_no';";
                if ($conn->query($sql)) {
                    echo "successfully";
                    $sql = "INSERT INTO `log` ( `tick_id`, `user_id`, `agent_id`, `transaction_type`,`rate`) VALUES ( '$card_no', '$user_id', '0', 'recharge acc', '$card_amt');";
                    $conn->query($sql);
                    return;
                }
            }

            echo "Invalid Card Details";
            return;
        }
    }
    $sql = "INSERT INTO `card` 
        ( `user_id`, `name`, `cardno`, `securityno`, `bankname`, `amt`,`pin`, `exp_date`) 
        VALUES ( '$user_id', '$card_name', '$card_no', '$card_security_no', '', '$card_amt','$pin', '$exp_date');";
    if ($conn->query($sql) === TRUE) {
        echo "successfully";
        $sql = "INSERT INTO `log` ( `tick_id`, `user_id`, `agent_id`, `transaction_type`,`rate`) VALUES ( '$card_no', '$user_id', '0', 'recharge acc', '$card_amt');";
        $conn->query($sql);
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>



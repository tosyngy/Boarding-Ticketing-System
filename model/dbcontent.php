<?php

//ob_start();
//session_start();

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
$id = 0;
if(isset($_SESSION["id"]))
$id = $_SESSION["id"];
else
 $_SESSION["adminid"];   
$bal = array();
$ticket = array();
$route = array();
$card = array();
$log = array();

$conn = connection();
if (isset($_SESSION["adminid"]))
    $sql = "SELECT tick_owner,tick_id,`tick_start_route`, `tick_end_route` , accumulator, use_accumulator,amt,unit_amt,reg_date,last_use_date,id FROM ticket order by reg_date, last_use_date";
else
    $sql = "SELECT tick_owner,tick_id,`tick_start_route`, `tick_end_route` , accumulator, use_accumulator,amt,unit_amt,reg_date,last_use_date,id FROM ticket where user_id='{$_SESSION['id']}' order by reg_date, last_use_date";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        array_push($ticket, $row);
    }
}
$sql = "SELECT * FROM reg_route where status=0";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        array_push($route, $row);
    }
}
$sql = "SELECT * FROM card where user_id=$id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        array_push($bal, $row);
    }
}
$sql = "SELECT `name`,`cardno`,`amt`,`exp_date` FROM `card` order by id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        array_push($card, $row);
    }
}
if (isset($_SESSION["adminid"])) {
    $sql = "SELECT `tick_id`,`user_id`,`rate`,`log_time` FROM `log` WHERE `agent_id`='{$_SESSION["adminid"]}' and `transaction_type`='use ticket' order by log_time";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($log, $row);
        }
    }
}
//print_r($log);



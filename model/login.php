<?php

//ob_start();
session_start();

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

if (isset($_GET["login"])) {
    $username = $_POST["usr"];
    $password = $_POST["pwd"];
    $conn = connection();
    if ($_GET["login"] == "adminlogin" || $_GET["login"] == "adminsignup") {
        $table = "login";
        $usr = "username";
    } else {
        $table = "registration";
        $usr = "email";
    }
    if ($_GET["login"] == "adminlogin" || $_GET["login"] == "login") {

        $sql = "SELECT id FROM $table WHERE $usr='$username' AND password='$password'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

                if ($_GET["login"] == "adminlogin")
                    $_SESSION["adminid"] = $row["id"];
                else
                    $_SESSION["id"] = $row["id"];
                $_SESSION["username"] = $username;
                echo $result->num_rows;
            }
        } else {
            echo "0";
        }
    } else if ($_GET["login"] == "signup") {
        $sql = "SELECT id FROM $table WHERE $usr='$username'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo '2';
            return;
        } else {
            insertIntoDB();
        }
    } else {
        session_destroy();
    }
}

function insertIntoDB() {
    $conn = connection();
    $surname = $conn->real_escape_string($_POST["firstname"]);
    $othernames = $conn->real_escape_string($_POST["othernames"]);
    $address = $conn->real_escape_string($_POST["address"]);
    $email = $conn->real_escape_string($_POST["usr"]);
    $mobileno = $conn->real_escape_string($_POST["mobileno"]);
    $password = $conn->real_escape_string($_POST["pwd"]);
    $sql = "INSERT INTO `registration` (id, `firstname`, `othernames`, `email`, `mobileno`, `address`,`password`) VALUES ('null', '$surname', '$othernames', '$email', '$mobileno', '$address', '$password');";
    if ($conn->query($sql) === TRUE) {
        $sql = "SELECT id FROM registration WHERE email='$email' AND password='$password'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $_SESSION["id"] = $row["id"];
                $_SESSION["username"] = $email;
                echo $result->num_rows;
            }
        } else {
            echo "0";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
<?php

//ob_start();
session_start();
if (!isset($_SESSION["adminid"])) {
    header("Location: index.php");
}
?>
<?php
ob_start();
session_start();
if (isset($_SESSION["adminid"])) {
    header("Location: ../index.php");
}
?>

<!DOCTYPE html>
<html>

    <head>

        <meta charset="UTF-8">

        <title>My Ticket My World | Admin | Log-in</title>
        <script src="../js/jquery2.1.3.min.js"></script>
        <script src='../jqueryUI/jquery-ui.js'></script>
        <link rel='stylesheet' href="../jqueryUI/jquery-ui.css" />
        <link rel='stylesheet' href="../bootstrap/css/bootstrap.css" />

        <link rel="stylesheet" href="../index/css/style.css" media="screen" type="text/css" />
        <link rel="stylesheet" href="../font-awesome/css/font-awesome.css" media="screen" type="text/css" />

    </head>

    <body>

        <div class="login-card">
            <h1><b>My Ticket My World</b> <br/> <small>Admin Login</small></h1>
            <h5>fill the field below to sign in/up</h5><br />
            <form enctype="multipart/form-data" id="post_form4">
                <input type="text" name="user" placeholder="Username" required=""/>
                <input type="password" name="pass" placeholder="Password" required=""/>
                <button type="submit" name="login" class="login login-submit btn-primary" style="width: 100%">
                    Login
                </button>
                <div style="margin: auto;font-style: italic; text-align: center">
                <!--<input type="button" name="signup" class="login register-submit btn-warning" value="sign up">-->
                    <span class="alert-danger in-pass shownot">Invalid Login details</span>
                    <span class="alert-danger in-require shownot">Please, supply username and password</span>
                    <span class="alert-warning up-pass shownot">User id not allow, choose a new one</span>
                    <span class="alert-success login-success shownot">Login Successfully</span>
                </div>
            </form>

            <div class="login-help">
                <!--<a href="#">Register</a> • <a href="#">Forgot Password</a>-->
            </div>
        </div>

<!-- <div id="error"><img src="https://dl.dropboxusercontent.com/u/23299152/Delete-icon.png" /> Your caps-lock is on.</div> -->



    </body>

    <script>
        $(function () {
            $("form").submit(function (e) {
                return false;
                //   e.preventDefault();
            });
            $("form").click(function (e) {
                return false;
                //   e.preventDefault();
            });
            $("[name=login], [name=signup]").click(function (e) {
                $(".in-require").slideUp();
                var whr = "login";
                $(".login-success").hide();
                $(".in-pass").hide();
                $(".up-pass").hide();
                if ($("[name=user]").val().length == 0) {
                    $("[name=user]").focus();
                    $("[name=user]").select();
                    $(".in-require").slideDown();
                    return;
                }
                if ($("[name=pass]").val().length == 0) {
                    $("[name=pass]").focus();
                    $("[name=pass]").select();
                    $(".in-require").slideDown();
                    return;
                }
                if ($(this).attr("name") === "login") {
                    whr = "adminlogin";
                } else if($(this).attr("name") === "signup") {
                    whr = "adminsignup";
                }
                $.post("../model/login.php?login="+whr,
                {
                    usr: $("[name=user]").val(),
                    pwd: $("[name=pass]").val()
                },
                function (data) {
                    if (data === "0") {
                        $(".in-pass").slideDown();
                    } else if (data === "1") {
                        $(".login-success").slideDown();
                        $(location).attr("href","../index.php");
                    } else if (data === "2") {
                        $(".up-pass").slideDown();
                    }else{
                        // alert("your lock code is: "+data+" \nmake sure you secure it, this is your real access to your file");
                        $(".in-pass").slideDown();
                    }
                    // return false;
                })
                e.preventDefault();
            });

            $(".up-pass, .login-success, .in-pass, .in-require").mousemove(function () {
                $(this).fadeOut();
            })
        })
    </script>
</html>
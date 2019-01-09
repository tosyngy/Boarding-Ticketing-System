<?php
error_reporting(0);
ob_start();
session_start();
$ip = "https://tosyngy.000webhostapp.com/";

if (isset($_POST['process'])) {
    require_once 'model/main.php';
}

if (!isset($_SESSION["username"])) {
    $_SESSION["ticket"] = $_GET['ticket'];
    header("Location: agent/index.php");
    return exit;
}
if (isset($_GET['ticket']) || isset($_SESSION["ticket"])) {
    require_once 'model/preview.php';
}
$value = $ticket;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Ticket | Preview</title>
        <meta name="description" content="">
         <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <link media="all" rel='shortcut icon' type='image/x-icon' href='favicon.ico' />
        <link media='all' rel="apple-touch-icon-precomposed" href="apple-touch-icon-precomposed.png">
        <link media='all' href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link media='all' href="font-awesome/css/font-awesome.css" rel="stylesheet">
        <link media='all' rel="stylesheet" href="css/normalize.min.css">
        <link media='all' rel="stylesheet" href="css/main.css"> 
        <link media='all' rel='stylesheet' href="jqueryUI/jquery-ui.css" />
        <script src="js/jquery2.1.3.min.js"></script>
        <script src='bootstrap/js/bootstrap.js'></script> 
        <script src="jqueryUI/jquery-ui.min.js"></script>



<!--        <script src="js/vendor/jquery.hashchange.min.js"></script>
        <script src="js/vendor/jquery.easytabs.min.js"></script>-->

        <script src="js/jquery.dataTables.js"></script>
        <script type="text/javascript" src="js/qrcode.js"></script>


        <script src="js/main.js"></script>
        <!--[if lt IE 9]>
            <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
            <script>window.html5 || document.write('<script src="js/vendor/html5shiv.js"><\/script>')</script>
            <![endif]-->
    </head>
    <body>
        <!--<div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >-->
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-center">
<!--                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    -->
                    <?php
                    if (isset($_SESSION["adminid"])) {
                        echo '<h2>Agent Confirmation Page</h2>';
                    }
                    ?>
                    <h4 class="modal-title"><?php echo $value["tick_id"]; ?></h4>
                </div>
                <div class="modal-body">
                    <div id="tab-container" class="tab-container">
                        <div id="tab-data-wrap">
                            <!-- About Tab Data -->
                            <div id="about">
                                <section class="clearfix">
                                    <div class="g3" style="text-align: center">

                                        <div class="col-md-12 col-sm-12 ">
                                            <div class=" col-md-12 col-sm-12" style="text-align: center">
                                                <div class="main-links sidebar" style="margin: auto">

                                                    <div id="qrcode<?php echo $value['id']; ?>" style="width:100%; height:auto; margin-top:15px;margin: auto"></div>
                                                </div>
                                            </div>
                                            <!--                                                                                        <div class="photo col-md-12 col-sm-12" style="float: left">
                                                                                                                                                <img src="uploads/<?php echo $value["pix"]; ?>" alt="<?php echo $value["name"]; ?>" />
                                                                                                                                            </div>-->

                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="col-md-12 col-sm-12 ">
                                            <div class="info">
                                                <h2>
                                                    <?php echo "<span style='text-transform:uppercase'>" . $value["surname"] . "</span><br /><span style='text-transform:capitalize'> " . $value["othernames"] . "</span>"; ?>
                                                </h2>
                                                <h4>
                                                    <?php echo $value["unit"]; ?>
                                                </h4>
                                                <p>
                                                    <?php echo $value["qoute"]; ?>
                                                </p>
                                            </div>
                                        </div>


                                    </div>


                                    <div class="break"></div>
                                    <div class="contact-info">
                                        <div class="g3">
                                            <div class="item-box clearfix">
                                                <i class="icon-envelope"></i>
                                                <div class="item-data">
                                                    <p>Name: </p>
                                                    <h3> <?php echo $value["tick_owner"]; ?></h3>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="g1">
                                            <div class="item-box clearfix">
                                                <i class="icon-facebook"></i>
                                                <div class="item-data">
                                                    <p>Quantity: </p>
                                                    <h3><?php echo $value["accumulator"]; ?></h3>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="g1">
                                            <div class="item-box clearfix">
                                                <i class="icon-twitter"></i>
                                                <div class="item-data">
                                                    <p>Used Quantity:</p> 
                                                    <h3><?php echo $value["use_accumulator"]; ?></h3>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="g1">
                                            <div class="item-box clearfix">
                                                <i class="icon-twitter"></i>
                                                <div class="item-data">
                                                    <p>Remaining Quantity:</p>  
                                                    <h3><?php echo $value["accumulator"] - $value["use_accumulator"]; ?></h3>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="g1">
                                            <div class="item-box clearfix">
                                                <i class="icon-envelope"></i>
                                                <div class="item-data">
                                                    <p>Route: </p>
                                                    <h3> <?php echo $value["tick_start_route"] . ' - ' . $value["tick_end_route"]; ?></h3>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="g1">
                                            <div class="item-box clearfix">
                                                <i class="icon-facebook"></i>
                                                <div class="item-data">
                                                    <p>Register Date: </p> 
                                                    <h3><?php echo $value["reg_date"]; ?></h3>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="g1">
                                            <div class="item-box clearfix">
                                                <i class="icon-envelope"></i>
                                                <div class="item-data">
                                                    <p>Lastly Use On: </p>
                                                    <h3> <?php echo $value["last_use_date"]; ?></h3>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="g3">
                                            <div class="item-box clearfix">
                                                <i class="icon-twitter"></i>
                                                <div class="item-data">
                                                    <p>Tick ID</p> 
                                                    <h3><?php echo $value["tick_id"]; ?></h3>

                                                </div>
                                            </div>
                                        </div>
                                        <?php if (isset($_SESSION["adminid"])) { ?>

                                            <div class="g3">
                                                <div class="item-box clearfix">
                                                    <i class="icon-twitter"></i>
                                                    <div class="item-data">
                                                        <?php
                                                        if (isset($_SESSION["adminid"])) {
                                                            ?>
                                                            <form action=""  method="post">
                                                                <input type="number" class="form-control " name="acc" placeholder="Require No of Ticket for Journey" max="<?php echo $value["accumulator"] - $value["use_accumulator"]; ?>" min="1"/>
                                                                <input type="hidden" class="form-group" value="<?php echo $_GET['ticket'] ?>" name="tick_id">
                                                                <input type="hidden" class="form-group" value="<?php echo $value["use_accumulator"]; ?>" name="use_acc">
                                                                <input type="submit" class="btn btn-default " name="process" value="Proceed"/>
                                                            </form>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>  <?php
                                                }
                                                    ?>
                                    </div>

                                </section><!-- content -->
                            </div>
                            <!-- End About Tab Data -->

                        </div>
                    </div>

                    <aaa ccc="<?php echo $my_id ?>" ></aaa>
                     <!--<input type="hidden"  id="code" value="http://inatia.org/mybiodata/index.php?user=<?php echo $_SESSION["id"] ?>">-->
                    <input type="hidden"  id="code<?php echo $value['id']; ?>" value="<?php echo $ip; ?>/myticketmyworld/ticket.php?ticket=<?php echo $value['tick_id'] ?>">

                </div>
                <div class="modal-footer">


                    <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                    <a href="" class="btn btn-default" id="savecode<?php echo $value['id']; ?>" style="text-align: center">Print</a>

              <!--<button type="button" class="btn btn-primary save_changes" sn="<?php echo $value['id']; ?>" >Save changes</button>-->
                </div>
            </div><!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
        <!--</div> /.modal -->
        <style>
            #about img{
                margin: auto !important;
            }
        </style>
        <script type="text/javascript">
            var qrcode = new QRCode(document.getElementById("qrcode<?php echo $value['id']; ?>"), {
                width : 200,
                height : 200
            });

            function makeCode () {		
                var elText = document.getElementById("code<?php echo $value['id']; ?>")
                                                                                                                                                                                                                                                                                                            	
                if (!elText.value) {
                    alert("Input a text");
                    elText.focus();
                    return;
                }
                                                                                                                                                                                                                                                                                                            	
                qrcode.makeCode(elText.value);
            }

            makeCode();

            $("#text").
                on("blur", function () {
                makeCode();
            }).
                on("keydown", function (e) {
                if (e.keyCode == 13) {
                    makeCode();
                }
            });
            $(function(){
                $("#savecode<?php echo $value['id']; ?>").click(function(e){
                    var mymodal="#myModal<?php echo $value['id']; ?>";
                    print();
                    //  $(this).attr("href", pix)
                    e.preventDefault();
                })
            })                                                    
                                                                                                                                                                                                                                                                   
            $(function(){
                $("#myModal").modal();
            })                                                                                                                                                                                                                                                                       
                                                                                                                                                                                                                                                                                                       
        </script>

    </body>
</html>

<?php
ob_start();
session_start();
$ip = "https://tosyngy.000webhostapp.com";

//if (isset($_GET['user'])) {
//    require_once 'model/preview.php';
//} else {

if (!isset($_SESSION["username"])) {
    header("Location: index/index.php");
}
require_once 'model/dbcontent.php';
//print_r($ticket);
//}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php if (isset($_SESSION["adminid"])) echo "Admin" ?> Ticket | Welcome Page</title>
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
    <body class="bg-fixed bg-1">
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
            <![endif]-->
        <div class="main-container">
            <div style="    background: #fcf8e3;
                 width: 100%;
                 text-align: center;
                 color: #f0ad4e;">
                <div style="text-align: center;font-size: 2.125em;"><b><?php if (isset($_SESSION["adminid"])) echo "Admin" ?> Ticket Page</b></div>
                <span>Your Ticket to anywhere ...</span>
                <div style="text-align: center">
                    <p> Welcome <?php echo $_SESSION['username']; ?></p>
       <!--<small><a href="save.php" style="position: relative; right: 0px;font-size: 0.725em;padding: 20px;">Add New</a></small>-->
                </div>


            </div>
            <div class="main wrapper clearfix">


                <!-- End Tab Container -->
                <div class="text-info text-center bg-danger">
                    <!--                    <h5> Please Verify the information Below</h5>-->

                    <?php if (!isset($_SESSION["adminid"])) { ?>
                        <h6>Your Account Balance is : #<span id="bal"><?php
                    if (!empty($bal) && $bal[0]['amt'] != "") {
                        echo $bal[0]['amt'];
                    } else {
                        echo "0";
                    }
                        ?> </span> </h6>
                    <?php }
                    ?> 
                </div>

                <div style="margin-left: auto;margin-top: 50px;text-align: center; height: 400px;">           
                    <div class="title " style="padding: 5px; margin-top: 20%; text-align: center">
                        <h4>
                            Action Menu
                        </h4>
                    </div>

                    <div style="margin: 10px 0" class="col-md-4 col-xs-12" data-toggle="modal" data-target="#buy_tick">
                        <button type="button" class="btn btn-lg  btn-warning" id="buy_ticket" style="width: 100%;height: 100px">
                            <?php
                            if (!isset($_SESSION["adminid"])) {
                                echo 'Buy Ticket';
                            } else {
                                echo 'My Confirmed Ticket';
                            }
                            ?>
                        </button>

                    </div>
                    <div style="margin: 10px 0" class="col-md-4 col-xs-12" data-toggle="modal" data-target="#top_up">
                        <button type="button" class="btn btn-lg  btn-success" id="top_acc" style="width: 100%;height: 100px">    
                            <?php
                            if (!isset($_SESSION["adminid"])) {
                                echo 'Recharge';
                            } else {
                                echo 'Registered Cards';
                            }
                            ?> </button>

                    </div>
                    <div style="margin: 10px 0" class="col-md-4 col-xs-12" data-toggle="modal" data-target="#tick_his">
                        <button type="button" class="btn btn-lg  btn-primary" id="ticket_history" style="width: 100%;height: 100px">Ticket History</button>

                    </div>



                    <!-- Modal -->
                    <div class="modal fade" id="buy_tick" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-warning">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                                    <h4 class = "modal-title" id = "myModalLabel">  
                                        <?php
                                        if (!isset($_SESSION["adminid"])) {
                                            echo 'Buy Ticket';
                                        } else {
                                            echo 'Tickets Confirmed By Me';
                                        }
                                        ?></h4>
                                </div>
                                <?php if (!isset($_SESSION["adminid"])) { ?>

                                    <form enctype="multipart/form-data" method="post" id="post_form">
                                        <div class="modal-body">

                                            <section class="clearfix">
                                                <div class="form-group">
                                                    <!--<label for="name">Full Name</label>-->
                                                    <input type="text" class="form-control" name="name"  placeholder="Full name" required="">
                                                </div>
                                                <div class="form-group">
                                                    <!--<label for="name">Source Route</label>-->
                                                    <input type="text" class="form-control route" name="route1" auautocomplete="off" list="route"  id="route1" placeholder="Source Route" required="">
                                                </div>
                                                <div class="form-group">
                                                    <!--<label for="name">Destination Route</label>-->
                                                    <input type="text" class="form-control route" name="route2" auautocomplete="off" list="route"  id="route2" placeholder="Destination Route" required="">
                                                </div>
                                                <div class="form-group">
                                                    <!--<label for="name">Accumulator</label>-->
                                                    <input type="numbew"  max="99" maxlength="2" class="form-control" name="acc" id="acc" placeholder="No of Ticket(s)" required="">
                                                </div>
                                                <input type="hidden" class="form-control" name="ticket"  value="buy_ticket" placeholder="save">
                                                <div class="form-group">
                                                    <label id="route_amt2"></label>
                                                </div>
                                                <div class="form-group">
                                                    <label id="net_amt2"></label>
                                                </div>
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" name="route_amt"  id="route_amt" placeholder="Unit Amount">
                                                </div>
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" name="net_amt"  id="net_amt" placeholder="Net Amount">

                                                </div>
                                            </section><!-- content -->  


                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-warning"  value="">Proceed</button>
                                        </div>
                                    </form>
                                <?php } else { ?>

                                    <div style="height: 80%;overflow-y: auto; overflow-x: auto">
                                        <table id="draft" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>

                                                <tr class="active" style="padding: 10px;font-size: 16px;">

                                                    <th scope="row">S.N</th>
                                                    <th>Ticket ID</th>
                                                    <th>Buyer ID</th>
                                                    <th>Quantity</th>
                                                    <th>Period</th>
                                                </tr>
                                            </thead>
                                            <tfoot>  <tr class="active" style="padding: 10px;font-size: 16px;">

                                                    <th scope="row">S.N</th>
                                                    <th>Ticket ID</th>
                                                    <th>Buyer ID</th>
                                                    <th>Quantity</th>
                                                    <th>Period</th>
                                                </tr>
                                            </tfoot >
                                            <tbody id='cont_val'>

                                                <?php
                                                $j = 0;
//                                for ($k = 0; $k < 20; $k++)
                                                // print_r($ticket);
                                                foreach ($log as $key => $value) {
                                                    $j++;
                                                    echo " <tr class='success text-center'><td> $j</td>";
                                                    echo "<td style='text-transform:uppercase'>{$value['tick_id']}</td>";
                                                    echo "<td style='text-transform:capitalize'>{$value['user_id']}</td>";
                                                    echo "<td style='text-transform:capitalize'>{$value['rate']}</td>";
                                                    echo "<td style='text-transform:capitalize'>{$value['log_time']}</td>";
                                                    ?> 
                                                    </tr> 
                                                    <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="top_up" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form enctype="multipart/form-data" method="post" id="post_form1">

                                    <div class="modal-header bg-success">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">
                                            <?php
                                            if (!isset($_SESSION["adminid"])) {
                                                echo 'Top Up';
                                            } else {
                                                echo 'Registered Cards';
                                            }
                                            ?>
                                        </h4>
                                    </div>
                                    <?php if (!isset($_SESSION["adminid"])) { ?>

                                        <div class="modal-body">
                                            <section class="clearfix">
                                                <div class="form-group">
                                                    <!--<label for="name">Full Name</label>-->
                                                    <input type="text" class="form-control" name="card_name" id="card_name"    placeholder="Card name" required="">
                                                </div>
                                                <div class="form-group">
                                                    <!--<label for="name">Full Name</label>-->
                                                    <input type="number" class="form-control"  min="1000000000000000" min="9999999999999999" maxlength="16" name="card_no" id="card_no"  placeholder="Card No" required="">
                                                </div>
                                                <div class="form-group">
                                                    <!--<label for="name">Full Name</label>-->
                                                    <input type="number" class="form-control" maxlength="3" max="999" name="card_security_no"  id="card_security_no"  placeholder="Security No" required="">
                                                </div>
                                                <div class="form-group">
                                                    <!--<label for="name">Destination Route</label>-->
                                                    <input type="text"  class="form-control" name="exp_date" id="exp_date" maxlength="5" placeholder="Expire Date" required="">
                                                </div>
                                                <div class="form-group">
                                                    <!--<label for="name">Source Route</label>-->
                                                    <input type="number" class="form-control" name="card_amt" id="card_amt"  placeholder="Amount" required="">
                                                </div>
                                                <div class="form-group">
                                                    <!--<label for="name">Source Route</label>-->
                                                    <input type="hidden" class="form-control" name="amt" id="amt" required="">
                                                </div>
                                                <div class="form-group">
                                                    <!--<label for="name">Source Route</label>-->
                                                    <input type="number" class="form-control" name="pin" id="pin" maxlength="4" max="9999" placeholder="PIN" required="">
                                                </div>
                                                <input type="hidden" class="form-control" name="ticket"  id="ticket" value="topup"  placeholder="save">

                                                <div class="form-group">
                                                    <label id="card_warning"></label>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success"  value="Save changes">Save changes</button>
                                        </div>
                                    </form>
                                <?php } else { ?>

                                    <div style="height: 80%;overflow-y: auto; overflow-x: auto">
                                        <table id="draft" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>

                                                <tr class="active" style="padding: 10px;font-size: 16px;">

                                                    <th scope="row">S.N</th>
                                                    <th>Card Name</th>
                                                    <th>Card No</th>
                                                    <th>Balance</th>
                                                    <th>Expire Date</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr class="active" style="padding: 10px;font-size: 16px;">
                                                    <th scope="row">S.N</th>
                                                    <th>Card Name</th>
                                                    <th>Card No</th>
                                                    <th>Balance</th>
                                                    <th>Expire Date</th>
                                                </tr>
                                            </tfoot >
                                            <tbody id='cont_val'>

                                                <?php
                                                $j = 0;
//                                for ($k = 0; $k < 20; $k++)
                                                // print_r($ticket);
                                                foreach ($card as $key => $value) {
                                                    $j++;
                                                    echo " <tr class='success text-center'><td> $j</td>";
                                                    echo "<td style='text-transform:uppercase'>{$value['name']}</td>";
                                                    echo "<td style='text-transform:capitalize'>{$value['cardno']}</td>";
                                                    echo "<td style='text-transform:capitalize'>{$value['amt']}</td>";
                                                    echo "<td style='text-transform:capitalize'>{$value['exp_date']}</td>";
                                                    ?> 
                                                    </tr> 
                                                    <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="tick_his" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-danger">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Transaction History</h4>
                                </div>
                                <div class="modal-body">
                                    <div style="height: 80%;overflow-y: auto; overflow-x: auto">
                                        <table id="draft" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>

                                                <tr class="active" style="padding: 10px;font-size: 16px;">

                                                    <th scope="row">S.N</th>
                                                    <th>Tick Name</th>
                                                    <th>Tick ID</th>
                                                    <th>Ticket Route</th>
                                                    <th>Booked Acc</th>
                                                    <th>Used Acc</th>
                                                    <th>Bal Acc</th>
                                                    <th>Amount</th>
                                                    <th>View</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr class="active" style="padding: 10px;font-size: 16px;">
                                                    <th scope="row">S.N</th>
                                                    <th>Tick Name</th>
                                                    <th>Tick ID</th>
                                                    <th>Ticket Route</th>
                                                    <th>Booked Acc</th>
                                                    <th>Used Acc</th>
                                                    <th>Bal Acc</th>
                                                    <th>Amount</th>
                                                    <th>View</th>
                                                </tr>
                                            </tfoot >
                                            <tbody id='cont_val'>

                                                <?php
                                                $j = 0;
//                                for ($k = 0; $k < 20; $k++)
                                                // print_r($ticket);
                                                foreach ($ticket as $key => $value) {
                                                    $j++;
                                                    $bal_acc = $value['accumulator'] - $value['use_accumulator'];
                                                    echo " <tr class='success text-center'><td> $j</td>";
                                                    echo "<td style='text-transform:uppercase'>{$value['tick_owner']}</td>";
                                                    echo "<td style='text-transform:capitalize'>{$value['tick_id']}</td>";
                                                    echo "<td style='text-transform:capitalize'>{$value['tick_start_route']} to {$value['tick_end_route']}</td>";
                                                    echo "<td style='text-transform:capitalize'>{$value['accumulator']}</td>";
                                                    echo "<td style='text-transform:capitalize'>{$value['use_accumulator']}</td>";
                                                    echo "<td style='text-transform:capitalize'>$bal_acc</td>";
                                                    echo "<td style='text-transform:capitalize'>{$value['amt']}</td>";
                                                    ?> 

                                                <td class="file-edit-indicator shower"  title="View Information" data-toggle="modal" data-target="#myModal<?php echo $value["id"]; ?>"><i class="glyphicon glyphicon-file text-warning"></i></td>
                                                <div class="modal fade" id="myModal<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
                                                                                        <div class=" col-md-12 col-sm-12" style="float: left">
                                                                                            <div class="main-links sidebar">
                                                                                                <ul>
                                                                                                    <div id="qrcode<?php echo $value['id']; ?>" style="width:100%; height:auto; margin-top:15px;margin: auto"></div>


                                                                                                </ul>
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
                                                                                                <?php echo "<span style='text-transform:uppercase'>" . $value["tick_owner"] . "</span><br />"; ?>
                                                                                            </h2>
                                                                                            <h4>
                                                                                                <?php echo $value["tick_id"]; ?>
                                                                                            </h4>
                                                                                            <p>
                                                                                                <?php echo $value["tick_start_route"] . ' - ' . $value["tick_end_route"]; ?>
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
                                                                                        </div
                                                                                    </div>
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
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                <a href="ticket.php?ticket=<?php echo $value["tick_id"]; ?>" class="btn btn-default" id="savecode<?php echo $value['id']; ?>" style="text-align: center">Preview Print Page</a>

                                                    <!--<button type="button" class="btn btn-primary save_changes" sn="<?php echo $value['id']; ?>" >Save changes</button>-->
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal --> 
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
                var pix=$(".modal.fade.in #qrcode<?php echo $value['id']; ?> img").attr("src");
                var mymodal="#myModal<?php echo $value['id']; ?>";
                //                                alert(mymodal);
                //                                $(mymodal).
                //                                print();
                // alert(pix)
                $(location).attr("href", pix);
                //  $(this).attr("href", pix)
                e.preventDefault();
            })
        })                                                    
                                                                                                                                                                                                                                                                                                   
                                                                                                                                                                                                                                                                                                               
                                                                                                                                                                                                                                                                                                                                       
                                                </script>
                                                </tr> 
                                                <?php
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="confirm_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width: 50%;margin: auto">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Confirmation Dialog</h4>
                                </div>
                                <form enctype="multipart/form-data" method="post" id="post_formall">
                                    <div class="modal-body">

                                        <section class="clearfix">
                                            <div class="text-info text-center">
                                                <h5> Please Verify the information Below</h5>
                                            </div>
                                            <div class="text-info" id="verifier">
                                                <span id="ver">

                                                </span>
                                            </div>
                                        </section><!-- content -->  

                                        <input type="hidden" id="veri">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-warning"  value="">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>





                </div>
                <style>
                    table, td, th {
                        border: 1px solid #337ab7;
                        font-size: 12px;
                    }

                    th {
                        background-color: #337ab7 !important;
                        color: white;
                        text-align: center
                    }
                    td {
                        padding: 5px;
                    }
                    td {

                        vertical-align: bottom;
                    }
                    tr:hover + td {
                        color: #eee;
                    }
                    .main-links.sidebar img{
                        margin: auto;
                    }
                    input[type="search"] {
                        font-size: 16px;
                        border-radius: 5px;
                        height: 35px;
                        width: 80%;
                    }
                    .main{
                        padding: 0;
                    }
                    select[name='draft_length'] {
                        height: 35px;
                        border-radius: 5px;
                    }
                    a.paginate_button:after {
                        content: " ";
                    }

                </style>




                <script>
                   
                                                        
                    $(function(){                                    
                        $("#logout").click(function(e){
                            e.preventDefault();
                            $.post("model/login.php?login=logout",
                            {
                            },
                            function(data){
                                $(location).attr("href","index/index.php");
                            })
                        })
                        $(document).on("blur , keyup",".route",function(e){
                            e.preventDefault();
                            // if($(this).val().length !=0 && $(".route").not(this).val().length !=0 ){
                            var amt=$("#route_amt ."+$(this).val()+"_"+$(".route").not(this).val()).text();
                            if(amt.length !=0){
                                $("#route_amt").val(amt);  
                                $("#route_amt2").text("Route Price : "+amt);  
                            }else{
                                $("#route_amt").val("");  
                                $("#route_amt2").text("No such route");   
                            } 
                            // }
                            $("#acc").trigger("keyup");
                        })
                        $(document).on("blur , keyup","#acc",function(e){
                            e.preventDefault();
                            //  if($("#route1").val().length !=0 && $("#route2").val().length !=0 && $(this).val().length !=0 ){
                            var amt=$("#route_amt ."+$("#route1").val()+"_"+$("#route2").val()).text();
                            var acc=$("#acc").val()
                            if(amt.length !=0 && acc.length!=0){
                                $("#net_amt").val(amt*acc);  
                                $("#net_amt2").text("Total Accumulator Price : "+(amt*acc));  
                            }else{
                                $("#net_amt").val("");  
                                $("#net_amt2").text("");  
                            }  
                            //   }
                        })
                        
                        $(document).on("submit","#post_form",function(e){
                            e.preventDefault();
                            //                            alert($("#net_amt2").text()+isNaN($("#net_amt2").text()) );
                            //                            alert($("#route_amt2").text()+isNaN($("#route_amt2").text()) );
                            
                            if(!isNaN($("#net_amt2").text()) || !isNaN($("#route_amt2").text()) || isEmpty($("#net_amt2").text()) || isEmpty($("#route_amt2").text())){
                                $("#route_amt2").html("<div class='alert-warning'>Please supply valid information</div>"); 
                                return;
                            } 
                            
                            var ttt="Route: Between "+$("#route1").val()+" and "+$("#route2").val();
                            ttt+="<br />Per Unit Amount: #"+$("#route_amt").val();
                            ttt+="<br />Route Count: "+ $("#acc").val()
                            ttt+="<br />Total Amount: #"+$("#net_amt").val();
                            $("#veri").val("#post_form");
                            $("#verifier").html(ttt);
                            $("#confirm_model").modal();
                            
                           
                            
                          
                        })
                       
                        $(document).on("submit","#post_form1",function(e){
                            e.preventDefault();
                            $("#card_warning").html("");
                            if(isEmpty($("#card_no").val()) || isEmpty($("#card_security_no").val())|| isEmpty($("#card_amt").val())){
                                $("#card_warning").html("<div class='alert-warning'>Please supply valid information</div>"); 
                                return;
                            }
                            var d = new Date();
                            var mm=parseInt($("#exp_date").val().substr(0, 2));
                            var yy=parseInt($("#exp_date").val().substr(3));
                           // alert(mm+"" + yy)
                            var mm2=parseInt(d.getMonth())+1;
                            var yy2=parseInt(d.getFullYear())-2000;
                           // alert(mm2 +""+yy2)
                            if(isEmpty($("#exp_date").val()) || (mm>99 || yy>99)||(mm<1 || yy<1) ){
                                $("#card_warning").html("<div class='alert-warning'>Date format not match</div>"); 
                                return;
                            }
                            if((mm2>mm && yy2>yy) || yy2>yy){
                                $("#card_warning").html("<div class='alert-warning'>Card Date has Expire</div>"); 
                                return;
                            }
                            
                            var ttt="Card Name: "+$("#card_name").val();
                            ttt+="<br />Card No: "+$("#card_no").val();
                            ttt+="<br />Security No: "+ $("#card_security_no").val()
                            ttt+="<br />Deposit Amount: #"+$("#card_amt").val();
                            ttt+="<br />Opening Balance: #"+$("#bal").text();
                            ttt+="<br />Total Acc Bal: #"+(parseFloat($("#card_amt").val())+parseFloat($("#bal").text()));
                            $("#amt").val(parseFloat($("#card_amt").val())+parseFloat($("#bal").text()))
                            $("#veri").val("#post_form1");
                            $("#verifier").html(ttt);
                            //                            alert(ttt)
                            $("#confirm_model").modal();
                        })
                        
                        $(document).on("submit","#post_formall",function(e){
                            $.post("model/main.php",
                            $($("#veri").val()).serialize()
                            ,
                            function(data){
                                alert(data)
                                if($.trim(data)==="successfully"){
                                    $(location).attr("href","");
                                } 
                               
                            })
                            e.preventDefault();
                        })
                    })   
                    function isEmpty(val){
                        if(val.length==0)
                            return true;
                        else
                            return false;
                    }
                </script>

            </div><!-- #main -->
        </div><!-- #main-container -->
        <footer>

            <div id="logout">Logout</div>

        </footer>
    </body>
    <datalist id="route">
        <?php
        $route_acc = array();

        foreach ($route as $key => $value) {

            if (!in_array("%" . $value['route1'] . "%", $route_acc))
                echo "<option value='{$value['route1']}'>{$value['route1']}</option>";
            if (!in_array("%" . $value['route2'] . "%", $route_acc))
                echo "<option value='{$value['route2']}'>{$value['route2']}</option>";
            array_push($route_acc, "%" . $value['route1'] . "%");
            array_push($route_acc, "%" . $value['route2'] . "%");
        }
        ?>
    </datalist>
    <div id="route_amt" class="hidden">
        <?php
        $route_acc = array();
        foreach ($route as $key => $value) {
            if (!in_array($value['route1'] . '_' . $value['route2'], $route_acc)) {
                echo "<span class='{$value['route1']}_{$value['route2']}'>{$value['amount']}</span>";
                echo "<span class='{$value['route2']}_{$value['route1']}'>{$value['amount']}</span>";

                array_push($route_acc, $value['route1'] . '_' . $value['route2']);
                array_push($route_acc, $value['route2'] . '_' . $value['route1']);
            }
        }
        ?>
    </div>


</html>

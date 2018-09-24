<?php
session_start();
if(!isset($_SESSION["sh_user"]))
{
    header("Location: index.php");
}

?>
<!DOCTYPE>
<html en="lang">
<head>
<title>Dashboard</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="css/bootstrap.min.css" rel="stylesheet">
<script src="js/respond.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css"  media="all" /> 

<style>
    body{
            background: #f0f0f0;
        }
    sidebar-menu{
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            -webkit-box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
        }
        
    .box {
            background: #fff;
            margin: 0 0 30px;
            border: solid 1px #e6e6e6;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            padding: 20px;
            -webkit-box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
        }
    thead{
        background: #816943;
        border-radius: 0px;
        color: white;
    }
    .nav-pills>li.active>a:hover{
        background: #816943;
    }
    .nav-pills>li.active>a{
        background: #816943;
        border-radius: 0px;
        }
    .navbar-text {
        margin-top: 15px;
        margin-bottom: 15px;
        font-size: 20px;
        }
    a{
        color: #816943;
    }
    a:hover{
        color: #816943;
    }
    .btn-default
    {
        background: #bd7f1c;
        color: #fff;
        border-color: #bd7f1c;
    }
    .btn-default:hover
    {
        background: #bd7f1c;
        color: #fff;
        border-color: #bd7f1c;
    }
</style>
</head>
<body>
    <div class="header"> 
	     <div class="wrap">
			<div class="top-header">
				<div class="logo">
					<a href="index.html"><img src="images/logo.png" title="logo" /></a>
				</div>
				<div class="clear"> </div>
			</div>
		</div>
	</div>
    <nav class="navbar navbar-default navbar-fixed">
        <div class="navbar-header">
            <div class="navbar-text pull-right"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION["sh_user"]; ?></div>
            
        </div>
    </nav>
    
        
        <div class="col-md-12">
            <div class="col-md-3">
                <div class="panel panel-default sidebar-menu">

                    <div class="panel-heading"><span class="glyphicon glyphicon-th-large"></span> DASHBOARD</div>

                        <div class="panel-body">

                            <ul class="nav nav-pills nav-stacked">
                                <li class="active">
                                    <?php 
                                    $link = mysqli_connect("localhost", "root", "", "shake");
                                    $sql = "SELECT * FROM sh_contact";
                                    $res = mysqli_query($link,$sql);
                                    $sql1 = "SELECT * FROM sh_order";
                                    $res1 = mysqli_query($link,$sql1);
                                ?>
                                <li  class="active">
                                    <a href="dashboard.php"><i class="glyphicon glyphicon-list"></i> Requested Orders <span class="badge pull-right"><?php echo mysqli_num_rows($res1); ?></span></a>
                                </li>
                                <li>
                                    <a href="dashboard_message.php"><i class="glyphicon glyphicon-envelope"></i> Messages <span class="badge pull-right"><?php echo mysqli_num_rows($res); ?></span></a>
                                </li>
                                <?php
                                ?>
                                <li>
                                    <a href="logout.php"><i class="glyphicon glyphicon-log-out"></i> Logout</a>
                                </li>
                            </ul>
                        </div>

                </div>
            </div>
            <div class="col-md-9">
                <div class="box">
                    <p class="pull-right"><?php echo date("Y-m-d H:i:s"); ?></p>

                    <p class="lead">Received Orders</p><hr>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Date</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Company Name</th>
                                        <th>Budget (₦)</th>
                                        <th>Num of People</th>
                                        <th>Type of Function</th>
                                        <th>Prefered Menu</th>
                                        <th>Type of Service</th>
                                        <th>Details of Venue/Menu Required</th>
                                        <th>Address of Venue</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <?php
                                $link = mysqli_connect("localhost", "root", "", "shake");
                                     
                                if (isset($_POST['delete']))
                                {
                                    $deleteQuery="DELETE * FROM sh_order WHERE sh_id='".$_POST["hidden"]."'"; 
                                    mysqli_query($link, $deleteQuery);
                                    $delete= "Order successfully deleted";
                                }
                                        $sql = "SELECT * FROM sh_order";
                                        $MyData = mysqli_query($link, $sql);

                                        while($res=mysqli_fetch_array($MyData))
                                        {
                                            
                                            ?>
                                                
                                                <tbody>
                                                    <tr>
                                                        <th><?php echo $res["id"]; ?></th>
                                                        <td><?php echo date('F j, Y', $res["sh_datetime"]); ?></td>
                                                        <td><?php echo $res["sh_fullname"]; ?></td>
                                                        <td><?php echo $res["sh_email"]; ?></td>
                                                        <td><?php echo $res["sh_mobile"]; ?></td>
                                                        <td><?php echo $res["sh_companyname"]; ?></td>
                                                        <td><?php echo $res["sh_budget"]; ?></td>
                                                        <td><?php echo $res["sh_people"]; ?></td>
                                                        <td><?php echo $res["sh_function"]; ?></td>
                                                        <td><?php echo $res["sh_menu"]; ?></td>
                                                        <td><?php echo $res["sh_service"]; ?></td>
                                                        <td><?php echo $res["sh_detailsvenue"]; ?></td>
                                                        <td><?php echo $res["sh_addressvenue"]; ?></td>
                                                        <form method="post" action="dashboard.php">
                                                        <td><button name="delete" type="submit" class="btn btn-default btn-sm">Delete</button></td>
                                                        <td><input type="hidden" name="hidden" value="<?php echo $res['id']; ?>"></td>
                                                        </form>
                                                        
                                                    </tr>
                                        <?php
                                        }
                                ?>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>
        </div>
    
    
    
<script src="js/jquery.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/bootstrap.min.js"></script>    
</body>
</html>


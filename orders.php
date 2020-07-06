<?php
include 'includes/connect.php';
$user_id = $_SESSION['user_id'];

  if($_SESSION['customer_sid']==session_id())
  {
    ?>
<!DOCTYPE html>
<html>
<head>
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <title>orders</title>
</head>
<body>
 <nav class="navbar" style="background-color: red;">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="home.html">Dine & Wine</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.php">Order Food</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Orders <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li class="<?php
                if(!isset($_GET['status'])){
                    echo 'active';
                  }?>
                  "><a href="orders.php">All Orders</a>
                                </li>
            <?php
                  $sql = mysqli_query($con, "SELECT DISTINCT status FROM orders  WHERE customer_id = $user_id;;");
                  while($row = mysqli_fetch_array($sql)){
                  if(isset($_GET['status'])){
                    $status = $row['status'];
                  }
                                    echo '<li class='.(isset($_GET['status'])?($status == $_GET['status'] ? 'active' : ''): '').'><a href="orders.php?status='.$row['status'].'">'.$row['status'].'</a>
                                    </li>';
                  }
                  ?>
       </ul>
      </li>
      <li><a href="details.php">Edit details</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Orders<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="routers/logout.php">Logout</a></li>
        
        </ul>
      </li>
   </ul>
</nav>

  <!--start container-->
        <div class="container">
          <p class="caption">List of your past orders with details</p>
          <div class="divider"></div>
          <!--editableTable-->
<div id="work-collections" class="seaction">
             
          <?php
          if(isset($_GET['status'])){
            $status = $_GET['status'];
          }
          else{
            $status = '%';
          }
          $sql = mysqli_query($con, "SELECT * FROM orders WHERE customer_id = $user_id AND status LIKE '$status';;");
          echo '              <div class="row">
                <div>
                    <h4 class="header">List</h4>
                    <ul id="issues-collection" class="collection">';
          while($row = mysqli_fetch_array($sql))
          {
            $status = $row['status'];
            echo '<li class="collection-item avatar">
                              <i class="mdi-content-content-paste red circle"></i>
                              <span class="collection-header">Order No. '.$row['id'].'</span>
                              <p><strong>Date:</strong> '.$row['date'].'</p>
                              <p><strong>Payment Type:</strong> '.$row['payment_type'].'</p>
                <p><strong>Address: </strong>'.$row['address'].'</p>                
                              <p><strong>Status:</strong> '.($status=='Paused' ? 'Paused <a  data-position="bottom" data-delay="50" data-tooltip="Please contact administrator for further details." class="btn-floating waves-effect waves-light tooltipped cyan">    ?</a>' : $status).'</p>                
                '.(!empty($row['description']) ? '<p><strong>Note: </strong>'.$row['description'].'</p>' : '').'                                           
                <a href="#" class="secondary-content"><i class="mdi-action-grade"></i></a>
                              </li>';
            $order_id = $row['id'];
            $sql1 = mysqli_query($con, "SELECT * FROM order_details WHERE order_id = $order_id;");
            while($row1 = mysqli_fetch_array($sql1))
            {
              $item_id = $row1['item_id'];
              $sql2 = mysqli_query($con, "SELECT * FROM items WHERE id = $item_id;");
              while($row2 = mysqli_fetch_array($sql2)){
                $item_name = $row2['name'];
              }
              echo '<li class="collection-item">
                            <div class="row">
                            <div class="col s7">
                            <p class="collections-title"><strong>#'.$row1['item_id'].'</strong> '.$item_name.'</p>
                            </div>
                            <div class="col s2">
                            <span>'.$row1['quantity'].' Pieces</span>
                            </div>
                            <div class="col s3">
                            <span>Rs. '.$row1['price'].'</span>
                            </div>
                            </div>
                            </li>';
              $id = $row1['order_id'];
            }
                echo'<li class="collection-item">
                                        <div class="row">
                                            <div class="col s7">
                                                <p class="collections-title"> Total</p>
                                            </div>
                                            <div class="col s2">
                      <span> </span>
                                            </div>
                                            <div class="col s3">
                                                <span><strong>Rs. '.$row['total'].'</strong></span>
                                            </div>';
                if(!preg_match('/^Cancelled/', $status)){
                  if($status != 'Delivered'){
                echo '<form action="routers/cancel-order.php" method="post">
                    <input type="hidden" value="'.$id.'" name="id">
                    <input type="hidden" value="Cancelled by Customer" name="status"> 
                    <input type="hidden" value="'.$row['payment_type'].'" name="payment_type">                      
                    <button class="btn waves-effect waves-light right submit" type="submit" name="action">Cancel Order
                                              <i class="mdi-content-clear right"></i> 
                    </button>
                    </form>';
                }
                }
                echo'</div></li>';

          }
          ?>
           </ul>
                </div>
              </div>
            </div>
        </div>

     



 


</body>

</html>
<?php
  }
  else
  {
    if($_SESSION['admin_sid']==session_id())
    {
      header("location:all-orders.php");    
    }
    else{
      header("location:login.php");
    }
  }
?>
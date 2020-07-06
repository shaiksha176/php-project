<?php
include 'includes/connect.php';
$user_id = $_SESSION['user_id'];
  if($_SESSION['customer_sid']==session_id())
  {
$result = mysqli_query($con, "SELECT * FROM users where id = $user_id");
while($row = mysqli_fetch_array($result)){
$name = $row['name']; 
$address = $row['address'];
$contact = $row['contact'];
$verified = $row['verified'];
}
    ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar" style="background-color: red;">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Dine & Wine</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.php">Order Food</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Orders <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="orders.php">All Orders</a></li>
            <?php
                  $sql = mysqli_query($con, "SELECT DISTINCT status FROM orders WHERE customer_id = $user_id;");
                  while($row = mysqli_fetch_array($sql)){
                                    echo '<li><a href="orders.php?status='.$row['status'].'">'.$row['status'].'</a>
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
          <p class="caption">Provide required delivery and payment details.</p>
          <div class="divider"></div>
    
                <h4 class="header">Details</h4>
      
                <div class="card-panel">
                  <div class="row">
                    <form class="formValidate col s12 m12 l6" id="formValidate" method="post" action="confirm-order.php" novalidate="novalidate">
                      <div class="row">
                        <div class="input-field col s12">
              <label for="payment_type">Payment Type</label><br><br>
              <select id="payment_type" name="payment_type">
                  <option value="Wallet" selected>Wallet</option>
                  <option value="Cash On Delivery" <?php if(!$verified) echo 'disabled';?>>Cash on Delivery</option>              
              </select>
                        </div>
                      </div>          
                      <div class="row">
                        <div class="input-field col s12">
                          <i class="mdi-action-home prefix"></i>
              <textarea name="address" id="address" class="materialize-textarea validate" data-error=".errorTxt1"><?php echo $address;?></textarea>
              <label for="address" class="">Address</label>
              <div class="errorTxt1"></div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="input-field col s12">
                          <i class="mdi-action-credit-card prefix"></i>
              <input name="cc_number" id="cc_number" type="text" data-error=".errorTxt2" required>
              <label for="cc_number" class="">Card Number</label>
              <div class="errorTxt2"></div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="input-field col s12">
                          <i class="mdi-communication-vpn-key prefix"></i>  
              <input name="cvv_number" id="cvv_number" type="text" data-error=".errorTxt3" required>
              <label for="cvv_number" class="">CVV Number</label>               
              <div class="errorTxt3"></div>
                        </div>
                      </div>            
                      <div class="row">
                        <div class="row">
                          <div class="input-field col s12">
                            <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Submit
                              <i class="mdi-content-send right"></i>
                            </button>
                          </div>
                        </div>
                      </div>
            <?php
              foreach ($_POST as $key => $value)
            {
              if($key == 'action' || $value == ''){
                break;
              }
              echo '<input name="'.$key.'" type="hidden" value="'.$value.'">';
            }
            ?>
                    </form>
                  </div>
                </div>
              
            <div class="divider"></div>
            
        
        <!--end container-->

      </div>
    
        <div class="container">
          <p class="caption">Estimated Receipt</p>
          <div class="divider"></div>
          <!--editableTable-->
<div id="work-collections" class="seaction">
<div class="row">
<div>
<ul id="issues-collection" class="collection">
<?php
    echo '<li class="collection-item avatar">
        <i class="mdi-content-content-paste red circle"></i>
        <p><strong>Name:</strong>'.$name.'</p>
    <p><strong>Contact Number:</strong> '.$contact.'</p>
        <a href="#" class="secondary-content"><i class="mdi-action-grade"></i></a>';
    
  foreach ($_POST as $key => $value)
  {
    if($value == ''){
      break;
    }
    if(is_numeric($key)){
    $result = mysqli_query($con, "SELECT * FROM items WHERE id = $key");
    while($row = mysqli_fetch_array($result))
    {
      $price = $row['price'];
      $item_name = $row['name'];
      $item_id = $row['id'];
    }
      $price = $value*$price;
          echo '<li class="collection-item">
        <div class="row">
            <div class="col s7">
                <p class="collections-title"><strong>#'.$item_id.' </strong>'.$item_name.'</p>
            </div>
            <div class="col s2">
                <span>'.$value.' Pieces</span>
            </div>
            <div class="col s3">
                <span>Rs. '.$price.'</span>
            </div>
        </div>
    </li>';
    $total = $total + $price;
  }
  }
    echo '<li class="collection-item">
        <div class="row">
            <div class="col s7">
                <p class="collections-title"> Total</p>
            </div>
            <div class="col s2">
                <span>&nbsp;</span>
            </div>
            <div class="col s3">
                <span><strong>Rs. '.$total.'</strong></span>
            </div>
        </div>
    </li>';
    if(!empty($_POST['description']))
    echo '<li class="collection-item avatar"><p><strong>Note: </strong>'.htmlspecialchars($_POST['description']).'</p></li>';
?>
</ul>


                </div>
        </div>
                </div>
              </div>
            </div>
        </div>
        <!--end container-->

    





</body>

</html>
<?php
  }
  else
  {
    if($_SESSION['admin_sid']==session_id())
    {
      header("location:admin-page.php");    
    }
    else{
      header("location:login.php");
    }
  }
?>
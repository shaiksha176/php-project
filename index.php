<?php
include 'includes/connect.php';

$user_id = $_SESSION['user_id'];
  if($_SESSION['customer_sid']==session_id())
  {
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Index</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Logout<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="routers/logout.php">Logout</a></li>
        
        </ul>
      </li>
   </ul>
</nav>
  
  <!--start container-->
  <div class="container-fluid">
    <p class="caption">Order Your Food Here</p>
    <div class="divider"></div>
  
  <form action="place-order.php" method="post">
     <h2>ORDER</h2>
      <table id="data-table-customer" class="table responsive-table display table-hover" cellspacing="5 ">
          <thead>
             <tr>
                        <th>Name</th>
                        <th>Item Price/Piece</th>
                        <th>Quantity</th>
                      </tr>
                    </thead>

                    <tbody>
        <?php
        $result = mysqli_query($con, "SELECT * FROM items where not deleted;");
        while($row = mysqli_fetch_array($result))
        {
          echo '<tr><td>'.$row["name"].'</td><td>'.$row["price"].'</td>';                      
          echo '<td><div class="input-field col s12"><label for='.$row["id"].' class=""></label>';
          echo '<input id="'.$row["id"].'" name="'.$row['id'].'" type="text" data-error=".errorTxt'.$row["id"].'"><div class="errorTxt'.$row["id"].'"></div></td></tr>';
        }
        ?>
                    </tbody>
</table>
<div >
                              <button class="btn  right" type="submit" name="action">Order
                               
                              </button>
                            </div>
  </form>

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
      header("location:admin-page.php");    
    }
    else{
      header("location:login.php");
    }
  }
?>
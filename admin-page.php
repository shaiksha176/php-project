<?php
include 'includes/connect.php';
$user_id = $_SESSION['user_id'];

  if($_SESSION['admin_sid']==session_id())
  {
    ?>
<html>
<head>
  <title>Admin page</title>
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
          <li><a href="#">All Orders</a></li>
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
       <li ><a href="users.php">Users</a></li>        
    </ul>
    <ul class="nav navbar-nav navbar-right" style="margin-right: 4px; ">
       <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Admin<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="routers/logout.php">Logout</a></li>
        
        </ul>
      </li>
   </ul>
</nav>
  <form method="post" action="routers/menu-router.php">
          
              <div class="form-group">
                <h4 class="header">Order Food</h4>
              </div>
              <div>
        <table  class="responsive-table display table" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Item Price/Piece</th>
                        <th>Available</th>
                      </tr>
                    </thead>

                    <tbody>
        <?php
        $result = mysqli_query($con, "SELECT * FROM items");
        while($row = mysqli_fetch_array($result))
        {
          echo '<tr><td><div class="input-field col s12"><label for="'.$row["id"].'_name">Name</label>';
          echo '<input value="'.$row["name"].'" id="'.$row["id"].'_name" name="'.$row['id'].'_name" type="text" data-error=".errorTxt'.$row["id"].'"><div class="errorTxt'.$row["id"].'"></div></td>';          
          echo '<td><div class="input-field col s12 "><label for="'.$row["id"].'_price">Price</label>';
          echo '<input value="'.$row["price"].'" id="'.$row["id"].'_price" name="'.$row['id'].'_price" type="text" data-error=".errorTxt'.$row["id"].'"><div class="errorTxt'.$row["id"].'"></div></td>';                   
          echo '<td>';
          if($row['deleted'] == 0){
            $text1 = 'selected';
            $text2 = '';
          }
          else{
            $text1 = '';
            $text2 = 'selected';            
          }
          echo '<select name="'.$row['id'].'_hide">
                      <option value="1"'.$text1.'>Available</option>
                      <option value="2"'.$text2.'>Not Available</option>
                    </select></td></tr>';
        }
        ?>
                    </tbody>
</table>
              </div>
        <div class="form-group">
                  <button class="btn" type="submit" name="action">Modify</button>
        </div>
          
      </form>
      <form method="post" action="routers/add-item.php" style="margin-left: 20px;">
            <div class="row">
              <div class="form-group">
                <h4 class="header">Add Item</h4>
              </div>
              <div>
<table class="table ">
                    <thead>
                      <tr>
                        <th data-field="id">Name</th>
                        <th data-field="name">Item Price/Piece</th>
                      </tr>
                    </thead>

                    <tbody>
        <?php
          echo '<tr><td><div class="input-field col s12"><label for="name"></label>';
          echo '<input id="name" name="name" type="text" data-error=".errorTxt01"><div class="errorTxt01"></div></td>';         
          echo '<td><div class="input-field col s12 "><label for="price" class=""></label>';
          echo '<input id="price" name="price" type="text" data-error=".errorTxt02"><div class="errorTxt02"></div></td>';                   
          echo '<td></tr>';
        ?>
                    </tbody>
</table><br>
              </div>
        <div class="form-group">
                              <button class="btn" type="submit" name="action">Add</button>
                            </div>
            </div>
      </form>     
</body>
</html>
<?php
  }
  else
  {
    if($_SESSION['customer_sid']==session_id())
    {
      header("location:index.php");   
    }
    else{
      header("location:login.php");
    }
  }
?>
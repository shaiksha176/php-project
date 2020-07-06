<?php
include 'includes/connect.php';
$user_id = $_SESSION['user_id'];

$result = mysqli_query($con, "SELECT * FROM users where id = $user_id");
while($row = mysqli_fetch_array($result)){
$name = $row['name'];	
$address = $row['address'];
$contact = $row['contact'];
$email = $row['email'];
$username = $row['username'];
}
	if($_SESSION['customer_sid']==session_id())
	{
		?>
<!DOCTYPE html>
<html>

<head>
  <title>Edit details</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
    input{
      border-radius: 5px;
      width: 500px;
    }
  </style>
</head>

<body>
<nav class="navbar" style="background-color: #424242;">
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
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Out?<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="routers/logout.php">Logout</a></li>
        
        </ul>
      </li>
   </ul>
</nav>

<div class="container">
	<h2>Edit your details here</h2>

	<form  method="post" action="routers/details-router.php" >
   <div class="form-group row"> 
		<label for="username" class="control-group col-sm-2">Username</label>
		 <input  name="username" id="username" type="text"  value="<?php echo $username;?>"></div>
     <div class="form-group">
		 <label for="name" class="control-group col-sm-2">Name</label>
		  <input name="name" id="name" type="text" value="<?php echo $name;?>"></div>
      <div class="form-group">
		         <label for="email" class="control-group  col-sm-2">Email</label>  
          <input name="email" id="email" type="email" value="<?php echo $email;?>"></div>
                <div class="form-group">
                  <label for="password" class="control-group col-sm-2">Password</label>
                <input name="password" id="password" type="password"></div>
           <div class="form-group"> 
            <label for="phone"class="control-group col-sm-2">Contact</label>  
            <input name="phone" id="phone" type="number" value="<?php echo $contact;?>">

            </div>

         <div class="form-group">   
          <label for="address" class="col-sm-2">Address</label>
              
        <textarea name="address" id="address"><?php echo $address;?></textarea>
                        
          </div>               
        <button class="btn  right" type="submit" name="action">Submit</button>
						                 

                          
	</form>
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
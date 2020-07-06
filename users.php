<?php
include 'includes/connect.php';
$user_id = $_SESSION['user_id'];

	if($_SESSION['admin_sid']==session_id())
	{
		?>
<!DOCTYPE html>
<html>
<head>
	<title>Users</title>
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
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Admin<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="routers/logout.php">Logout</a></li>
        
        </ul>
      </li>
   </ul>
</nav>
<div class="container-fluid">
	<form method="post" action="routers/user-router.php">
		<div class="form-group">
			<h3>List of Users</h3>
			<table class="table">
				<thead>
					<tr>
						<th data-field="name">Name</th>
                        <th data-field="price">Email</th>
                        <th data-field="price">Contact</th>
                        <th data-field="price">Address</th>	
                        <th data-field="price">Role</th>
					</tr>
				</thead>
				 <tbody>
				<?php
				$result = mysqli_query($con, "SELECT * FROM users");
				while($row = mysqli_fetch_array($result))
				{
					echo '<tr><td>'.$row["name"].'</td>';
					echo '<td>'.$row["email"].'</td>';
					echo '<td>'.$row["contact"].'</td>';   
					echo '<td>'.$row["address"].'</td>';      					
					echo '<td><select name="'.$row['id'].'_role">
                      <option value="Administrator"'.($row['role']=='Administrator' ? 'selected' : '').'>Administrator</option>
                      <option value="Customer"'.($row['role']=='Customer' ? 'selected' : '').'>Customer</option>
                    </select></td>';
					
					
					}
				?>
                    </tbody>

			</table>

		</div>
		
	</form>
	   <button class="btn btn-primary" type="submit" name="action">Modify
                           
                              </button>
</div>
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
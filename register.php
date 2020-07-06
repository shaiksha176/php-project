<?php  
session_start(); 
if(isset($_SESSION['admin_sid']) || isset($_SESSION['customer_sid']))
{
  header("location:index.php");
}
else{
?>

 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
     <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">
    <style type="text/css">
        body{ font: 14px sans-serif; background-color: #FFF8E1;}
        .wrapper{ width: 350px; padding: 20px;
        position: absolute;left: 500px;top: 100px; }
          input{
            font-style: italic;
        }
        h2,p,label{
            color: black;
            font-family: 'Abril Fatface', cursive;
            letter-spacing: 2px;
        }
        span{
          color: green;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Sign <span> Up</span></h2>
        <p>Please <span> fill this form </span>to create an account.</p>
        <form action="routers/register-router.php" method="post">
            <div class="form-group">
                 <label for="username" class="center-align">Username</label>
                 <input name="username" id="username" type="text"  data-error=".errorTxt1" class="form-control">
         
            </div> 
             <div class="form-group">
                 <label for="name" class="center-align">Name</label>
                 <input name="name" id="name" type="text"  data-error=".errorTxt1" class="form-control">
        
            </div>    
            <div class="form-group">
              <label for="password">Password</label>
              <input name="password" id="password" type="password" data-error=".errorTxt3" class="form-control">
            </div>
            <div class="form-group">
       
            <label for="phone">Phone</label>
     
            <input name="phone" id="phone" type="number" class="form-control">
        
          
        </div>  
            <br>
            <br>
         
        
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Log <span>in</span>  here</a>.</p>
        </form>
    </div>    
</body>
</html>
<?php
}
?>
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
 
  <title>Login</title>
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

<body class="cyan">
 



  <div id="login-page" class="row" style="text-align: center;">
    <div class="col s12 z-depth-4 card-panel">
      <form method="post" action="routers/router.php" class="login-form" id="form">
        <div class="row">
          <div class="input-field col s12 center">
            <p class="center login-form-text">Login</p>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-social-person-outline prefix"></i>
            <input name="username" id="username" type="text">
            <label for="username" class="center-align">Username</label>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-action-lock-outline prefix"></i>
            <input name="password" id="password" type="password">
            <label for="password">Password</label>
          </div>
        </div>
        <div class="row">
      <a href="javascript:void(0);" onclick="document.getElementById('form').submit();"class="btn col s12">Login</a>
          </div>
          <div class="row">
          <div class="input-field col s6 m6 l6">
            <p class="margin medium-small"><a href="register.php">Register Now!</a></p>
          </div>         
        </div>
        </div>


      </form>
    </div>
  </div>



 

</body>
</html>
<?php
}
?>
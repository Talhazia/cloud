<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registration Form for CelTel Wireless</title>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
<script type="text/javascript" src="js/validation.min.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" media="screen">
<script type="text/javascript" src="js/script.js"></script>
</head>

<body>

<form class="form-signin" method="post" id="register-form">

        <h2 class="form-signin-heading">Sign Up</h2><hr />

        <div id="error">
        <!-- error will be showen here ! -->
        </div>

        <div class="form-group">
        <input type="text" class="form-control" placeholder="Username" name="username" id="username" />
        </div>

        <div class="form-group">
        <input type="email" class="form-control" placeholder="Email address" name="useremail" id="useremail" />
        <span id="check-e"></span>
        </div>

        <div class="form-group">
        <input type="password" class="form-control" placeholder="Password" name="password" id="password" />
        </div>

        <div class="form-group">
        <input type="password" class="form-control" placeholder="Retype Password" name="cpassword" id="cpassword" />
        </div>
      <hr />

        <div class="form-group">
            <button type="submit" class="btn btn-default" name="btn-save" id="btn-submit">
      <span class="glyphicon glyphicon-log-in"></span> &nbsp; Create Account
   </button>
        </div>

 </form>
 </div>
 <script src="js/bootstrap.min.js"></script>
 </body>
 </html>

<head>
	<title>Focus.in | Login</title>
<meta charset="utf-8">
<meta name="description" content="Always looking into the minds of others. Visually capturing the modern creatives.">
<meta name="keywords" content="Focus, Visual, Photography, Creative">
<meta name="viewport" content="width=device-width, initial-scale=10.">
<script src="js.js"></script>
<link rel="stylesheet" media="all" href="css/style.css">
</head>

<?php
include 'header.php'
?>
<div id="login_section">
<h2>Login</h2>
<form method="post" action="login.php">
	<input type="text" placeholder="username" name="username"/><br>
	<input type="password" placeholder="password" name="password"/><br>                 
	<input type="submit" name="submit" value="Log In"/>
	<a href="logout.php">Log Out</a>	
	<a href="../page/add-edit.phtml">Sign Up</a>	

</form>
</div>
<?php
include 'footer.php'
?>
<?php

require_once 'conn.php';

require_once 'head.php';

try
{
	$pdo = new PDO($attr, $user, $pass, $opts);
}
catch (PDOException $e)
{
	throw new PDOException($e->getMessage(), (int)$e->getCode());
}

$fail2="";

if (isset($_POST['email']) && isset($_POST['pword']))
{
	$_SESSION=[];
	$email = $_POST['email'];
	$pword = $_POST['pword'];
	//echo"'$user'";
	//echo"'$pass'"."<br>";
	/*$stmt = $pdo->prepare('SELECT ID, email, password FROM regusr WHERE email=?');
	$stmt->bindParam(1, $email, PDO::PARAM_STR, 128);
	$stmt->execute([$email]);*/
	$sql = "SELECT ID, email, pass FROM regusr WHERE email ='$email'";

    $result = $pdo->query($sql);

    if ($result->rowCount())
	{
		echo"Select successful";
		while ($row = $result ->fetch())
		{
			$pass1 = $row['pass'];
			$em = $row['email'];
			$id = $row['ID'];

			echo"'$pass1'";
			echo "'$em'";
			echo "'$id'";

			if ($pass1!=$pass || $em != $user) 
			{
				$fail2 = "Email and Password do not match";
			}
			else 
			{
				$_SESSION['userID'] = $id;
				$_SESSION['loggedin'] = true;
				$fail2="";
			}
			
			//echo 'Email: 	' .htmlspecialchars($row['email'])		."<br";
			//echo 'ID:		' .htmlspecialchars($row['ID'])		."<br>";
			//echo "why no select password";
				
		}

		
	}
	
}
		echo<<<_END
			
			<script>
			function validate(form)
			{

			fail = validateEmail(form.email.value)
			fail += validatePassword(form.pword.value)

			if (fail =="")  
			{
			return true
			}
			else 
			{
			alert(fail); 
			return false
			}
			}
			function validateEmail(field)
			{
			if (field == "") return "No Email was entered.\n"
			else if (!((field.indexOf(".") > 0) &&
			(field.indexOf("@") > 0)) ||
			/[^a-zA-Z0-9.@_-]/.test(field))
			return "The Email address is invalid.\n"
			return ""
			}
			function validatePassword(fielda)
			{
			
			if (fielda == "") return "No Password was entered.\n"
			else if (fielda.length < 6)
			return "Passwords must be at least 6 characters.\n"
			else if (!/[a-z]/.test(fielda) || ! /[A-Z]/.test(fielda) ||
			!/[0-9]/.test(fielda))
			return "Passwords require one each of a-z, A-Z and 0-9.\n"
			return ""
			
			}
			</script>
			<body>
			<span>$fail2</span>
			<form id="login" action="log.php" method="post" onsubmit="return validate(this)"> 
			<div>
			<p>
			<label>Email:</label>
			<input type ="text" name="email" id="email"></input>
			</p>
			<p>
			<label>Password</label>
			<input type ="text" id="pword" name="pword"></input>
			</p>
			<p>
			<button type="submit" name="loginbtn">Login</button> 
			</p>
			</div>
			</form>
			</body>
			</html>

		_END;
?>
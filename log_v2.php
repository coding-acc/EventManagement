<?php
require_once 'conn.php';
session_start();
/*$currenttime=time();
$diff=$currenttime-$_SESSION['timer'];
if($diff>1800)
{
	header("Location: http://localhost/log_v2.php");
//echo"Automatically logged out";
}*/

$_SESSION=[];
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
	$email = $_POST['email'];
	$pword = $_POST['pword'];
    $sql = "SELECT ID, email, pass, login_count FROM regusr WHERE email ='$email'";
    $result = $pdo->query($sql);
    if ($result->rowCount())
	{
		//echo"Select successful";
		while ($row = $result ->fetch())
		{
			$pass1 = $row['pass'];
			$em = $row['email'];
			$id = $row['ID'];

			//echo"'$pass1'";
			//echo "'$em'";
			//echo "'$id'";

			if ($pass1!=$pword || $em != $email) 
			{
				$fail2 = "Email and Password do not match";
			}
			else 
			{
				$_SESSION['userID'] = $id;
				$_SESSION['loggedin'] = true;
                $_SESSION['user'] = $em;
				$sessiontime=time();
				$_SESSION['timer']=$sessiontime;
                $test = $_SESSION['user'];
				$log_count=$row['login_count'];
				$log_count+=1;

				$sql3="UPDATE regusr SET login_count='{$log_count}' WHERE ID='{$id}'";
				$res3=$pdo->query($sql3);

				//echo"Session started at :".$_SESSION['timer']; 
				
                //$fail2 = "Login successful the user is: $test". " and the ID is: $id";
                header("Location: http://localhost/existing.php");
			}
        }
    }
}

else
{
echo<<<_A
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
		if (field == "") return "No Email was entered."
		else if (!((field.indexOf(".") > 0) &&
		(field.indexOf("@") > 0)) ||
		/[^a-zA-Z0-9.@_-]/.test(field))
		return "The Email address is invalid."
		return ""
	}
	function validatePassword(fielda)
	{
		
		if (fielda == "") return "No Password was entered."
		else if (fielda.length < 6)
		return "Passwords must be at least 6 characters."
		else if (!/[a-z]/.test(fielda) || ! /[A-Z]/.test(fielda) ||
		!/[0-9]/.test(fielda))
		return "Passwords require one each of a-z, A-Z and 0-9."
		return ""
		
	}

    </script>
    </head>
    <body>
        
    <form id="login" action="log_v2.php" method="post" onsubmit="return validate(this)"> 
    <div> <h3> Login </h3>
    <p><strong>$fail2</strong></p>
    <p>
    <label>Email:</label>
    <input type ="text" name="email" id="email"></input>
    </p>
    <p>
    <label>Password: </label>
    <input type ="text" id="pword" name="pword"></input>
    </p>
    <p>
    <button type="submit" name="loginbtn">Login</button> 
    </p>
    </div>
    </form>
    </body>
    </html>
_A;
}
?>
<?php
require_once 'conn.php';
require_once 'head.php';
session_start();
$currenttime=time();
$diff=$currenttime-$_SESSION['timer'];
if($diff>1800)
{
echo"login time exceeded";
header("Location: http://192.168.137.1/existing.php");
}
try
{
	$pdo = new PDO($attr, $user, $pass, $opts);
}
catch (PDOException $e)
{
	throw new PDOException($e->getMessage(), (int)$e->getCode());
}
$message="";
if ($_SESSION['loggedin'])
{
$user = $_SESSION['user'];
$id =$_SESSION['userID'];
$sql = "SELECT Event_name FROM usertb WHERE ID ='$id'";
$result = $pdo->query($sql);

if ($result->rowCount()) 
{
    $btncount=0;
    while ($row = $result ->fetch())
    {
        $btncount += 1;
        $event = $row['Event_name'];
    $message .="<label> Event:</label> <br> <span>{$event}</span><br><button type=\"submit\" name=\"{$event}\">Submit</button><br>";
    }

}
else $message="No projects available";

echo<<<_A
    </head>
    <body>
    <div>
    <span>Current Projects</span><br>
    <span>User: {$user} </span><br>
    </div>
    <form id="exist" action="wp1_v2.php" method="post">  
    <div>{$message}
    </div>
    
    </form>
    <div>
    <span> Click here to create a new project</span><br>
    <button onclick="window.location.href='http://localhost/wp1_v2.php';"> New Project </button>
    </div>
    <a href= http://192.168.137.1/log_v2.php>LOGOUT</a><br><br>
    </body>
    </html>
_A;
}

?>
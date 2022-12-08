<?php
//echo"wp7";
require_once 'conn.php';
require_once 'head.php';
session_start();
try
{
	$pdo = new PDO($attr, $user, $pass, $opts);
}
catch (PDOException $e)
{
	throw new PDOException($e->getMessage(), (int)$e->getCode());
}
$error="";
$currenttime=time();
$diff=$currenttime-$_SESSION['timer'];
if($diff>1800)
{
    header("Location: http://localhost/log_v2.php");
//echo"Automatically logged out";
//add go to login
}
/*if ($_SESSION['pcount']=7) 
{
    echo"Project Completed";
    header("Location: http://localhost/landing.html");
}*/
if(!$_SESSION['loggedin'])
{
    //echo"cannot enter this page";
    header("Location: http://localhost/log_v2.php");
}
if (isset($_POST['s7'])) 
{
    $rem = $_POST['reminder'];
    $t3=strtotime($rem);
    $sql="SELECT startdate FROM usertb WHERE Event_ID='{$_SESSION['event_id']}'";
    $result=$pdo->query($sql);
    while ($row=$result->fetch()) 
    {
        $compare = strtotime($row['startdate']);
        if ($t3>=$compare) 
        {
            $error="Invalid Reminder date";
        }

        else
        {
            $pubkey=$_SESSION['event_id']."pubaccess";
            $sql2="UPDATE usertb SET reminder_date='$rem', publickey='{$pubkey}' WHERE Event_ID='{$_SESSION['event_id']}'";
            $res2=$pdo->query($sql2);
            $error="";
            echo"Attempted update statement";
        }
    }

    if($error=="")
    {
        echo"Finished process updating the process coount";
        $sqlx = "UPDATE usertb SET process_count='7' WHERE Event_ID ='{$_SESSION['event_id']}'";
        $resx = $pdo->query($sqlx);
        
        $_SESSION['pcount']=7;
        mail($_SESSION['user'], "sys mail", "COMPLETED EVENT. THE PUBLIC KEY IS: {$_SESSION['event_id']}pubaccess", "From: EventSystem");
    }
}

echo<<<_M
    </head>
    <body>
    <span> <strong>STEP 7/7</strong> </span><br><br>
    <span> <strong>Instruction: </strong> Set a date to automatically send out a reminder</span><br><br>
    <span> {$error} </span>
    <form id="w7" action="wp7.php" method="post">
    <div id=main>
    <label for="reminder"> Set Reminder date: </label>
    <input type="date" name="reminder" id="reminder"><br>
    <input type="submit" name="s7" id="s7">
    </div>
    </form>
    </body>
    </html>
_M;
?>
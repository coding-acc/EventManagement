<?php
require_once 'conn.php';
require_once 'head.php';
session_start();
$currenttime=time();
$diff=$currenttime-$_SESSION['timer'];


if($diff>1800)
{
    header("Location: http://localhost/log_v2.php");
//echo"Automatically logged out";
//add go to login
}
try
{
	$pdo = new PDO($attr, $user, $pass, $opts);
}
catch (PDOException $e)
{
	throw new PDOException($e->getMessage(), (int)$e->getCode());
}
$proceed ="";
$error="";

$sqly="SELECT Event_ID, Event_name, process_count FROM usertb WHERE ID='{$_SESSION['userID']}'";
$resy=$pdo->query($sqly);

while ($rowy=$resy->fetch()) 
{
    $e=$rowy['Event_name'];
    if (isset($_POST[''.$e])) 
    {
        echo"Button name". +$_POST[''.$e];
        $_SESSION['pcount']=$rowy['process_count'];
        if ($_SESSION['pcount']>=1) 
    {
    header("Location: http://localhost/wp2.php");
    }

    }
    else
    {
        $_SESSION['pcount']=0;
    }
    //echo$_SESSION['pcount'];
    
}
//echo"Pcoess count:  ".$_SESSION['pcount'];

if (isset($_POST['s1'])) 
{
    $eventname = $_POST['event'];
    $_SESSION['main_name']=$eventname;
    $id = $_SESSION['userID'];
    $t1=strtotime($_POST['startdate']);
    $t2=strtotime($_POST['enddate']);
    
    //echo "time is :".$t1."<br>";
    
    //echo "current time is :".$currenttime;
    $diff2=$currenttime-$t1;
    $diff2=$diff2/60;
    $diff2=$diff2/60;

    $difference=$t2-$t1;
    //echo"Difference in hours: ".$diff2;
    if($difference<0)
    {
        //echo"Invalid date";
        $error="Invalid Date Selected Please try again <br>";
    }
    //check if there is an event by this name already
    else
    {
    $sql = "SELECT Event_name, ID FROM usertb WHERE Event_name ='$eventname' AND ID='$id'";
    $result = $pdo->query($sql);
    if ($result->rowCount())
    {

        $error="Event of this name already exists please try again";
       $proceed="";
    }
    else
    {
    $s_date = $_POST['startdate'];
    $e_date = $_POST['enddate'];
    $process=1;
    $_SESSION['main_start']=$t1;
    $_SESSION['main_end']=$t2;
     //$duration = $e_date - $s_date; 
     //insert duration calculation add field to table
     //insert a process count to display step project stopped at insert into table as well
    
    $stmt = $pdo->prepare('INSERT INTO usertb (Event_ID, Event_name, ID, startdate, enddate, process_count) VALUES(?,?,?,?,?,?)');
    $stmt->bindParam(1, $eventname, PDO::PARAM_INT, 25);
    $stmt->bindParam(2, $id, PDO::PARAM_STR, 11);
    $stmt->bindParam(3, $s_date, PDO::PARAM_STR, 128);
    $stmt->bindParam(4, $e_date, PDO::PARAM_STR, 128);
    $stmt->bindParam(5, $process,PDO::PARAM_STR, 11);
    $stmt->execute([NULL, $eventname, $id, $s_date, $e_date, $process]);
 
    $proceed ="GO";
    $_SESSION['pcount']=$process;
}
}
   
}
if ($proceed!="")
{
    
    $sql1 = "SELECT Event_ID FROM usertb WHERE Event_name ='$eventname' AND ID='$id'";
    $res = $pdo->query($sql1);
    while ($row = $res ->fetch())
    {
    //$event_id = $res->fetch();
    $_SESSION['event_id'] = $row['Event_ID'];
    $event_id=$_SESSION['event_id'];
    //echo $event_id;
    }
    header("Location: http://localhost/wp2.php");
}
if ($_SESSION['loggedin'])
{
    echo<<<_WP1
    <script>
    
    function validate(form)
    {
        fail = checkfields(form.event.value, form.startdate.value, form.enddate.value)
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
    function checkfields(field1, field2, field3)
    {
        if (field1==''||field2==''||field3=='')
        return "Please fill in all fields before submitting"
        else
        return "" 
    }

    </script>
    </head>
   
    <body>
    <span><strong> STEP 1/7 </strong> </span><br>
    <span>{$error}</span><br>
    <span><strong> Instruction : </strong> In this step, choose the name of the event you wish to create and the start and end date</span><br>
    <form id = "w1" action="wp1_v2.php" method="post" onsubmit="return validate(this)">
    <br>
    <div>
    <label>Event name: </label>
    <input type = "text" id="event" name ="event"></input>
    <br>
    <label>Start date: </label>
    <input type ="date" name ="startdate"></input><br>
    <label>End Date: </label>
    <input type ="date" name ="enddate"></input><br><br>
    <button type = "submit" name="s1">Submit</button>
    </div>
    </form>
    <a href= http://localhost/log_v2.php>LOGOUT</a><br><br>
    </body>
    </html>
_WP1;
    
}
else
{
    echo"</head> <body> <div> NO Login Detected</body></html>";
    header("Location: http://localhost/log_v2.php");
}





//check type of date field php?
//compare start and end date in javascript to avoid invalid date entry

?>
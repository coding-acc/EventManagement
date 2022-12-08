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
if ($_SESSION['pcount']>3) 
{
    header("Location: http://localhost/wp4_v2.php");
}
if(!$_SESSION['loggedin'])
{
    echo"cannot enter this page";
    header("Location: http://localhost/log_v2.php");
}

try
{
	$pdo = new PDO($attr, $user, $pass, $opts);
}
catch (PDOException $e)
{
	throw new PDOException($e->getMessage(), (int)$e->getCode());
}
$name = $start = $end = $msg ="";
$subevents =[];
$day=[];
$ev_id = $_SESSION['event_id'];
$sql = "SELECT Event_name, startdate, enddate FROM usertb WHERE Event_ID ='$ev_id'";
$result = $pdo->query($sql);
while ($row = $result->fetch())
    {
        $name = $row['Event_name'];
        
        $start = $row['startdate'];
        $end = $row['enddate']; 
        /*echo $name;
        echo $start;
        echo $end;*/
    }
$sql2 ="SELECT sub_event, startdate, enddate FROM subevent WHERE Event_ID = '$ev_id' AND e_day ='0'";
$result2 = $pdo->query($sql2);
$counter =0;
while($row2 = $result2->fetch())
{
    $output="";
    $sub = $row2['sub_event'];
    $sd = $row2['startdate'];
    $ed = $row2['enddate'];
    $subevents[$counter] = $sub;
    $msg .= "<br><br><span><strong>Sub Event: </strong>{$sub} </span><br>";
    $msg .= "<span><strong> Start Date: </strong>{$sd} </span>";
    $msg .= "<span></strong>End Date: </strong>{$ed} </span>";
    $msg .= "<br>";
    $sd = $row2['startdate'];
    $ed = $row2['enddate'];
    $startdate = new DateTime($sd);
    $enddate = new DateTime($ed);
    $interval = $startdate->diff($enddate);
    $days = $interval->format('%a');
    $day[$counter]=$days;
    for ($i=0; $i <=$days ; $i++) 
    { 
        $output .="<Span> Day: {$i} <br>";
        $output .= "<label> <strong>Start time : </strong></label>";
        $output .= "<input type=\"time\" name=\"s{$sub}".$i."\" min=\"00:00\" max=\"24:00\"<br>";
        $output .= "<label> <strong>End time : </strong></label>";
        $output .= "<input type=\"time\" name=\"e{$sub}".$i."\" min=\"00:00\" max=\"24:00\"</span><br>";
    }
    $msg .= $output;
    $counter+=1;
   /* $msg .= "<label>";
    $msg .= "<input type=\"text\" name=\"{$sub}\"></input><br>";*/
}
$out="";  
if (isset($_POST['s3'])) 
{
    $no_subs = count($subevents); 
    for ($j=0; $j <$no_subs ; $j++) 
    {
        $subid = $ev_id.$subevents[$j]; 
        $evename = $subevents[$j];
        $secondloop = $day[$j]; 
        for ($r=0; $r <=$secondloop; $r++) 
        { 
            $stime = $_POST['s'.$subevents[$j].$r];
            //$out .= $stime;
            $totime = strtotime($stime);
            $sqltime = date('H:i:s', $totime);
            $out .= $sqltime;
            $etime = $_POST['e'.$subevents[$j].$r];
            $totime2 = strtotime($etime);
            $sqltime2 = date('H:i:s', $totime2);
            $out .= $sqltime2;
            $sql3 = "UPDATE subevent SET starttime = '$sqltime', endtime ='$sqltime2' WHERE Event_ID ='$ev_id' AND e_day='$r' AND sub_ID='$subid'";
            /*$sqltime = "INSERT INTO subevent (Event_ID, sub_event, startdate, enddate, num_day, start_time, end_time) SELECT Event_ID, sub_event, startdate, enddate, '$r', start_time, end_time FROM subevent WHERE Event_ID ='$ev_id' AND sub_event ='$evename'";*/
            $result3 = $pdo->query($sql3);
        }
    }
    $sqlx = "UPDATE usertb SET process_count='3' WHERE Event_ID ='{$_SESSION['event_id']}'";
    $resx = $pdo->query($sqlx);
    $_SESSION['pcount']=3;
    header("Location: http://localhost/wp4_v2.php");   
}

//insert into the html fields
//what fields to use
//timer slider
//how to partititon the time

    echo<<<_P3
        <script></script>
        </head>
        <body>
        <div><span><strong>Event name:</strong> {$name} <br>
         <strong> Start date: </strong>   {$start}
         <strong> End date: </strong>{$end}</span>
        </div>
        <form id="w3" action="wp3_v2.php" method="post"> 
        <div id="container">{$msg}<br>
        
        <input type="submit" name="s3">
        </div>
        </form><br>
        <div>{$out}</div>
        </body>
        </html>
    _P3;
?>
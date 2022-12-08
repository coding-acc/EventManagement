<?php

require_once 'conn.php';
session_start();
//before performing action check if event start or end exceeded current date
//select start date and end date of main event from user tb
//receives pubkey from landing page
try
{
	$pdo = new PDO($attr, $user, $pass, $opts);
}
catch (PDOException $e)
{
	throw new PDOException($e->getMessage(), (int)$e->getCode());
}
//$testpubkey="pub1234";

$msg="";
$set=false;
if(isset($_POST['publog']))
{
$testpubkey=$_POST['pubkey'];
   

//gotten from post function

$sql="SELECT Event_ID, startdate, enddate, subevent_no From usertb WHERE publickey='{$testpubkey}'";
$result=$pdo->query($sql);

$sdate="";
$edate="";
$sub_num="";
$sub_e;
$e_id="";
while($row=$result->fetch())
{
    $e_id = $row['Event_ID'];
    $sdate = $row['startdate'];
    $edate = $row['enddate'];
    $sub_num= $row['subevent_no'];
    $_SESSION['main_s']=$sdate;
    $_SESSION['main_e']=$edate;

}
$_SESSION['ID']=$e_id;

$sql3="SELECT DISTINCT sub_event FROM subevent WHERE Event_ID='{$e_id}'";
$result3 = $pdo->query($sql3);

$counter=0;
while($row3=$result3->fetch())
{
    $msg.="<span>Event: {$row3['sub_event']}</span><br>";
    $msg.="<input type=\"radio\" id=\"event[]\" name=\"event\" value=\"{$row3['sub_event']}\"><br>";
   
}

$_SESSION['set']=false;
/*$sql2="SELECT sub_event, e_day, t_slot, starttime, endtime, duration, participants FROM infotb WHERE Event_ID='{$e_id}'";
$res = $pdo->query($sql2);

while($row2=$res->fetch())
{
    $msg.= "<span> Event: {$row2['sub_event']} <span><br>";
}*/



}

echo<<<_I
    <!DOCTYPE html>
    <html>
    <head>
    <h2><strong>PRESENTATION TIMER EVENT MANAGEMENT SOFTWARE V1.1.1 </strong></h2>
    <meta http-equiv="refresh" content="20" > 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Event Management Wizard</title>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
    crossorigin="anonymous"></script>
    <style>
			h2
			{
				font-size:25px;
				text-align: center
			}
			span
			{
				box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
				text-align: center;
				width:80%
			}
			label
			{
				display:inline-block;
				text-align:right
			}
		
			
				body
				{
					box-shadow: rgba(0, 0, 0, 0.5) 0px 3px 8px;
					background: #c0c0c0;
					padding: 10px;
					font-size: 20px
				}
				input {
					box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
					border: 2px solid blue;
					border-radius: 4px;
					cursor: pointer;
					color: #020202;
					display:inline-block;
					text-align: center;
					background: LightGray
					}
					button 
					{
						box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
						cursor: pointer;
						color: #fff;
						background: LightGray;               
						font-size: 16px;
						text-align: center
					}
					div{
						box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
						text-align: center;
						padding: 10px;
						margin: auto;
						width:63%
					}
					a{
						font-size: 16px;
						box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
						
					}
			</style>
    </head>
    <body>
    <script> 
    function update()
    {

    }
    </script>
    <form id="info" action="info.php" method="post">
    <div id="main">
    <span>{$msg}</span><br>
    <input type="submit" id="info" name="info" onclick="update()"><br>

    </div></form>
_I;

if(isset($_POST['info']))
{
    $_SESSION['set']=true;
   $t=time();
   $counter=0;
    // echo "Option Selected: ".$_POST['event'];

    $sql2="SELECT e_day, t_slot, starttime, endtime, duration, participants FROM infotb WHERE Event_ID='{$_SESSION['ID']}' AND sub_event='{$_POST['event']}'";
    $res = $pdo->query($sql2);

    while($row2=$res->fetch())
    {
        $_SESSION['sub_ev']=$_POST['event'];
        $_SESSION['day'][$counter]=$row2['e_day'];
        $_SESSION['st'][$counter]=$row2['starttime'];
        $_SESSION['ed'][$counter]=$row2['endtime'];
        $_SESSION['ptp'][$counter]=$row2['participants'];
        

    $msg.= "<span> EVENT: {$_POST['event']} </span><br>";
    $msg.= "<span> DAY : {$row2['e_day']}</span><br>";


    $msg.= "<span> TIMESLOT: {$row2['starttime']} - {$row2['endtime']} </span><br>";
    $msg.="<span> DESCRIPTION: {$row2['participants']}</span><br><br><br>";   
    //echo "event participants= ".$row2['participants'];
    $counter+=1;
    }
    $_SESSION['cout']=$counter;
   
   /* echo<<<_NEW
    <script>$("#main").html("");
   
    </script>
    <div> {$msg} </div>
    
    _NEW;*/
}
if($_SESSION['set'])
{
    date_default_timezone_set('Africa/Johannesburg');
    $current = time(); 
for ($i=0; $i <$_SESSION['cout'] ; $i++) 
{ 
    
   
   /* $sql2="SELECT e_day, t_slot, starttime, endtime, duration, participants FROM infotb WHERE Event_ID='{$_SESSION['ID']}' AND sub_event='{$_SESSION['sub_ev']}'";
    $res = $pdo->query($sql2);

    while($row2=$res->fetch())
    {
      /*  $_SESSION['sub_ev']=$_POST['event'];
        $_SESSION['day'][$counter]=$row2['e_day'];
        $_SESSION['st'][$counter]=$row2['starttime'];
        $_SESSION['ed'][$counter]=$row2['endtime'];
        $_SESSION['ptp'][$counter]=$row2['participants'];*/
        

    $msg.= "<span> <strong> EVENT: </strong>{$_SESSION['sub_ev']} </span><br>";
    $msg.= "<span><strong> DAY : </strong>{$_SESSION['day'][$i]}</span><br>";
    $t1=strtotime($_SESSION['ed'][$i]);
    $t2=strtotime($_SESSION['st'][$i]);
    $tx = strtotime($current);
    $time = date('g:i a', $current);
    $ty = strtotime($time);
    //echo"current time - ".$ty;
    //echo"DB time - ".$t1;
    //$t1=$current+15000;
    if($ty>$t1)
    {
        $msg.="<span style=\"color:red\"> TIMESLOT: {$_SESSION['st'][$i]} - {$_SESSION['ed'][$i]} </span><br><span style=\"color:red\"><strong>SESSION OVER</strong></span><br>";
    }
    else
    {
    $msg.= "<span> <strong> TIMESLOT: </strong>{$_SESSION['st'][$i]} - {$_SESSION['ed'][$i]} </span><br>";
    }
    if($ty>$t2 && $ty<$t1)
    {
        $max=$t1-$t2;
        $diff = $ty-$t1;
        $percentage =100-(-($diff/$max))*100;
        //echo"The percentage: ".$percentage;
        $msg.="<label for=\"prog[]\">Progress: </label><progress id=\"prog[]\" value=\"{$percentage}\" max=\"100\"></progress><br>";
    }
    else
    {
        $msg.="<label for=\"prog[]\">Progress: </label><progress id=\"prog[]\" value=\"0\" max=\"100\"></progress><br>";
    }
    $msg.="<span> <strong>DESCRIPTION : </strong>{$_SESSION['ptp'][$i]}</span><br><br><br>";   
    //echo "event participants= ".$row2['participants'];
    //$counter+=1;
    //}
    echo<<<_NEW
    <script>$("#main").html("");
   
    </script>
    <div> {$msg} </div>
    
    _NEW;

    $msg="";
}
/*echo<<<_END
    <script>$("#main").html("");
    let out="";
    $("#main").append("<span>{$msg}</span><br>");
    
    </script>

_END;*/

}


//echo"Event ID: " . $e_id;
echo"</body></html>";
?>
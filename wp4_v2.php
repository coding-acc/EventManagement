<?php
require_once 'conn.php';
require_once 'head.php';
session_start();

$currenttime=time();
$diff=$currenttime-$_SESSION['timer'];
if($diff>1800)
{
//echo"Automatically logged out";
header("Location: http://localhost/log_v2.php");
//add go to login
}
if ($_SESSION['pcount']>4) 
{
    header("Location: http://localhost/wp5.php");
}
try
{
	$pdo = new PDO($attr, $user, $pass, $opts);
}
catch (PDOException $e)
{
	throw new PDOException($e->getMessage(), (int)$e->getCode());
}


if(!$_SESSION['loggedin'])
{
    echo"cannot enter this page";
    header("Location: http://localhost/log_v2.php");
}



$name = $start = $end = $msg ="";
$subevents =[];
$day=[];
$info=[];
$theday=[];
$ev_id = $_SESSION['event_id'];
$sql = "SELECT Event_name, startdate, enddate FROM usertb WHERE Event_ID ='$ev_id'";
$result = $pdo->query($sql);
while ($row = $result->fetch())
    {
        $name = $row['Event_name'];
        
        $start = $row['startdate'];
        $end = $row['enddate'];
    }
$sql2 ="SELECT sub_event, startdate, enddate FROM subevent WHERE Event_ID = '$ev_id' AND e_day ='0'";
$result2 = $pdo->query($sql2);
$counter =0;
while($row2 = $result2->fetch())
{
    $sub = $row2['sub_event'];
    $sd = $row2['startdate'];
    $ed = $row2['enddate'];
    $subevents[$counter] = $sub;
    $msg .= "<span> <strong> Sub Event: </strong>{$sub} </span><br>";
    $msg .= "<span><strong> Start Date: </strong>{$sd} </span>";
    $msg .= "<span><strong>End Date: </strong>{$ed} </span>";
    $msg .= "<br>";
    $startdate = new DateTime($sd);
    $enddate = new DateTime($ed);
    $interval = $startdate->diff($enddate);
    $days = $interval->format('%a');
    $day[$counter]=$days; //stores number of days of each sub event
    $info[$counter]=$msg;
    
    //echo $subevents[$counter];
    //echo $day[$counter];
    //echo $info[$counter];
    $counter+=1; //counts number of sub events
    //echo $counter;
    
    $msg="";
    

}

if (isset($_POST['s4'])) 
{
   $num_days = $_POST['r']; //array containing num of time splits for each sub event day
   //echo"form subbed";
   //print_r($day);
   $strttimes = $_POST['strttime']; //strttimes of all time slots
   $endtimes = $_POST['endtime'];
   $_SESSION['timesplits'] = $num_days;

   
   
   //print_r($strttimes);

   //print_r($endtimes);

   //loop through every element of time splits
   //foreach element then have aloop of the length of the element
   //at each instance insert into the table: Event ID subid sub_event the time slot numbered as loop value
   //the day sotred in theday array
   //shove into tbl
   //add field for examiners here to make it easier i.e.use a check box
   //Time difference

    $subcount=0;
    $pos=0;
    $pos2=0;
    foreach ($subevents as $x)
    {
        //add to insert the description of the time slot
        //echo "sub event: ".$x;
        for($l=0; $l<=$day[$subcount]; $l++)
        {
            for($n=0; $n<$num_days[$pos]; $n++)
            { 
                //echo"Subevent: ".$x."<br>";
                //echo"Day: ".$l."<br>";
                //echo"Timeslot: ".$n."  start Value: ".$strttimes[$pos2]."<br>";
                //echo"Timeslot: ".$n."  end Value: ".$endtimes[$pos2]."<br>";
                $t1 = strtotime($strttimes[$pos2]);
                $t2 = strtotime($endtimes[$pos2]);
                $secs = $t2-$t1;
                $dur = $secs/60;
                $subid = $ev_id.$x;
                //echo "Time formatted :".$dur."<br>";
                //echo "Sub_ID: ".$subid."<br>";
                $stmt = $pdo->prepare('INSERT INTO infotb (sub_ID, Event_ID, sub_event, e_day, t_slot, starttime, endtime, duration) VALUES(?,?,?,?,?,?,?,?)'); 
                $stmt->bindParam(1, $ev_id, PDO::PARAM_STR, 11);
                $stmt->bindParam(2, $subid, PDO::PARAM_STR, 30);
                $stmt->bindParam(3, $x, PDO::PARAM_STR, 100);
                $stmt->bindParam(4, $l, PDO::PARAM_STR, 11);
                $stmt->bindParam(5, $n, PDO::PARAM_STR, 11);
                $stmt->bindParam(6, $t1, PDO::PARAM_STR, 30);
                $stmt->bindParam(7, $t2, PDO::PARAM_STR, 30);
                $stmt->bindParam(8, $dur, PDO::PARAM_STR, 30);
                $stmt->execute([$subid, $ev_id, $x, $l, $n, $strttimes[$pos2], $endtimes[$pos2], $dur]);
                $pos2+=1;
            }
            
            $pos+=1;
        }
        $subcount+=1;
       
    }
    
    
   
    $sqlx = "UPDATE usertb SET process_count='4' WHERE Event_ID ='{$_SESSION['event_id']}'";
    $resx = $pdo->query($sqlx);
    $_SESSION['pcount']=4;
   header("Location: http://localhost/wp5.php"); 
}



$_SESSION['sub_e']=$subevents;
$_SESSION['no_days']=$day; //no. of days per sub event 

    echo<<<_P4
        <script>
            
        </script>
        </head>
        <body>
        <span> <strong>STEP 4/7</strong></span><br><br>
        <span> <strong>Instructions: </strong>Choose the number of timeslots per event per day then complete the start and end times</span><br><br>
        <div><span><strong>Event name: </strong>{$name} </span><br>
        <span><strong> Start date: </strong>{$start} </span>
        <span><strong> End date: {$end} </strong></span>
        </div><br>
        
        
    _P4;
    echo "<script> var f_counter=0; console.log(f_counter); let info = []; let arr = []; let divname = []; let gen = [];</script><div id=\"main\">";
$noranges = 0;
    for ($k=0; $k<$counter; $k++) 
{  
    echo<<<_F
        <div id="container{$k}">{$info[$k]}
        </div><br>    
    _F;
    for ($j=0; $j<=$day[$k] ; $j++) 
    {
        $daynum = "Day: ".$j."<br>";
        $theday[$k]= $j;
        //echo $theday[$k];
        echo<<<_F
            <span><strong>Day: </strong>{$j} </span><br>
            <label> <strong>Number of Time Slots: </strong></label>
            <input type="range" min="1" max="25" value="1" name="r{$subevents[$k]}{$j}" id="r{$subevents[$k]}{$j}"></input><br>
            <br>
            
            <div id="d{$subevents[$k]}{$j}"></div><br>
            <script> arr [f_counter] = "r{$subevents[$k]}{$j}";
            divname [f_counter] = "d{$subevents[$k]}{$j}";
            gen [f_counter] ="{$subevents[$k]}{$j}";
            info [f_counter] ="{$info[$k]}{$daynum}";
            console.log(arr[f_counter]);
            f_counter++;
            console.log(f_counter);
            </script>        
        _F;
    }
}
echo"<div> <button onclick=\"num_events()\" id=\"btn1\">Confirm</button></div></div><br>";
/*<span><input type="time" name="s{$subevents[$k]}{$j}" min="00:00" max="24:00"</span>
<span><input type="time" name="e{$subevents[$k]}{$j}" min="00:00" max="24:00"</span><br>*/
//onsubmit=\"submitForm(); return false\" method=\"post\"
echo<<<_F2
    <script>
   
    
       
    function num_events()
        {
            let examinercheck = false;
            let participant = false;
            let out ="";
           /* if(document.getElementById("examiners").checked)
            {
                examinercheck = true;
            }
            if(document.getElementById("participants").checked)
            {
                participant = true;
            }*/
            //out += "<div id=\"formdiv\">";
            for (i=0; i<f_counter;i++)
            {
            console.log(arr[i]);
            var range = document.getElementById(arr[i]).value;
            console.log(range);
            out += "<input type=\"hidden\" id=\"r[]\" name=\"r[]\" value=\""+range+"\"";
            out += "<label>"+info[i]+"</label>";
            for (j=0; j<range; j++)
            {
                out+="<label for=\"slot_desc[]\"><strong> Time slot Description: </strong></label>";
                out +="<input type=\"text\" name=\"slot_desc[]\" id=\"slot_desc[]\"><br>";
                out += "<label for=\"strttime[]\"><strong> Time Slot Start: </strong></label>";
                out += "<input type =\"time\" name =\"strttime[]\" min=\"00:00\" max=\"24:00\"></input>";
                out += "<label for=\"endtime[]\"><strong> Time Slot End:</strong> </label>";
                out += "<input type =\"time\" name =\"endtime[]\" min=\"00:00\" max=\"24:00\"></input><br>";
               
            }
           
            $("#main2").append(out+"<br>");
            out ="";
           
            }
            document.getElementById("btn1").disabled=true
            //document.getElementById("s4").disabled=false
            out += "<input type=\"submit\" name=\"s4\" id=\"s4\">";
            $("#main2").append(out);
            $("#main").html("");
            out="";

        } 
    
    </script>
    
    <form id="w4" action="wp4_v2.php" method="post">
    <div id="main2"></div>
    </form>
    </div>
    </body>
    </html>
_F2;



//validate inside the submitform thing

?>
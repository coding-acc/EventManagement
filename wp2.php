<?php
require_once 'conn.php';
require_once 'head.php';
session_start();
$msg = "";
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
    //echo"cannot enter this page";
    header("Location: http://localhost/log_v2.php");
    
}
$currenttime=time();
$diff=$currenttime-$_SESSION['timer'];
if($diff>1800)
{
    header("Location: http://localhost/log_v2.php");
//echo"Automatically logged out";
//add go to login
}
if ($_SESSION['pcount']>2) 
{
    header("Location: http://localhost/wp3_v2.php");
}
echo"<script>let numeve=0;</script>";
if (isset($_POST['num_eve'])) {
    $numeve = $_POST['num_eve'];
    //echo"the number is {$numeve}";
    $_SESSION['subevent_no'] = $numeve;
    echo"<script>numeve={$numeve};console.log(numeve)</script>";
}
echo<<<_P2
    <script>

  

    function num_events()
    {
        var num_e = document.getElementById("range").value
        document.getElementById("btn1").disabled=true
        $("#container").html("<br>number of events: "+num_e);
        $.post('wp2.php',{ num_eve : num_e},
        function(data)
        { console.log(num_e)
            
        });
        createFields(num_e)

        
    }
    function createFields(n)
    {
        out="";
        $("#A").html("");
        for (count=1; count<=n; ++count)
        {
            out += "<label>Sub event: "+count+"</label><br>"
            out += "<input type=\"text\" name=\""+count+"\"><br>"
            out += "<label>Event start </label><br>"
            out += "<input type =\"date\" name =\"startdate"+count+"\"></input><br>"
            out += "<label>Event end </label><br>"
            out += "<input type =\"date\" name =\"enddate"+count+"\"></input><br><br>"
            console.log(out)   
        }
        $("#A").html(out+"<br><br>")
        $("#A").append("<input type=\"submit\" name=\"s2\"><br>")

    }
    function getvals()
    {
        var ranges = document.getElementById("range").value;
        $("#container").html("Number of sub-events: "+ranges);
    }
    </script>
    </head>
    <body>
    <span> STEP 2/7 </span>
    <form id="w2" action ="wp2.php" method="post" onsubmit="return validate(this)">
    <div id="A">
    <p>Select the number of sub-events required. <br> The maximum is 5 sub-events</p>
    <input type="range" min="1" max="5" value="1" id="range" onclick="getvals()"></input><br>
    <button onclick="num_events()" id="btn1">Confirm</button>
    <br>
    <div id="container">&nbsp;</div> 
    
    
    
    <input type="hidden" id="event_count" name="event_count">
    
    <br>
    
    </div>
    </form>
    
    </body>
    </html>
_P2;

if(isset($_POST['s2']))
{
    $error="";
    //user cannot reach this page if step already completed - do this using the step counter
    $stmt = $pdo->prepare('INSERT INTO subevent VALUES(?,?,?,?,?,?,?,?)');
   
    $no_event = $_SESSION['subevent_no'];
    $events=[];
    $s_date=[];
    $e_date=[];
    $e_id = $_SESSION['event_id'];
    for ($k=1; $k<=$no_event ; ++$k) 
    {
       $start=$_POST['startdate'.$k];
       $t1=strtotime($start);
       $ending=$_POST['enddate'.$k];
       $t2=strtotime($ending);
       if($t1>$_SESSION['main_end'] || $t1<$_SESSION['main_start'] || $t2>$_SESSION['main_end'] || $t2<$_SESSION['main_start'])
       {
        $error="Invalid date entry";
        echo"Invalid Date Detected please try again";

       }
    }
    if($error=="")
    {
    for ($i=1; $i<=$no_event ; ++$i) 
    {
        
        //$label1 = "startdate"+$i;
         
         $events[$i]=$_POST[$i];
         echo $events[$i];
         $s_date[$i]=$_POST['startdate'.$i];    
         echo $s_date[$i];
         $e_date[$i]=$_POST['enddate'.$i];
         echo $e_date[$i];
         $startdate = new DateTime($s_date[$i]);
         $enddate = new DateTime($e_date[$i]);
         $interval = $startdate->diff($enddate);
         $no_days= $interval->format('%a');
         $subid = $e_id.$events[$i]; 
         for ($r=0; $r <=$no_days; $r++) 
         { 
            $stmt->bindParam(1, $subid, PDO::PARAM_STR, 30);
            $stmt->bindParam(2, $e_id, PDO::PARAM_STR, 11);
            $stmt->bindParam(3, $i, PDO::PARAM_STR, 11);
            $stmt->bindParam(4, $events[$i], PDO::PARAM_STR, 30);
            $stmt->bindParam(5, $s_date, PDO::PARAM_STR, 128);
            $stmt->bindParam(6, $e_date, PDO::PARAM_STR, 128);
            $stmt->execute([$subid, $e_id, $events[$i], $r, $s_date[$i], $e_date[$i], NULL, NULL]);
         }
         
         //create table and insert
    }
    $sql = "UPDATE usertb SET subevent_no = '$no_event', process_count='2' WHERE Event_ID ='$e_id'";
    $result = $pdo->query($sql);
    $_SESSION['pcount']=2;
    header("Location: http://localhost/wp3_v2.php");
}
}
?>
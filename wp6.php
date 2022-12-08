<?php
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
$currenttime=time();
$diff=$currenttime-$_SESSION['timer'];
if ($_SESSION['pcount']>6) 
{
    header("Location: http://localhost/wp7.php");
}
if(!$_SESSION['exist_ex_mail']&&!$_SESSION['exist_p_mail'])
{
    $sqlx = "UPDATE usertb SET process_count='6' WHERE Event_ID ='{$_SESSION['event_id']}'";
    $resx = $pdo->query($sqlx);
    $_SESSION['pcount']=6;
    header("Location: http://localhost/wp7.php");
}
if(isset($_POST['s6']))
{
    $_SESSION['pcount']=6;
    $daytrack=0;
    $track2=0;
    $track3=0;
    $fieldcount=0;
    $fieldspersub=[];
    $subid="";
    $ex_mail_pday=[];
    $examinertrack=0;

   if($_SESSION['exist_ex_mail'] && $_SESSION['exist_p_mail']) 
   {
    echo"using first if";
    foreach ($_SESSION['sub_e'] as $index2=>$val2)
    {
        $subid=$_SESSION['event_id'].$val2;
        echo "subsession is: ".$val2."<br>";

        for ($m=0; $m <$_POST['num_fields'] ; $m++) 
        { 
           // echo"The field is : ".$_POST['fields_per_sub'][$fieldcount]."<br>";
            $fieldspersub[$m] = $_POST['fields_per_sub'][$fieldcount];
            $fieldcount+=1;
        }
        for($n=0; $n<=$_SESSION['no_days'][$index2];$n++)
        {
            for($f=0;$f<$_SESSION['num_ex_perday'][$daytrack];$f++)
            {
                //echo "The examiner email is : ".$_SESSION['ex_mail'][$examinertrack]."<br>";
                $ex_mail_pday[$f]=$_SESSION['ex_mail'][$examinertrack];
                $examinertrack+=1;
            }
            echo"The day is :".$n."<br> num of time splits = ".$_SESSION['timesplits'][$daytrack]."<br>";
            for ($k=0; $k <$_SESSION['timesplits'][$daytrack] ; $k++) 
            { 

                echo"The time slot is : ".$k." <br> the number of participants per slot is : ".$_SESSION['num_p_p_slot'][$track2];
                for ($l=0; $l<$_SESSION['num_p_p_slot'][$track2] ; $l++) 
                {
                   // echo "The participant is :".$_SESSION['p_email'][$track3]."<br>";

                   foreach ($fieldspersub as $key=>$value)
                   {
                    echo"Insert Field :".$value." <br> for participant :> ".$_SESSION['p_email'][$track3]."<br>";
                        foreach($ex_mail_pday as $key3=>$val3)
                        {
                            echo"Examined by examiner : ".$val3."<br>";
                            $stmt = $pdo->prepare('INSERT INTO examiners (Event_ID, subid, Examiner, timeslot, participant_mail, field) VALUES(?,?,?,?,?,?)'); 
                            $stmt->bindParam(1, $_SESSION['event_id'], PDO::PARAM_STR, 11);
                            $stmt->bindParam(2, $subid, PDO::PARAM_STR, 30);
                            $stmt->bindParam(3, $val3, PDO::PARAM_STR, 100);
                            $stmt->bindParam(4, $k, PDO::PARAM_STR, 11);
                            $stmt->bindParam(5, $_SESSION['p_email'][$track3], PDO::PARAM_STR, 150);
                            $stmt->bindParam(6, $value, PDO::PARAM_STR, 150);
                            $stmt->execute([$_SESSION['event_id'], $subid, $val3, $k, $_SESSION['p_email'][$track3], $value]);
                        }
                }
                    
                    $track3+=1;

                }
                $track2+=1;
            }
            $daytrack+=1;
        }
    }
   }

   else if(!$_SESSION['exist_ex_mail'] && $_SESSION['exist_p_mail']) 
   {
    foreach ($_SESSION['sub_e'] as $index2=>$val2)
    {
        $subid=$_SESSION['event_id'].$val2;
        echo "subsession is: ".$val2."<br>";

        for ($m=0; $m <$_POST['num_fields'] ; $m++) 
        { 
           // echo"The field is : ".$_POST['fields_per_sub'][$fieldcount]."<br>";
            $fieldspersub[$m] = $_POST['fields_per_sub'][$fieldcount];
            $fieldcount+=1;
        }
        for($n=0; $n<=$_SESSION['no_days'][$index2];$n++)
        {
            /*for($f=0;$f<$_SESSION['num_ex_perday'][$daytrack];$f++)
            {
                //echo "The examiner email is : ".$_SESSION['ex_mail'][$examinertrack]."<br>";
                $ex_mail_pday[$f]=$_SESSION['ex_mail'][$examinertrack];
                $examinertrack+=1;
            }*/
            echo"The day is :".$n."<br> num of time splits = ".$_SESSION['timesplits'][$daytrack]."<br>";
            for ($k=0; $k <$_SESSION['timesplits'][$daytrack] ; $k++) 
            { 

                echo"The time slot is : ".$k." <br> the number of participants per slot is : ".$_SESSION['num_p_p_slot'][$track2];
                for ($l=0; $l<$_SESSION['num_p_p_slot'][$track2] ; $l++) 
                {
                   // echo "The participant is :".$_SESSION['p_email'][$track3]."<br>";

                   foreach ($fieldspersub as $key=>$value)
                   {
                    echo"Insert Field :".$value." <br> for participant :> ".$_SESSION['p_email'][$track3]."<br>";
                       // foreach($ex_mail_pday as $key3=>$val3)
                        //{
                            //echo"Examined by examiner : ".$val3."<br>";
                            $stmt = $pdo->prepare('INSERT INTO examiners (Event_ID, subid, timeslot, participant_mail, field) VALUES(?,?,?,?,?)'); 
                            $stmt->bindParam(1, $_SESSION['event_id'], PDO::PARAM_STR, 11);
                            $stmt->bindParam(2, $subid, PDO::PARAM_STR, 30);
                            //$stmt->bindParam(3, $val3, PDO::PARAM_STR, 100);
                            $stmt->bindParam(3, $k, PDO::PARAM_STR, 11);
                            $stmt->bindParam(4, $_SESSION['p_email'][$track3], PDO::PARAM_STR, 150);
                            $stmt->bindParam(5, $value, PDO::PARAM_STR, 150);
                            $stmt->execute([$_SESSION['event_id'], $subid, $k, $_SESSION['p_email'][$track3], $value]);
                        //}
                }
                    
                    $track3+=1;

                }
                $track2+=1;
            }
            $daytrack+=1;
        }
    }
   }
   
   $sqlx = "UPDATE usertb SET process_count='6' WHERE Event_ID ='{$_SESSION['event_id']}'";
   $resx = $pdo->query($sqlx);
   $_SESSION['pcount']=6;
   header("Location: http://localhost/wp7.php");

   //update process count
}

if($diff>1800)
{
echo"Automatically logged out";
header("Location: http://localhost/log_v2.php");
//add go to login
}
if(!$_SESSION['loggedin'])
{
    echo"cannot enter this page";
    header("Location: http://localhost/log_v2.php");
}

echo"<script>let totaldays = []; let count=0; let timespl = []; let sub_e_name=[]; let day_tag = []; </script>";
foreach ($_SESSION['sub_e'] as $key=>$value)
{
    echo"<script> sub_e_name [count]=\"{$value}\"; console.log(sub_e_name[count]);count++;</script>";
}
echo "<script> count=0;</script>";

foreach ($_SESSION['no_days'] as $key2=>$value2) //day per subevent
{
    
    //echo "no_days var: ".$value2;
    echo"<script>totaldays[{$key2}]= {$value2}; console.log(\"This is total days\"+totaldays[{$key2}]); </script>";
   for ($i=0; $i <=$value2 ; $i++) 
   { 
    echo"<script> day_tag[count]=\"{$i}\"; console.log(\" Day: \"+day_tag[count]); count++;</script>";
   }//day per subevent
}

echo<<<_W6
    <script>
    var num_fields=0;
        function checkboxes()
        {
            if(document.getElementById("rubric").checked)
            {
                $("#initial").html("<label for=\"r_fields\"> <strong>How many fields required? </strong></label><input type=\"range\" max=\"15\" min=\"1\" value=\"1\" id=\"r_fields\" name=\"r_fields\"><button onclick=\"checkrange()\">Confirm</button>");
               
            }
            else
            {
                $("#initial").html("<span>Proceeding to next page</span>"); 
            }
        }
        function checkrange()
        {
            var out="";
            num_fields = document.getElementById("r_fields").value;
            console.log("number of rubric fields :"+num_fields);
            $("#initial").html("");
            $("#main").append("<input type=\"hidden\" name=\"num_fields\" id=\"num_fields\" value=\""+num_fields+"\">");

            for(i=0; i<sub_e_name.length;i++)
            {
                console.log ("sub event: "+sub_e_name[i]);
                console.log("insert the rubric fields of for each sub_event");
                out+="<span> <strong>Event :</strong>"+sub_e_name[i]+"</span><br><br>";
                for (j=0;j<num_fields;j++)
                {
                    out+= "<label for=\"fields_per_sub[]\"><strong> Field Label :</strong>"+j+" : </label>";
                    out+="<input type=\"text\" name=\"fields_per_sub[]\" id=\"fields_per_sub[]\"></input><br>";
                }
                $("#main").append(out+"<br>");
                
                out="";
            }

            $("#main").append("<input type=\"submit\" name=\"s6\"></input></form>");
        }
        
    </script>
    </head>
    <body>
    
    <span> <strong>STEP 6/7</strong></span><br>
    <span><strong>Instruction: </strong>Choose whether you would like to create a form or not</span><br><br>
    <div id="initial">
    <span><br>
    <label for="rubric"><strong> would you like a form to capture data based on events and time slots: </strong></label> 
    <input type="checkbox" id="rubric" name="rubric" value="YES"></span>
    <button onclick="checkboxes()" id="btn1">Confirm</button>
    </div>
    <form id="wp6" action="wp6.php" method="post">
    <div id="main">
    </div>
    </form> 
    <p style="font-size:8px">Max = 15 fields</p>
    </body>
    </html>
_W6;
//different participants
//different field per event


?>
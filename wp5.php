<?php
require_once 'conn.php';
require_once 'head.php';
session_start();

$currenttime=time();
$diff=$currenttime-$_SESSION['timer'];
$_SESSION['exist_ex_mail']=false;
$_SESSION['exist_p_mail']=false;

if ($_SESSION['pcount']>5) 
{
    header("Location: http://localhost/wp6.php");
}

try
{
	$pdo = new PDO($attr, $user, $pass, $opts);
}
catch (PDOException $e)
{
	throw new PDOException($e->getMessage(), (int)$e->getCode());
}

if (isset($_POST['s5']))
{
    $daytrack=0;
    $ex_emails="";
    $track2=0;
    $e_id = $_SESSION['event_id'];
    $p_mail="";
    $track3=0;
    $subid="";
    
  /* echo "number of days subevent 1:". $_SESSION['no_days'][0];

    echo "posted <br>";*/




   if (isset($_POST['ex_email'])) 
   {
    $_SESSION['exist_ex_mail']=true;
    $_SESSION['ex_mail']= $_POST['ex_email'];
    $num_examiners_perday = $_POST['e_r'];
    $_SESSION['num_ex_perday']=$_POST['e_r'];;
    /*foreach ($num_examiners_perday as $val1)
    {
        echo "Examiners per day: ".$val1;
    }*/
    foreach ($_SESSION['sub_e'] as $index=>$val)
    {
       $subid= $e_id.$val;
        for($n=0; $n<=$_SESSION['no_days'][$index];$n++)
        {
            echo "The day is : ".$_SESSION['no_days'][$index]."<br> The number of examiners is: ".$_POST['e_r'][$daytrack] ."<br>";
            for ($k=0; $k<$_POST['e_r'][$daytrack] ; $k++) 
            { 
                $ex_emails .=$_POST['ex_email'][$track2].",";
                $track2+=1;
            }
            echo "The Emails for day: ".$_SESSION['no_days'][$index]." are as follows : ".$ex_emails;
            for ($j=0; $j <$_SESSION['timesplits'][$daytrack] ; $j++) 
            { 
                echo"The time split :".$j." for Day: ".$_SESSION['no_days'][$index]." of event: ".$val." is: ".$_SESSION['timesplits'][$daytrack]."<br>";
                //put in examiner detail for each time split - this however corresponds to the day i.e. examiners are unique to the day but must be updated per ts in the table
                
                $sql0 ="UPDATE infotb SET co_hosts='$ex_emails' WHERE sub_ID='$subid' AND e_day = '$n' AND t_slot='$j'";
                $res = $pdo->query($sql0);
            }
            $ex_emails="";
            $daytrack+=1;
        }
    
       /* $exam_email = $_POST['ex_email'];
        $imploded_email = implode(",", $exam_email);
        echo"combined record: ".$imploded_email;*/
    }
    }

    $daytrack=0;
    $track2=0;

    if (isset($_POST['p_email'])) 
    {
        $_SESSION['exist_p_mail']=true;
        $_SESSION['p_email'] = $_POST ['p_email'];
        $_SESSION['num_p_p_slot']= $_POST['p_r'];
        /*$participant_email = $_POST['p_email'];
        $imploded_p_mail = implode(",", $participant_email);
        echo"combined record: ".$imploded_p_mail;

        $num_p_per_ts = $_POST['p_r'];
        foreach ($num_p_per_ts as $val2) 
        {
            echo "Num participants per time slot = ".$val2;
        }*/
        foreach ($_SESSION['sub_e'] as $index2=>$val2)
        {
            $subid= $e_id.$val2;
            //echo "subsession is: ".$val2."<br>";
            for($n=0; $n<=$_SESSION['no_days'][$index2];$n++)
            {
                //echo"The day is :".$n."<br>";
                for ($k=0; $k <$_SESSION['timesplits'][$daytrack] ; $k++) 
                { 
                    //echo" Number of participants for timeslot: ".$k."<br> is : ".$_POST['p_r'][$track2];
                    for ($l=0; $l<$_POST['p_r'][$track2] ; $l++) 
                    { 
                        $p_mail .= $_POST['p_email'][$track3].",";
                        $track3+=1;
                    }
                    $sql1 ="UPDATE infotb SET participants='$p_mail' WHERE sub_ID='$subid' AND e_day = '$n' AND t_slot='$k'";
                    $res1 = $pdo->query($sql1);
                    //echo " emails for timeslot: ".$k."<br> is : ".$p_mail;
                    $track2+=1;
                    $p_mail="";
                }
                $daytrack+=1;
            }
            
    }

    }

    
    $sqlx = "UPDATE usertb SET process_count='5' WHERE Event_ID ='{$_SESSION['event_id']}'";
    $resx = $pdo->query($sqlx);
    $_SESSION['pcount']=5;
    header("Location: http://localhost/wp6.php");
    
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
$num_sub_events = count($_SESSION['sub_e']);
$timesplit = count($_SESSION['timesplits']);
//echo $num_sub_events;
//echo"<br>";
//echo $timesplit;
foreach ($_SESSION['timesplits'] as $key3=>$value3) //day per subevent
{
   echo"<script>timespl[{$key3}]= {$value3}; console.log(\"number ts: \"+timespl[{$key3}]);</script>";
}
echo<<<_P5
    <script>
    let checkex = false;
    let checkpt = false;

    function checkranges()
    {
        var a=[];
        out="";
        let counter=0;
        let counterb=0;
        var num_examiners = document.getElementsByName('e[]');
        for(l=0; l<num_examiners.length; l++)
        {
            a[l]=num_examiners[l].value
            //console.log("Num examiners: "+a[l]);
        }
        var b = [];
        var num_participants_persplit = document.getElementsByName('p[]');
        for(h=0; h<num_participants_persplit.length; h++)
        {
            b[h]=num_participants_persplit[h].value
            console.log("Num participants per split "+h+": "+b[h]);
        }

        if(checkex && checkpt)
            { 
                checkex=true;
                checkpt=true;
                $("#b").html("");
                $("#main").html("");
               
                for(i=0; i<sub_e_name.length; i++)
                {
                    
                    for (n=0; n<=totaldays[i]; n++)
                    {
                        out="";
                        out+= "<span> <strong>Event: </strong>"+sub_e_name[i]+"<br> <strong>Day: </strong>"+day_tag[counter]+"</span><br>";
                        out+="<input type=\"hidden\" id=\"e_r[]\" name=\"e_r[]\" value=\""+a[counter]+"\">";
                        
                        for(m=0; m<a[counter]; m++)
                        {

                            out+="<label><strong> Examiner Field: </strong>"+m+" </label>";
                            out+="<input type=\"text\" name=\"ex_email[]\" id=\"ex_email[]\"></input><br><br>";
                           
                        }
                    
                        for (k=0; k<timespl[counter]; k++)
                        {
                            out+="<input type=\"hidden\" id=\"p_r[]\" name=\"p_r[]\" value=\""+b[counterb]+"\"";   
                            for(j=0; j<b[counterb]; j++)
                            {
                                out+= "<span><strong>Participant: </strong>"+j+" <br> <strong> Event: </strong>"+sub_e_name[i]+"<br><strong> Day: </strong>"+day_tag[counter]+"<br> <strong>Timeslot : </strong>"+k+"</span><br>";
                                out+="<input type=\"text\" name=\"p_email[]\" id=\"p_email[]\"></input><br><br>";
                                
                            }
                            counterb++;
                        }
                    $("#main2").append(out+"<br>");
                    out="";
                    counter++;
                    }                  
                }
                $("#main2").append("<br><input type=\"submit\" name=\"s5\"></form>");
                counter=0;
            }
           
            else if(checkpt&& !checkex)
            {
                checkpt=true;
                $("#b").html("");
                $("#main").html("");
                
                for(i=0; i<sub_e_name.length; i++)
                {
                    for (n=0; n<=totaldays[i]; n++)
                    {
                        out="";
                        console.log("Number of time splits for day: " +n+ " : "+timespl[counter]);
                        out+="<input type=\"hidden\" id=\"e_r[]\" name=\"e_r[]\" value=\""+a[counter]+"\">";
                        for (k=0; k<timespl[counter]; k++)
                        {
                            out+="<input type=\"hidden\" id=\"p_r[]\" name=\"p_r[]\" value=\""+b[counterb]+"\"";
                            console.log("participants per split: "+b[counterb]);
                            for(j=0; j<b[counterb]; j++)
                            {
                                out+= "<span><strong> Participant: </strong>"+j+" <br><strong> Event: </strong>"+sub_e_name[i]+"<br> <strong> Day: </strong>"+day_tag[counter]+"<br> <strong> Timeslot </strong>:"+k+"</span><br>";
                                out+="<input type=\"text\" name=\"p_email[]\" id=\"p_email[]\"></input><br><br>";
                                
                            }
                        counterb++;
                        }
                        $("#main2").append(out+"<br>");
                        counter++;
                    }
                    
                }
                $("#main2").append("<input type=\"submit\" name=\"s5\"></input></form>");
            }

            else if(checkex && !checkpt)
            {
                checkex=true;
                $("#b").html("");
                $("#main").html("");
                
                for(i=0; i<sub_e_name.length; i++)
                {
                    for (n=0; n<=totaldays[i]; n++)
                    {
                        out="";
                        console.log ("total days ofr sub event: "+sub_e_name[i]+" :"+totaldays[i]);
                        console.log("value of a array: "+a[counter]);
                        out+="<input type=\"hidden\" id=\"e_r[]\" name=\"e_r[]\" value=\""+a[counter]+"\">";
                        for (k=0; k<a[counter]; k++)
                        {
                            
                        console.log("ranges for examiners per day: "+a[counter]);
                        out+= "<span><strong>Examiner: </strong>"+k+" <br> <strong>Email: </strong>"+sub_e_name[i]+" <br> <strong> Day: </strong>"+day_tag[counter]+"</span><br>";
                        out+="<input type=\"text\" name=\"ex_email[]\" id=\"ex_email[]\"></input><br><br>";
                        
                        }
                        counter++;
                        console.log("counter: "+counter);
                        $("#main2").append(out+"<br>");
                        
                    }                   
                }
                $("#main2").append("<br><input type=\"submit\" name=\"s5\"></input></form>");
            }
    }





    function checkboxes()
    {
        let out="";
        let out2="";
        let counter2=0;
        let counter3=0;
        
        if(document.getElementById("examiners").checked && document.getElementById("participants").checked)
            { 
                checkex=true;
                checkpt=true;
                $("#b").html("");
                $("#main").html("");
                for(i=0; i<sub_e_name.length; i++)
                {
                    
                    for (n=0; n<=totaldays[i]; n++)
                    {
                    out+= "<span><strong>Number of examiners for Event: </strong>"+sub_e_name[i]+"<br> <strong>Day: </strong>"+day_tag[counter2]+"</span><br>";
                    out+="<input type=\"range\" min=\"1\" max=\"5\" value=\"1\" name=\"e[]\" id=\"e[]\"></input><br>";
                    for (k=0; k<timespl[counter2]; k++)
                    {
                        out+= "<span><strong>Number of participants for Event: </strong>"+sub_e_name[i]+"<br> <strong> Day: </strong>"+day_tag[counter2]+"<br> <strong>Timeslot :</strong>"+k+"</span><br>";
                        out+="<input type=\"range\" min=\"1\" max=\"10\" value=\"1\" name=\"p[]\" id=\"p[]\"></input><br>";
                    }
                    $("#main").append(out+"<br>");
                    out="";
                    counter2++;
                    }
                   
                }
                $("#b").html("<button onclick=\"checkranges()\" id=\"btn2\">Submit</button>");
                counter2=0;
            }
           
            else if(document.getElementById("participants").checked && !document.getElementById("examiners").checked)
            {
                checkpt=true;
                $("#b").html("");
                $("#main").html("");
                for(i=0; i<sub_e_name.length; i++)
                {
                    for (n=0; n<=totaldays[i]; n++)
                    {
                    for (k=0; k<timespl[counter2]; k++)
                    {
                        out+= "<span><strong>Number of participants for Event: </strong>"+sub_e_name[i]+"<br><strong> Day: </strong>"+day_tag[counter2]+"<br><strong> Timeslot :</strong>"+k+"</span><br>";
                        out+="<input type=\"range\" min=\"1\" max=\"10\" value=\"1\" name=\"p[]\" id=\"p[]\"></input><br>";
                    }
                    $("#main").append(out);
                    out="";
                    counter2++;
                    }
                    
                }
                $("#b").html("<button onclick=\"checkranges()\" id=\"btn2\">Submit</button>");
            }

            else if(document.getElementById("examiners").checked && !document.getElementById("participants").checked)
            {
                checkex=true;
                $("#b").html("");
                $("#main").html("");
                for(i=0; i<sub_e_name.length; i++)
                {
                    for (n=0; n<=totaldays[i]; n++)
                    {
                    out+= "<span><strong>Number of examiners for Event: </strong>"+sub_e_name[i]+" <br> <strong>Day: </strong>"+day_tag[counter2]+"</span><br>";
                    out+="<input type=\"range\" min=\"1\" max=\"5\" value=\"1\" name=\"e[]\" id=\"e[]\"></input><br>";
                    counter2++;    
                    }
                    
                }
                
                $("#main").append(out);
                out="";
                $("#b").html("<br><button onclick=\"checkranges()\" id=\"btn2\">Submit</button>");
            }

    }
    </script>
    </head>
    <body>
    <span><strong>STEP 5/7</strong></span><br>
    <span> <strong>Instruction: </strong>Choose whether you would like to add participants or co-hosts to your event then complete their details </span><br><br>
    
    <div id="main"><span> <strong>Check the box if you would require cohosts/examiners/judges etc. Selecting will enable their details to be filled in. A maximum of five variables are definable per day for this field!! </strong></span><br><br>
        <input type="checkbox" id="examiners" name="examiners" value="YES"> 
        <label for="examiners"> I would like to include this field </label><br><br>
        <br>
        <span><strong> Check the box if you would require participants etc. Selecting will enable their details to be filled in. This variable is definable per time slot chosen!!</strong></span><br>
        <input type="checkbox" id="participants" name="participants" value="YES">
        <label for="participants"> I would like to include participants for the time slots</label><br><br>
        
       </div> <div id="b"> <span><strong>!!!WARNING: Skipping this step will render you unable to create a document for recording data</strong></span><br><button onclick="checkboxes()" id="btn1">Confirm</button><br><a href= http://localhost/wp6.php>SKIP STEP</a></div>
    <form id="w5" action="wp5.php" method="post">
    
    <div id="main2">
    </div>
    </form>
    <p syle="font-size:8px">Max Examiners=5 and Max participants=15</p>
    </body>
    </html>
_P5;


?>
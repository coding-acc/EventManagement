<?php
require_once 'conn.php';

$timezone = date_default_timezone_get();
echo $timezone; //current server timezone

$date ="". date('d/m/Y', time());

echo"current date: ".$date;
try
{
	$pdo = new PDO($attr, $user, $pass, $opts);
}
catch (PDOException $e)
{
	throw new PDOException($e->getMessage(), (int)$e->getCode());
}

$sql="SELECT Event_ID, reminder_date, startdate FROM usertb";
$result = $pdo->query($sql);

while ($row = $result->fetch())
    {
        $e_id = $row ['Event_ID'];
        $rem_date = $row['reminder_date'];
        if ($date==$rem_date) 
        {
            $sql2 = "SELECT DISTINCT participant_mail FROM examiners WHERE Event_ID='$e_id'";
            $result2 = $pdo->query($sql2);
            while ($row2 = $result2->fetch())
            {
                mail($_POST['participant_email'], "sys MAIL", "REMINDER!! YOUR EVENT IS SCHEDULED".$_POST['startdate'], "From: EventSystem");
            }
            $sql3 = "SELECT DISTINCT Examiner FROM examiners WHERE Event_ID='$e_id'";
            $result3 = $pdo->query($sql3);
            while ($row3 = $result3->fetch())
            {
                mail($_POST['Examiner'], "sys mail", "REMINDER!! YOUR EVENT IS SCHEDULED".$_POST['startdate'], "From: EventSystem");
            }

        }

    }
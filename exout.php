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

$msg="";
$txtfile="";
$sql="SELECT participant_mail, field, mark, comment FROM examiners WHERE subid='{$_SESSION['exkey']}' AND Examiner='{$_SESSION['exmail']}'";
$result=$pdo->query($sql);
$msg.="<span> <strong> Examiner: </strong> {$_SESSION['exmail']}</span><br>";
$txtfile .= "Examiner: {$_SESSION['exmail']}";
while ($row = $result->fetch())
{
    $txtfile .= "FIELD: {$row['field']}";
    $txtfile .= "FIELD: {$row['participant_mail']}";
    $txtfile .= "FIELD: {$row['mark']}";
    $txtfile .= "FIELD: {$row['comment']}";
    $msg.="<span> <strong>FIELD: </strong> {$row['field']} </span><br>";
    $msg.="<span> <strong>PARTICIPANT: </strong> {$row['participant_mail']} </span><br>";
    $msg.="<span> <strong>MARK: </strong> {$row['mark']} </span><br>";
    $msg.="<span> <strong>COMMENT: </strong> {$row['comment']} </span><br><br>";
}


echo<<<_M
    </head>
    <body>
    <div>{$msg}
    </div>
    <form id="exout" action="txtf.php" method="post">
    <span><strong>Generate TextFile</strong> </span><br>
    <input type="hidden" name="txt" id="txt" value="{$txtfile}">
    <input type="submit" id="exo" name="exo">
    </form>
    </body>
    </html>
_M;
?>
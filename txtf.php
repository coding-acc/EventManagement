<?php
if (isset($_POST['exo'])) 
{
    $data="";
    if (isset($_POST['txt'])) 
    {
    echo"FILE SET".$_POST['txt'];    
    $data=$_POST['txt'];
}
    
$file = "new.txt";
$txt = fopen($file, "w") or die("Unable to open file!");
fwrite($txt, $data);
fclose($txt);
header('Content-Description: File Transfer');
header('Content-Disposition: attachment; filename='.basename($file));
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($file));
header("Content-Type: text/plain");
readfile($file);
}
?>
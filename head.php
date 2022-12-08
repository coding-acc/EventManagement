<?php
require_once 'conn.php';

echo<<<_H
    <!DOCTYPE html>
    <html>
    <head>
    <h2>PRESENTATION TIMER EVENT MANAGEMENT SOFTWARE v1.1.1<br></h2>
    
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
    

_H;
$msg="";
if (isset($_SESSION['user'])) 
{
    $user_s = $_SESSION['user'];
    $loggedin = TRUE;
    $msg = "User: $user_s";
}

?>
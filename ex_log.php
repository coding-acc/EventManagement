<?php
require_once 'head.php';
require_once 'conn.php';
session_start();
echo<<<_MAIN
    </head>
    <body>
        <form id="ex1" action="ex.php" method="post">
        <div> <label for="exmail"> Your Email: </label>
        <input type="text" id="exmail" name="exmail"><br>
        <label for="exkey"> Your KEY: </label>
        <input type="text" id="exkey" name="exkey"><br>
        <input type="submit" id="exlog" name="exlog"><br>
        </div>
        </form>
    </body>
    </html>
_MAIN;
?>
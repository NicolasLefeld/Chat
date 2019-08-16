<?php
include("../mysqli.php");

if (MySQLDB::getInstance()->query("UPDATE usr SET status = 0 WHERE idUsr = '" . $_SESSION['idUsr'] . "'")){
    $_SESSION['logeo'] = 0;

    echo 1;
}else{
    echo 0;
}
<?php

date_default_timezone_set("Asia/Calcutta");

include_once('config.php');
include_once('func/func.php');
include_once('func/validations.php');
include_once('func/duplicate_check.php');
include_once('func/unique_code_generator.php');
include_once('func/member_func.php');
include_once('func/room_func.php');

$mysql_connect = NEW MySQLi(DB_HOST, DB_USER, DB_PASS, DB_NAME);

?>
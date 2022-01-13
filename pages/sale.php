<?php
session_start();
include('../config.php');
include('../functions.php');

$appFunction = new ApplicationFunction();
$result = $appFunction->checkCurrentLoginUser();

$appFunction->backupDatabase();
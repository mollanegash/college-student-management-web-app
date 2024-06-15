<?php
require_once('database.php');

session_destroy();  
header("location:login.php"); 
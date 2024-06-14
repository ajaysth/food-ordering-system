<?php
require_once('config.php');
$google->revokeToken($_SESSION['token']);

session_destroy();
header('Location:index.php');

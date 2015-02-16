<?php
 include('Logger.php');
session_start();
Logger::configure('../../includes/config.xml');
$tempid = 'sandip';
$log = Logger::getLogger($tempid);
$log->warn("foo");
$log->info("bar");
$log->info("baz");
 ?>
<?php

include_once ("includes/class/DBConnection.php");
include_once ("includes/class/Track.php");

$track = new Track();

$articleNo = $_GET['a'];
$issueNo = $_GET['i'];
$andarAcct = $_GET['n'];
$ipAddress = $track->getRealIpAddr();

$url = $track->recordClick($issueNo,$articleNo,$andarAcct,$ipAddress);

header("Location: ".$url);

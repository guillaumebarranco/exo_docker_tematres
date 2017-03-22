<?php

$DBCFG["DBdriver"] 	= "mysqli";
$DBCFG["Server"]   	= getenv('MYSQL_SERVER');
$DBCFG["DBName"]   	= getenv('MYSQL_DATABASE');
$DBCFG["DBLogin"]  	= getenv('MYSQL_USER');
$DBCFG["DBPass"] 	= getenv('MYSQL_PASSWORD');
$DBCFG["DBprefix"] 	= "lc_";
$DBCFG["DBcharset"] = "utf8";
$DBCFG["debugMode"] = "0";

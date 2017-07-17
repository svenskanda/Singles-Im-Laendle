<?php

$facebook_appid = '';
$facebook_appsecret = '';

$sql_connect_host = ';

# what is your Mysql database server
$database_host = "";

# what is the name of the database we are using
$database_name = "";

# who do we log in as?
$database_user = "";

# and what password do we use
$database_password = '';

/* mysql.inc */

function Sql_Connect($host,$user,$password,$database) {
  if ($host && $user)
    $db = mysql_connect($host , $user ,$password );
  $errno = mysql_errno();
  if (!$errno) {
    $res = mysql_select_db($database,$db);
    $errno = mysql_errno();
  }
  if ($errno) {
    switch ($errno) {
      case 1049: # unknown database
        print 'unknown database, cannot continue';
        exit;
      case 1045: # access denied
        print 'Cannot connect to database, access denied. Please contact the administrator';
        exit;
      case 2002:
        print 'Cannot connect to database, Sql server is not running. Please contact the administrator';
        exit;
      case 1040: # too many connections
        print 'Sorry, the server is currently too busy, please try again later.';
        exit;
      case 0:
        break;
      default:
        print mysql_error();
    }
    print "Cannot connect to Database, please check your configuration";
    exit;
  }
  if (!$db) {
    print "Cannot connect to Database, please check your configuration";
    exit;
  }
  return $db;
}

function Sql_Query($query,$ignore = 0) {
/*
  if (isset($GLOBALS['lastquery'])) {
    unset($GLOBALS['lastquery']);
  }
  if (isset($GLOBALS["developer_email"])) {
    # time queries to see how slow they are, so they can
    # be optimized
    $now =  gettimeofday();
    $start = $now["sec"] * 1000000 + $now["usec"];
    $GLOBALS['lastquery'] = $query;
  }
  $GLOBALS["pagestats"]["number_of_queries"]++;
*/
  $result = mysql_query($query,$GLOBALS["database_connection"]);
/*
  if (!$ignore) {
    if (Sql_Check_Error($GLOBALS["database_connection"]))
      dbg("Sql error in $query");
  }
  if (isset($GLOBALS["developer_email"])) {
    # log time queries take
    $now = gettimeofday();
    $end = $now["sec"] * 1000000 + $now["usec"];
    $elapsed = $end - $start;
    if ($elapsed > 300000) {
      $query = substr($query,0,200);
      sqllog(' ['.$elapsed.'] '.$query,"/tmp/phplist-sqltimer.log");
    }
  }
*/
  return $result;
}
function Sql_Fetch_Row($dbresult) {
  return mysql_fetch_row($dbresult);
}

function Sql_Fetch_Array($dbresult) {
  return mysql_fetch_array($dbresult);
}

?>

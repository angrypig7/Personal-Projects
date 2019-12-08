<?php
// include("./head.php");
// include("./footer.php");
include_once('./database.php');

ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
    $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
    $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
    $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
    $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
    $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
    $ipaddress = getenv('REMOTE_ADDR');
    else
    $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
$publicip = get_client_ip();
// $curtime = (new DateTime())->format("Y-m-d H:i:s");


if(isset($_GET['serverNum'])){
    $serverNum = $_GET['serverNum'];
}else{
    die("no \$_GET[serverNum]");
}

if(isset($_GET['serverName'])){
    $serverName = $_GET['serverName'];
}else{
    die("no \$_GET[serverName]");
}

if(isset($_GET['localip'])){
    $localip = $_GET['localip'];
}else{
    $localip = NULL;
}

if(isset($_GET['test'])){
    $test = $_GET['test'];
}
else{
    $test = NULL;
}

echo "serverNum: $serverNum - PublicIP: $publicip - LocalIP: $localip - test: $test";

$SQL = "INSERT INTO pf_servers (serverNum, serverName, local_ip, public_ip, test) VALUES('$serverNum', '$serverName', '$localip', '$publicip', '$test')";
mysqli_query($conn, $SQL);

// echo"<script>history.back();</script>";
// die;

?>

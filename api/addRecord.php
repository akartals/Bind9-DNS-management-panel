<?php
// ini_set("display_errors", "0");
use dns\util\ParseZone;

require_once ('helper.php');
if (
    isset($_GET['data']) && isset($_GET['recordType']) && isset($_GET['subdomain']) && isset($_GET['ttl']) && isset($_GET['aux']) &&
    intval($_GET['ttl'] >= 0) && intval($_GET['aux'] >= 0)
) {
    if ($zone = file_get_contents("./bind9-example")) {
        $newData = $_GET['subdomain'] . "\t" . intval($_GET['ttl']) . "\tIN\t" . $_GET['recordType'];
        if (intval($_GET['aux']) > 0)
            $newData .= "\t" . intval($_GET['aux']);
        $newData .= "\t" . $_GET['data'];

        if(str_contains($zone,$newData)){
            echo "failed";
            die();
        }
        $zone .= $newData;

        if (file_put_contents($zoneFile, $zone))
            echo 'success';
        else
            echo 'failed';
    } else
        echo 'failed';
}
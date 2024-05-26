<?php
// ini_set("display_errors", "0");
use dns\util\ParseZone;

require_once ('helper.php');
if (
    isset($_GET['data']) && isset($_GET['recordType']) && isset($_GET['subdomain']) && isset($_GET['ttl']) && isset($_GET['aux']) &&
    intval($_GET['ttl'] >= 0) && intval($_GET['aux'] >= 0)
) {
    $zone = file_get_contents($zoneFile);
    $degistirilecek = $_GET['subdomain'] . "\t" . intval($_GET['ttl']) . "\tIN\t" . $_GET['recordType'];
    if (intval($_GET['aux']) > 0)
        $degistirilecek .= "\t" . intval($_GET['aux']);
    $degistirilecek .= "\t" . $_GET['data'] . "\n";
    $degistirilecek2 = str_replace("." . $domain, "", $degistirilecek);
    if ($domain == $_GET['subdomain'])
        $degistirilecek = str_replace($domain, "@", $degistirilecek);
    $sayi = 0;
    $sayi2 = 0;
    $zone = str_replace($degistirilecek, "", $zone, $sayi);
    $zone = str_replace($degistirilecek2, "", $zone, $sayi2);
    // echo $degistirilecek2;
    if (($sayi > 0 || $sayi2 > 0) && file_put_contents($zoneFile, $zone))
        echo "success";
    else
        echo "failed";
}
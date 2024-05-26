<?php
// ini_set("display_errors", "0");
use dns\util\ParseZone;

require_once ('helper.php');
if (
    isset($_GET['data']) && isset($_GET['recordType']) && isset($_GET['subdomain']) && isset($_GET['ttl']) && isset($_GET['aux']) &&
    intval($_GET['ttl'] >= 0) && intval($_GET['aux'] >= 0) &&
    isset($_GET['dataYeni']) && isset($_GET['recordTypeYeni']) && isset($_GET['subdomainYeni']) &&
    isset($_GET['ttlYeni']) && isset($_GET['auxYeni']) && intval($_GET['ttlYeni'] >= 0) && intval($_GET['auxYeni'] >= 0)
) {
    $zone = file_get_contents($zoneFile);
    $degistirilecek = $_GET['subdomain'] . "\t" . intval($_GET['ttl']) . "\tIN\t" . $_GET['recordType'];
    if (intval($_GET['aux']) > 0)
        $degistirilecek .= "\t" . intval($_GET['data']);
    $degistirilecek .= "\t" . $_GET['data'];

    $yeniDeger = $_GET['subdomainYeni'] . "\t" . intval($_GET['ttlYeni']) . "\tIN\t" . $_GET['recordTypeYeni'];
    if (intval($_GET['auxYeni']) > 0)
        $yeniDeger .= "\t" . intval($_GET['auxYeni']);
    $yeniDeger .= "\t" . $_GET['dataYeni'];

    $sayi = 0;
    $zone = str_replace($degistirilecek, $yeniDeger, $zone, $sayi);
    if ($sayi > 0 && file_put_contents($zoneFile, $zone))
        echo "success";
    else
        echo "failed";
}
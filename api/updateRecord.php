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
    $degistirilecek = urldecode($_GET['subdomain']) . "\t" . intval($_GET['ttl']) . "\tIN\t" . urldecode($_GET['recordType']);
    if (intval($_GET['aux']) > 0)
        $degistirilecek .= "\t" . intval($_GET['aux']);
    $degistirilecek .= "\t" . htmlspecialchars_decode(urldecode($_GET['data']), ENT_NOQUOTES) . "\n";
    $degistirilecek2 = str_replace("." . $domain, "", $degistirilecek);

    if ($domain == urldecode($_GET['subdomain'])) {
        $degistirilecek = str_replace($domain, "@", $degistirilecek);
        $degistirilecek2 = str_replace($domain, "@", $degistirilecek2);
    }

    if ($domain == urldecode($_GET['subdomainYeni']))
        $_GET['subdomainYeni'] = str_replace($domain, "@", urldecode($_GET['subdomainYeni']));

    $yeniDeger = urldecode($_GET['subdomainYeni']) . "\t" . intval($_GET['ttlYeni']) . "\tIN\t" .
        urldecode($_GET['recordTypeYeni']);
    if (intval($_GET['auxYeni']) > 0)
        $yeniDeger .= "\t" . intval($_GET['auxYeni']);
    $yeniDeger .= "\t" . htmlspecialchars_decode(urldecode($_GET['dataYeni']), ENT_NOQUOTES) . "\n";
    $yeniDeger2 = str_replace("." . $domain, "", $yeniDeger);
    $sayi = 0;
    $sayi2 = 0;
    $zone = str_replace($degistirilecek, $yeniDeger, $zone, $sayi);
    $zone = str_replace($degistirilecek2, $yeniDeger2, $zone, $sayi2);
    $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
    $txt = "$degistirilecek\n$degistirilecek2\n$yeniDeger\n$yeniDeger2";
    fwrite($myfile, $txt);
    fclose($myfile);
    if (($sayi > 0 || $sayi2 > 0) && file_put_contents($zoneFile, $zone))
        echo "success";
    else
        echo "failed";
} else
    echo "failed";





// $yeniDeger = $_GET['subdomainYeni'] . "\t" . intval($_GET['ttlYeni']) . "\tIN\t" . $_GET['recordTypeYeni'];
// if (intval($_GET['auxYeni']) > 0)
//     $yeniDeger .= "\t" . intval($_GET['auxYeni']);
// $yeniDeger .= "\t" . $_GET['dataYeni'];
// $yeniDeger2 = str_replace(".".$domain,"",$degistirilecek);



// $zone = file_get_contents($zoneFile);
// $degistirilecek = $_GET['subdomain'] . "\t" . intval($_GET['ttl']) . "\tIN\t" . $_GET['recordType'];
// if (intval($_GET['aux']) > 0)
// $degistirilecek .= "\t" . intval($_GET['data']);
// $degistirilecek .= "\t" . $_GET['data'];
// $degistirilecek2 = str_replace(".".$domain,"",$degistirilecek);

// if($domain==$_GET['subdomain'])
// $degistirilecek = str_replace($domain,"@",$degistirilecek);

// $yeniDeger = $_GET['subdomainYeni'] . "\t" . intval($_GET['ttlYeni']) . "\tIN\t" . $_GET['recordTypeYeni'];
// if (intval($_GET['auxYeni']) > 0)
// $yeniDeger .= "\t" . intval($_GET['auxYeni']);
// $yeniDeger .= "\t" . $_GET['dataYeni'];
// $yeniDeger2 = str_replace(".".$domain,"",$degistirilecek);

// $sayi = 0;
// $sayi2 = 0;
// $zone = str_replace($degistirilecek, $yeniDeger, $zone, $sayi);
// $zone = str_replace($degistirilecek2, $yeniDeger2, $zone, $sayi2);
// if (($sayi > 0 || $sayi2>0) && file_put_contents($zoneFile, $zone))
// echo "success";
// else
// echo $degistirilecek;
<?php
// ini_set("display_errors", "0");
if(!isset($_GET['types']))
    die();
use dns\util\ParseZone;
require_once('helper.php');

$data = file_get_contents($zoneFile);
 $domain = 'aku.edu.tr';
$parser = new ParseZone($data, "$domain.");
$parser->parse();

$domain = $parser->getParsedData()['soa']['origin'];
while(str_ends_with($domain,"."))
    $domain = substr($domain, 0, -1);

$subdomainList = [];
$recordTypes=[];

foreach ($parser->getParsedData()['rr'] as $sub) {
    formatSubdomains($sub, $domain, $subdomainList,$recordTypes);
}
function formatSubdomains($subdomain, $domain, &$subdomainList,&$recordTypes){
    if(in_array($subdomain['type'], explode(",",$_GET['types'])) || $_GET['types']=="*"){

    if(!str_contains($subdomain['name'], $domain)){
        $subdomain['name'] = $subdomain['name'].".".$domain;
    }
    while(str_ends_with($subdomain['name'],"."))
        $subdomain['name'] = substr($subdomain['name'], 0, -1);
    
    while(str_starts_with($subdomain['name'],".") || str_starts_with($subdomain['name'],";"))
        $subdomain['name'] = substr($subdomain['name'], 1);
    
    while(str_ends_with($subdomain['data'],"."))
        $subdomain['data'] = substr($subdomain['data'], 0, -1);
    
    while(str_starts_with($subdomain['data'],".") || str_starts_with($subdomain['data'],";"))
        $subdomain['data'] = substr($subdomain['data'], 1);

    if (!isset($subdomainList[$subdomain['type']]) || !is_array($subdomainList[$subdomain['type']])) 
        $subdomainList[$subdomain['type']] = [];    

    array_push($subdomainList[$subdomain['type']], $subdomain);
}
    
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($subdomainList, JSON_PRETTY_PRINT);
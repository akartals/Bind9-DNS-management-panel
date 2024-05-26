<?php
require "helpers.php";
if (
    isset($_POST['data']) && isset($_POST['recordType']) && isset($_POST['subdomain']) && isset($_POST['ttl']) &&
    isset($_POST['aux']) && intval($_POST['ttl'] >= 0) && intval($_POST['aux'] >= 0)
) {
    $opts = array(
        'http' => array(
            'method' => "GET",
            'header' => "x-api-key: $apikey\r\n"
        )
    );
    $context = stream_context_create($opts);

    $data = $_POST['data'];
    $recordType = $_POST['recordType'];
    $subdomain = $_POST['subdomain'];
    $ttl = $_POST['ttl'];
    $aux = $_POST['aux'];
    $response = file_get_contents("$apiAddress/addRecord.php?data=$data&recordType=$recordType&" .
        "subdomain=$subdomain&ttl=$ttl&aux=$aux", false, $context);
    if ($response == "success") {
        header("Location: ./index.php?success");
        die();
    } else {
        header("Location: ./index.php?fail");
        die();
    }
}
HeaderMenu();

?>
<div class="tab-content">

<div class="header">
    <h2>DNS yönetim sistemi - Kayıt ekle</h2>
</div>
<div class="content">

<form action="./addRecord.php" method="POST">
    <div class="form-group">
        <!-- <input type="hidden" id="tur" name="tur" value="kullanici" /> -->
    </div>
    <div class="form-group">
        <label for="subdomain">Subdomain</label>
        <input type="text" class="form-control" id="subdomain" name="subdomain" placeholder="subdomain" />
    </div>
    <div class="form-group">
        <label for="recordType">Record Type</label>
        <input type="text" class="form-control" id="recordType" name="recordType" placeholder="A,AAAA,MX,TXT..." />
    </div>
    <div class="form-group">
        <label for="data">Data</label>
        <input type="text" class="form-control" id="data" name="data" placeholder="data" />
    </div>
    <div class="form-group">
        <label for="ttl">TTL</label>
        <input type="number" min="0" max="100000" class="form-control" value="3600" id="ttl" name="ttl" placeholder="3600" />
    </div>
    <div class="form-group">
        <label for="aux">aux</label>
        <input type="number" min="0" max="100000" class="form-control" value="0" id="aux" name="aux" placeholder="0" />
    </div>
    <button type="submit" class="btn btn-primary">Ekle</button>
</form>
</div></div>
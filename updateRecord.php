<?php
require "helpers.php";
if (
    isset($_POST['data']) && isset($_POST['recordType']) && isset($_POST['subdomain']) && isset($_POST['ttl']) &&
    isset($_POST['aux']) && intval($_POST['ttl'] >= 0) && intval($_POST['aux'] >= 0) &&
    isset($_POST['dataYeni']) && isset($_POST['recordTypeYeni']) && isset($_POST['subdomainYeni']) && isset($_POST['ttlYeni']) &&
    isset($_POST['auxYeni']) && intval($_POST['ttlYeni'] >= 0) && intval($_POST['auxYeni'] >= 0)
) {
    $opts = array(
        'http' => array(
            'method' => "GET",
            'header' => "x-api-key: $apikey\r\n"
        )
    );
    $context = stream_context_create($opts);

    $data = urlencode($_POST['data']);
    $recordType = urlencode($_POST['recordType']);
    $subdomain = urlencode($_POST['subdomain']);
    if (strlen($subdomain) == 0)
        $subdomain = "@";
    $ttl = urlencode($_POST['ttl']);
    $aux = urlencode($_POST['aux']);
    $dataYeni = urlencode($_POST['dataYeni']);
    $recordTypeYeni = urlencode($_POST['recordTypeYeni']);
    $subdomainYeni = urlencode($_POST['subdomainYeni']);
    if (strlen($subdomainYeni) == 0)
        $subdomainYeni = "@";
    $ttlYeni = urlencode($_POST['ttlYeni']);
    $auxYeni = urlencode($_POST['auxYeni']);
    $response = file_get_contents("$apiAddress/updateRecord.php?data=$data&recordType=$recordType&" .
        "subdomain=$subdomain&ttl=$ttl&aux=$aux&" .
        "dataYeni=$dataYeni&recordTypeYeni=$recordTypeYeni&" .
        "subdomainYeni=$subdomainYeni&ttlYeni=$ttlYeni&auxYeni=$auxYeni", false, $context);
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
        <h2>DNS yönetim sistemi - Kayıt Düzenle</h2>
    </div>
    <div class="content">


        <form action="./updateRecord.php" method="POST">
            <div class="form-group">
                <input type="hidden" id="data" name="data" value="<?php echo htmlspecialchars($_GET['data']); ?>" />
                <input type="hidden" id="recordType" name="recordType" value="<?php echo $_GET['recordType']; ?>" />
                <input type="hidden" id="subdomain" name="subdomain" value="<?php echo $_GET['subdomain'] ?>" />
                <input type="hidden" id="ttl" name="ttl" value="<?php echo $_GET['ttl']; ?>" />
                <input type="hidden" id="aux" name="aux" value="<?php echo $_GET['aux']; ?>" />
            </div>

            <div class="form-group">
                <label for="subdomainYeni">Subdomain</label>
                <input type="text" class="form-control" id="subdomainYeni" name="subdomainYeni" placeholder="subdomain"
                    value="<?php echo $_GET['subdomain'] ?>" />
            </div>
            <div class="form-group">
                <label for="recordTypeYeni">Record Type</label>
                <input type="text" class="form-control" id="recordTypeYeni" name="recordTypeYeni"
                    placeholder="A,AAAA,MX,TXT..." value="<?php echo $_GET['recordType']; ?>" />
            </div>
            <div class="form-group">
                <label for="dataYeni">Data</label>
                <input type="text" class="form-control" id="dataYeni" name="dataYeni" placeholder="data"
                    value="<?php echo htmlspecialchars($_GET['data']); ?>" />
            </div>
            <div class="form-group">
                <label for="ttlYeni">TTL</label>
                <input type="number" min="0" max="100000" class="form-control" value="3600" id="ttlYeni" name="ttlYeni"
                    placeholder="3600" value="<?php echo $_GET['ttl']; ?>" />
            </div>
            <div class="form-group">
                <label for="auxYeni">aux</label>
                <input type="number" min="0" max="100000" class="form-control" value="0" id="auxYeni" name="auxYeni"
                    placeholder="0" value="<?php echo $_GET['aux']; ?>" />
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Düzenle</button>
            </div>
        </form>
    </div>
</div>
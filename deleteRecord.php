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

    $data = urlencode($_POST['data']);
    $recordType = urlencode($_POST['recordType']);
    $subdomain = urlencode($_POST['subdomain']);
    $ttl = urlencode($_POST['ttl']);
    $aux = urlencode($_POST['aux']);
    $response = file_get_contents("$apiAddress/deleteRecord.php?data=$data&recordType=$recordType&" .
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
        <h2>DNS yönetim sistemi - Kayıt Sil</h2>
    </div>
    <div class="content">
        <h2>BU İŞLEM SEÇİLEN KAYDI(<?php echo $_GET['subdomain'] . " " . $_GET['recordType'] . " " . $_GET['data'] ?>)
            TAMAMEN
            SİLECEKTİR.
            ONAYLIYOR MUSUNUZ?</h2>

        <form action="./deleteRecord.php" method="POST">
            <div class="form-group">
                <input type="hidden" id="data" name="data" value="<?php echo htmlspecialchars($_GET['data']); ?>" />
                <input type="hidden" id="recordType" name="recordType" value="<?php echo $_GET['recordType']; ?>" />
                <input type="hidden" id="subdomain" name="subdomain" value="<?php echo $_GET['subdomain'] ?>" />
                <input type="hidden" id="ttl" name="ttl" value="<?php echo $_GET['ttl']; ?>" />
                <input type="hidden" id="aux" name="aux" value="<?php echo $_GET['aux']; ?>" />
            </div>
            <button type="submit" class="btn btn-primary">Kaydı Sil</button>
        </form>
    </div>
</div>
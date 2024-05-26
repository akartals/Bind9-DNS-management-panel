<?php
require "helpers.php";
$opts = array(
    'http'=>array(
      'method'=>"GET",
      'header'=>"x-api-key: $apikey\r\n"
    )
  );
$context = stream_context_create($opts);

// Open the file using the HTTP headers set above
$file = file_get_contents("$apiAddress/parseZone.php?types=*", false, $context);
$response=json_decode($file);

HeaderMenu();
?>

<div class="tab-content">

    <div class="header">
        <h2>DNS yönetim sistemi</h2>
    </div>
    <div class="content" style="display: block;">

        <table>
            <tr>
                <th>name</th>
                <th>ttl</th>
                <th>type</th>
                <th>aux</th>
                <th>data</th>
                <th style="width: 287px;">İşlemler</th>
            </tr>
            <?php 
foreach ($response as $cesit) {
    foreach ($cesit as $satir) {
        echo '<tr><td>'.
        $satir->name.
        '</td><td>'.
        $satir->ttl.
        '</td><td>'.
        $satir->type.
        '</td><td>'.
        $satir->aux.
        '</td><td>'.
        $satir->data.
        '</td><td>'.
        '<button class="btniconSmall" onclick="location.href=' .
        "'deleteRecord.php?".
        "subdomain=$satir->name&".
        "ttl=$satir->ttl&".
        "recordType=$satir->type&".
        "aux=$satir->aux".
        "&data=$satir->data'\"".
        " style='background-color:#a61600;'>" .
        '<i class="fa  fa-x"></i></br> ' .
        "Sil</button>".

        '<button class="btniconSmall" onclick="location.href=' .
        "'updateRecord.php?".
        "subdomain=$satir->name&".
        "ttl=$satir->ttl&".
        "recordType=$satir->type&".
        "aux=$satir->aux".
        "&data=$satir->data'\"".
        " style='background-color:#070621;'>" .
        '<i class="fa  fa-x"></i></br> ' .
        "Düzenle</button>".

        '</td></tr>';
    }
}
            ?>
        </table>
        <?php echo 
        '<button class="btniconBottom" onclick="location.href=\'addRecord.php\'"'.
        " style='background-color:#00a65a;'>" .
        '<i class="fa  fa-plus"></i></br> ' .
        "</button>";?>
    </div>
</div>
</div>
<?php footer(); ?>
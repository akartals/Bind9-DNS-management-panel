<?php
ini_set("display_errors", "0");
$apikey = "53cc19e0-9a38-4e8b-9d88-026236da1066";
$apiAddress = "http://localhost/bind9/api";
function HeaderMenu()
{
    session_start(); ?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <title>DNS yönetim sistemi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">


    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="container-fluid">
            <div id="tab-list">
                <div class="list-group">
                        <a href="https://github.com/akartals" class="list-group-item list-group-item-action">
                            <span><i class="fab fa-github"></i> Github</span>
                        </a>
                        <a href="./addRecord.php" class="list-group-item list-group-item-action">
                            <span><i class="fab fa-plus"></i> Yeni Kayıt</span>
                        </a>
                        <a href="./index.php" class="list-group-item list-group-item-action">
                            <span><i class="fas fa-home"></i> Ana menü</span>
                        </a>
                </div>
            </div>
    <?php
}

function footer()
{
    ?>
</div>
</body>

<?php
}


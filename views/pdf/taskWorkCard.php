<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Arbeitsauftrag</title>
    <style>
        ul {
            list-style: none;
            margin-top: 5px;
        }
        .resources {
            table-layout: fixed;
            width: 100%;
            font-size: 20px;
        }
        .checkbox {
            transform: scale(2.5);
        }
    </style>
</head>
<body>
    <div style="text-align: center;"><h1>Arbeitsauftrag - <?= $name ?></h1></div>
    <br>

    <h3>Beschreibung</h3>
    <p><?= $description ?></p>

    <br>
    <div style="text-align: center"><h2>Meterialliste</h2></div>
    <?= $resource ?>
    <br>

    <div style="text-align: center">
        <img src="<?= $pathToQRCode ?>" alt="Qr Code">
    </div>
</body>
</html>
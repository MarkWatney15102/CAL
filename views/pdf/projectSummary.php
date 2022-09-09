<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Projekt Zusammenfassung</title>
    <style>
        td {
            width: 50%;
            padding: 0 15px;
        }
        ul {
            list-style: none;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div style="text-align: center;"><h1>Projekt Zusammenfassung</h1></div>
    <br>
    <table>
        <tr>
            <td><p>Projekt ID: <?= $projectId ?></p></td>
            <td><p>Projekt Titel: <?= $projectTitle ?></p></td>
        </tr>
        <tr>
            <td><p>Projekt Start/Ende: <?= $projectStart ?> - <?= $projectEnd ?></p></td>
            <td><p>Anzahl Soll/Ist: <?= $soll ?>/<?= $is ?></p></td>
        </tr>
    </table>

    <br>
    <div style="text-align: center"><h2>Auftragsliste</h2></div>
    <?= $tasks ?>
    <br>

    <div style="text-align: center">
        <img src="<?= $pathToQRCode ?>" alt="Qr Code">
    </div>
</body>
</html>
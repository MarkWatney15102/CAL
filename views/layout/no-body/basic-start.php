<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAL</title>
    <link rel="stylesheet" href="/dist/css/build.css">
</head>
<body>
    <?php use lib\Message\MessageGroup;

    $messageGroup = MessageGroup::getInstance();
    echo $messageGroup->printMessages();
    ?>
    <div class="col-lg-12 row">
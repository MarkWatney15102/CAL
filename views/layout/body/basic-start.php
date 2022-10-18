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
    <div class="row col-lg-12">
        <?php use lib\Message\MessageGroup;

        require $_SERVER['DOCUMENT_ROOT'] . '/views/layout/navbar.php' ?>
        <?php
            $messageGroup = MessageGroup::getInstance();
            echo $messageGroup->printMessages();
        ?>
        <div id="main-content">
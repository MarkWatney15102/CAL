<?php

if (!file_exists('config/installed')) {
//    shell_exec("npm run deploy");
    require_once './vendor/autoload.php';

    $db = \lib\Database\Database::getDatabaseConnection(__DIR__ . "/config/config.php");

    $projectSql = file_get_contents('/config/sql/project.sql');
    $db->query($projectSql);

    $jobSql = file_get_contents('/config/sql/job.sql');
    $db->query($jobSql);

    $userSql = file_get_contents('/config/sql/user.sql');
    $db->query($userSql);

    $file = fopen("config/installed", "w");
    $txt = "installed";
    fwrite($file, $txt);
    fclose($file);
}
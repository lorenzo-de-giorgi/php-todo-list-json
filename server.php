<?php
    $todoJson = file_get_contents("js/data.json");
    // var_dump($todoJson);
    header('Content-Type: application/json');
    echo($todoJson);
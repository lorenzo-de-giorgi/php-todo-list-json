<?php
    $todoJson = file_get_contents("js/data.json");
    // var_dump($todoJson);
    $method = $_SERVER['REQUEST_METHOD'];
    if($method !== 'GET'){
        $todo = json_decode($todoJson, true);
        if($method === 'POST'){
            if(isset($_POST['id'])){
                var_dump($_POST);
                $todoTask = [
                    'id' => (int)$_POST['id'],
                    'text' => $_POST['text']
                ];
                $todo[] = $todoTask;
            }
        }
        $todoJson = json_encode($todo, JSON_PRETTY_PRINT);
        file_put_contents('/js/data.json', $todoJson);
    }
    header('Content-Type: application/json');
    echo($todoJson);
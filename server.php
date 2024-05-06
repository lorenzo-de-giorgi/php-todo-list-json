<?php
    $todoJson = file_get_contents("data.json");
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
        } elseif($method === 'DELETE'){
            $obj = json_decode(file_get_contents('php://input'), true);
            $index = $obj['id'];
            array_splice($todo, $index, 1);
        }
        $todoJson = json_encode($todo, JSON_PRETTY_PRINT);
        file_put_contents('data.json', $todoJson);
    }
    header('Content-Type: application/json');
    echo($todoJson);
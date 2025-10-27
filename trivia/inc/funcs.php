<?php

function generarPreguntaTrivia($tema) {

    $apiKey = OPENAI_API_KEY;
    $url = OPENAI_API_URL . 'chat/completions';

    $data = [
        'model' => 'gpt-3.5-turbo',
        'messages' => [
            ['role' => 'system', 'content' => 'Sos un generador de preguntas de trivia.'],
            ['role' => 'user', 'content' => "Generá una pregunta de trivia de nivel facil sobre $tema con 4 opciones y marcá la correcta, la respuesta 
            debe estar en formato JSON con las claves: 'pregunta', 'opciones' (un array con 4 opciones) y 'respuesta_correcta' (la opción correcta)."]
        ],
        'temperature' => 0.7
    ];

    $options = [
        'http' => [
            'header' => "Content-Type: application/json\r\nAuthorization: Bearer $apiKey\r\n",
            'method' => 'POST',
            'content' => json_encode($data)
        ]
    ];

    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    return json_decode($response, true);

}

?>

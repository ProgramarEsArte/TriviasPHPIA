<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trivia - Seleccion de categorias </title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .trivia-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 25px 45px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 700px;
            width: 100%;
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .topic-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 8px 20px;
            border-radius: 25px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        h1 {
            color: #2d3748;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .subtitle {
            color: #718096;
            font-size: 1.1rem;
            font-weight: 400;
        }

        .question-section {
            margin: 30px 0;
        }

        .question {
            background: #f8fafc;
            border-left: 4px solid #667eea;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .question p {
            font-size: 1.25rem;
            line-height: 1.6;
            color: #2d3748;
            font-weight: 500;
        }

        .options-container {
            display: grid;
            gap: 15px;
        }

        .option-button {
            background: white;
            border: 2px solid #e2e8f0;
            padding: 18px 25px;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 500;
            color: #4a5568;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: left;
            position: relative;
            overflow: hidden;
        }

        .option-button:hover {
            border-color: #667eea;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }

        .option-button:active {
            transform: translateY(0);
        }

        .option-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .option-button:hover::before {
            left: 100%;
        }

        .loading-spinner {
            display: none;
            text-align: center;
            padding: 20px;
        }

        .spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #667eea;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 0 auto;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .result-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
            z-index: 1000;
        }

        .modal-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 40px;
            border-radius: 20px;
            text-align: center;
            max-width: 400px;
            width: 90%;
            box-shadow: 0 25px 45px rgba(0, 0, 0, 0.2);
        }

        .modal-icon {
            font-size: 4rem;
            margin-bottom: 20px;
        }

        .correct-icon {
            color: #48bb78;
        }

        .incorrect-icon {
            color: #f56565;
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .modal-message {
            font-size: 1rem;
            color: #718096;
            margin-bottom: 25px;
            line-height: 1.5;
        }

        .next-question-btn {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .next-question-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }

        @media (max-width: 768px) {
            .trivia-container {
                padding: 25px;
                margin: 10px;
            }

            h1 {
                font-size: 2rem;
            }

            .question p {
                font-size: 1.1rem;
            }

            .option-button {
                padding: 15px 20px;
                font-size: 0.95rem;
            }
        }
    </style>
</head>
<body>
    <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        include 'inc/config.php';
        include 'inc/funcs.php';

        $tema = "Ciencia y tecnología";
        $pregunta = generarPreguntaTrivia($tema);
        $objetoPregunta = json_decode($pregunta['choices'][0]['message']['content'], true);
    ?>

    <div class="trivia-container">
        <div class="header">
            <div class="topic-badge">
                <i class="fas fa-microscope"></i>
                <?php echo $tema; ?>
            </div>
            <h1>Trivia Challenge</h1>
            <p class="subtitle">¡Pon a prueba tus conocimientos!</p>
        </div>

        <div class="question-section">
            <div class="question">
                <p><?php echo $objetoPregunta['pregunta']; ?></p>
            </div>

            <div class="options-container">
                <?php foreach ($objetoPregunta['opciones'] as $index => $opcion): ?>
                    <button class="option-button" onclick="validarRespuesta('<?php echo addslashes($opcion); ?>')">
                        <?php echo $opcion; ?>
                    </button>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="loading-spinner">
            <div class="spinner"></div>
            <p>Cargando nueva pregunta...</p>
        </div>
    </div>

    <!-- Modal para mostrar resultados -->
    <div class="result-modal" id="resultModal">
        <div class="modal-content">
            <div class="modal-icon" id="modalIcon">
                <i class="fas fa-check-circle correct-icon"></i>
            </div>
            <h2 class="modal-title" id="modalTitle">¡Excelente!</h2>
            <p class="modal-message" id="modalMessage">¡Respuesta correcta!</p>
            <button class="next-question-btn" onclick="siguientePregunta()">
                <i class="fas fa-arrow-right"></i> Nueva Pregunta
            </button>
        </div>
    </div>

    <script type="text/javascript">
        function validarRespuesta(opcionSeleccionada) {
            var respuestaCorrecta = "<?php echo addslashes($objetoPregunta['respuesta_correcta']); ?>";
            var modal = document.getElementById('resultModal');
            var icon = document.getElementById('modalIcon');
            var title = document.getElementById('modalTitle');
            var message = document.getElementById('modalMessage');
            
            // Deshabilitar todos los botones
            var botones = document.querySelectorAll('.option-button');
            botones.forEach(function(boton) {
                boton.style.pointerEvents = 'none';
                boton.style.opacity = '0.6';
            });
            
            if (opcionSeleccionada === respuestaCorrecta) {
                icon.innerHTML = '<i class="fas fa-check-circle correct-icon"></i>';
                title.textContent = '¡Excelente!';
                message.textContent = '¡Respuesta correcta! Muy bien hecho.';
            } else {
                icon.innerHTML = '<i class="fas fa-times-circle incorrect-icon"></i>';
                title.textContent = '¡Casi!';
                message.innerHTML = 'Respuesta incorrecta.<br>La respuesta correcta era: <strong>' + respuestaCorrecta + '</strong>';
            }
            
            // Mostrar modal con una pequeña animación
            setTimeout(function() {
                modal.style.display = 'block';
                setTimeout(function() {
                    modal.style.opacity = '1';
                }, 10);
            }, 800);
        }

        function siguientePregunta() {
            document.querySelector('.loading-spinner').style.display = 'block';
            document.querySelector('.question-section').style.display = 'none';
            
            setTimeout(function() {
                window.location.reload();
            }, 1000);
        }

        // Animación de entrada para los botones
        window.addEventListener('load', function() {
            var botones = document.querySelectorAll('.option-button');
            botones.forEach(function(boton, index) {
                boton.style.opacity = '0';
                boton.style.transform = 'translateY(20px)';
                
                setTimeout(function() {
                    boton.style.transition = 'all 0.5s ease';
                    boton.style.opacity = '1';
                    boton.style.transform = 'translateY(0)';
                }, 200 + (index * 100));
            });
        });
    </script>
</body>
</html>
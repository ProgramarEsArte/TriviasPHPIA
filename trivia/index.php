<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trivia - Ciencia y Tecnología</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        include 'inc/config.php';
        include 'inc/funcs.php';

        // Lista de categorías y colores
        $categorias = [
            ["nombre" => "Ciencia y tecnología", "color" => "#667eea"],
            ["nombre" => "Arte y literatura", "color" => "#e53e3e"],
            ["nombre" => "Televisión", "color" => "#38b2ac"],
            ["nombre" => "Comidas", "color" => "#f6ad55"],
            ["nombre" => "Deportes", "color" => "#48bb78"],
            ["nombre" => "Historia", "color" => "#ed64a6"],
            ["nombre" => "Geografía", "color" => "#f6ad55"]

        ];

        // Selección aleatoria si no se ha enviado por POST
        if (isset($_POST['categoria'])) {
            $tema = $_POST['categoria'];
        } else {
            $tema = $categorias[array_rand($categorias)]["nombre"];
        }

        $pregunta = generarPreguntaTrivia($tema);
        $objetoPregunta = json_decode($pregunta['choices'][0]['message']['content'], true);
    ?>

    <div class="trivia-container">
        <div class="header">
            <form id="rueda-categorias" method="post" style="margin-bottom: 30px;">
                <div style="display: flex; justify-content: center; gap: 25px; flex-wrap: wrap;">
                    <?php foreach ($categorias as $cat): ?>
                        <button type="submit" name="categoria" value="<?php echo $cat['nombre']; ?>" style="background: <?php echo $cat['color']; ?>; color: white; border: none; border-radius: 50%; width: 90px; height: 90px; font-size: 1rem; font-weight: 600; box-shadow: 0 4px 16px rgba(0,0,0,0.10); cursor: pointer; transition: transform 0.2s; display: flex; align-items: center; justify-content: center; margin-bottom: 10px;">
                            <?php echo $cat['nombre']; ?>
                        </button>
                    <?php endforeach; ?>
                </div>
                <div style="text-align:center; margin-top:10px; color:#718096; font-size:0.95rem;">Selecciona una categoría o deja que el sistema elija una al azar</div>
            </form>
            <div class="topic-badge" style="background: linear-gradient(135deg, #667eea, #764ba2);">
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
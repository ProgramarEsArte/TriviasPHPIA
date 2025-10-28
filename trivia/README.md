# Trivia Ciencia y Tecnología

¡Bienvenido a Trivia Ciencia y Tecnología! Este proyecto es una aplicación web sencilla que genera preguntas de trivia sobre ciencia y tecnología utilizando la API de OpenAI.

## Características
- Generación automática de preguntas y opciones de respuesta
- Interfaz moderna y responsiva
- Feedback visual para respuestas correctas e incorrectas
- Modal de resultados y animaciones
- Fácil de personalizar el tema de las preguntas

## Estructura del Proyecto
```
trivia/
├── index.php              # Página principal de la trivia
├── inc/
│   ├── config.php         # Configuración y claves de API
│   └── funcs.php          # Funciones para generar preguntas
└── README.md              # Documentación del proyecto
```

## Requisitos
- PHP 7.4 o superior
- Acceso a la API de OpenAI (clave en `config.php`)
- Servidor web (XAMPP, Apache, etc.)

## Instalación y Uso
1. Clona o descarga este repositorio en tu servidor local.
2. Configura tu clave de OpenAI en `inc/config.php`.
3. Accede a `index.php` desde tu navegador.
4. ¡Comienza a jugar y aprende!

## Personalización
- Puedes cambiar el tema de las preguntas modificando la variable `$tema` en `index.php`.
- El diseño y estilos se pueden ajustar en la sección `<style>` de `index.php`.

## Créditos
- Preguntas generadas por [OpenAI GPT-3.5 Turbo](https://openai.com/)
- Iconos por [Font Awesome](https://fontawesome.com/)
- Fuente [Inter](https://fonts.google.com/specimen/Inter)

## Licencia
Este proyecto es de uso educativo y personal. Puedes modificarlo y adaptarlo libremente.

---

¡Disfruta aprendiendo y jugando con la trivia!

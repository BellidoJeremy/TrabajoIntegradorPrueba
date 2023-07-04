<!DOCTYPE html>
<html>
<head>
    <!-- Encabezado y estilos -->
</head>
<body>
    <!-- Contenido principal -->

    <div class="preguntas--container">
        <?php
        session_start();

        // Inicializar el puntaje y el historial de puntajes
        if (!isset($_SESSION['puntaje'])) {
            $_SESSION['puntaje'] = 0;
        }

        if (!isset($_SESSION['historial_puntajes'])) {
            $_SESSION['historial_puntajes'] = array();
        }

        // Inicializar el historial de respuestas
        if (!isset($_SESSION['historial_respuestas'])) {
            $_SESSION['historial_respuestas'] = array();
        }

        $servername = "localhost";
        $username = "root";
        $password = "usbw";
        $dbname = "preguntados";

        // Crear conexión
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar conexión
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Obtener los datos de la pregunta actual
            $pregunta_id = $_POST["pregunta_id"];
            $respuesta_seleccionada = $_POST["respuesta_seleccionada"];

            // Consultar la respuesta correcta de la pregunta actual
            $sql_respuesta_correcta = "SELECT opcion FROM alternativas WHERE pregunta_id = $pregunta_id AND es_correcta = 1";
            $result_respuesta_correcta = $conn->query($sql_respuesta_correcta);

            if ($result_respuesta_correcta->num_rows > 0) {
                $row_respuesta_correcta = $result_respuesta_correcta->fetch_assoc();
                $respuesta_correcta = $row_respuesta_correcta["opcion"];

                $respuesta_actual = array(
                    'pregunta_id' => $pregunta_id,
                    'respuesta_seleccionada' => $respuesta_seleccionada,
                    'respuesta_correcta' => $respuesta_correcta
                );

                if ($respuesta_seleccionada == $respuesta_correcta) {
                    echo "<script>alert('¡Respuesta correcta!');</script>";
                    $_SESSION['puntaje'] += 400;
                    $respuesta_actual['es_correcta'] = true;
                } else {
                    echo "<script>alert('Respuesta incorrecta. La respuesta correcta es: $respuesta_correcta');</script>";
                    $respuesta_actual['es_correcta'] = false;
                }

                // Guardar la respuesta actual en el historial de respuestas
                $_SESSION['historial_respuestas'][] = $respuesta_actual;
            }
        }

        // Obtener el ID de la categoría seleccionada
        $categoria_id = $_POST["categoria"];

        // Obtener el contador de pregunta actual
        $contador_pregunta = isset($_POST["contador_pregunta"]) ? $_POST["contador_pregunta"] : 0;

        // Consulta de todas las preguntas de la categoría seleccionada
        $sql_preguntas = "SELECT id, texto FROM preguntas WHERE categoria_id = $categoria_id ORDER BY id";
        $result_preguntas = $conn->query($sql_preguntas);

        if ($result_preguntas->num_rows > 0) {
            $preguntas = $result_preguntas->fetch_all(MYSQLI_ASSOC);

            if ($contador_pregunta < count($preguntas)) {
                $pregunta_actual = $preguntas[$contador_pregunta];
                $pregunta_id = $pregunta_actual["id"];
                $pregunta_texto = $pregunta_actual["texto"];

                // Consulta de las alternativas de la pregunta actual
                $sql_alternativas = "SELECT id, opcion FROM alternativas WHERE pregunta_id = $pregunta_id";
                $result_alternativas = $conn->query($sql_alternativas);

                if ($result_alternativas->num_rows > 0) {
                    echo "<h2>Pregunta " . ($contador_pregunta + 1) . ":</h2>";
                    echo "<p>$pregunta_texto</p>";
                    echo "<form id='alternativas-form' action='' method='POST'>";
                    echo "<input type='hidden' name='categoria' value='$categoria_id'>";
                    echo "<input type='hidden' name='contador_pregunta' value='".($contador_pregunta + 1)."'>";
                    echo "<input type='hidden' name='pregunta_id' value='$pregunta_id'>";
                    echo "<div class='alternativas-container'>";
                    while ($row_alternativa = $result_alternativas->fetch_assoc()) {
                        $alternativa_id = $row_alternativa["id"];
                        $alternativa_texto = $row_alternativa["opcion"];
                        
                        echo "<div class='enunciado-alternativa-container'>";
                        echo "<label class='enunciado-alternativa'><input type='radio' name='respuesta_seleccionada' value='$alternativa_texto' class='radio-hidden' onclick='submitForm()'>$alternativa_texto</label>";
                        echo "</div>";
                    }
                    echo "</div>";
                    echo "</form>";
                }
            } else {
                // Guardar el puntaje actual en el historial de puntajes
                $_SESSION['historial_puntajes'][] = array(
                    'puntaje' => $_SESSION['puntaje'],
                    'preguntas' => $preguntas
                );

                echo "<h3>Historial de puntajes:</h3>";
                echo "<ul>";
                foreach ($_SESSION['historial_puntajes'] as $index => $historial) {
                    $puntaje = $historial['puntaje'];
                    $preguntas = $historial['preguntas'];

                    echo "<li>";
                    echo "<p>Puntaje obtenido: $puntaje puntos</p>";
                    echo "<p>Preguntas:</p>";
                    echo "<ul>";
                    foreach ($preguntas as $pregunta) {
                        echo "<li>";
                        echo "{$pregunta['texto']} - Puntaje: 400 puntos";
                        echo "</li>";
                    }
                    echo "</ul>";
                    echo "</li>";
                }
                echo "</ul>";

                echo "<h3>Historial de respuestas:</h3>";
                echo "<ul>";
                foreach ($_SESSION['historial_respuestas'] as $index => $respuesta) {
                    $pregunta_id = $respuesta['pregunta_id'];
                    $respuesta_seleccionada = $respuesta['respuesta_seleccionada'];
                    $respuesta_correcta = $respuesta['respuesta_correcta'];
                    $es_correcta = $respuesta['es_correcta'];

                    $pregunta_texto = $preguntas[$index]['texto'];

                    echo "<li>";
                    echo "<p>Pregunta: $pregunta_texto</p>";
                    echo "<p>Respuesta seleccionada: $respuesta_seleccionada</p>";
                    echo "<p>Respuesta correcta: $respuesta_correcta</p>";
                    if ($es_correcta) {
                        echo "<p>¡Respuesta correcta! - Puntaje: 400 puntos</p>";
                    } else {
                        echo "<p>Respuesta incorrecta - Puntaje: 0 puntos</p>";
                    }
                    echo "</li>";
                }
                echo "</ul>";
            }
        }

        // Cerrar conexión
        $conn->close();
        ?>
    </div>

    <!-- Scripts -->
    <script>
        function submitForm() {
            document.getElementById("alternativas-form").submit();
        }
    </script>
</body>
</html>

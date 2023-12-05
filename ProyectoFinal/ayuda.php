<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Preguntas Frecuentes</title>
    <style>
        /* Estilos CSS para dar formato a las preguntas y respuestas */
        .faq {
            margin-bottom: 20px;
        }
        .question {
            font-weight: bold;
            cursor: pointer;
        }
        .answer {
            display: none;
            margin-left: 20px;
        }
    </style>
</head>
<body>
    <h1>Preguntas Frecuentes</h1>

    <div class="faq">
        <div class="question">1. ¿QUÉ OPCIONES DE PAGO OFRECE DEPORTUAA PARA COMPRAR?</div>
        <div class="answer">DEPORTUAA pone a tu disposición los sigueintes métodos de pago, elige el que mejor se adapte a tus necesidades y empieza a cambiar tu vida a través del deporte. 

1 ) Pagos con Tarjeta de Crédito / Débito o a través de PayPal

</div>
    </div>

    <div class="faq">
        <div class="question">2. ¿TIENE SERVICIO DE ATENCIÓN AL CLIENTE POR TELÉFONO O CHAT EN VIVO?</div>
        <div class="answer">Puede ponerse en contacto con nuestro soporte técnico enviando un correo electrónico a deportuaa2023@hotmail.com o llamando al número 449-661-97-56.</div>
    </div>

    <div class="faq">
        <div class="question">3. ¿OFRECEN DESCUENTOS Y ARTICULOS ESPECIALES?</div>
        <div class="answer">Ofrecemos algunos productos con un 10% de descuento en articulos seleccionados, ademas de codigos de descuento en cupones participantes registrando el codigo .</div>
    </div>

    <div class="faq">
        <div class="question">4. ¿TIENE SERVICIO DE ATENCIÓN AL CLIENTE POR TELÉFONO O CHAT EN VIVO??</div>
        <div class="answer">Contamos con número de contacto al WhatsApp (449-661-97-56), asi como un chat en vivo como soporte. Nuestro chat en vivo está disponible durante nuestro horario de atención al cliente de L-V de 9 am - 10 pm. Simplemente haga clic en el icono de chat en la esquina inferior derecha de la página para empezar.
</div>
    </div>

    <div class="faq">
        <div class="question">5. ¿CÓMO PUEDO ENCONTRA UN PRODUCTOS ESPECIFICOS EN LA TIENDA?</div>
        <div class="answer">Para buscar un artículo en nuestra página web, sigue estos pasos:
           <ol>
                <li>Dirígete a la barra de búsqueda en la parte superior de la página.</li>
                <li>Ingresa palabras clave relacionadas con el artículo que estás buscando en el campo de búsqueda.</li>
                <li>Pulsa el botón "Buscar" o presiona la tecla "Enter".</li>
                <li>Los resultados de la búsqueda se mostrarán en una lista. Puedes hacer clic en un resultado para ver más detalles sobre el artículo.</li>
            </ol>

    <div class="faq">
        <div class="question">6. ¿HACEN ENVIOS INTERNACIONALES?</div>
        <div class="answer">Sí, DEPORTUAA ofrece envíos internacionales. Durante el proceso de compra, podrás seleccionar tu ubicación y ver las opciones de envío disponibles para tu país. Ten en cuenta que los tiempos de entrega pueden variar según la ubicación.</div>
    </div>

    <div class="faq">
        <div class="question">7. ¿CÓMO PUEDO CANCELAR UN PEDIDO YA REALIZADO?</div>
        <div class="answer">Si necesitas cancelar un pedido que ya has realizado, por favor, ponte en contacto con nuestro servicio de atención al cliente lo antes posible. Ten en cuenta que una vez que el pedido ha sido enviado, la cancelación podría no ser posible.</div>
    </div>

    <div class="faq">
        <div class="question">8. ¿PUEDO RASTREAR MI PEDIDO?</div>
        <div class="answer">Sí, ofrecemos la posibilidad de rastrear tu pedido. Una vez que tu pedido haya sido enviado, recibirás un correo electrónico con el número de seguimiento y las instrucciones para rastrear tu paquete.</div>
    </div>

    <div class="faq">
        <div class="question">9. ¿CÓMO PUEDO REALIZAR DEVOLUCIONES O CAMBIOS?</div>
        <div class="answer">Si necesitas realizar una devolución o cambio, por favor contacta a nuestro servicio de atención al cliente. Te proporcionaremos las instrucciones necesarias y te ayudaremos a gestionar el proceso de manera eficiente.</div>
    </div>

    <div class="faq">
        <div class="question">10. ¿QUÉ OPCIONES DE ENVÍO OFRECE DEPORTUAA?</div>
        <div class="answer">DEPORTUAA ofrece opciones de envío estándar y express. El costo y tiempo de entrega pueden variar según tu ubicación. Puedes obtener más información sobre nuestras opciones de envío durante el proceso de compra.</div>
    </div>


</div>
    </div>

 

    <script>
        // JavaScript para mostrar/ocultar respuestas cuando se hace clic en las preguntas
        const questions = document.querySelectorAll(".question");

        questions.forEach(question => {
            question.addEventListener("click", () => {
                const answer = question.nextElementSibling;
                answer.style.display = (answer.style.display === "block") ? "none" : "block";
            });
        });
    </script>
</body>
</html>
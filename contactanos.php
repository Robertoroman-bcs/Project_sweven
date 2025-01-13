<!DOCTYPE html>
<html lang="en">
<?php include './head.php' ?>
<title>Contáctanos</title>
</head>

<body>
    <?php include './navbar.php' ?>

    <section class="hero_contactanos_section">
        <div class="title_contactos">
            <h1 class="title">Información corporativa</h1>
        </div>

    </section>
    <section class="hero_contactanos_infomacion">
        <div class="contactanos_content">
            <div class="item_contactanos_info">
                <div class="info img_contactanos"></div>
                <div class="info map_contactanos">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d470.33507851448945!2d-99.21415497394527!3d19.42620035302488!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d201ab6652ca2b%3A0xff1e3b7d5a2d2496!2sBCS%20Advisor%20Capital%20SA%20de%20CV!5e0!3m2!1ses-419!2smx!4v1730844300962!5m2!1ses-419!2smx"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </iframe>
                </div>
                <div class="info datos_contactanos">
                    <h1>Datos de contacto</h1>
                    <div class="content_ubicacion space">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Monte Himalaya 125B, Lomas de Chapultepec, Miguel Hidalgo, 11000 Ciudad de México,
                            CDMX</span>
                    </div>
                    <div class="content_numero space">
                        <i class="fas fa-phone"></i>
                        <span>+52 561 123 4000</span>
                    </div>
                    <div class="content_email space">
                        <i class="fas fa-envelope"></i>
                        <span>miempresa@consulting.com</span>
                    </div>
                    <div class="content_redesociales space_redesociales">
                        <i class="fab fa-facebook"></i>
                        <i class="fab fa-instagram"></i>
                        <i class="fab fa-twitter"></i>
                    </div>
                </div>
            </div>
            <div class="item_contactanos_form">
                <div class="title-form">
                    <h1>Contáctanos</h1>

                    <p class="description-form">Escríbenos y en breve nos pondremos en contacto contigo</p>
                </div>
                <div class="inputs_contactanos">
                    <form action="" method="post">
                        <div class="input-contact">
                            <label for="Nombre">Nombre:</label>
                            <input type="text" name="nombre" placeholder="Nombre Completo" required>
                        </div>
                        <div class="input-contact">
                            <label for="Nombre" class="email-lbl">Email:</label>
                            <input type="email" name="email" class="email" placeholder="Email" required>
                        </div>
                        <div class="input-contact">
                            <label for="Nombre">Telefono:</label>
                            <input type="text" name="telefono" placeholder="Telefono" required>
                        </div>
                        <div class="input-contact">
                            <label for="Nombre">Mensaje:</label>
                            <textarea placeholder="Escriba su mensaje..." name="msjContact" style="resize: none;"
                                required></textarea>
                        </div>
                        <button class="btn_enviar_contactanos">Enviar</button>
                    </form>
                </div>
            </div>

        </div>

    </section>




    <?php include './footer.php' ?>
</body>

</html>
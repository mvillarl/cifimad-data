<p>&nbsp;</p>
<p>&nbsp;</p>
<div id="signup-form">
<?php if ($show) { ?>
    <h2 align="center">Voluntarios CifiMad</h2>
    <?php if ($created) { ?>
        <p align="center">Gracias por enviar tu inscripción. ¡Nos vemos en CifiMad!</p>
    <?php } else { ?>
<form method="post" id="form-volunteer" onsubmit="return sendForm();">
    <input type="hidden" name="<?= $csrfName ?>" value="<?= $csrfValue ?>"/>
    <div id="errors"><?= $errors ?></div>
    <div id="d-form-volunteer">
        <div id="d-form-volunteer-1">
        <p>Hola a todos.</p>

        <p>¡Vamos allá una vez más! Después de un par de años difíciles, 2023 vuelve a ser CifiMad sin pandemia y con invitados internacionales.
        Como siempre necesitamos vuestra ayuda para hacer que sea posible.</p>
        <p class="labelReq">* Obligatorio</p>
        <p><label>E-mail</label><span class="labelReq">*</span><br>
        <span><input type="text" name="email" size="40" maxlength="100" class="required email"/></span><br/>
        <div class="labelReq" id="error_email"></div></p>
        <p><label>Nombre y Apellidos<span class="labelReq">*</span></label><br>
        <span><input type="text" name="name" size="40" maxlength="100" class="required"/></span></p>
        <p><label>Nombre en Facebook</label><br>
        <span><input type="text" name="nameFacebook" size="40" maxlength="100" /></span></p>
            <p><input type="button" value="Siguiente" class="btnNav" id="volunteerNext"/></p>
        </div>
        <div id="d-form-volunteer-2">
            <h3>Sobre ti</h3>
            <p><label>¿Qué tal se te da la informática?</label><span class="labelReq">*</span><br>
            <p><select name="computersLevel" class="required">
                    <option value="">-- Escoge uno --</option>
                    <option value="1">No sé mucho</option>
                    <option value="2">Me defiendo</option>
                    <option value="3">Me pregunta todo el mundo a mí</option>
                </select></p>
            <h3>Colaboración</h3>
            <p><label>¿Dónde crees que podrías colaborar?</label><span class="labelReq">*</span><br>
            Las opciones que elijas serán valoradas por los responsables de la organización y se os comunicará el/los trabajo/s asignado/s.<br>
                <ul class="checkboxes">
            <?php foreach ($functions as $code => $name) { ?>
                <li><input type="checkbox" name="functions[]" class="functions required" value="<?= $code ?>"/> <?= $name ?> </li>
            <?php } ?>
                <li><input type="checkbox" name="functions[]" class="functions required requiresOther" data-other="functionOther" value="OT"/> Otra: <span><input type="text" name="functionOther" id="functionOther" size="40" maxlength="100" /></span></li>
            </ul>
            <p><label>¿Qué disponibilidad tienes?</label><span class="labelReq">*</span><br>
            <div class="ulcont">
            <ul class="checkboxes">
            <?php foreach ($shifts as $code => $name) { ?>
                <li><input type="checkbox" name="shifts[]" class="shifts required" value="<?= $code ?>"/> <?= $name ?> </li>
            <?php } ?>
                <li><input type="checkbox" name="shifts[]" class="shifts required requiresOther" data-other="shiftOther" value="OT"/> Otra: <span><input type="text" name="shiftOther" id="shiftOther" size="40" maxlength="100" /></span></li>
            </ul></div>
            <p><label>¿Conoces a alguien que quiera colaborar como voluntario?</label><br>
            En caso afirmativo, por favor necesitamos su nombre, apellidos, correo electrónico y teléfono para mantenernos en contacto.<br>
                <span><input type="text" name="otherVolunteer" size="40" maxlength="500" /></span></p>
            <p><input type="button" value="Anterior" class="btnNav" id="volunteerPrev"/>
                <input type="button" value="Enviar inscripción" class="submit" id="sendForm"/></p>
        </div>
    </div>
</form>
	<?php } ?>
<?php } else { ?>
	<h2 align="center">El plazo de inscripción de voluntarios ha finalizado</h2>
	<p align="center"> <img src="/img/cosplay-monstruitos.jpg"/> </p>
	<p>¡Gracias por animarte en todo caso!</p>
<?php } ?>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>


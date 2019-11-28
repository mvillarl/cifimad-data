<?php if ($show) { ?>
    <h2 align="center">Inscripción previa al concurso de cosplay</h2>
    <?php if ($created) { ?>
        <p align="center">Gracias por enviar tu inscripción. ¡Nos vemos en CifiMad!</p>
    <?php } else { ?>
    <form method="post" id="form-cosplay" onsubmit="return sendForm();">
        <input type="hidden" name="<?= $csrfName ?>" value="<?= $csrfValue ?>"/>
        <div id="errors"></div>
    <div id="d-form-cosplay">
        <p><label>Nombre</label><br>
        <span><input type="text" name="name" size="40" maxlength="100" class="required"/></span></p>
        <p><label>Apellidos</label><br>
            <span><input type="text" name="surname" size="40" maxlength="100" class="required"/></span></p>
        <p><label>E-mail</label><br>
            <span><input type="text" name="email" size="40" maxlength="100" class="required"/></span></p>
        <p><label>Categoría</label><br>
            <span><select name="category" class="required">
            <?php foreach ($categories as $catid => $catname) { ?>
                <option value="<?= $catid ?>"><?= $catname ?></option>
            <?php } ?>
        </select></span></p>
        <p><label>Personaje</label><br>
            <span><input type="text" name="characterName" size="40" maxlength="100" class="required"/></span></p>
        <p><label>Notas de elaboración</label><br>
            <span><textarea name="remarks" cols="60" rows="6"></textarea></span></p>
        <p>¿Has hecho tú mismo/a tu cosplay? ¿Has modificado una pieza existente de forma ingeniosa? ¿Has utilizado algún material o técnica exótica? ¿Has movido cielo y tierra para encontrar algún accesorio?
            ¡Usa el recuadro para contarnos cualquier cosa que creas que pueda interesar a los jueces para evaluar mejor tu trabajo!</p>
        <p class="consent"><input type="checkbox" name="consent" class="required"/> Al usar este formulario accedes al almacenamiento y gestión de tus datos por parte de esta web.</p>
        <p><input type="button" value="Enviar inscripción" class="submit" id="sendForm"/></p>
    </div>
    </form>
        <?php } ?>
    <p align="center"><img src="/img/cosplay-familia.jpg"/> </p>
<?php } else { ?>
    <h2 align="center">El plazo de inscripción previa al concurso de cosplay ha finalizado</h2>
    <p align="center"> <img src="/img/cosplay-monstruitos.jpg"/> </p>
    <p>Pero no te preocupes. ¡Aún puedes apuntarte en el propio evento! ¡Te esperamos!</p>
<?php } ?>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

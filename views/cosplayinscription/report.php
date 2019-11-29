<?php

use app\models\CosplayInscription;

/* @var $this yii\web\View */
/* @var $inscriptions app\models\CosplayInscription[] */

$this->title = 'Informe - Inscripciones al concurso de cosplay';
$this->params['breadcrumbs'][] = ['label' => 'Inscripciones al concurso de cosplay', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$rowsperpage = 40;
?>
<div class="cosplay">
    <?php for ($i = 0, $ct = count ($inscriptions), $cat = '', $num = 1; $i < $ct; $i++, $num++) { ?>
    <?php if ($cat != $inscriptions[$i]->category) { ?>
    <?php if (strlen ($cat)) { ?>
    </tbody>
    </table>
</div>
    <p class="pagebreak"> </p>
<div class="cosplay">
    <?php } ?>
    <table class="cosplay" cellpadding="1" cellspacing="1">
        <thead>
        <tr class="cosplaytitle">
            <th colspan="6">Categoría <?php echo $inscriptions[$i]->categoryValue; ?></th>
        </tr>
        <tr>
            <th>Nº</th>
            <th>COSPLAYER</th>
            <th>COSPLAY</th>
            <th class="med">Notas de elaboración</th>
            <th class="peq">¿Actuación?</th>
            <th class="peq">¿Banda sonora?</th>
        </tr>
        </thead>
        <tbody>
        <?php $cat = $inscriptions[$i]->category; $num = 1; } ?>
        <tr class="<?php echo ($i % 2)? 'even': 'odd' ?>">
            <td><?= $num ?></td>
            <td><?= htmlspecialchars($inscriptions[$i]->fullname) ?></td>
            <td><?= htmlspecialchars($inscriptions[$i]->characterName) ?></td>
            <td class="med"><?= htmlspecialchars($inscriptions[$i]->remarks) ?></td>
            <td><?= $inscriptions[$i]->hasPerformance? 'Sí': '' ?></td>
            <td><?= $inscriptions[$i]->hasSoundtrack? 'Sí': '' ?></td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

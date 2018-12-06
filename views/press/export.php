<table border="1" cellpadding="2">
	<thead>
	<tr>
		<th>Procedencia</th>
		<th>Nombre</th>
		<th>E-mail</th>
		<th>Clave de verificación</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($press as $pr) { ?>
		<tr>
			<td><?= $pr->sourceName ?></td>
			<td><?= $pr->name ?></td>
			<td><?= $pr->email ?></td>
			<td><?= $pr->keyCheck ?></td>
		</tr>
	<?php } ?>
	</tbody>
</table>
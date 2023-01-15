<table border="1" cellpadding="2">
	<thead>
	<tr>
		<th>Nombre</th>
		<th>E-mail</th>
		<th>Teléfono</th>
		<th>Nombre en redes sociales</th>
		<th>Conocimientos informática</th>
		<th>Dónde colabora</th>
		<th>Disponibilidad</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($volunteers as $v) { ?>
		<tr>
			<td><?= $v->name ?></td>
			<td><?= $v->email ?></td>
			<td><?= $v->phone ?></td>
			<td><?= $v->nameFacebook ?></td>
			<td><?= $v->computersLevelValue ?></td>
			<td><?= $v->getFunctionsValue() ?></td>
			<td><?= $v->getShiftsValue() ?></td>
		</tr>
	<?php } ?>
	</tbody>
</table>
<table border="1" cellpadding="2">
	<thead>
	<tr>
		<th>Nombre</th>
		<th>Apellidos</th>
		<th>E-mail</th>
		<th>DNI</th>
		<th>Observaciones</th>
		<th>Clave de verificación</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($members as $member) { ?>
		<tr>
			<td><?= $member->name ?></td>
			<td><?= $member->surname ?></td>
			<td><?= $member->email ?></td>
			<td><?= $member->nif ?></td>
			<td><?= $member->remarks ?></td>
			<td><?= $member->keyCheck ?></td>
		</tr>
	<?php } ?>
	</tbody>
</table>
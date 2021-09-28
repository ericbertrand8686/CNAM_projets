
<?php ob_start(); ?>

	<div class="container mt-3">
		<div class="card">
			<div class="card-header">
				<h2>Liste des genres</h2>
			</div>
			<div class="card-body">

			<main class="main" role="main">
			<div class="container">

				<p class="text-right">
					<a class="btn btn-primary" href='../controllers/admin.Objet.php?id=0&Objet=Genre'><i class="fas fa-plus mr-2"></i> Ajouter un genre</a>
				</p>

				<table class="table">
					<tr>
						<th>Titre</th>
						<th>Der</th>
						<th>Die</th>
						<th>Das</th>
						<th style="width:50px;"></th>
						<th style="width:50px;"></th>
					</tr>
					<?php
					foreach ($lesGenres as $genre) {
						echo "<tr>";
						echo "<td>" . $genre->getTitre() . "</td>";
						echo "<td>" . $genre->getDer() . "</td>";
						echo "<td>" . $genre->getDie() . "</td>";
						echo "<td>" . $genre->getDas() . "</td>";
						echo "<td><a href='../controllers/admin.Objet.php?id=" . $genre->getId() . "&Objet=Genre" . "' rel=\"tooltip\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"Modifier\"><i class=\"fas fa-edit\"></i></a></td>";
						echo "<td><a href='../controllers/admin.delete.php?idSuppression=" . $genre->getId() . "&Objet=Genre" . "' rel=\"tooltip\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"Supprimer\"><i class=\"fas fa-trash\"></i></a></td>";
						echo "</tr>";
					}
					?>
				</table>

			</div>
		</main>

			</div>
			<div class="card-footer"></div>
		</div>
	</div>

<?php $contenu = ob_get_clean(); ?>
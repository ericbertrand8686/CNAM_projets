
<?php ob_start(); ?>

	<div class="container mt-3">
		<div class="card">
			<div class="card-header">
				<h2>Listes de mots</h2>
			</div>
			<div class="card-body">

			<main class="main" role="main">
			<div class="container">

				<p class="text-right">
					<a class="btn btn-primary" href='../controllers/admin.Objet.php?id=0&Objet=Liste'><i class="fas fa-plus mr-2"></i> Ajouter une liste</a>
				</p>

				<table class="table">
					<tr>
						<th>Titre</th>
						<th style="width:50px;"></th>
						<th style="width:50px;"></th>
					</tr>
					
					<?php
					foreach ($lesListes as $liste) {
						echo "<tr>";
						echo "<td>" . $liste->getTitreFrancais() . "</td>";
						echo "<td><a href='../controllers/admin.Objet.php?id=" . $liste->getId() . "&Objet=Liste" . "' rel=\"tooltip\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"Modifier\"><i class=\"fas fa-edit\"></i></a></td>";
						echo "<td><a href='../controllers/admin.delete.php?idSuppression=" . $liste->getId() . "&Objet=Liste" . "' rel=\"tooltip\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"Supprimer\"><i class=\"fas fa-trash\"></i></a></td>";
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
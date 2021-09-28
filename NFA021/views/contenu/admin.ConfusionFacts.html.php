
<?php ob_start(); ?>

	<div class="container mt-3">
		<div class="card">
			<div class="card-header">
				<h2>Liste des facteurs de confusion</h2>
			</div>
			<div class="card-body">

			<main class="main" role="main">
			<div class="container">

				<p class="text-right">
					<a class="btn btn-primary" href='../controllers/admin.Objet.php?id=0&Objet=ConfusionFact'><i class="fas fa-plus mr-2"></i> Ajouter un facteur</a>
				</p>

				<table class="table">
					<tr>
						<th>Titre</th>
						<th>Description</th>
						<th>Genre</th>
						<th style="width:50px;"></th>
						<th style="width:50px;"></th>
					</tr>
					<?php
					foreach ($lesConfusionFacts as $confusionFact) {
						echo "<tr>";
						echo "<td>" . $confusionFact->getTitre() . "</td>";
						echo "<td>" . $confusionFact->getDescrFrancais() . "</td>";
						echo "<td><a href='../controllers/admin.Objet.php?id=" . $confusionFact->getId() . "&Objet=Regle" . "' rel=\"tooltip\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"Modifier\"><i class=\"fas fa-edit\"></i></a></td>";
						echo "<td><a href='../controllers/admin.delete.php?idSuppression=" . $confusionFact->getId() . "&Objet=Regle" . "' rel=\"tooltip\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"Supprimer\"><i class=\"fas fa-trash\"></i></a></td>";
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
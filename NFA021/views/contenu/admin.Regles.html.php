
<?php ob_start(); ?>

	<div class="container mt-3">
		<div class="card">
			<div class="card-header">
				<h2>Liste des règles</h2>
			</div>
			<div class="card-body">

			<main class="main" role="main">
			<div class="container">

				<p class="text-right">
					<a class="btn btn-primary" href='../controllers/admin.Objet.php?id=0&Objet=Regle'><i class="fas fa-plus mr-2"></i> Ajouter une règle</a>
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
					foreach ($lesRegles as $regle) {
						echo "<tr>";
						echo "<td>" . $regle->getTitre() . "</td>";
						echo "<td>" . $regle->getDescrFrancais() . "</td>";
						echo "<td>" . $regle->getGenre() . "</td>";
						echo "<td><a href='../controllers/admin.Objet.php?id=" . $regle->getId() . "&Objet=Regle" . "' rel=\"tooltip\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"Modifier\"><i class=\"fas fa-edit\"></i></a></td>";
						echo "<td><a href='../controllers/admin.delete.php?idSuppression=" . $regle->getId() . "&Objet=Regle" . "' rel=\"tooltip\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"Supprimer\"><i class=\"fas fa-trash\"></i></a></td>";
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
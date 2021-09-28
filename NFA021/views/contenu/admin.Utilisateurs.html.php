
<?php ob_start(); ?>

	<div class="container mt-3">
		<div class="card">
			<div class="card-header">
				<h2>Liste des utilisateur</h2>
			</div>
			<div class="card-body">

			<main class="main" role="main">
			<div class="container">

				<p class="text-right">
					<a class="btn btn-primary" href='../controllers/admin.Objet.php?id=0&Objet=Utilisateur'><i class="fas fa-plus mr-2"></i> Ajouter un utilisateur</a>
				</p>

				<table class="table">
					<tr>
						<th>Nom</th>
						<th>Prénom</th>
						<th>Valide</th>
						<th style="width:50px;"></th>
						<th style="width:50px;"></th>
					</tr>
					<?php
					foreach ($lesUtilisateurs as $utilisateur) {
						echo "<tr>";
						echo "<td>" . $utilisateur->getNom() . "</td>";
						echo "<td>" . $utilisateur->getPrenom() . "</td>";
						echo "<td>" . ($utilisateur->getEstValide() ? "Oui" : "Non") . "</td>";
						echo "<td><a href='../controllers/admin.Objet.php?id=" . $utilisateur->getId() . "&Objet=Utilisateur" . "' rel=\"tooltip\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"Modifier\"><i class=\"fas fa-edit\"></i></a></td>";
						echo "<td><a href='../controllers/admin.delete.php?idSuppression=" . $utilisateur->getId() . "&Objet=Utilisateur" . "' rel=\"tooltip\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"Supprimer\"><i class=\"fas fa-trash\"></i></a></td>";
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

	<script>
		$(function() {
			$("[rel='tooltip']").tooltip();
		});
	</script>


<?php $contenu = ob_get_clean(); ?>
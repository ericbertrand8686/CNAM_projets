
<?php ob_start(); ?>

	<div class="container mt-3">
		<div class="card">
			<div class="card-header">
				<h2>Choisissez une liste de mots</h2>
			</div>
			<div class="card-body">

			<main class="main" role="main">
			<div class="container">

				<table class="table">
					
					<?php
					foreach ($lesListes as $liste) {
						echo "<tr>" . "<td>";
						echo  "<a href='../controllers/utilisateur.Objets.php?idliste=" . $liste->getId() . "&Objets=Mots" . "'>" .
						$liste->getTitreFrancais() . "</a>";
						echo "</td>" . "</tr>";
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
<?php ob_start(); ?>

	<div class="container mt-3">
		<div class="card">
			<div class="card-header">
				<h2>Choisissez un objet</h2>
			</div>
			<div class="card-body">

			<ul class="navbar-nav ml-auto">
				<li class="nav-item"><a href="../controllers/admin.Objets.php?Objets=Utilisateurs" class="nav-link text-uppercase font-weight-bold">UtilisateurS</a></li>
				<li class="nav-item"><a href="../controllers/admin.Objets.php?Objets=Groupes" class="nav-link text-uppercase font-weight-bold">Thèmes</a></li>
				<li class="nav-item"><a href="../controllers/admin.Objets.php?Objets=Listes" class="nav-link text-uppercase font-weight-bold">Listes</a></li>
				<li class="nav-item"><a href="../controllers/admin.Objets.php?Objets=Mots" class="nav-link text-uppercase font-weight-bold">Mots</a></li>
				<li class="nav-item"><a href="../controllers/admin.Objets.php?Objets=Genres" class="nav-link text-uppercase font-weight-bold">Genres</a></li>
				<li class="nav-item"><a href="../controllers/admin.Objets.php?Objets=Regles" class="nav-link text-uppercase font-weight-bold">Règles</a></li>
				<li class="nav-item"><a href="../controllers/admin.Objets.php?Objets=ConfusionFacts" class="nav-link text-uppercase font-weight-bold">Facteurs de confusion</a></li>
				<li class="nav-item"><a href="../controllers/admin.Objets.php?Objets=Scores" class="nav-link text-uppercase font-weight-bold">Scores</a></li>
				<li class="nav-item"><a href="../controllers/admin.Objets.php?Objets=Revisions" class="nav-link text-uppercase font-weight-bold">Révisions</a></li>
			</ul>

			</div>
			<div class="card-footer"></div>
		</div>
	</div>

<?php $contenu = ob_get_clean(); ?>
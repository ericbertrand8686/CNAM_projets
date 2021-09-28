<?php ob_start(); ?>

	<div class="container mt-3">
		<div class="card">
			<div class="card-header">
				<h2>Trouvez le genre du mot</h2>
			</div>
			<div class="card-body">

			<main class="main" role="main">
			<div class="container" style="text-align:center">

				<h1 id="leMot" style="color:darkred;"></h1><br>
				<h3 id="Traduction"></h3><br>
				<div id="btnLigne1"></div><span id="Ligne1"></span><br>
				<div id="btnLigne2"></div><span id="Ligne2"></span><br><br>
				
				<table class="table">
				<tr>
					<td>Tour : <span id="Tour"></span></td>
					<td>Score : <span id="Score"></span></td>
				</tr> 
				</table>


				<div style="font-weight: bold;">

					<button
					type="button" id="Der" class="btn btn-outline-primary btn-rounded btn-lg btnGenre" data-mdb-ripple-color="dark">
					DER
					</button>

					<button
					type="button" id="Die" class="btn btn-outline-primary btn-rounded btn-lg btnGenre" data-mdb-ripple-color="dark">
					DIE
					</button>

					<button
					type="button" id="Das" class="btn btn-outline-primary btn-rounded btn-lg btnGenre" data-mdb-ripple-color="dark">
					DAS
					</button>

					<button
					type="button" id="Suivant" class="btn btn-outline-primary btn-rounded btn-lg" data-mdb-ripple-color="dark">
					<i class="fas fa-arrow-right "></i>
					</button>

				</div>
			

			</div>
		</main>

			</div>
			<div class="card-footer"></div>
		</div>
	</div>

	<script type="text/javascript" src="../views/scripts/utlisateur.Mots.script.js"></script>

	<script type="application/javascript">

		// Je récupère toutes les données de la liste d'un seul tenant sous forme de JSON
		// Je ne peux le faire que dans un fichier PHP et pas dans le fichier .js en src
		// ou se trouvent l'essentiel des fonctions
		var lesMotsJson = <?php echo json_encode($lesMots) ?>;
		var nbtours = lesMotsJson.length;
		var tour = 1;
		var leMot= JSON.parse(lesMotsJson[tour]);
		var aRepondu = 0;
		var score = 0;
		var resultat = "";
		var listeid = <?php echo $_SESSION["listeId"] ?>;

		var originalButtonColor = $("#Der").css('color');
		var originalButtonBackground = $("#Der").css('background-color');

	</script>

<?php $contenu = ob_get_clean(); ?>
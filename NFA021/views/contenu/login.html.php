<?php ob_start(); ?>

	<div class="container mt-3">
		<div class="card">
			<div class="card-header">
				<h2>Connexion</h2>
			</div>
			<div class="card-body">

				<form action= "../../controllers/login.php" method="post">

					<div class="form-group">
						<label for="mail">Email : </label>
						<input type="text" class="form-control" id="mail" name="mail" value="" />
					</div>

					<div class="form-group">
						<label for="password">Password : </label>
						<input type="password" class="form-control" id="password" name="password" value="" />
					</div>

					<input type="submit" class="btn btn-primary" name="btnEnvoyer" value="Envoyer" />
				</form>

				<p class="text-center">
					<a href="/views/signin.php">Inscription</a>
				</p>

			</div>
			<div class="card-footer"></div>
		</div>
	</div>

<?php $contenu = ob_get_clean(); ?>

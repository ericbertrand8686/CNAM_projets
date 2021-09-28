<?php ob_start(); ?>

	<div class="container mt-3">
		<div class="card">
			<div class="card-header">
				<h2>Nous vous informons que</h2>
			</div>
			<div class="card-body">
				<?php echo $message ?>
			</div>
			<div class="card-footer"></div>
		</div>
	</div>

<?php $contenu = ob_get_clean(); ?>

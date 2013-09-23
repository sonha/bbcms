<?php
	$presenter = new Illuminate\Pagination\BootstrapPresenter($paginator);
?>

<div class="row">
	<div class="col-md-4">
		<div class="pagination pull-left">
			Hiển thị
			<?php echo $paginator->getFrom(); ?>
			-
			<?php echo $paginator->getTo(); ?>
			trên
			<?php echo $paginator->getTotal(); ?>
			tin
		</div>
	</div>

	<div class="col-md-8">
		<ul class="pagination pull-right">
			<?php echo $presenter->render(); ?>
		</ul>
	</div>
</div>

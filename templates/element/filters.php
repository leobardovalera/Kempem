<?php 
	use Cake\Utility\Text;
	$request = $this->request->getQuery(); 
?>

<form action="" method="get" id="filters" class="mb-4">
	<div class="row filters dataTables_wrapper form-inline dt-bootstrap no-footer">
		<div class="col-9">
			<?php if($filters) foreach($filters as $field => $f){ ?>
					<?php switch ($f['type']) {
						case 'active': ?>
							<select name="<?= $field ?>" class="form-control input-sm mb-1">
								<option value="">Status</option>
									<option value="1" 
										<?= $request && $request[$field] == '1' ? 'selected' : '' ?>
									>Activo</option>
									<option value="0" 
										<?= $request && $request[$field] == '0' ? 'selected' : '' ?>
									>Inactivo</option>
							</select>
					<?php
						break;
						case 'select': ?>
							<select name="<?= $field ?>" id="<?= Text::slug($field) ?>" class="form-control form-control-sm">
								<option value=""><?= $f['label'] ?></option>
								<?php if(!empty($f['options'])) foreach($f['options'] as $value => $text){ ?>
									<option value="<?= $value ?>" 
										<?= $request && isset($request[$field]) && $request[$field] == $value ? 'selected' : '' ?>
									>
										<?= $text ?>
									</option>
								<?php } ?>
							</select>
					<?php
						break;
						case 'text': ?>
							<input type="text" name="<?= $field ?>" id="<?= Text::slug($field) ?>" class="form-control form-control-sm" value="<?= isset($request[$field])?$request[$field]:'' ?>" placeholder="<?= $f['label'] ?>" />
					<?php
						break;
						case 'break':
							echo '<br />';
						break;
						case 'date':?>
							<input type="date" name="<?= $field ?>" id="<?= Text::slug($field) ?>" class="form-control form-control-sm" value="<?= isset($request[$field])?$request[$field]:'' ?>" placeholder="<?= $f['label'] ?>" />
					<?php
						break;
					} ?>
			<?php } ?>
		</div>
		<div class="col-3 text-right">
			<button type="submit" title="Filtrar" class="btn btn-primary btn-xs mr-2">Filtrar</button>
			<?= $this->Html->link(
				'Limpiar',
				['action' => 'index', '_full' => true, 'class' => 'btn btn-light btn-xs']
			); ?>
		</div>
	</div>
</form>

<?php $this->append('css'); ?>
    <style>
	    .filters label {
		    display: inline-block;
		    margin-right: 15px;
		}
		.form-control-sm{
			max-width: 200px;
		}
		input[type="date"]:before {
			content: attr(placeholder) !important;
			color: #aaa;
			margin-right: 0.5em;
		}
		input[type="date"]:focus:before,
		input[type="date"]:valid:before {
			content: "";
		}
    </style>
<?php $this->end(); ?>
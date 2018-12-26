<li class="todo-list">
		<div class="row">
			<div class="col-sm-8">
    		<div class="form-check">
					<input class="form-check-input" type="checkbox" value="<?php echo $data['id']?>" id="todo<?php echo $data['id']?>" name="<?php echo $data['name']?>">
	  			<label class="form-check-label" style="width: 100%">
		    		<?php echo $data['name'] ?>
	  			</label>
				</div>
			</div>
			<div class="col-sm-4">
				<form action="<?php echo route('todoDelete', ['id' => $data['id']])?>" method="POST" class="delete_todo form-inline">
        		<?php echo method_field('DELETE') ?>
        		<button type="submit" name="x" data-token = "<?php echo csrf_token()?>">[x]</button>
    		</form>
			</div>
		</div>
</li>
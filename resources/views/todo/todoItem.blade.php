<li class="todo-list">
    <input type="checkbox" name="<?php echo $data['name']?>" value="<?php echo $data['id']?>"> <?php echo $data['name'] ?> 
    <form action="<?php echo route('todoDelete', ['id' => $data['id']])?>" method="POST" class="delete_todo">
        <?php echo method_field('DELETE') ?>
        <button type="submit" name="x" data-token = "<?php echo csrf_token()?>">[x]</button>
    </form>
</li>
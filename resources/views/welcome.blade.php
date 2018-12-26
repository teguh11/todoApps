<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>
        <!-- <meta name="csrf-token" content="<?php echo csrf_token() ?>"> -->
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
        <style type="text/css">
            ul{
                margin: 0; padding: 0;
            }
            ul li{
                list-style: none;
                margin-bottom: 10px;
            }
        </style>
        <script type="text/javascript">
            $(document).ready(function(){
                var list_arr = [];

                function list_todo() {
                    var url = $('ul#todo-lists').attr('data-url');
                    $.get(url, function(data) {
                        $('ul#todo-lists').html($.parseHTML(data));
                    })
                }

                list_todo();

                $('form#todo').submit(function(e) {
                    $.ajax({
                        url : $(this).attr('action'),
                        type : "POST",
                        data : $(this).serialize(),
                        success : function(data) {
                            console.log(data);
                            if(data.status)
                            {
                                $('ul#todo-lists').append($.parseHTML(data.data.item));
                                $('#todo_add').val('');

                            }
                        }
                    })
                    // $.post($(this).attr('action'), $(this).serialize(), function(data) {
                        
                    // })
                    e.preventDefault();
                })

                $('ul#todo-lists').on('click', 'li.todo-list input', function(evt) {
                    var clickId = $(this).attr('value');
                    $indexId = list_arr.indexOf(clickId);
                    if( $indexId >= 0){
                        list_arr.splice($indexId, 1);
                    }
                    else{
                        list_arr.push(clickId);
                    }
                })

                function list(data)
                {
                    return '<li class="todo-list"><input type="checkbox" name="'+data.data.name+'" value="'+data.data.id+'"> '+data.data.name+' </li>';
                }

                // delete per todo item
                $('ul#todo-lists').on('click', '.delete_todo', function(e) {
                    if(confirm("Are you sure?"))
                    {
                        $.ajax({
                            url : $(e.target).closest('form').attr('action'),
                            type : 'DELETE',
                            data : {
                                '_method' : 'DELETE',
                                '_token'  :  $(this).find('button').attr('data-token')
                            },
                            success : function(data) {
                                console.log(data);
                                list_todo();            
                            }
                        })
                    }        
                    e.preventDefault();
                })

                $('#delete_selected_todo').click(function(e) {
                    if(confirm("Are you sure?"))
                    {
                        $.ajax({
                            url : $(e.target).closest('form').attr('action'),
                            type : 'DELETE',
                            data : {
                                '_method' : 'DELETE',
                                '_token'  :  $(this).find('button').attr('data-token'),
                                'id' : list_arr
                            },
                            success : function(data) {
                                console.log(data);
                                list_todo();            
                            }
                        })
                    }                    
                    e.preventDefault();
                })

            })
        </script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col">
                    <form action="<?php echo route('todoCreate')?>" method="post" id="todo" class="form-inline">
                        <div class="form-group mx-sm-3 mb-2">
                            <input type="text" class="form-control" id="todo_add" name="todo" placeholder="To do list">
                        <?php echo csrf_field(); ?>
                        <!-- <input type="text" name="todo" class="form-control"> -->
                        <input type="hidden" name="todo_val" value="">

                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Add</button>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <ul id="todo-lists" data-url="<?php echo route('todoLists')?>">
                       
                    </ul>

                    <form method="post" id="delete_selected_todo" action="<?php echo route('todoBulkDelete')?>">
                        <?php echo method_field('DELETE') ?>
                        <button data-token="<?php echo csrf_token()?>">DELETE SELECT</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>


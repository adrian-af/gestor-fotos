<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
</head>
<body>
    <h1>hola mundo</h1>
    <input type="text" id='search'>
    <div id='info'></div>
    <script>
         $.ajaxSetup({
            headers: 
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#search").keyup(function()
        {
            $value = $("#search").val();
            $.ajax({
                type: 'get',
                url: "<?php echo e(URL::to('search')); ?>",
                data: {search: $value},
                success: function(data)
                {
                    $info = $("#info");
                    $info.append(data);
                }
            })
        });
    </script>
</body>
</html><?php /**PATH C:\xampp\htdocs\scriptsPHP\gestor\resources\views/ajax.blade.php ENDPATH**/ ?>
<?PHP require 'sql_connect.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Добавить статью</title>
</head>
<body>
    <!-- Подключение шапки сайта -->
    <?php 
        require_once('block/header.php');
    ?>

<!-- Основная часть сайта -->
  <main>
      <div class="container">
       <h2>Добавить статью</h2>
            <div class="row">
                <div class="col-md-6">
                <form id="add_form" class="mt-5" method="post"  enctype="multipart/form-data">

                    <input class="form-control mt-2 mb-4" type="text" name="title" id="title" placeholder="Введите заголовок статьи">
                    <textarea name="intro" id="intro" class="form-control mb-4" placeholder="Введите интро статьи"></textarea>
                    <textarea name="text" id="text" class="form-control mb-4" placeholder="Введите текст статьи"></textarea>
                    
                    <div id="errorBlock" class="alert alert-danger mt-3"></div>
                    <div id="successBlock" class="alert alert-success mt-3"></div>

                    <!-- <input id="upload-file" class="form-control" type="file" name="uploadfile" multiple="multiple"> -->

                    <button id="add_article" type="button" name="submit" class="btn btn-secondary mt-3">Добавить</button>
                </form>
           


                </div>
                <div class="col-md-6">
                    <div>
                       <img class="register_img" src="writeArt.png" alt="">
                    </div>
                </div>
            </div>
      </div>

  </main>

    <!-- Подключение подвала сайта -->
     <?php 
        require_once('block/footer.php');
    ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $('#add_article').click(function() {
        let title = $('#title').val();
        let intro = $('#intro').val();
        let text = $('#text').val();

        $.ajax({
            url: 'ajax/add_article.php',
            type: 'post',
            cache: false,
            data: {'title':title,'intro':intro,'text':text},
            datatype: 'html',
            success: function(data) {
                if(data == 'Готово') {
                    $('#add_article').text('Отправленно');
                    $('#errorBlock').hide();
                    $('#successBlock').show();
                    $('#successBlock').text('Данные отправленны');
                    $('#add_form')[0].reset();
                } else {
                    $('#errorBlock').show();
                    $('#errorBlock').text(data);
                }
            }
        });
    });

</script>

    
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Регистрация</title>
</head>
<body>
    <!-- Подключение шапки сайта -->
    <?php 
        require_once('block/header.php');
    ?>

<!-- Основная часть сайта -->
  <main>
      <div class="container">
        <h2>Форма регистрации</h2>
            <div class="row">
                <div class="col-md-6">
                <form id="regForm" method="post">
            <div class="mt-5">
                <!-- <label for="username" class="form-label">Введите имя</label> -->
                <input type="text" class="form-control mb-4" id="username" name="username" placeholder="Введите ваше имя">
                
                <!-- <label for="email" class="form-label">Введите Email</label> -->
                <input type="text" class="form-control mb-4" id="email" name="email" placeholder="Введите ваш email">

                <!-- <label for="login" class="form-label">Введите логин</label> -->
                <input type="text" class="form-control mb-4" id="login" name="login" placeholder="Введите ваш логин">

                <!-- <label for="password" class="form-label">Введите пароль</label> -->
                <input type="password" class="form-control mb-4" id="password" name="password" placeholder="Введите ваш пароль">
            </div>
                <div id="successBlock" class="alert alert-success"></div>
                <div id="errorBlock" class="alert alert-danger"></div>
                <button id="reg_user" type="button" class="btn btn-primary">Регистрация</button>
            </form>
                </div>
                <div class="col-md-6">
                    <div>
                       <img class="register_img" src="draw1.webp" alt="">
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
    $('#reg_user').click(function() {
        let username = $('#username').val();
        let email = $('#email').val();
        let login = $('#login').val();
        let password = $('#password').val();

        $.ajax({
            url: 'ajax/register.php',
            type: 'post',
            cache: false,
            data: {'username':username,'email':email,'login':login,'password':password},
            datatype: 'html',
            success: function(data) {
                if(data == 'Готово') {
                    $('#reg_user').text('Отправленно');
                    $('#errorBlock').hide();
                    $('#successBlock').show();
                    $('#successBlock').text('Данные отправленны успешно');
                    $('#regForm')[0].reset();
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
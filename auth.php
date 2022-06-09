<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Вход</title>
</head>
<body>
    <!-- Подключение шапки сайта -->
    <?php 
        require_once('block/header.php');
    ?>

<!-- Основная часть сайта -->

<main>
    <div class="container">
        <div class="row">
            <?PHP if($_COOKIE['login'] == ''): ?>
            <div class="col-md-6">
                <img src="signUp.jpg" alt="" style="width: 600px">
            </div>
            <div class="col-md-6">
            <form id="signForm" method="post">
                <h3 class="mt-5">Форма авторизации</h3>
        <div class="mt-4">
            <label for="login" class="form-label">Введите логин</label>
            <input type="text" class="form-control mb-3" id="login" name="login" placeholder="Пример: John">

            <label for="password" class="form-label">Введите пароль</label>
            <input type="password" class="form-control mb-3" id="password" name="password" placeholder="Пример: john123">
        </div>

        <div id="successBlock" class="alert alert-success"></div>
            <div id="errorBlock" class="alert alert-danger"></div>

            <div class="g-recaptcha" data-sitekey="6Lf6yCkgAAAAAAbO0bfbOiwpnhTWM40fNUau7EDQ"></div>

            <button id="sign_user" type="button" class="btn btn-primary mt-3">Вход</button>
            </form>
            <?PHP else:?>
                    <div class="d-flex align-items-center justify-content-between"
                    style="margin-bottom: 20px; padding: 10px 0px 20px ;border-bottom: 2px solid #000;">
                    <h4>Добро пожаловать, <p class="d-inline text-danger"><?=$_COOKIE['login']?></p></h4>
                    <button id="logout_btn" type="button" class="btn btn-outline-danger mt-3" style="width: 100px">Выход</button>
                    </div>

                    <div class="crud-system">
                        <div class="row">
                    <h2 class="fw-Semibold mb-5">Опублекованные статьи:</h2>
                        <?PHP
                            include_once 'sql_connect.php';

                            $sql = "SELECT COUNT(id) AS total FROM articles WHERE author = :login";
                            $query = $dsn->prepare($sql);
                            $query->execute(['login'=>$_COOKIE['login']]);
                            $row = $query->fetch(PDO::FETCH_ASSOC);
                           if($row['total'] == 0) {
                               echo "
                                <div class='rounded-3 alert alert-info'>
                               <p class='fw-SemiBold'>У вас нет ниодной статьи. Что бы добавить свою статью нажмите кнопку Добавить статью в панели управления</p>
                               </div>
                               ";
                           } else {
                            $sql = "SELECT * FROM articles WHERE author = :login";
                            $query = $dsn->prepare($sql);
                            $query->execute(['login'=>$_COOKIE['login']]);
                            while($row = $query->fetch(PDO::FETCH_OBJ)) {
                                echo "
                                <div class='col mb-5'>
                                <div class='card shadow-sm'>
                                    <div class='card-body'>
                                    <h2 class='fw-bold'>$row->title</h2>
                                    <p class='card-text'>$row->text</p>
                                    <div class='d-flex justify-content-between align-items-center'>
                                        <div class='btn-group'>
                                        <a href='updating/update.php?id=$row->id'><button type='button' class='btn btn-sm btn-primary me-2'>Изменить</button></a>
                                        <a href='news.php?id=$row->id'><button type='button' class='btn btn-sm btn-secondary me-2'>Посмотреть</button></a>
                                        <a href='updating/delete.php?id=$row->id'><button type='button' class='btn btn-sm btn-danger me-2'>Удалить</button></a>
                                        <a href='updating/upload.php?id=$row->id'><button type='button' class='btn btn-sm btn-info'>Добавить изображение</button></a>
                                        </div>
                                        <small class='text-muted'9 mins></small>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                ";
                    }
                }
                ?>
                        </div>
                    </div>
                <!-- </form> -->
                <?php endif;?>
            </div>
        </div>
    </div>
    </main>


    <!-- Подключение подвала сайта -->
     <?php 
        require_once('block/footer.php');
    ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script>
    $('#sign_user').click(function() {
        let login = $('#login').val();
        let password = $('#password').val();

        $.ajax({
            url: 'ajax/authorization.php',
            type: 'post',
            cache: false,
            data: {'login':login,'password':password},
            datatype: 'html',
            success: function(data) {
                if(data == 'Готово') {
                    $('#sign_user').text('Отправленно');
                    $('#errorBlock').hide();
                    $('#successBlock').show();
                    $('#successBlock').text('Данные отправленны успешно');
                    $('#signForm')[0].reset();
                    document.location.reload(true);
                } else {
                    $('#errorBlock').show();
                    $('#errorBlock').text(data);
                }
            }
        });
    });


   
    $('#logout_btn').click(function() {
    $.ajax({
            url: 'ajax/logout.php',
            type: 'post',
            cache: false,
            data: {},
            datatype: 'html',
            success: function(data) {
                document.location.reload(true);
            }
        });
    });
</script>

    
</body>
</html>
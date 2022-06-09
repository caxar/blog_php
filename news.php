    <?PHP
        include_once './sql_connect.php';

        $sql = "SELECT * FROM articles WHERE id = :id";
        $id = $_GET['id'];
        $query = $dsn->prepare($sql);
        $query->execute(['id'=>$id]);

        $article = $query->fetch(PDO::FETCH_OBJ);

    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Blog</title>
</head>
<body>
    <!-- Подключение шапки сайта -->
    <?php 
        require_once('block/header.php');
    ?>

<!-- Основная часть сайта -->
  <main>
      <div class="container">
          <div class="articles">
          <div class="p-5 mb-4 bg-light rounded-3">
                <div class="container-fluid py-5">
                    <img src='upload/<?= $article->name?>' alt="<?=$article->name?>" class="mb-5" style="width: 500px">
                    <h1 class="display-5 fw-bold"><?=$article->title?></h1>
                    <p>Автор: <mark><b><?=$article->author?></b></mark>
                <span>Время публикации:<?=$date = date('l dS \of F Y h:i:s A', $article->date);?></span></p>
                    <p class="col-md-8 fs-4"><?=$article->intro?></p>
                    <p class="col-md-8 fs-4"><?=$article->text?></p>
                    <a href="index.php"><button class="btn btn-primary btn-lg" type="button">Вернутся к статьям</button></a>
                 </div>
            </div>
          </div>
      </div>
  </main>

    <!-- Подключение подвала сайта -->
     <?php 
        require_once('block/footer.php');
    ?>
    
</body>
</html>
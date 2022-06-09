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
          <div class="d-flex flex-wrap">
        <?PHP
            include_once './sql_connect.php';

            $sql = 'SELECT * FROM articles ORDER BY id DESC';
            $query = $dsn->query($sql);
            while($row = $query->fetch(PDO::FETCH_OBJ)) {
                $date = date('l dS \of F Y h:i:s A', $row->date);
                echo "
                <div class='flex-fill h-100 p-5 bg-light border rounded-3 me-2 mb-5'>
                    <h2>$row->title</h2>
                    <p>Автор: <mark><b>$row->author</b></mark>
                    <span>Время публикации: <span class='text-danger'>$date</span></span></p>
                    <p>$row->intro</p>
                    <p class='row-items'>$row->text</p>
                    <a href='news.php?id=$row->id'><button class='btn btn-outline-secondary'>Открыть</button></a>
                </div>
                ";
            }
        ?>
          </div>
      </div>
  </main>
  <!-- <img src='upload/$row->name' style='width: 150px; margin-bottom: 20px' alt=''> -->

    <!-- Подключение подвала сайта -->
     <?php 
        require_once('block/footer.php');
    ?>
    
</body>
</html>
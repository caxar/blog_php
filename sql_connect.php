<?PHP
    $username = 'root';
    $password = '';
    $db = 'blognew';
    $host = 'localhost';
    $dsn = new PDO('mysql:host='.$host.';dbname='.$db, $username, $password);
?>
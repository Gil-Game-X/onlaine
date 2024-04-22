<?php
// Параметры подключения к базе данных
$dbname = 'priemnyi';
$host = '95.57.215.42';
$port = '5486';
$user = 'zhu_kezek101';
$password = 'Kezek_101$';

try {
    // Подключение к базе данных с помощью PDO
    $dbconn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);

    
    // Устанавливаем режим обработки ошибок
    $dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Проверяем, была ли отправлена форма
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Получаем данные из формы
        $surname = $_POST['surname'];
        $name = $_POST['name'];
        $fathername = $_POST['fathername'];
        $email = $_POST['email'];

        // Подготавливаем SQL запрос
        $stmt = $dbconn->prepare("INSERT INTO master_class (a_surname, a_father_name, a_name, email) VALUES (?, ?, ?, ?)");
        
        // Выполняем запрос с передачей данных
        $stmt->execute([$surname, $fathername, $name, $email, $number]);

        // Выводим сообщение об успешном сохранении
        echo "<div style='text-align: center; color: blue; font-weight: bold;'>Данные успешно сохранены в базе данных!</div>";
    }
} catch(PDOException $e) {
    // Выводим сообщение об ошибке при подключении или выполнении запроса
    echo "Ошибка: " . $e->getMessage();
}

// Закрываем соединение с базой данных
$dbconn = null;
?>


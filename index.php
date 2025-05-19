<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Этнофит</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <main class="container">
    <section id="about" class="section padd">
      <div class="section-title">Bird Check</div>
      <img class="logo" src="logo.png" alt="Логотип">
    </section>

    <section id="check" class="section check">
      <form id="cheeck" method="POST" action="">
        <div class="opr">Определитель</div>
        <label for="sound_bird">Загрузите звук птицы</label>
        <input type="file" id="sound_bird" name="sound_bird"/>
        <button type="submit" class="check-btn" name="submit">Определить</button>
      </form>
      <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          $conn = @new mysqli("localhost", "root", "mysql", "bird_check");
          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }
          
          $Bird = rand(1,4);
          $result = $conn->query("SELECT * FROM `birds` WHERE `ID` = '$Bird'");
          
          if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo '<div class="bird-result">';
            echo 'Определенная птица: ' . htmlspecialchars($row['birds_name']);
            echo '</div>';
          } else {
            echo '<div class="bird-result">Птица не найдена</div>';
          }
          
          $conn->close();
        }
      ?>
    </section>
  </main>

  <footer>
    &copy; 2025 Bird Check. Все права защищены.
  </footer>
</body>
</html>
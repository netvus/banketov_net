<?php
require_once "../includes/auth_check.php";
require_once "../config/db.php";

$user_id = $_SESSION["user_id"];
$id = (int)$_GET["id"];

$message = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $review = $_POST["review"];

    mysqli_query(
    $conn,
    "INSERT INTO reviews
    (user_id,application_id,review_text)
    VALUES
    ('$user_id','$id','$review')"
    );

    $message = "Отзыв отправлен";
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<title>Отзыв</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

<link rel="stylesheet" href="../assets/css/style.css">

</head>
<body>

<div class="container py-5">

<div class="row justify-content-center">

<div class="col-md-6">

<div class="card shadow">

<div class="card-body">

<h2 class="mb-4">
Отзыв о мероприятии
</h2>

<div class="text-success mb-3">
<?= $message ?>
</div>

<form method="POST">

<textarea name="review"
          class="form-control mb-3"
          rows="5"
          placeholder="Напишите впечатления о проведенном банкете"
          required></textarea>

<button type="submit" class="btn btn-danger w-100">
Отправить
</button>

</form>

</div>

</div>

</div>

</div>

</div>

</body>
</html>

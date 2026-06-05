<?php
require_once "../includes/auth_check.php";
require_once "../config/db.php";

$user_id = (int) $_SESSION["user_id"];
$message = "";
$message_type = "success";
$today = date("Y-m-d");

$venue_types = [
    "Банкетный зал",
    "Ресторан",
    "Летняя веранда",
    "Закрытая веранда",
];

$payment_methods = [
    "Карта",
    "Наличные",
    "Безналичный расчет",
];

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $hall_type = mysqli_real_escape_string($conn, trim($_POST["hall_type"]));
    $event_date = mysqli_real_escape_string($conn, trim($_POST["event_date"]));
    $payment_method = mysqli_real_escape_string($conn, trim($_POST["payment_method"]));

    if($event_date < $today){
        $message = "Укажите сегодняшнюю или будущую дату банкета.";
        $message_type = "danger";
    }else{
        mysqli_query(
            $conn,
            "INSERT INTO applications (user_id,hall_type,event_date,payment_method)
             VALUES ('$user_id','$hall_type','$event_date','$payment_method')"
        );

        $message = "Заявка отправлена администратору.";
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Оформление заявки</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="app-page">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <div class="card">
                <div class="card-body p-4">
                    <h1 class="h3 mb-4">Оформление заявки</h1>

                    <?php if($message !== ""): ?>
                    <div class="alert alert-<?= $message_type ?>"><?= htmlspecialchars($message) ?></div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Помещение</label>
                            <select name="hall_type" class="form-select" required>
                                <?php foreach($venue_types as $venue_type): ?>
                                <option value="<?= htmlspecialchars($venue_type) ?>"><?= htmlspecialchars($venue_type) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Дата начала банкета</label>
                            <input type="date" name="event_date" class="form-control" min="<?= $today ?>" required>
                            <div class="form-text">Формат даты: ДД.ММ.ГГГГ.</div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Способ оплаты</label>
                            <select name="payment_method" class="form-select" required>
                                <?php foreach($payment_methods as $payment_method): ?>
                                <option value="<?= htmlspecialchars($payment_method) ?>"><?= htmlspecialchars($payment_method) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-danger w-100">Создать заявку</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>

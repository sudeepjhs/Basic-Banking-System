<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/footer.css">
    <title>Welcome to Bank</title>
</head>

<body>
    <div id="intro">
        <h1>Welcome to Spark Foundation | Bank</h1>
        <button onclick="veiwCustomer();" class="btn btn-primary">Veiw Customer</button>
    </div>
    <br>
    <div class="container">
        <div class="icons">
            <img src="icon/lighting.png" alt="icon">
            <h4>FAST</h4>
        </div>
        <div class="icons">
            <img src="icon/padlock.png" alt="icon">
            <h4>SECURE</h4>
        </div>
        <div class="icons">
            <img src="icon/globe.png" alt="icon">
            <h4>RELIABLE</h4>
        </div>
    </div>
    <br><br><br>
    <?php include_once "footer.php"?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
</body>
    <script>
        function veiwCustomer(){
            window.location.href = "customers.php"; 
        }
    </script>
</html>
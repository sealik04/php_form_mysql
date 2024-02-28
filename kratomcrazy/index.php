<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kratom Crazy</title>
    <style>
        body {
            font-family: "Heiti SC";
            background-color: #111;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #232222;
            border: 0.5px solid #7d7d7d;
            color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        h2 {
            margin-bottom: 10px;
        }

        input,
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        input[type="radio"] {
            accent-color: rebeccapurple;
            margin-bottom: 0;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        input[type="text"],
        input[type="password"],
        input[type="file"],
        select {
            background-color: #262626;
            color: white;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

    </style>

</head>
<body>

<?php
$connection = mysqli_connect("localhost", "root", "", "formular");

if(isset($_POST["submit"])){
    $errors = [];

    $requiredFields = ['name', 'surname', 'pass', 'confirm-pass', 'jazyky', 'pohlavi', 'image-upload'];
    foreach ($requiredFields as $field) {
        if ($field === 'pohlavi') {
            if (!isset($_POST[$field])) {
                $errors[] = "neni vyplneno pohlavi";
                break;
            }
        } elseif ($field === 'image-upload') {
            if (empty($_FILES[$field]['name'])) {
                $errors[] = "neni vyplneny obrazek";
                break;
            }
        } elseif ($field === 'jazyky') {
            if (empty($_POST[$field])) {
                $errors[] = "neni vyplneny jazyk";
                break;
            }
        } elseif (empty($_POST[$field])) {
            $errors[] = "nejsou vyplnena vsechna pole";
            break;
        }
    }

    if(empty($errors)) {
        $first_name = $_POST["name"];
        $last_name = $_POST["surname"];
        $sex = $_POST["pohlavi"];
        $language = $_POST["jazyky"];

        $image = file_get_contents($_FILES['image-upload']['tmp_name']);

        $insert_query = "INSERT INTO data_formular (jmeno, prijmeni, pohlavi, jazyk, image) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($connection, $insert_query);
        mysqli_stmt_bind_param($stmt, "sssss", $first_name, $last_name, $sex, $language, $image);
        $result = mysqli_stmt_execute($stmt);

        if(!$result){
            echo "chyba pri vkladu";
        } else {
            echo "uspesne vlozene";
        }

    } else {
        foreach ($errors as $error) {
            echo "<p class='error'>$error</p>";
        }
    }
}
?>

<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
    <h2>Ride</h2>
    <input type="image" name="klik" src="richard.png"><br>

    <h2>jmeno</h2>
    <input type="text" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>">
    <h2>prijmeni</h2>
    <input type="text" name="surname" value="<?php echo isset($_POST['surname']) ? $_POST['surname'] : ''; ?>"><br>
    <h2>heslo</h2>
    <input type="password" name="pass" value="<?php echo isset($_POST['pass']) ? $_POST['pass'] : ''; ?>"><br>
    <h2>potvrdit heslo</h2>
    <input type="password" name="confirm-pass" value="<?php echo isset($_POST['confirm-pass']) ? $_POST['confirm-pass'] : ''; ?>"><br>
    <h2>pohlavi</h2>
    <input type="radio" name="pohlavi" value="muz">muž<br>
    <input type="radio" name="pohlavi" value="zena">žena<br>
    <input type="radio" name="pohlavi" value="nemam">preferuji neodpovídat<br>
    <h2>obrazek</h2>
    <input type="file" name="image-upload" accept="image/jpg, image/png"><br>
    <h2>jazyk</h2>
    <select name="jazyky" size="4">
        <option value="cz">cz</option>
        <option value="en">en</option>
        <option value="de">de</option>
        <option value="es">es</option>
    </select>
    <br>
    <input type="submit" name="submit" value="Submit">
</form>

</body>
</html>

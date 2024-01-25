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

        input[type="text"] {
            background-color: #262626;
            color: white;
        }

        input[type="password"] {
            background-color: #262626;
            color: white;
        }

        input[type="select"] {
            background-color: #262626;
            color: white;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        input[type="option"] {
            background-color: #262626;
            color: white;
        }
    </style>

</head>
<body>
<?php
$connection = mysqli_connect("localhost", "root", "", "formular");

if(isset($_POST["submit"])){
    $first_name = $_POST["name"];
    $last_name = $_POST["surname"];
    $sex = $_POST["pohlavi"];
    $language = $_POST["jazyky"];

    if(isset($first_name, $last_name, $sex, $language, $image)){
        $insert_query = "INSERT INTO data_formular (jmeno, prijmeni, pohlavi, jazyk) VALUES ('$first_name', '$last_name', '$sex', '$language')";

        $result = mysqli_query($connection, $insert_query);
        if(!$result){
            echo "error";
        }
    }

}
?>

<form action="index.php" method="post">
    <h2>Ride</h2>
    <input type="image" name="klik" src="richard.png"><br>

    <h2>Full name</h2>
    <input type="text" name="name" value="">
    <h2>Surname</h2>
    <input type="text" name="surname" value=""><br>
    <h2>Password</h2>
    <input type="password" name="pass" value=""><br>
    <h2>Confirm Password</h2>
    <input type="password" name="confirm-pass" value=""><br>
    <h2>Gender</h2>
    <input type="radio" name="pohlavi" value="muz">muž<br>
    <input type="radio" name="pohlavi" value="zena">žena<br>
    <input type="radio" name="pohlavi" value="nemam">preferuji neodpovídat<br>
    <h2>Upload cv</h2>
    <input type="file" name="image-upload" accept="image/jpg, image/png"><br>
    <h2>Language</h2>
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
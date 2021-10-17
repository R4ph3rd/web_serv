<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POO php</title>
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

<form method="post" action="#">
    <?php
        include('./classes/Form.php');
        $form = new Form($_POST);

        echo $form->input('username', 'text');
        echo $form->input('password', 'password');
        echo $form->input('', 'submit');

    ?>
</form>
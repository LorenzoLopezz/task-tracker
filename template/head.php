<?php
    $user_theme_select = 0;
    switch ($user_theme_select) {
        case '1':
            $user_theme = "css/light_theme.css";
            break;
        
        default:
            $user_theme = "css/light_theme.css";
            break;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="-1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,800|Raleway:400,700|Thasadith:400" rel="stylesheet">
    <title><?php echo $titulo; ?></title>
    <link rel="stylesheet" href="css/flexboxgrid.min.css">
    <link rel="stylesheet" href="css/primary.css">
    <link rel="stylesheet" href="<?php echo $user_theme; ?>">
</head>
<body class="body_fonts" onresize="resizing()" onload="resizing()">
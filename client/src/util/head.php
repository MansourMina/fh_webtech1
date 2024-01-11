<link rel="icon" href="res/img/title-logo.svg" type="image/icon type">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,600&display=swap" rel="stylesheet">
<?php
function getIcon($icon)
{
    $icons = ["country" => "flag", "business" => "briefcase", "hotel" => "hotel"];
    if (!array_key_exists(strtolower($icon), $icons)) return 'hotel';
    return $icons[strtolower($icon)];
}
?>


<style>
    * {
        font-family: 'Open Sans', sans-serif;
    }

    html {
        padding: 0;
        margin: 0;
    }

    .btn-full {
        color: <?= $GLOBALS["darkMode"] ? 'black' : 'white' ?>;
        background-color: <?= $GLOBALS["darkMode"] ? 'white' : '#15736b' ?>;
    }

    .title,
    i,
    svg,
    .category {
        color: <?= $GLOBALS["darkMode"] ? 'white' : '#15736b' ?>;
    }



    .btn {
        border-radius: 0;
    }



    .drk:after {
        content: "";
        display: block;
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: black;
        opacity: 0.6;
        z-index: 1;
    }

    /*  Dark mode  */
</style>
<?php
// Get form data
$name = $_POST['name'] ?? '';
$age = $_POST['age'] ?? '';
$color = $_POST['color'] ?? '';
$hometown = $_POST['hometown'] ?? '';
$activity = $_POST['activity'] ?? '';
$points = array(0, 0, 0, 0, 0);
// Check if any fields are empty
$errors = [];
if (empty($name)) {
    $errors[] = "Please enter your name";
}
if (empty($age)) {
    $errors[] = "Please select your age range";
}
if (empty($color)) {
    $errors[] = "Please select your favorite color";
}
if (empty($hometown)) {
    $errors[] = "Please select your hometown";
}
if (empty($activity)) {
    $errors[] = "Please select your favorite activity";
}

// If there are errors, redirect back to the form with error messages
if (!empty($errors)) {
    $error_string = implode("<br>", $errors);
    header("Location: index.php?error=" . urlencode($error_string));
    exit();
}

// Determine character based on answers

if ($age == 'under18') {
    $points[0]++;
} elseif ($age == '18-24') {
    $points[1]++;
} elseif ($age == '25-34') {
    $points[2]++;
} elseif ($age == '35-44') {
    $points[3]++;
} elseif ($age == '45+') {
    $points[4]++;
}

if ($color == 'blue') {
    $points[0]++;
} elseif ($color == 'yellow') {
    $points[1]++;
} elseif ($color == 'green') {
    $points[2]++;
} elseif ($color == 'red') {
    $points[3]++;
}

if ($hometown == 'springfield') {
    $points[0]++;
} elseif ($hometown == 'shelbyville') {
    $points[1]++;
} elseif ($hometown == 'capital_city') {
    $points[2]++;
} elseif ($hometown == 'other') {
    $points[3]++;
}

if ($activity == 'watching_tv') {
    $points[0]++; // Homer
} elseif ($activity == 'knitting') {
    $points[1]++; // Marge
} elseif ($activity == 'skateboarding') {
    $points[2]++; // Bart
} elseif ($activity == 'reading') {
    $points[3]++; // Lisa
}
$max_points = max($points);
$character = array_search($max_points, $points);

$character_names = array("Homer Simpson", "Marge Simpson", "Bart Simpson", "Lisa Simpson");
$character = $character_names[$character];


// define the file path where we want to store the data
$path = getcwd();

// construct a filename
$filename = $path . "/data/character.txt";    

file_put_contents($filename, $character . "\n", FILE_APPEND);

setcookie("character", $character, time() + 3600);

header("Location: index.php");
exit();

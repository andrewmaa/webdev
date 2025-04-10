<?php
// Start the session
session_start();

// Get the character data from the file
$filename = __DIR__ . "/data/character.txt";
$characterData = file_get_contents($filename);

// Count total submissions by counting lines
$submissions = preg_split('/\r\n|\r|\n/', $characterData);
$submissions = array_filter($submissions); // Remove empty lines
$totalSubmissions = count($submissions);

// Count occurrences of each character
$characterCounts = [
    'Homer Simpson' => 0,
    'Marge Simpson' => 0,
    'Bart Simpson' => 0,
    'Lisa Simpson' => 0
];

foreach ($submissions as $submission) {
    foreach ($characterCounts as $character => $count) {
        if (strpos($submission, $character) !== false) {
            $characterCounts[$character]++;
            break;
        }
    }
}

// Calculate percentages
$percentages = [];
foreach ($characterCounts as $character => $count) {
    $percentages[$character] = ($totalSubmissions > 0) ? round(($count / $totalSubmissions) * 100) : 0;
}

// Define colors for each character
$characterColors = [
    'Homer Simpson' => 'bg-blue-400',
    'Marge Simpson' => 'bg-purple-400',
    'Bart Simpson' => 'bg-orange-400',
    'Lisa Simpson' => 'bg-red-400'
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Results</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-3xl font-bold text-center my-4 text-blue-600">Quiz Results</h1>
        
        <p class="text-lg text-center mb-6">
            Total number of quiz submissions: <span class="font-bold"><?php echo $totalSubmissions; ?></span>
        </p>
        
        <div class="space-y-6 mb-8">
            <h2 class="text-xl font-semibold text-gray-700">Character Distribution</h2>
            
            <?php foreach ($characterCounts as $character => $count): ?>
                <div class="mb-4">
                    <div class="flex justify-between mb-1">
                        <span class="font-medium"><?php echo $character; ?></span>
                        <span><?php echo $count; ?> votes (<?php echo $percentages[$character]; ?>%)</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-6">
                        <div class="<?php echo $characterColors[$character]; ?> h-6 rounded-full" 
                             style="width: <?php echo $percentages[$character]; ?>%"></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center">
            <a href="index.php" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Take the Quiz Again
            </a>
        </div>
    </div>
</body>
</html>

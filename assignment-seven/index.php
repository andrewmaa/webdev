<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simpsons Character Quiz</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        .form-radio {
            accent-color: #2563eb;
        }
    </style>
</head>
<body class="bg-gray-100">
    <h1 class="text-3xl font-bold text-center my-6 text-blue-600">Which Simpsons Character Are You?</h1>

    <?php
    if (isset($_GET['error'])) {
        echo '<div class="max-w-md mx-auto bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">';
        echo urldecode($_GET['error']);
        echo '</div>';
    }
    
    if (isset($_COOKIE['character'])) {
        echo '<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md text-center">';
        echo '<h2 class="text-2xl font-bold text-blue-600 mb-4">Your Result</h2>';
        echo '<p class="text-xl text-gray-700">You are ' . htmlspecialchars($_COOKIE['character']) . '!</p>';
        echo '<div class="mt-4 flex justify-center space-x-4">';
        echo '<a href="index.php?reset=true" class="text-white bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded">Take the quiz again</a>';
        echo '<a href="results.php" class="text-white bg-green-500 hover:bg-green-700 font-bold py-2 px-4 rounded">View All Results</a>';
        echo '</div>';
        echo '</div>';
    } else {
    ?>
    <form action="processresults.php" method="post" class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">What is your name?</label>
            <input type="text" name="name" placeholder="Name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">How old are you?</label>
            <select name="age" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">Select your age range</option>
                <option value="under18">Under 18</option>
                <option value="18-24">18-24</option>
                <option value="25-34">25-34</option>
                <option value="35-44">35-44</option>
                <option value="45+">45+</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">What is your favorite color?</label>
            <div class="flex flex-wrap gap-2">
                <label class="inline-flex items-center">
                    <input type="radio" name="color" value="blue" class="form-radio text-blue-600">
                    <span class="ml-2">Blue</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="color" value="yellow" class="form-radio text-yellow-600">
                    <span class="ml-2">Yellow</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="color" value="green" class="form-radio text-green-600">
                    <span class="ml-2">Green</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="color" value="red" class="form-radio text-red-600">
                    <span class="ml-2">Red</span>
                </label>
            </div>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Where is your hometown?</label>
            <select name="hometown" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">Select your hometown</option>
                <option value="springfield">Springfield</option>
                <option value="shelbyville">Shelbyville</option>
                <option value="capital_city">Capital City</option>
                <option value="other">Other</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">What's your favorite activity?</label>
            <div class="flex flex-wrap gap-2">
                <label class="inline-flex items-center">
                    <input type="radio" name="activity" value="watching_tv" class="form-radio text-blue-600">
                    <span class="ml-2">Watching TV</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="activity" value="knitting" class="form-radio text-pink-600">
                    <span class="ml-2">Knitting</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="activity" value="skateboarding" class="form-radio text-orange-600">
                    <span class="ml-2">Skateboarding</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="activity" value="reading" class="form-radio text-purple-600">
                    <span class="ml-2">Reading</span>
                </label>
            </div>
        </div>
        <div class="flex items-center justify-center mb-4">
            <input type="submit" value="Submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline cursor-pointer">
        </div>
        <div class="flex items-center justify-center">
            <p class="text-gray-700 text-sm font-bold mb-2"> <a href="results.php">See the results</a></p>
        </div>
        
    </form>
    <?php
    }
    
    if (isset($_GET['reset']) && $_GET['reset'] == 'true') {
        setcookie('character', '', time() - 3600);
        header('Location: index.php');
        exit();
    }
    ?>
</body>
</html>

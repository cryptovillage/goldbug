<?php
$currentBug = "/var/www/html/puzzles/2023/bughunt/current";
$imageDirectory = '/var/www/html/puzzles/2023/bughunt/img/';

$imageFiles = scandir($imageDirectory);
$imageFiles = array_filter($imageFiles, function ($file) {
    return in_array(pathinfo($file, PATHINFO_EXTENSION), ['png']);
});
$randomKey = array_rand($imageFiles);
$chosenImage = $imageFiles[$randomKey];
$creationTime = filectime($currentBug);
$currentTime = time();

// Check if the currentBug was updated more than 15 minutes ago
if ($creationTime < $currentTime - (5 * 60)) {
  // set new bug
  file_put_contents($currentBug, "/puzzles/2023/bughunt/img/$chosenImage");
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Bug Hunt</title>

    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <style>
        @font-face {
            font-family: 'CrayonPastel';
            src: url('/puzzles/2023/bughunt/Crayon pastel.otf') format('opentype');
        }

        body {
            font-family: 'CrayonPastel', sans-serif;
            background-color: black;
            color: white;
            font-size: 16pt;
	    margin-left: 50px;
	    margin-right: 50px;
        }

        h1 {
            font-family: 'CrayonPastel', sans-serif;
        }
    </style>
</head>
<body>
    <h1>Lost Bugs</h1>
    <p>I came to DEF CON with my jar of bugs to show all my new friends.  I walked around all over the conference before I noticed the lid was loose, so now they could be anywhere.</p>  
</br>
<p>
Here is a picture of what they look like:</p>
</br>
<img src="<?php echo file_get_contents($currentBug)?>" alt="Image of a bug with strange markings over it." width=30%>
</br>
<p>Find as many as you can and take note of their unique markings.  You can hold one or two for a while, but please release them when you are done so all can enjoy.  Be sure to leave them in plain sight!</p>
</br>
</br>
</br>
<p style="font-family:courier;">Submit your answers and access the rest of the GoldBug Contest at <a href="https://bbs.goldbug.cryptovillage.org/">https://bbs.goldbug.cryptovillage.org/</a></p> 
</body>
</html>

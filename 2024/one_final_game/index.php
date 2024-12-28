<?php
// Define the start time and number of images in the directory
// The first card will be released at Noon on Thursday
//   The final card will be revealed at 5pm on Saturday
$startDateTime = new DateTime('2024-08-08 12:00:00');
$imageDirectory = 'images'; // Directory containing images

// Get all image files from the directory
$imageFiles = array_diff(scandir($imageDirectory), array('..', '.'));
$numberOfImages = count($imageFiles);

// Ensure there are enough images in the directory
if ($numberOfImages < 54) {
    die('The directory does not contain enough images.');
}

// Get the current date and time
$currentDateTime = new DateTime();

// Ensure that no images are displayed before the start time
if ($currentDateTime < $startDateTime) {
    $imagesToDisplay = [];
} else {
    // Calculate the time difference from the start time
    $intervalSinceStart = $currentDateTime->diff($startDateTime);

    // Calculate the total hours since the start time
    $totalHours = $intervalSinceStart->days * 24 + $intervalSinceStart->h;

    // Calculate how many images to display
    $imagesToDisplay = array_slice($imageFiles, 0, min($totalHours + 1, $numberOfImages));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A Final Game</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }
        .container {
            text-align: left;
	    max-width: 90%;
	    padding: 25px;
        }
        .gallery {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .image-wrapper {
            margin: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            overflow: hidden;
            max-width: 100px;
            max-height: 150px;
        }
        .image-wrapper img {
            width: 100%;
            height: auto;
            display: block;
        }
        .info {
            font-size: 16px;
            color: gray;
        }
    </style>
</head>


    <div class="container">
	<div class="header-text">


<style>
    @font-face {
      font-family: 'Calligraffitti';
      src: url('Calligraffitti-Regular.ttf') format('ttf'),
      font-weight: normal;
      font-style: normal;
    }
  </style>



<p style="font-family: 'Calligraffitti'; font-size: 44px;" align="center">
One Final Game
</br></br>
<img src="party.png" width=50%">
</p>
<br>
<p style="font-family: 'Calligraffitti'; font-size: 22px;">

An evening of merriment and frivolity, such fun!  As the guests gather once again in the parlour, returning from their assorted games and diversions, the host announces that there is time enough for one final game.  <br><br>

But what shall it be? <br><br>

"Let's play a card game!" comes a shout from somewhere in the back of the room.<br><br>

"No, let's read some literature!" someone interrupts.<br><br>

"Perhaps," a timid voice starts, "we could go into the garden and try the hedge maze?"<br><br>

"A treasure hunt!" comes another suggestion.<br><br>

Silently, the host watches as the room fills with ideas, counter-arguments, and confusion.  The crowd begins to grow wild, many guests defending their ideas from perceived attack as they would protect an infant from an agitated badger.  The boisterous arguments give way to insults and mischief.  Slippers hidden, bonnets tugged, and perhaps even a mustache cut off halfway.<br><br>

Raising a hand to halt the din, the corners of the host's mouth begin a snail's journey upward as the hint of a smile forms.  The guests halt their commotion immediately, terribly embarrassed by their emotion-fueled breach of etiquette.  They wait patiently for the host to speak or to form a fully-functional grin, not knowing which was more likely to occur first.<br><br>

The grin.  Like a Cheshire cat standing in front of the crowd, the host finally speaks.<br><br>

"If we've only time for one final game," he begins, "then it should be one to remember!  I'll make a game that you shall all enjoy."<br><br>

</p>



	<br><br><br>

	</div>
        <?php if (empty($imagesToDisplay)): ?>
        <?php else: ?>
            <div class="gallery">
                <?php foreach ($imagesToDisplay as $image): ?>
                    <?php
                    $imagePath = $imageDirectory . '/' . $image;
                    ?>
                    <div class="image-wrapper">
                        <a href="<?php echo htmlspecialchars($imagePath, ENT_QUOTES, 'UTF-8'); ?>" target="_blank">
                            <img src="<?php echo htmlspecialchars($imagePath, ENT_QUOTES, 'UTF-8'); ?>" alt="Image">
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

<p style="padding: 20px;">
Note: Card images will be released over time.  For a physical deck of cards, please visit the Crypto and Privacy Village or the Gold Bug table in the Contest Area.  </p>
</body>
</html>


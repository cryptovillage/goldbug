<?php
session_start();

// Check if a number is already stored in the session and if it's still valid
if (!isset($_SESSION['random_number']) || time() - $_SESSION['timestamp'] > 600) {
    // Generate a new random number and store it in the session
    $_SESSION['random_number'] = rand(0, 13);
    $_SESSION['timestamp'] = time();
}

echo "<style>
    @font-face {
      font-family: 'Calligraffitti';
      src: url('Calligraffitti-Regular.ttf') format('ttf'),
      font-weight: normal;
      font-style: normal;
    }
  </style>
<img src=\"hunt.png\" alt=\"Hunt the Slipper\" width=50%>";




// Display the random number and corresponding message
$randomNumber = $_SESSION['random_number'];
//echo "<br><br><br>The random number is: " . $randomNumber . "<br><br><br>";

echo "<p style=\"font-family: 'Calligraffitti'; font-size: 24px;\">";

echo "A slipper hunt!  O, a slipper hunt!  What a joyous game!  One bold guest is ";
if ($randomNumber !== 1) {echo "chosen";} else {echo "selected";}
echo " to close their eyes while a slipper is ";
if ($randomNumber !== 2) {echo "exchanged";} else {echo "passed";}
echo " between hands, from one player to the next.  The hunter must listen ";
if ($randomNumber !== 3) {echo "carefully";} else {echo "earnestly";}
echo " for any hint of guile or deceit, for the other players will use any ";
if ($randomNumber !== 4) {echo "sly";} else {echo "cunning";}
echo " trick to confuse.  ";
if ($randomNumber !== 5) {echo "Tiny";} else {echo "Subtle";}
echo " differences in their movements or wording may be the key for the hunter to ";
if ($randomNumber !== 6) {echo "notice";} else {echo "observe";}
echo ".  When the hunter's eyes are opened again, they watch the other players ";
if ($randomNumber !== 7) {echo "intently";} else {echo "closely";}
echo " to see who might be averting their gaze or trying to ";
if ($randomNumber !== 8) {echo "hide";} else {echo "veil";}
echo " a grin.  The players may continue to pass the slipper, trying to avoid ";
if ($randomNumber !== 9) {echo "suspicion";} else {echo "observation";}
echo " as the hunter attempts to peer into their souls.  The hunter points excitedly at a suspect, ";
if ($randomNumber !== 10) {echo "but";} else {echo "yet";}
echo " the slipper has already moved on.  A few more ";
if ($randomNumber !== 11) {echo "tries";} else {echo "attempts";}
echo ", each one quicker, and the slipper is soon found!  The ";
if ($randomNumber !== 12) {echo "circle";} else {echo "group";}
echo " breaks out in a cheer, as the hunter holds up the slipper proudly and takes a bow, signaling that the game has ";
if ($randomNumber !== 13) {echo "concluded";} else {echo "ended";}
echo ".";


echo "</p>";

echo "<br><br><br>To submit your answer and access the rest of the puzzles, go to <a href=\"https://bbs.goldbug.cryptovillage.org\">https://bbs.goldbug.cryptovillage.org</a>";

?>

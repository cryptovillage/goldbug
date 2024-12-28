<?php              
session_start();

$target_letter = "ourmeltedshipnevergonnagiveyouupnevergonnaletyoudownnevergonnaturnaroundanddesertyou.";

// Function to check if user inputs a real word (noun)
function wordExists($word) {
	$words = file('91Knouns.txt', FILE_IGNORE_NEW_LINES);
    return in_array(rtrim(strtolower($word)), $words);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item = $_POST['item'];

    if (!isset($_SESSION['current_letter'])) {
        $_SESSION['current_letter'] = 'o';
        $_SESSION['items_bought'] = 0;
    }

    if (wordExists($item)) {
        if (strtolower($item[0]) === $_SESSION['current_letter']) {
            // Correct item
         
            
            if ($_SESSION['items_bought'] == 0) {
                echo "\"Let me go check on that,\" the shopkeeper replies and disappears around a shelf.  You wonder nervously if the shop even carries the item you randomly blurted out.  After an uncomfortable wait, which was probably only about 20 seconds, the shopkeeper returns with the item you requested.";
            }
            if ($_SESSION['items_bought'] == 1) {
                echo "\"Certainly!\" the shopkeeper reaches under the counter and fishes your item from a hidden shelf.  You smile at yourself, pleased that you were able to remember the first two items on Granny's shopping list.";
            }
            if ($_SESSION['items_bought'] == 2) {
                echo "\"Hmmmm.... I think I have that in the back.\"  The shopkeeper leaves for a moment and returns with your item.";
            }
            if ($_SESSION['items_bought'] == 3) {
                echo "\"That one's easy!\" the shopkeeper exclaims, producing the item so quickly you couldn't even tell where he got it from.";
            }
            if ($_SESSION['items_bought'] == 4) {
                echo "\"We may have a few of those left,\" says the shopkeeper.  You try your best to remember more items your Granny asked for as he checks a few shelves.  \"I was sure we had some, but I guess--\" he paused.  \"Oh here it is!\"";
            }
            if ($_SESSION['items_bought'] == 5) {
                echo "\"I don't think we've carried that in ages,\" the shopkeeper tells you.  \"I suppose it doesn't hurt to check...\"  You wait as the shopkeeper rummages through some shelves.  \"Good news!  It turns out I did have some.";
            }
            if ($_SESSION['items_bought'] == 6) {
                echo "\"Ah, yes,\" the shopkeeper smiles.  \"I'm sure we have plenty of that.\"";
            }
            if ($_SESSION['items_bought'] == 7) {
                echo "\"We just got a new batch of those in yesterday,\" the shopkeeper says, quickly finding your item.";
            }
            if ($_SESSION['items_bought'] == 8) {
                echo "\"That might be tricky,\" the shopkeeper scratched his head.  \"Someone came in just this morning for a whole bunch of those\"  He walks away to search, and comes back several minutes later with one he found in the back.";
            }
            if ($_SESSION['items_bought'] == 9) {
                echo "\"Of course,\" the shopkeeper grins.  \"Granny buys some of that almost every time she comes in to the shop.\"";
            }
            if ($_SESSION['items_bought'] == 10) {
                echo "\"Yes,\" the shopkeeper replies.  I believe we have a few of those left.";
            }
            if ($_SESSION['items_bought'] == 11) {
                echo "\"That shouldn't be a problem.\"  The shopkeeper walks up and down the shelves to find what you requested.  Just one more item from Granny's list... can you remember the last one?";
            }
            if ($_SESSION['items_bought'] == 12) {
                echo "\"Absolutely!\"  The shopkeeper finds your final item and places it on the counter.  \"That's everything, is it?  I'll go ahead and ring you up.\"<br><br>As he does so, you take a look at your metaphorical colander, pleased that it is now patched up enough to hold Granny's entire list without spilling a bit.<br><br><img src=\"purchased.jpeg\" alt=\"Image of the shopkeeper handing you a sack full of the items you purchased.\" width=40%></br><br>";
            }
            if ($_SESSION['items_bought'] >= 13) {
                echo "\"You bought too many items. I don't know how you even did that unless there's a bug or you cheated...\"";
            }
            
            
            $_SESSION['current_letter'] = substr($target_letter, $_SESSION['items_bought'] + 1, 1);
            $_SESSION['items_bought']++;

            // Display form for next item if not all items bought
            if ($_SESSION['items_bought'] < 13) {
                echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '">';
                echo '<label for="item"><br><br>"What else can I get for you?"<br><br></label>';
                echo '<input type="text" name="item" id="item">&nbsp;';
                echo '<input type="submit" value="Ask">';
                echo '</form>';
            }
        } else {
            // Wrong letter
            echo "\"Sorry, I couldn't find that,\" the shopkeeper says.<br><br>";
            echo "\"Maybe you should go back and ask Granny again what she wanted.\"";
            echo '<br><br><button onclick="location.href=\'' . $_SERVER['PHP_SELF'] . '?restart=1\'">Start Over</button>';
            session_destroy();
        }
    } else {
        // Word not found
        echo "\"What's that?\" asked the shopkeeper, confused.  \"I've... never even heard of that.\"<br><br>";
        echo "\"Maybe you should go back and ask Granny again what she wanted.\"";
        echo '<br><br><button onclick="location.href=\'' . $_SERVER['PHP_SELF'] . '?restart=1\'">Start Over</button>';
        session_destroy();
    }

    if ($_SESSION['items_bought'] === 13) {
        echo "Great job!  You bought all of the items that Granny wanted!";
        echo '<br><br><button onclick="location.href=\'' . $_SERVER['PHP_SELF'] . '?restart=1\'">Start Over</button>';

    }
} else {
    // Game start
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Shopping for Granny</title>
    </head>
    <body>
        <h1>Shopping for Granny</h1>
<br>
<img src="shop.jpeg" alt="Image of a shop front" width=40%><br><br>
You arrive at the shop.  It was a pleasant journey; short enough to enjoy it, but long enough to prefer not to repeat it unnecessarily.  The bell rings as you open the door, and you are greeted by the warm weathered smile of the shopkeeper.
<br><br>
"Good morning!  Come to do some shopping for Granny, have you?"
<br><br>
"Yes, sir," you respond politely.
<br><br>
"Well, what can I get for you?" he asks.
<br><br>
"Thirteen items," you recall Granny say before sending you out the door with your overcoat buttoned up just so.  "It is very important that you remember them all."
<br><br>
You listened intently as she named each one, taking care to imprint it in your mind.  As you walked to the shop, you carried your mental list in your finest metaphorical pail, taking care not to spill a drop.  Upon facing the shopkeeper, however, you suddenly find that your pail had been swapped for a colander.
You look on the floor behind you, half expecting to see a puddle or a trail of water.  Alas, nothing is left behind of Granny's list.
<br><br>
You suppose you&apos;ll just have to guess.
<br><br>


        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="item"><i>Ask the shopkeeper for an item: </i></label>
            <input type="text" name="item" id="item">
            <input type="submit" value="Ask">
        </form>
        <?php if (isset($_SESSION['items_bought']) && $_SESSION['items_bought'] < 13): ?>
            <button onclick="location.href='<?php echo $_SERVER['PHP_SELF']; ?>?restart=1'">Start Over</button>
        <?php endif; ?>
    </body>
    </html>
    <?php
}

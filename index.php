/** Copyright 2015 Georg Felbinger

    This file is part of texbot.

    texbot is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

    texbot is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

    You should have received a copy of the GNU General Public License along with Foobar. If not, see http://www.gnu.org/licenses/.
*/

<?php
/* Include the API-Configuration, e.g.
    <?php
    define('BOT_TOKEN', '[FILL-TOKEN-HERE]');
    define('API_URL', 'https://api.telegram.org/bot'.BOT_TOKEN.'/');
    define('BOT_NAME', '[FILL-NAME-HERE]')
    ?>
*/
include 'secret.php';

// Get chatid and message
$content = file_get_contents("php://input");
$update = json_decode($content, true);
$chat_id = $update["message"]["chat"]["id"];
$message = $update['message']['text'];

// Set non-$-fenced math blocks into \text{.}
$math_pattern="/(\\\$)(\S[^\\\$]*)(\\\$)(\s|$)/";
$math_replacement="}$2\\text{";
$message="\\text{".preg_replace($math_pattern, $math_replacement, $message)."}";

// Remove bot-references
$texbot_pattern="/@".BOT_NAME."/";
$texbot_replacement="";
$message=preg_replace($texbot_pattern, $texbot_replacement, $message);

// Create a link for Google Chart API-tex'd message
$reply = "https://chart.googleapis.com/chart?cht=tx&chs=75&chl=".urlencode($message);

// Reply the link
$sendto = API_URL."sendmessage?chat_id=".$chat_id."&text=".urlencode($reply);
file_get_contents($sendto);
?>

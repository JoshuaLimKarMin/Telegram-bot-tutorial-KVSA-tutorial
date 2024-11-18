<?php
use SergiX44\Nutgram\Nutgram;

// Parameters
$bot->onText('I\'m {name}', function (Nutgram $bot, $name) {
   $bot->sendMessage('From now, I\'ll call you '.$name);
});

// Regex usage
$bot->onText('([0-9]+) by ([0-9]+)', function (Nutgram $bot, $num1, $num2) {
   $bot->sendMessage($num1." * ".$num2." = ". $num1 * $num2);
});

// Regex number and selection
$bot->onText('Add ([0-9]+) to (HP|attack|defense)', function (Nutgram $bot, $num, $selection) {
   $bot->sendMessage("Added ".$num." to ".$selection);
});
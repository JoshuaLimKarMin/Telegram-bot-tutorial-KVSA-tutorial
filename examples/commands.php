<?php
use SergiX44\Nutgram\Nutgram;

// Detect for commands sent.
$bot->onCommand('start', function(Nutgram $bot){
   // Respond to the sender
   $bot->asResponse()->sendMessage("Online still");

   // Respond to the sender with their channel ID.
   // Realised that the asResponse() method is missing?
   // It works because the bot variable is based on the function's parameters
   $bot->sendMessage("Your chat id is \"".$bot->chatId()."\"");
});

// Commands with parameters
$bot->onCommand('parameters example {args}', function (Nutgram $bot, $args) {
   $bot->sendMessage('Parameter received: '.$args);
});

// Commands with multiple parameters
$bot->onCommand('multi parameters example {args}, {args2}', function (Nutgram $bot, $args, $args2) {
   $bot->sendMessage('Parameter received: '.$args."&".$args2);
});

// Commands with multiple parameters
$bot->onCommand('multi parameters example {args} {args2}', function (Nutgram $bot, $args, $args2) {
   $bot->sendMessage('Parameter received: '.$args."&".$args2);
});
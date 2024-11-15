<?php
// Runs composer's auto loader
include_once './vendor/autoload.php';
// Runs the env loader
include './modules/envLoader.php';

// Inports the Nutgram class
use SergiX44\Nutgram\Nutgram;

// Initialize the bot
$bot = new Nutgram($_ENV['TOKEN']);

// Send a message on startup
$bot->sendMessage(
   text: "Hi there! Telegram test bot is now online.",
   chat_id: 1869267181 /* This is my real account ID. Please do not send any messages to it. */
);

// Detect for commands sent.
$bot->onCommand('start', function(Nutgram $bot){
   // Respond to the sender
   $bot->asResponse()->sendMessage("Online still");

   // Respond to the sender with their channel ID.
   $bot->asResponse()->sendMessage("Your chat id is \"".$bot->chatId()."\"");
});

$bot->run();
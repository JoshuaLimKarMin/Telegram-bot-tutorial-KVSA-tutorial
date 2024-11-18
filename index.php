<?php
// Imports composer's auto loader
require_once './vendor/autoload.php';
// Emports env loader
require_once './modules/envLoader.php';

// Inports the Nutgram classes
use SergiX44\Nutgram\Nutgram;

// Initialize Nutgram
$bot = new Nutgram($_ENV['TOKEN']);

// Imports examples
require './examples/commands.php'; // NOTE: ONLY ENABLE ONE AT A TIME
// require './examples/commandRegistration.php'; // NOTE: ONLY ENABLE ONE AT A TIME
// require './examples/textCommands.php';
// require './examples/sendingMessages.php';

// Initialize bot listeners
$bot->run();


/*
   This example was made by a JavaScript developer.
   Almost everything is JavaScript habits.
*/
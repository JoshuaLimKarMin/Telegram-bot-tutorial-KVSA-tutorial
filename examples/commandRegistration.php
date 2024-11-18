<?php
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Handlers\Type\Command;

// Create a class for the command
class StartCommand extends Command
{
   // Command
   protected string $command = "start";
   // Description of the command
   protected ?string $description = 'Initialize chat with bot.';
   // Function that will be executed when command is ran.
   public function handle(Nutgram $bot): void {
      $bot->sendMessage('This is a registered command.');
   }
}

// Registering a command with parameters
class ParamsExampleCommands extends Command
{
   // Command
   protected string $command = "params example {arg1}";
   // Description of the command
   protected ?string $description = 'Testing with parameters';
   // Function that will be executed when command is ran.
   public function handle(Nutgram $bot, $arg1): void {
      $bot->sendMessage('Parameters: '.$arg1);
   }
}

// Register the commands to Nutgram
$bot->registerCommand(StartCommand::class);
$bot->registerCommand(ParamsExampleCommands::class);

// Register the commands with Telegram
$bot->registerMyCommands();

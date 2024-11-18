# Telegram bot tutorial

This is a tutorial written in PHP to help get started with Telegram bots in PHP for Kolej Vokasional Shah Alam (KVSA) students. Usage of this tutorial besides for KVSA students is strictly prohibited.

| INDEX OF CONTENTS
|-
| [Reference](#reference)
| [Registering bot account, getting and storing API token](#registering-bot-account-getting-and-storing-api-token)
| [Setup](#setup)
| [Bot initialization](#bot-initialization)
| [Receiving commands](#receiving-commands)
| [Receiving commands with parameters](#receiving-commands-with-parameters)
| [Registering a command](#registering-a-command)
| [Receiving a text](#receiving-a-text)
| [Sending messages to specific chats](#sending-messages-to-specific-chats)
| [Sending media](#sending-media)

**NOTE: IT IS STRONGLY RECOMMANDED THAT YOU READ EVERYTHING BEFORE TRYING OUT FOR YOURSELF**

**Please note that this tutorial is in assumption that you're not using Laravel or any other frameworks.**

## Reference
- Libraries can be found at: https://core.telegram.org/bots/samples
- The library chosen for this tutorial is [nutgram](https://github.com/nutgram/nutgram).
- Nutgram documentation can be found at [here](https://nutgram.dev/docs/introduction). The official documentation has  a comprehensive explanation on everything important beyond this initial tutorial.

---

Note: If you're doing a proper project, it is recommended to initialize the project properly with composer before continuing. But for this tutorial, we won't be doing that.

## Registering bot account, getting and storing API token

1. Message [@BotFather](https://t.me/botfather) to register yout account and get your token.
![Account registration example](./docs/Account%20registration%20example.jpg)

2. After that, create a ```.env``` file and paste the API key like this ```TOKEN=<<YOUR_API_KEY>>```
 **NOTE: THE .ENV FILE MUST NEVER BE COMMITTED TO ANY REPOSITORY. ALWAYS GIT IGNORE THE ENV FILE**
 ![ENV file example](./docs/ENV%20file%20example.jpg)

## Setup
1. Run the command ```composer require nutgram/nutgram``` in the command line **(We will be using composer for this tutorial as it's prefered)**.
   ![Composer install](./docs/Composer%20example.jpg)

   Alternatively, you can downlaod and extract the src file into the root of your project and rename the extracted folder as ```nutgram```. Though, since Composer will not be there to automatically manage package loading, you will need to know how to import the packages into the app. **GOOD LUCK. YOU'LL NEED IT**
      ![Extracted list](./docs/Extracted%20file%20list.jpg)

2. Create a modules folder and create a file inside of it with the name ```envLoader.php```. Load the ```.env``` file into your app's $_ENV variable with this code **(NTOE: YOU CAN USE ANY OTHER CODE TO LOAD THE ```.ENV``` FILE INTO THE APPLICATION)** and include it in ```index.php```.
```php
// envLoader.php

<?php

$env = parse_ini_file('./.env');

foreach ($env as $key => $value) {
   $_ENV[$key] = $value;
}
```
```php
// index.php

<?php

include "./modules/envLoader.php";
```

<br>
<br>
<br>

# NOTE: THE NEXT SECTION STARTING WILL BE RAN IN THE COMMAND LINE WITH THE ```php``` COMMAND

![Example of php command in use](./docs/Example%20of%20using%20php%20command.jpg)

<br>
<br>
<br>

## Bot initialization
Initialize the bot with the token stored in the ```$_ENV``` variable

```php
// index.php

<?php
// Runs composer's auto loader
include_once './vendor/autoload.php';
// Runs the env loader
include './modules/envLoader.php';

// Inports the Nutgram class
use SergiX44\Nutgram\Nutgram;

// Initialize Nutgram
$bot = new Nutgram($_ENV['TOKEN']);
```

<br>

## Receiving commands
You can detect for commands sent by users with the ```onCommand``` method.

```php
// index.php

...

$bot->onCommand(<COMMAND IN STRING>, function(Nutgram $bot){
   // Respond to the sender
   $bot->asResponse()->sendMessage(<MESSAGE IN STRING>);
});

// Initialize bot listeners
$bot->run();

```
<br>

Example:
```php
// index.php

...

$bot->onCommand('start', function(Nutgram $bot){
   // Respond to the sender
   $bot->asResponse()->sendMessage("Online still");
});

// Tells nutgram to run the app and to not close (MUST RUN IN CLI WITH php COMMAND)
$bot->run();

```
You can also get the chat ID with the following.
```php
// index.php

...

$bot->onCommand('start', function(Nutgram $bot){
   // Respond to the sender with their chat ID.
   // Realised that the asResponse() method is missing?
   // It works because the bot variable is based on the function's parameters
   $bot->sendMessage("Your chat id is \"".$bot->chatId()."\"");
});

// Initialize bot listeners
$bot->run();

```

Example:

![Example of response](./docs/Example%20of%20response.jpeg)

<br>

## Receiving commands with parameters
It is possible to use commands with arguments / parameters. For example, a command that allows you to update a value in the database with a new one given by the user.

```php
// index.php

...

$bot->onCommand('parameters example {args}', function (Nutgram $bot, $args) {
   $bot->sendMessage('Parameter received: '.$args);
});
```

Example:

![Example of commands with parameter](./docs/Example%20of%20params.jpeg)

Fun fact, you can actually have multiple parameters chained together like so.

```php
// index.php 

...

$bot->onCommand('multi parameters example {args}, {args2}', function (Nutgram $bot, $args, $args2) {
   $bot->sendMessage('Parameter received: '.$args."&".$args2);
});
```

Example:

![Example of chaining params.](./docs/Example%20of%20multi%20params.jpeg)

- **NOTE: Realise that there is a comma in between arg1 & 2? That's important because without that, the bot will misunderstand the seperation.**

Example:

![Example of forgetting comma](./docs/Example%20of%20forgetting%20comma.jpeg)

<br>

## Registering a command
Registering a command will allow your users to easily get a menu for selecting commands from a list.

```php
// index.php

...

// Imports the command class - VERY IMPORTANT
use SergiX44\Nutgram\Handlers\Type\Command;

...

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

// Register the commands with Nutgram
$bot->registerCommand(StartCommand::class);

// Register the commands with Telegram
$bot->registerMyCommands();
```

![Example of registered commands](./docs/Example%20of%20registered%20commands.jpg)

- **NOTE: If you want, you can also have parameters for the registered commands, but it's not recommanded. It is better to have the command update a vale in the database that puts the chat into a certain mode and then use the onText listener to upadte data. After all, this is not Discord.**

<br>

## Receiving a text 
It is possible to detect for others messaging you with the `onText` listener. **This part should have been first...**

```php
// index.php

...

$bot->onText('I\'m {name}', function (Nutgram $bot, $name) {
   $bot->sendMessage('From now, I\'ll call you '.$name);
});
```

If you want to make your life easier, you can also use **regular expresions (RegEX)** too.

```php
// index.php

...

$bot->onText('([0-9]+) by ([0-9]+)', function (Nutgram $bot, $num1, $num2) {
   $bot->sendMessage($num1." * ".$num2." = ". $num1 * $num2);
});
```

You can take it a step further by adding in options.

```php
// index.php

...

$bot->onText('Add ([0-9]+) to (HP|attack|defense)', function (Nutgram $bot, $num, $selection) {
   $bot->sendMessage("Added ".$num." to ".$selection);
});
```

<br>

## Sending messages to specific chats
You can send messages with the ```sendMessage``` method.
```php
// index.php

...

$bot->sendMessage(
   text: <MESSAGE IN STRING>,
   chat_id: <CHAT ID>
);
```
<br>

Example:
```php
// index.php

...

$bot->sendMessage(
   text: "Hi there! Telegram test bot is now online.",
   chat_id: 1869267181 /* This is my real account ID. Please do not send any messages to me */
);
```

<br>

## Sending media
It is possible to send media from your bot to any users. You can send it as a reply to a message, command or even on demand when the app needs it to be sent out. **For this example, we'll be sending it to a specific user. If you have no idea what to use as your sample media, you may use the ones that I have left in the media folder.**

Sending a photo.
```php
// Create a file stream
$photo = fopen(<RELATIVE PATH TO THE PHOTO IN STRING>, 'r+');
// Sending a photo
$bot ->sendPhoto(
   photo: InputFile::make($photo),
   chat_id: <CHAT ID>
);
```

Example: 

```php
// index.php

...

// Create a file stream
$photo = fopen('./media/image.jpg', 'r+');
// Sending a photo
$bot ->sendPhoto(
   photo: InputFile::make($photo),
   chat_id: 1869267181
);
```

<br>

Sending a video.
```php
// Create a file stream
$photo = fopen(<RELATIVE PATH TO THE PHOTO IN STRING>, 'r+');
// Sending a video
$bot ->sendVideo(
   video: InputFile::make($video),
   chat_id: <CHAT ID>
);
```

Example:

```php
// index.php

...

// Create a file stream
$video = fopen('./media/video.mp4', 'r+');
// Sending a video
$bot ->sendVideo(
   video: InputFile::make($video),
   chat_id: 1869267181
);
```

<br>
<br>
<br>
<br>
<br>

Go to the [official docs](https://nutgram.dev/docs/introduction) for more.

Sorry for any poor explinations or if the tutorial seams hard to follow. Lost motivation to do this but have to finish it off. Might update again in the future.

-END OF TUTORIAL-
# Telegram bot integrations 

This is a tutorial written in PHP to help get started with Telegram bots in PHP for Kolej Vokasional Shah Alam (KVSA) students. Usage of this tutorial besides for KVSA students is strictly prohibited.

| INDEX OF CONTENTS
|-
| [Reference](#reference)
| [Registering bot account, getting and storing API token](#registering-bot-account-getting-and-storing-api-token)
| [Setup](#setup)
| [Bot initialization](#bot-initialization)
| [Sending messages](#sending-messages)
| [Receiving commands](#receiving-commands)

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

// Initialize the bot
$bot = new Nutgram($_ENV['TOKEN']);
```

## Sending messages
You can send messages with the ```sendMessage``` method. **(TO KNOW HOW TO GET CHAT ID, PLEASE GO TO RECEIVING [RECEIVING COMMANDS](#receiving-commands) OR YOU CAN START THERE)**
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

## Receiving commands
You can detect for commands sent by users with the ```onCommand``` method.

````php
// index.php

...

$bot->onCommand(<COMMAND IN STRING>, function(Nutgram $bot){
   // Respond to the sender
   $bot->asResponse()->sendMessage(<MESSAGE IN STRING>);
});

// Tells nutgram to run the app and to not close (MUST RUN IN CLI WITH php COMMAND)
$bot->run();

````
<br>

Example:
````php
// index.php

...

$bot->onCommand('start', function(Nutgram $bot){
   // Respond to the sender
   $bot->asResponse()->sendMessage("Online still");
});

// Tells nutgram to run the app and to not close (MUST RUN IN CLI WITH php COMMAND)
$bot->run();

````
You can also get the chat ID with the following.
````php
// index.php

...

$bot->onCommand('start', function(Nutgram $bot){
   // Respond to the sender with their chat ID.
   $bot->asResponse()->sendMessage("Your chat id is \"".$bot->chatId()."\"");
});

// Tells nutgram to run the app and to not close (MUST RUN IN CLI WITH php COMMAND)
$bot->run();

````
<br>

Result:

![Example of telegram](./docs/Example%20of%20response.jpeg)

<br>
<br>
<br>
<br>
<br>

Go to the [official docs](https://nutgram.dev/docs/introduction) for more.

-END OF TUTORIAL-
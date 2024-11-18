<?php
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Types\Internal\InputFile;

// Send a message on startup
$bot->sendMessage(
   text: "Hi there! Telegram test bot is now online.",
   chat_id: 1869267181 /* This is my real account ID. Please do not send any messages to it. */
);

// Create a file stream
$photo = fopen('./media/image.jpg', 'r+');
// Sending a photo
$bot ->sendPhoto(
   photo: InputFile::make($photo),
   chat_id: 1869267181
);

// Create a file stream
$video = fopen('./media/video.mp4', 'r+');
// Sending a video
$bot ->sendVideo(
   video: InputFile::make($video),
   chat_id: 1869267181
);
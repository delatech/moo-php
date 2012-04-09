<?php
use \MooPhp\MooInterface\Data as Data;
/**
 * Demo of fiddling about with a pack on the commandline.
 * This will create a businesscard with an image side, and a details side.
 * There'll be an image on both sides, and some text on the details side.
 *
 * @package packManipulator
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */


error_reporting(E_ALL);
ini_set('display_errors', 1);

require(dirname(__FILE__) . '/../MooPhp/autoloader.php');

$opts = getopt("k:s:");

if (!isset($opts["k"]) || !isset($opts['s'])) {
	die("Need to provide key and secret.");
}

$key = $opts['k'];
$secret = $opts['s'];

$logger = new \MooPhp\Client\FileLogger();
$logger->setLogLevel(\MooPhp\Client\Logger::LOG_LEVEL_DEBUG);

$client = new \MooPhp\Client\OAuthSigningClient($key, $secret, $logger);

/*
// If we want to do three legged we'd need to jump about a bit
$request_token = $client->getRequestToken();

// At this point if you were writing a web app you'd want to store the request token data.
// Then redirect the user orf too (passing a useful callback, this example uses oob callbacks):
print "Visit:\n" . $client->getAuthUrl() . "\n";
print "Hit enter";
fgets(STDIN);

// So now the user would be redirected back. You'd need to call setToken() with the request token data.

// Then get an access token and you're done:
$client->getAccessToken();
*/

$api = new \MooPhp\Api($client);


$packResp = $api->packCreatePack();
$packId = $packResp->getPackId();
$pack = $packResp->getPack();


// Right, lets make ourselves an image side containing a picture.
$uploadImageResp = $api->imageUploadImage(__DIR__ . '/poor_kettle_purchasing_decision.jpg');
$basketItem = $uploadImageResp->getImageBasketItem();

$pack->getImageBasket()->addItem($basketItem);

$template = $api->templateGetTemplate("businesscard_full_image_landscape");
$imageSide = new Data\Side();
$imageSide->setType("image");
$imageSide->setTemplateCode($template->getTemplateCode());


/**
 * @var \MooPhp\MooInterface\Data\Template\Items\ImageItem $item
 */
$item = $template->getItemByLinkId("variable_image_front");

$printImage = $basketItem->getImageItem("print");

$imageData = new Data\UserData\ImageData();
$imageData->setLinkId("variable_image_front");
$imageData->setImageBox($item->calculateDefaultImageBox($printImage->getWidth(), $printImage->getHeight()));
$imageData->setResourceUri($uploadImageResp->getImageBasketItem()->getResourceUri());

$imageSide->addDatum($imageData);
$pack->addSide($imageSide);

$detailsSide = new Data\Side();
$detailsSide->setType("details");
$detailsSide->setTemplateCode("businesscard_right_image_landscape");

// First off, lets put our image on the details side too
$imageData = new Data\UserData\ImageData();
$imageData->setLinkId("variable_image_back");
$imageData->setImageBox($item->calculateDefaultImageBox($printImage->getWidth(), $printImage->getHeight()));

// OK, so you may wonder where these numbers came from... well I had to use the Moo flash canvas to make it look right,
// and then pull the data out of the pack data that wrote.
$imageData->setImageBox(new Data\Types\BoundingBox(new Data\Types\Point(29.85, 78.09), 81.81, 61.36));
$imageData->setResourceUri($uploadImageResp->getImageBasketItem()->getResourceUri());
$detailsSide->addDatum($imageData);

$textLine = new Data\UserData\TextData();
$textLine->setFont(new Data\Types\Font("radio"));
$textLine->setText("Kettles should not burn this well;");
$textLine->setPointSize(3.35);
$textLine->setColour(new Data\Types\ColourRGB(255, 0, 0));
$textLine->setLinkId("back_line_1");
$detailsSide->addDatum($textLine);

$textLine = new Data\UserData\TextData();
$textLine->setFont(new Data\Types\Font("meta"));
$textLine->setText("Especially if they turn themselves on;");
$textLine->setPointSize(2.65);
$textLine->setColour(new Data\Types\ColourRGB(0, 255, 0));
$textLine->setLinkId("back_line_2");
$detailsSide->addDatum($textLine);

$textLine = new Data\UserData\TextData();
$textLine->setFont(new Data\Types\Font("vagrounded"));
$textLine->setText("This was a poor purchasing decision;");
$textLine->setPointSize(2.65);
$textLine->setColour(new Data\Types\ColourRGB(0, 0, 255));
$textLine->setLinkId("back_line_3");
$detailsSide->addDatum($textLine);

$textLine = new Data\UserData\TextData();
$textLine->setFont(new Data\Types\Font("bryant"));
$textLine->setText("And now I cannot make tea.");
$textLine->setPointSize(3.35);
$textLine->setLinkId("back_line_4");
$detailsSide->addDatum($textLine);

$pack->addSide($detailsSide);

$updateResp = $api->packUpdatePack($packId, $pack);


// OK, all done.

// We might have some warnings (though at time of writing this pack was fine.)
var_dump($updateResp->getWarnings());

// We should also be able to enter the Moo build flow at various points identified by dropins.
var_dump($updateResp->getDropIns());

print "\nAll done!\n";


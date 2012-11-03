Moo-Php
=======

Moo-Php is a client library for the moo.com API. It provides a full (at time of writing) implementation of the Moo pack
and template models.

This is a very early stage implementation, I've released it because I've got to the point where I feel it's usable, and
could do with more eyes on it.

This is one developer's crazed thrashings after consuming one too many cups of tea over a long weekend. It is in no way,
shape, or form derived from any internal stuff at Moo, or representative of anything that might happen at Moo. It is not
supported by Moo. Blah, blah, etc. Basically, if it explodes, don't contact Moo.

It requires the php-weasel library (https://github.com/moodev/php-weasel) to be available via autoloading.

Usage
-----
Grab the php-weasel library (https://github.com/moodev/php-weasel) and arrange for the packages within it
to be autoloadable.

There's an example called packManipulator.php in the examples directory. It sets up the API client and creates a
businesscard pack with some stuff in it.

The important bits to start with are a Client and a MooApi. The Client provides a simple interface for making requests
to Moo. The MooApi interface actually provides the, errr, MooApi methods. It uses the Client to communicate with Moo.

The implementations currently provided are \MooPhp\Client\OAuthSigningClient, and \MooPhp\Api.

```php

    require_once("path/to/autoloader.php");

    $client = new \MooPhp\Client\OAuthSigningClient($apiKey, $apiSecret);
    $api = new \MooPhp\Api($client);

    // Now call stuff on $api.
    $packResponse = $api->packCreatePack("businesscard");
    // Look, pack data!
    var_dump($packResponse->pack);

```

The methods on Api will return the relevant MooInterface\Response objects, except getTemplate which is magical and
speshul: that'll return a Template object.

The above example makes use of 2-legged OAuth, which should be fine for most use-cases. If you need 3-legged you need
to jump through a load of hoops which are documented in the packManipulator.

Design
------

This has all been a bit fluid. The original serializer/deserializer became exceedingly complex, and was eventually
rewritten as php-weasel. That has significantly cut down the quantity and complexity of code in this package.

The MooInterface namespace contains various classes/interfaces that represent the raw Moo API and data model. A few of
them do have a slightly more useful interface than the raw Moo model, just for ease of use (notably Side and Pack.) I'm
not 100% convinced this is the correct design decision, as I cannot decide where to draw the line at adding to the Moo
model? Is the ImageItem::calculateDefaultImageBox() method a step too far?

Almost everything in MooInterface is "annotated" with serialization related information which is used to configure
the Weasel\JsonMarshaller and Weasel\XmlMarshaller. These are responsible for marshalling and unmarshalling the
communications with the Moo API.

The Client interface provides the ability to send requests to some API endpoint. It draws a distinction between
normal API requests (`makeRequest()`), potentially unsigned get requests (`getFile()`), and file uploads (`sendFile()`.)
Each of these methods expects an array of parameters to send in the request.

The Api is the part which glues everything together. It builds Request objects, marshalls them, sends them to Moo using
the Client, and unmarshalls the responses.

Extending
---------
Extending the Api class (or implementing your own MooApi) should be reasonably painless. Ditto the Client (just pass
your own implementation to the Api constructor.)

Adding new request and response objects requires them to be annotated with the appropriate Weasel\JsonMarshaller
annotations, after which they can be passed straight into the Api `makeRequest()`, `getFile()` or `sendFile()` methods.

Contributing
------------
Please do. Fork it, send a pull request. You can also email patches to me.

FAQ
---
Where are the tests?
> Oopse.

If there are no tests, how do you know it's correct?
> I don't. It probably isn't.

So is this safe to use?
> Probably.



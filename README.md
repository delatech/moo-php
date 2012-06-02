Moo-Php
=======

Moo-Php is a client library for the moo.com API. It provides a full (at time of writing) implementation of the Moo pack
and template models.

This is a very early stage implementation, I've released it because I've got to the point where I feel it's usable, and
could do with more eyes on it.

This is one developer's crazed thrashings after consuming one too many cups of tea over a long weekend. It is in no way,
shape, or form derived from any internal stuff at Moo, or representative of anything that might happen at Moo. It is not
supported by Moo. Blah, blah, etc. Basically, if it explodes, don't contact Moo.

It requires the php-marshaller library to be available via autoloading.

Usage
-----
Grab the php-marshaller library (https://github.com/JonathanO/php-marshaller) and arrange for the packages within it
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

Err, about that. There wasn't one. This has all just fallen together. Here's roughly how it probably works:

The MooInterface namespace contains various classes/interfaces that represent the raw Moo API and data model. A few of
them do have a slightly more useful interface than the raw Moo model, just for ease of use (notably Side and Pack.) I'm
not 100% convinced this is the correct design decision, as where do you draw the line at adding to the Moo model? Is
the ImageItem::calculateDefaultImageBox() method a step too far?

Almost everything in MooInterface is "annotated" with serialization related information which is used to configure
the Weasel\JsonMarshaller and Weasel\XmlMarshaller.

The Client interface is intended to provide a way to send requests to some API endpoint. It basically expects a method
name and its arguments. Except the magical special cases for handling templates and image uploads (yawn.) I'm intending
to move a bit of more of the request functionality into the Client in the future.

The Api is the part which glues everything together. It builds Request objects, serializes them using a Serializer,
sends them to Moo using the Client, and deserializes the responses.

Serialization was also implemented here, but I realised it'd be far more useful to have a general purpose, annotation
driven library separately.

Extending
---------
Extending the Api class (or implementing your own MooApi) should be reasonably painless. Ditto the Client (just pass
your own implementation to the Api constructor.)

Contributing
------------
Please do. Fork it, send a pull request. You can also email patches to me.

FAQ
---
Where are the tests?
> Oopse. There were tests. Then I rewrote it all, and didn't write any because I'd already spent a day on this and
> wanted to just get something working.

If there are no tests, how do you know it's correct?
> I don't. It probably isn't.

But what about TDD? How could you do such a thing? OH THE HUMANITY!
> Much of the "design" was made up on the fly. If I'd been doing this for $dayjob then I probably would have written
> tests as I went. However, I did this in my own time, and didn't want to lose days writing tests before I got onto
> writing something that I could actually use.

Will there be tests?
> Yes. Yes there will. They'll almost certainly find this is a buggy heap of s**t.

All these questions are about tests. Are you embarrassed about the lack of them?
> Yes. Very.

So is this safe to use?
> Probably, but expect to find interesting bugs in the features I don't use.



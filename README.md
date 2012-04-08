Moo-Php
=======

Moo-Php is a client library for the moo.com API. It provides a full (at time of writing) implementation of the Moo pack
and template models.

This is a very early stage implementation, I've released it because I've got to the point where I feel it's usable, and
could do with more eyes on it.

Usage
-----
There's an example called packManipulator.php in the examples directory. It sets up the API client and creates a
businesscard pack with some stuff in it.

The important bits to start with are a Client and a MooApi. The Client provides a simple interface for making requests
to Moo. The MooApi interface actually provides the, errr, MooApi methods. It uses the Client to communicate with Moo.

The implementations currently provided are \MooPhp\Client\OAuthSigningClient, and \MooPhp\Api.

```php

    $client = new \MooPhp\Client\OAuthSigningClient($apiKey, $apiSecret);
    $api = new \MooPhp\Api($client);

    // Now call stuff on $api.
    $packResponse = $api->packCreatePack("businesscard");
    // Look, pack data!
    var_dump($packResponse->pack);

```

The methods on Api will return the relevant MooInterface\Response objects, except getTemplate which is magical and
speshul: that'll return a Template object.

The above example makes use of 2-legged OAuth, which should be fine for most usecases. If you need 3-legged you need
to jump through a load of hoops which are documented in the packManipulator.

Design
------

Err, about that. There wasn't one. This has all just fallen together. Here's roughly how it probably works:

The MooInterface namespace contains various classes/interfaces that represent the raw Moo API and data model. A few of
them do have a slightly more useful interface than the raw Moo model, just for ease of use (notably Side and Pack.) I'm
not 100% convinced this is the correct design decision, as where do you draw the line at adding to the Moo model? Is
the ImageItem::calculateDefaultImageBox() method a step too far?

The Client interface is intended to provide a way to send requests to some API endpoint. It basically expects a method
name and its arguments. Except the magical special cases for handling templates and image uploads (yawn.) I had
originally intended that the Client would be passed Request objects, and know what to do with them, but that broke down
over the image and template handling.

The Serialization namespace is a bit more of a horror than I had originally hoped. It has grown into a general purpose,
configurable serialization/deserialization system. Things implementing the Marshaller interface are expected to be able
to convert to/from some serialized format, given an object/serialized data and some sort of type name.

Currently there's an ArrayMarshaller which works on arrays, and an XmlMarshaller which works on XML. Both make use of
configuration files written in json to work out how to (de)serialize various flavours of object. The second argument
to the (de)serialize methods in both is expected to be the name of the starting element in the configuration file.

I'm planning to split the serialization framework out. Perhaps it can be beaten into a form that might be useful to
other people.

The Api is the part which glues everything together. It builds Request objects, serializes them using a Serializer,
sends them to Moo using the Client, and deserializes the responses.

Extending
---------
Extending the Api class (or implementing your own MooApi) should be reasonably painless. Ditto the Client (just pass
your own implementation to the Api constructor.)

Extending any of the Moo model is going to be more exciting. At present you'll need to modify the marshalling configs
that mention the class you intend to extend. You'll need to update any entries for the original class to instead have
a type of your new implementation. If you copy the config files elsewhere you'll need to extend the Api class in order
to change where it loads its configs from. I intend to make this simpler, by (a) making the config file path
configurable (why isn't it already?) and (b) allowing you to include additional configs that override parts of the main
config.

Adding new parts to the model is much like the above, but will require you to add additional sections to the serializer
configs.

If you're extending requests you'll also either need to extend the Api class to change the method implementations, or
you'll need to use the Api::makeRequest() method, which allows you to pass in arbitrary request objects. Note that this
method is only able to cope with simple API calls (i.e. those which accept an OAuth signed POST, and return JSON.)

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

All these questions are about tests. Are you embarassed about the lack of them?
> Yes. Very. You know how, as a sysadmin, you'd never consider not having working off-site backups of every machine
> you're responsible for... but your machines at home have never been backed up. It's a lot like that.

So is this safe to use?
> Probably, but expect to find interesting bugs in the features I don't use.

TODO
----
* Refactor Serializers: the Xml one's pattern is better...
* Tests.
* Allow serialization config from multiple files.
* Split out serialization framework.
* Serialization config from annotations?
* Implement the product model.
* Performance.


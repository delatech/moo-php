<?php
namespace MooPhp\MooInterface;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan@moo.com>
 * @copyright Copyright (c) 2012, Moo Print Ltd.
 */

interface MooApi
{
    /**
     * Product type constants
     */
    /**
     * Classic businesscard 50 pack
     */
    const PRODUCT_TYPE_BUSINESSCARD = "businesscard";
    /**
     * Minicard 100 pack
     */
    const PRODUCT_TYPE_MINICARD = "minicard";
    /**
     * Postcard 20 pack
     */
    const PRODUCT_TYPE_POSTCARD = "postcard";
    /**
     * Stickerbook 90 pack
     */
    const PRODUCT_TYPE_STICKER = "sticker";
    /**
     * Image type constants
     */
    /**
     * Photo enhancement off by default
     */
    const IMAGE_TYPE_UNKNOWN = "unknown";
    /**
     * Photo enhancement on by default
     */
    const IMAGE_TYPE_PHOTO = "photo";
    /**
     * Currently same as UNKNOWN, but may change
     */
    const IMAGE_TYPE_LINEART = "lineart";
    /**
     * Moo will try to guess if it's a photo or lineart
     */
    const IMAGE_TYPE_DETECT = "detect";

    const UNIT_MILLIMETERS = "mm";
    const UNIT_POINTS = "pts";

    /**
     * Send a signed request object to the Moo API, and deserialize the response as $responseType.
     *
     * @abstract
     * @param Request\Request $request The request to send
     * @param string $responseType The response type to deserialize as. Expected to either be fully qualified, or
     * inside the \MooInterface\MooApi\Response namespace.
     * @return Response\Response
     */
    public function makeRequest(\MooPhp\MooInterface\Request\Request $request, $responseType);

    /**
     * Send an unsigned request object to the Moo API, and return the raw response.
     *
     * @abstract
     * @param Request\Request $request The request to send
     * @return string
     */
    public function getFile(\MooPhp\MooInterface\Request\Request $request);

    /**
     * Send an unsigned request object that contains a file to the Moo API, and deserialize the response as $responseType.
     * @abstract
     * @param Request\Request $request The request to send
     * @param string $fileParam The name of the property containing the path to the file to send
     * @param string $responseType The response type to deserialize as. Expected to either be fully qualified, or
     * inside the \MooInterface\MooApi\Response namespace.
     * @return Response\Response
     */
    public function sendFile(\MooPhp\MooInterface\Request\Request $request, $fileParam, $responseType);

    /**
     * Create a new Moo pack.
     * This will actually create a pack of a given type on the server.
     * Requires create permissions which everyone should have.
     * @abstract
     * @param \MooPhp\MooInterface\Data\PhysicalSpec $physicalSpec The physical spec to build the pack with
     * @param Data\Pack $pack An optional initial pack to use.
     * @param string $friendlyName A friendly name to give the pack in the cart (and I think default save names?)
     * @param string $trackingId Optional tracking ID to use for tracking callbacks
     * @param string $startAgainUrl Absolute URL to send the user to if they hit the start again button
     * @return Response\CreatePack
     */
    public function packCreatePack(\MooPhp\MooInterface\Data\PhysicalSpec $physicalSpec,
                                   Data\Pack $pack = null,
                                   $friendlyName = null,
                                   $trackingId = null,
                                   $startAgainUrl = null);

    /**
     * Get a Moo pack from the builder store.
     * This requires read permissions, which you ought to have.
     * Note that once you've handed off the user to a dropIn URL the pack becomes "owned" and you cannot read it anymore.
     * @abstract
     * @param string $packId The pack ID to get
     * @return Response\GetPack
     */
    public function packGetPack($packId);

    /**
     * Update a Moo pack on the builder store.
     * This requires update permissions, which you ought to have.
     * Note that once you've handed off the user to a dropIn URL the pack becomes "owned" and you cannot update it anymore.
     * @abstract
     * @param string $packId The pack to update
     * @param Data\Pack $pack The new pack data
     * @return Response\UpdatePack
     */
    public function packUpdatePack($packId, Data\Pack $pack);

    /**
     * Add a Moo pack from the builder store to the cart.
     * Note that you don't have the ability to do this by default as it requires the cart permission.
     * If 2 legged OAuth is used this applies to the session of the client making the HTTP request, i.e. this API client
     * @abstract
     * @param string $packId The pack ID to add
     * @param int $quantity
     * @return Response\AddToCart
     */
    public function packAddToCart($packId, $quantity = 1);

    /**
     * Upload a local image to the Moo servers.
     * Will take an ImageResource, which could be wrapping a file or some binary and feed it to moo.
     * Requires upload_image permission, which is granted to everyone.
     * @abstract
     * @param string $imageFile path to the image to import
     * @param string $imageType Type of image from the IMAGE_TYPE_ constants. Default is unknown which will not trigger image enhance by default.
     * @return Response\UploadImage
     */
    public function imageUploadImage($imageFile, $imageType = self::IMAGE_TYPE_UNKNOWN);

    /**
     * Ask Moo's servers to grab an image from a URL and import it.
     * Requires import_image which is NOT granted by default.
     * @abstract
     * @param string $url URL to obtain the image from
     * @param string $imageType Type of image from the IMAGE_TYPE_ constants. Default is unknown which will not trigger image enhance by default.
     * @return \MooPhp\MooInterface\Response\ImportImage
     */
    public function imageImportImage($url, $imageType = self::IMAGE_TYPE_UNKNOWN);

    /**
     * Get the template XML for a template.
     * Implementations of this API are not expected to deserialize the XML.
     * Requires get_template permission which is granted to everyone.
     * @abstract
     * @param string $templateCode The template to retrieve
     * @return \MooPhp\MooInterface\Data\Template\Template
     */
    public function templateGetTemplate($templateCode);

    /**
     * Update the physical spec on a pack.
     * @abstract
     * @param string $packId
     * @param Data\PhysicalSpec $physicalSpec
     * @return \MooPhp\MooInterface\Response\UpdatePhysicalSpec
     */
    public function updatePhysicalSpec($packId, \MooPhp\MooInterface\Data\PhysicalSpec $physicalSpec);

    /**
     * @param string $text The text to measure
     * @param float $fontsize The font size in $units
     * @param \MooPhp\MooInterface\Data\FontSpec $fontSpec Font to use for the measurement
     * @param float $wrappingWidth Width in mm after which to wrap to a new line (for multi-line text areas)
     * @param float $leading line spacing as a multiple of the default for the font.
     * @param string $fontUnits Unit of measurement for the font size
     * @return \MooPhp\MooInterface\Response\TextMeasure
     */
    public function textMeasure($text,
                                $fontsize,
                                \MooPhp\MooInterface\Data\FontSpec $fontSpec,
                                $wrappingWidth = null,
                                $leading = null,
                                $fontUnits = self::UNIT_MILLIMETERS);

}

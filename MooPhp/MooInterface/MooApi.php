<?php
namespace MooPhp\MooInterface;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

interface MooApi {
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
	/**
	 * Create a new Moo pack.
	 * This will actually create a pack of a given type on the server.
	 * Requires create permissions which everyone should have.
	 * @abstract
	 * @param string $productType A product type to create. This should use one of the PRODUCT_TYPE_ constants.
	 * @param Data\Pack $pack An optional initial pack to use.
	 * @param string $trackingId Optional tracking ID to use for tracking callbacks
	 * @return Response\CreatePack
	 */
	public function packCreatePack($productType = self::PRODUCT_TYPE_BUSINESSCARD, Data\Pack $pack = null, $trackingId = null);

	/**
	 * Get a Moo pack from the session.
	 * Note that you don't have the ability to do this by default as it requires the read permission.
	 * @abstract
	 * @param string $packId The pack ID to get
	 * @return Response\GetPack
	 */
	public function packGetPack($packId);

	/**
	 * Update a Moo pack on the session.
	 * Note that you don't have the ability to do this by default as it requires the update permission.
	 * @abstract
	 * @param string $packId The pack to update
	 * @param Data\Pack $pack The new pack data
	 * @return Response\UpdatePack
	 */
	public function packUpdatePack($packId, Data\Pack $pack);

	/**
	 * Add a Moo pack from the session to the cart.
	 * Note that you don't have the ability to do this by default as it requires the cart permission.
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
}

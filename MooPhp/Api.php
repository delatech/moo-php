<?php
namespace MooPhp;
/**
 * @package Api.php
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class Api implements MooInterface\MooApi {

	/**
	 * @var Client\Client
	 */
	protected $_client;

	protected $_templateDeserializer;

	protected $_marshaller;
	protected $_templateMarshaller;

	public function __construct(Client\Client $client) {
		$this->_client = $client;
		// TODO: caching of the configs
		$this->_marshaller = new Serialization\ArrayMarshaller(json_decode(file_get_contents(__DIR__ . "/Serialization/ArrayMarshallingConfig.json"), true));
		$this->_templateMarshaller = new Serialization\XmlMarshaller(json_decode(file_get_contents(__DIR__ . "/Serialization/XmlMarshallingConfig.json"), true));
	}

	public function getClient() {
		return $this->_client;
	}

	/**
	 * @param MooInterface\Request\Request $request
	 * @param string $responseType
	 * @return string
	 */
	public function makeRequest(\MooPhp\MooInterface\Request\Request $request, $responseType) {
		$rawResponse = $this->_client->makeRequest($request->getMethod(), $this->_marshaller->marshall($request, "Request"));
		return $this->_handleResponse($rawResponse, $responseType);
	}

	protected function _handleResponse($rawResponse, $type) {
		$arrayResponse = json_decode($rawResponse, true);
		if (isset($arrayResponse["exception"])) {
			$e = $this->_marshaller->unmarshall($arrayResponse["exception"], "MooException");
			/**
			 * @var \Exception $e
			 */
			throw $e;
		}
		/**
		 * @var MooInterface\Response\Response $object
		 */
		$object = $this->_marshaller->unmarshall($arrayResponse, $type);
		return $object;
	}

	/**
	 * Create a new Moo pack.
	 * This will actually create a pack of a given type on the server.
	 * Requires create permissions which everyone should have.
	 * @param string $productType A product type to create. This should use one of the PRODUCT_TYPE_ constants.
	 * @param MooInterface\Data\Pack $pack An optional initial pack to use.
	 * @param string $trackingId Optional tracking ID to use for tracking callbacks
	 * @return MooInterface\Response\CreatePack
	 */
	public function packCreatePack($productType = self::PRODUCT_TYPE_BUSINESSCARD, MooInterface\Data\Pack $pack = null, $trackingId = null) {
		$request = new MooInterface\Request\CreatePack();
		$request->setPack($pack);
		$request->setProduct($productType);
		$request->setTrackingId($trackingId);
		return $this->makeRequest($request, "CreatePackResponse");
	}

	/**
	 * Get a Moo pack from the builder store.
	 * This requires read permissions, which you ought to have.
	 * Note that once you've handed off the user to a dropIn URL the pack becomes "owned" and you cannot read it anymore.
	 * This may change in a future API version.
	 * @param string $packId The pack ID to get
	 * @return MooInterface\Response\GetPack
	 */
	public function packGetPack($packId) {
		$request = new MooInterface\Request\GetPack();
		$request->setPackId($packId);
		return $this->makeRequest($request, "GetPackResponse");
	}

	/**
	 * Update a Moo pack on the builder store.
	 * This requires update permissions, which you ought to have.
	 * Note that once you've handed off the user to a dropIn URL the pack becomes "owned" and you cannot update it anymore.
	 * @param string $packId The pack to update
	 * @param MooInterface\Data\Pack $pack The new pack data
	 * @return MooInterface\Response\UpdatePack
	 */
	public function packUpdatePack($packId, MooInterface\Data\Pack $pack) {
		$request = new MooInterface\Request\UpdatePack();
		$request->setPackId($packId);
		$request->setPack($pack);
		return $this->makeRequest($request, "GetPackResponse");
	}

	/**
	 * Add a Moo pack from the builder store to the cart.
	 * Note that you don't have the ability to do this by default as it requires the cart permission.
	 * If 2 legged OAuth is used this applies to the session of the client making the HTTP request, i.e. this API client
	 * @param string $packId The pack ID to add
	 * @param int $quantity
	 * @return MooInterface\Response\AddToCart
	 */
	public function packAddToCart($packId, $quantity = 1) {
		$request = new MooInterface\Request\AddToCart();
		$request->setPackId($packId, $quantity);
		return $this->makeRequest($request, "AddToCartResponse");
	}

	/**
	 * Get the template XML for a template.
	 * Implementations of this API are not expected to deserialize the XML.
	 * Requires get_template permission which is granted to everyone.
	 * @param string $templateCode The template to retrieve
	 * @return \MooPhp\MooInterface\Data\Template\Template
	 */
	public function templateGetTemplate($templateCode) {
		$request = new MooInterface\Request\GetTemplate();
		$request->setTemplateCode($templateCode);
		$rawResponse = $this->_client->getFile($request->getMethod(), $this->_marshaller->marshall($request, "Request"));
		return $this->_templateMarshaller->unmarshall($rawResponse, "Template");
	}

	/**
	 * Upload a local image to the Moo servers.
	 * Will take an ImageResource, which could be wrapping a file or some binary and feed it to moo.
	 * Requires upload_image permission, which is granted to everyone.
	 * @param string $imageFile path to the image to import
	 * @param string $imageType Type of image from the IMAGE_TYPE_ constants. Default is unknown which will not trigger image enhance by default.
	 * @return MooInterface\Response\UploadImage
	 */
	public function imageUploadImage($imageFile, $imageType = self::IMAGE_TYPE_UNKNOWN) {

		$imageFilePath = realpath($imageFile);

		if (!$imageFilePath || !is_file($imageFilePath) || !is_readable($imageFilePath)) {
			throw new \InvalidArgumentException("Cannot access file $imageFile");
		}

		$request = new MooInterface\Request\UploadImage();
		$request->setImageType($imageType);
		$rawResponse = $this->_client->sendFile($request->getMethod(), $this->_marshaller->marshall($request, "Request"), $imageFilePath);
		return $this->_handleResponse($rawResponse, "UploadImageResponse");
	}

	/**
	 * Ask Moo's servers to grab an image from a URL and import it.
	 * Requires import_image which is NOT granted by default.
	 * @param string $url URL to obtain the image from
	 * @param string $imageType Type of image from the IMAGE_TYPE_ constants. Default is unknown which will not trigger image enhance by default.
	 * @return MooInterface\Response\ImportImage
	 */
	public function imageImportImage($url, $imageType = self::IMAGE_TYPE_UNKNOWN) {
		$request = new MooInterface\Request\ImportImage();
		$request->setImageType($imageType);
		$request->setImageUrl($url);
		return $this->makeRequest($request, "ImportImageResponse");
	}

}


<?php
namespace MooPhp;
use MooPhp\MooInterface\Data\FontSpec;
use MooPhp\MooInterface\Request\Request;

/**
 * @package Api.php
 * @author Jonathan Oddy <jonathan@moo.com>
 * @copyright Copyright (c) 2012, Moo Print Ltd.
 */

class Api implements MooInterface\MooApi
{

    /**
     * @var Client\Client
     */
    protected $_client;

    protected $_marshaller;
    protected $_templateMarshaller;

    /**
     * @var \Weasel\Common\Logger\Logger
     */
    protected $_logger;

    public function __construct(Client\Client $client, \Weasel\Common\Cache\Cache $cache = null)
    {
        $this->_client = $client;
        // TODO: caching of the configs
        $this->_logger = $client->getLogger();

        if (!isset($cache)) {
            $cache = new \Weasel\Common\Cache\ArrayCache();
        }

        $annotationConfigurator = new \Weasel\Annotation\AnnotationConfigurator($this->_logger, $cache);

        $this->_templateMarshaller =
            new \Weasel\XmlMarshaller\XmlMapper(new \Weasel\XmlMarshaller\Config\AnnotationDriver($this->_logger, $annotationConfigurator, $cache));
        $this->_marshaller =
            new \Weasel\JsonMarshaller\JsonMapper(new \Weasel\JsonMarshaller\Config\AnnotationDriver($this->_logger, $annotationConfigurator, $cache));

    }

    public function getClient()
    {
        return $this->_client;
    }

    protected function _getRequestParams(\MooPhp\MooInterface\Request\Request $request)
    {
        $rObject = new \ReflectionObject($request);
        $requestParams = array();
        if (isset($this->_logger)) {
            $this->_logger->logDebug("Encoding request " . print_r($request, true));
        }
        foreach ($rObject->getMethods() as $method) {
            /**
             * @var \ReflectionMethod $method
             */
            $name = $method->getName();
            if ($method->getNumberOfParameters() === 0 && strpos($name, "get") === 0) {
                $property = lcfirst(substr($name, 3));
                $rawValue = $request->$name();
                $value = null;
                if (is_object($rawValue)) {
                    $value = $this->_marshaller->writeString($rawValue);
                } elseif (is_array($rawValue)) {
                    $value = json_encode($rawValue);
                } elseif (is_bool($rawValue)) {
                    $value = $rawValue ? "true" : "false";
                } else {
                    $value = $rawValue;
                }
                if ($property != 'httpMethod' && isset($value)) {
                    $requestParams[$property] = $value;
                }
            }
        }
        return $requestParams;
    }

    /**
     * @param MooInterface\Request\Request $request
     * @param string $responseType
     * @return \MooPhp\MooInterface\Response\Response
     */
    public function makeRequest(\MooPhp\MooInterface\Request\Request $request, $responseType)
    {
        $rawResponse =
            $this->_client->makeRequest($this->_getRequestParams($request),
                                        $request->getHttpMethod() == Request::HTTP_GET ? Client\Client::HTTP_GET :
                                            Client\Client::HTTP_POST
            );
        return $this->_handleResponse($rawResponse, $responseType);
    }

    public function getFile(\MooPhp\MooInterface\Request\Request $request)
    {
        return $this->_client->getFile($this->_getRequestParams($request));
    }

    public function sendFile(\MooPhp\MooInterface\Request\Request $request, $fileParam, $responseType)
    {
        $rawResponse = $this->_client->sendFile($this->_getRequestParams($request), $fileParam);
        return $this->_handleResponse($rawResponse, $responseType);
    }


    protected function _handleResponse($rawResponse, $type)
    {
        if ($type[0] !== '\\') {
            $type = '\MooPhp\MooInterface\Response\\' . $type;
        }
        /**
         * @var \MooPhp\MooInterface\Response\Response $object
         */
        $object = $this->_marshaller->readString($rawResponse, $type);

        if (isset($this->_logger)) {
            $this->_logger->logDebug("Decoded response to " . print_r($object, true));
        }

        if ($object->getException()) {
            throw $object->getException();
        }
        return $object;
    }

    /**
     * Create a new Moo pack.
     * This will actually create a pack of a given type on the server.
     * Requires create permissions which everyone should have.
     * @abstract
     * @param \MooPhp\MooInterface\Data\PhysicalSpec $physicalSpec The physical spec to build the pack with
     * @param \MooPhp\MooInterface\Data\Pack|null $pack An optional initial pack to use.
     * @param string $friendlyName A friendly name to give the pack in the cart (and I think default save names?)
     * @param string $trackingId Optional tracking ID to use for tracking callbacks
     * @param string $startAgainUrl Absolute URL to send the user to if they hit the start again button
     * @return \MooPhp\MooInterface\Response\CreatePack
     */
    public function packCreatePack(\MooPhp\MooInterface\Data\PhysicalSpec $physicalSpec,
                                   MooInterface\Data\Pack $pack = null,
                                   $friendlyName = null,
                                   $trackingId = null,
                                   $startAgainUrl = null)
    {
        $request = new MooInterface\Request\CreatePack();
        $request->setPack($pack);
        $request->setPhysicalSpec($physicalSpec);
        $request->setTrackingId($trackingId);
        $request->setFriendlyName($friendlyName);
        $request->setStartAgainUrl($startAgainUrl);
        return $this->makeRequest($request, "CreatePack");
    }

    /**
     * Get a Moo pack from the builder store.
     * This requires read permissions, which you ought to have.
     * Note that once you've handed off the user to a dropIn URL the pack becomes "owned" and you cannot read it anymore.
     * This may change in a future API version.
     * @param string $packId The pack ID to get
     * @return MooInterface\Response\GetPack
     */
    public function packGetPack($packId)
    {
        $request = new MooInterface\Request\GetPack();
        $request->setPackId($packId);
        return $this->makeRequest($request, "GetPack");
    }

    /**
     * Update a Moo pack on the builder store.
     * This requires update permissions, which you ought to have.
     * Note that once you've handed off the user to a dropIn URL the pack becomes "owned" and you cannot update it anymore.
     * @param string $packId The pack to update
     * @param MooInterface\Data\Pack $pack The new pack data
     * @return MooInterface\Response\UpdatePack
     */
    public function packUpdatePack($packId, MooInterface\Data\Pack $pack)
    {
        $request = new MooInterface\Request\UpdatePack();
        $request->setPackId($packId);
        $request->setPack($pack);
        return $this->makeRequest($request, "UpdatePack");
    }

    /**
     * Add a Moo pack from the builder store to the cart.
     * Note that you don't have the ability to do this by default as it requires the cart permission.
     * If 2 legged OAuth is used this applies to the session of the client making the HTTP request, i.e. this API client
     * @param string $packId The pack ID to add
     * @param int $quantity
     * @return MooInterface\Response\AddToCart
     */
    public function packAddToCart($packId, $quantity = 1)
    {
        $request = new MooInterface\Request\AddToCart();
        $request->setPackId($packId, $quantity);
        return $this->makeRequest($request, "AddToCart");
    }

    /**
     * Get the template XML for a template.
     * Implementations of this API are not expected to deserialize the XML.
     * Requires get_template permission which is granted to everyone.
     * @param string $templateCode The template to retrieve
     * @return \MooPhp\MooInterface\Data\Template\Template
     */
    public function templateGetTemplate($templateCode)
    {
        $request = new MooInterface\Request\GetTemplate();
        $request->setTemplateCode($templateCode);

        $rawResponse = $this->getFile($request);
        return $this->_templateMarshaller->readString($rawResponse,
                                                      '\MooPhp\MooInterface\Data\Template\Template',
                                                      'http://www.moo.com/xsd/template-1.0'
        );
    }

    /**
     * Upload a local image to the Moo servers.
     * Will take an ImageResource, which could be wrapping a file or some binary and feed it to moo.
     * Requires upload_image permission, which is granted to everyone.
     * @param string $imageFile path to the image to import
     * @param string $imageType Type of image from the IMAGE_TYPE_ constants. Default is unknown which will not trigger image enhance by default.
     * @throws \InvalidArgumentException
     * @return \MooPhp\MooInterface\Response\UploadImage
     */
    public function imageUploadImage($imageFile, $imageType = self::IMAGE_TYPE_UNKNOWN)
    {

        $imageFilePath = realpath($imageFile);

        if (!$imageFilePath || !is_file($imageFilePath) || !is_readable($imageFilePath)) {
            throw new \InvalidArgumentException("Cannot access file $imageFile");
        }

        $request = new MooInterface\Request\UploadImage();
        $request->setImageType($imageType);
        $request->setImageFile($imageFilePath);

        return $this->sendFile($request, "imageFile", "UploadImage");

    }

    /**
     * Ask Moo's servers to grab an image from a URL and import it.
     * Requires import_image which is NOT granted by default.
     * @param string $url URL to obtain the image from
     * @param string $imageType Type of image from the IMAGE_TYPE_ constants. Default is unknown which will not trigger image enhance by default.
     * @return MooInterface\Response\ImportImage
     */
    public function imageImportImage($url, $imageType = self::IMAGE_TYPE_UNKNOWN)
    {
        $request = new MooInterface\Request\ImportImage();
        $request->setImageType($imageType);
        $request->setImageUrl($url);
        return $this->makeRequest($request, "ImportImage");
    }

    /**
     * Update the physical spec on a pack.
     * @param string $packId
     * @param \MooPhp\MooInterface\Data\PhysicalSpec $physicalSpec
     * @return MooInterface\Response\UpdatePhysicalSpec
     */
    public function updatePhysicalSpec($packId, \MooPhp\MooInterface\Data\PhysicalSpec $physicalSpec)
    {
        $request = new MooInterface\Request\UpdatePhysicalSpec();
        $request->setPackId($packId);
        $request->setPhysicalSpec($physicalSpec);
        return $this->makeRequest($request, "UpdatePhsyicalSpec");
    }

    /**
     * @param string $text The text to measure
     * @param float $fontSize The font size in $units
     * @param \MooPhp\MooInterface\Data\FontSpec $fontSpec Font to use for the measurement
     * @param float $wrappingWidth Width in mm after which to wrap to a new line (for multi-line text areas)
     * @param float $leading line spacing as a multiple of the default for the font.
     * @param string $fontUnits Unit of measurement for the font size
     * @throws \InvalidArgumentException
     * @return \MooPhp\MooInterface\Response\TextMeasure
     */
    public function textMeasure($text,
                                $fontSize,
                                \MooPhp\MooInterface\Data\FontSpec $fontSpec,
                                $wrappingWidth = null,
                                $leading = null,
                                $fontUnits = self::UNIT_MILLIMETERS)
    {
        // The API call currently takes points, which is incredibly inconsistent as you're almost always working in
        // mm when dealing with the API. To make life a bit simpler we'll provide the ability to do the conversion here.
        switch ($fontUnits) {
            case self::UNIT_MILLIMETERS:
                $pointSize = $fontSize * 72 / 25.4;
                break;
            case self::UNIT_POINTS:
                $pointSize = $fontSize;
                break;
            default:
                throw new \InvalidArgumentException("Unknown unit of measurement, $fontUnits");
        }

        // API call also requires the optional parameters (oopse.)
        if (!isset($wrappingWidth)) {
            $wrappingWidth = 0;
        }
        if (!isset($leading)) {
            $leading = 1;
        }

        $request = new MooInterface\Request\TextMeasure();
        $request->setText($text);
        $request->setFontSize($pointSize);
        $request->setFontSpec($fontSpec);
        $request->setWrappingWidth($wrappingWidth);
        $request->setLeading($leading);
        return $this->makeRequest($request, "TextMeasure");
    }
}


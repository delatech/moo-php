<?php
namespace MooPhp\MooInterface\Client;

use MooPhp\MooInterface\MooApi;

class Image
{

    /**
     * @var string
     */
    private $imageFile;

    /**
     * @var string
     */
    private $imageType;

    /**
     * @param string $imageFile Path to image file on disk.
     * @param string $imageType One of the MooApi::IMAGE_TYPE_ constants.
     */
    function __construct($imageFile, $imageType = MooApi::IMAGE_TYPE_UNKNOWN)
    {
        $this->imageFile = $imageFile;
        $this->imageType = $imageType;
    }

    /**
     * @return string Path to image on disk.
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @return string one of the MooApi::IMAGE_TYPE_ constants.
     */
    public function getImageType()
    {
        return $this->imageType;
    }

} 
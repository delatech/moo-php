<?php
namespace MooPhp\MooInterface\Request;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan@moo.com>
 * @copyright Copyright (c) 2012, Moo Print Ltd.
 */

class ImportImage extends Request
{

    private $_imageUrl;
    private $_imageType = null;

    public function __construct()
    {
        parent::__construct("moo.image.importImage");
    }

    /**
     * @param string $imageType One of the IMAGE_TYPE_ constants from MooApi
     */
    public function setImageType($imageType)
    {
        $this->_imageType = $imageType;
    }

    /**
     * @param string $imageUrl
     */
    public function setImageUrl($imageUrl)
    {
        $this->_imageUrl = $imageUrl;
    }

    public function getImageType()
    {
        return $this->_imageType;
    }

    public function getImageUrl()
    {
        return $this->_imageUrl;
    }
}

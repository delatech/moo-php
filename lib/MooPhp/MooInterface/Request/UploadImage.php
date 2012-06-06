<?php
namespace MooPhp\MooInterface\Request;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan@moo.com>
 * @copyright Copyright (c) 2012, Moo Print Ltd.
 */

class UploadImage extends Request
{

    protected $_imageFile;
    protected $_imageType = null;

    public function __construct()
    {
        parent::__construct("moo.image.uploadImage");
    }

    /**
     * @param string $imageType One of the IMAGE_TYPE_ constants from MooApi
     */
    public function setImageType($imageType)
    {
        $this->_imageType = $imageType;
    }

    /**
     * @param string $imageFile
     */
    public function setImageFile($imageFile)
    {
        $this->_imageFile = $imageFile;
    }

    public function getImageFile()
    {
        return $this->_imageFile;
    }

    public function getImageType()
    {
        return $this->_imageType;
    }
}

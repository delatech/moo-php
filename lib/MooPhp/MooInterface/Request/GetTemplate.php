<?php
namespace MooPhp\MooInterface\Request;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan@moo.com>
 * @copyright Copyright (c) 2012, Moo Print Ltd.
 */

class GetTemplate extends Request
{

    private $_templateCode;

    public function __construct()
    {
        parent::__construct("moo.template.getTemplate");
    }

    /**
     * @param string $templateCode Template code
     */
    public function setTemplateCode($templateCode)
    {
        $this->_templateCode = $templateCode;
    }

    public function getTemplateCode()
    {
        return $this->_templateCode;
    }

}

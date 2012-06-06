<?php
namespace MooPhp\MooInterface\Response;
use Weasel\JsonMarshaller\Config\Annotations\JsonProperty;

/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan@moo.com>
 * @copyright Copyright (c) 2012, Moo Print Ltd.
 */

class AddToCart extends Response
{

    private $_warnings;
    private $_dropIns;

    /**
     * @return \MooPhp\MooInterface\Warning[] Any warnings we've triggered
     */
    public function getWarnings()
    {
        return $this->_warnings;
    }

    /**
     * @return string[] of dropin urls we can use at this point
     */
    public function getDropIns()
    {
        return $this->_dropIns;
    }

    /**
     * @param $dropIns
     * @JsonProperty(type="string[string]")
     */
    public function setDropIns($dropIns)
    {
        $this->_dropIns = $dropIns;
    }

    /**
     * @param $warnings
     * @JsonProperty(type="\MooPhp\MooInterface\Response\Warning[]")
     */
    public function setWarnings($warnings)
    {
        $this->_warnings = $warnings;
    }

}

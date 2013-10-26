<?php
namespace MooPhp\MooInterface\Request;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan@moo.com>
 * @copyright Copyright (c) 2012, Moo Print Ltd.
 */

class CreateTrialPartnerPack extends CreatePack
{

    /**
     * @var string
     */
    private $_trialPartner;

    public function __construct()
    {
        $this->_method = "moo.pack.createTrialPartnerPack";
    }

    /**
     * @param string $trialPartner
     */
    public function setTrialPartner($trialPartner)
    {
        $this->_trialPartner = $trialPartner;
    }

    /**
     * @return string
     */
    public function getTrialPartner()
    {
        return $this->_trialPartner;
    }

}

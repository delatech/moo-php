<?php
namespace MooPhp\MooInterface\Data;

use Weasel\JsonMarshaller\JsonMapper;
use Weasel\JsonMarshaller\Config\AnnotationDriver;
use MooPhp\MooInterface\MooApi;
use MooPhp\MooInterface\Data\UserData\TextData;
use MooPhp\MooInterface\Data\UserData\BoxData;

class SideTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \MooPhp\MooInterface\Data\Side
     */
    public function testMarshallSide()
    {
        $om = new JsonMapper(new AnnotationDriver());

        $side = new Side();
        $side->setType("left");
        $side->setSideNum(123);
        $side->setTemplateCode("ugly_card.xml");
        $side->setData(array(new BoxData()));

        $json = $om->writeString($side);
        $this->assertEquals($side, $om->readString($json, '\MooPhp\MooInterface\Data\Side'));

    }

}

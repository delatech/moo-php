<?php
namespace MooPhp\MooInterface\Data;

use Weasel\JsonMarshaller\JsonMapper;
use Weasel\JsonMarshaller\Config\AnnotationDriver;
use MooPhp\MooInterface\MooApi;

class PhysicalSpecTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \MooPhp\MooInterface\Data\PhysicalSpec
     */
    public function testMarshallPhysicalSpec()
    {
        $om = new JsonMapper(new AnnotationDriver());

        $physicalSpec = new PhysicalSpec(MooApi::PRODUCT_TYPE_MINICARD, "toilet", "square", 123, "sandpaper");
        $json = $om->writeString($physicalSpec);
        $this->assertEquals($physicalSpec, $om->readString($json, '\MooPhp\MooInterface\Data\PhysicalSpec'));

    }

}

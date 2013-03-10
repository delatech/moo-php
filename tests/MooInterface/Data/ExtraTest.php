<?php
namespace MooPhp\MooInterface\Data;

use Weasel\JsonMarshaller\JsonMapper;
use Weasel\JsonMarshaller\Config\AnnotationDriver;

class ExtraTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \MooPhp\MooInterface\Data\Extra
     */
    public function testMarshallExtra()
    {
        $om = new JsonMapper(new AnnotationDriver());

        $extra = new Extra("left", "right");

        $json = $om->writeString($extra);

        $this->assertEquals($extra, $om->readString($json, '\MooPhp\MooInterface\Data\Extra'));


    }

}

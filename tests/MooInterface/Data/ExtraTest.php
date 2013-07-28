<?php
namespace MooPhp\MooInterface\Data;

use Weasel\JsonMarshaller\JsonMapper;
use Weasel\JsonMarshaller\Config\AnnotationDriver;
use Weasel\WeaselDoctrineAnnotationDrivenFactory;

class ExtraTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \MooPhp\MooInterface\Data\Extra
     */
    public function testMarshallExtra()
    {
        $fact = new WeaselDoctrineAnnotationDrivenFactory();
        $om = $fact->getJsonMapperInstance();

        $extra = new Extra("left", "right");

        $json = $om->writeString($extra);

        $this->assertEquals($extra, $om->readString($json, '\MooPhp\MooInterface\Data\Extra'));


    }

}

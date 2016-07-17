<?php

namespace StoutLogic\AcfBuilder\Tests\Transform;

use StoutLogic\AcfBuilder\FieldsBuilder;
use StoutLogic\AcfBuilder\ConditionalBuilder;
use StoutLogic\AcfBuilder\Transform;
use Prophecy\Argument;

class FlexibleContentLayoutTest extends \PHPUnit_Framework_TestCase
{
    public function testTransformValue()
    {
        $builder = $this->prophesize('\StoutLogic\AcfBuilder\FieldsBuilder');
        $builder
            ->getName()
            ->willReturn('Fields Builder Name');

        $transform = new Transform\FlexibleContentLayout($builder->reveal());

        $expected = [
            'sub_fields' => 'fields',
            'label' => 'title',
        ];

        $actual = $transform->transform([
            'fields' => 'fields',
            'title' => 'title',
        ]);

        $this->assertSame($expected, $actual);
    }
}

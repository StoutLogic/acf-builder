<?php

namespace StoutLogic\AcfBuilder\Tests\Transform;

use StoutLogic\AcfBuilder\FieldsBuilder;
use StoutLogic\AcfBuilder\FieldBuilder;
use StoutLogic\AcfBuilder\ConditionalBuilder;
use StoutLogic\AcfBuilder\Transform;

class ConditionalLogicTest extends \PHPUnit_Framework_TestCase
{
    public function testIsRecursive()
    {
        $builder = $this->prophesize('\StoutLogic\AcfBuilder\FieldsBuilder');
        $transform = new Transform\ConditionalLogic($builder->reveal());
        $this->assertInstanceOf('\StoutLogic\AcfBuilder\Transform\RecursiveTransform', $transform);
    }

    public function testGetKeys()
    {
        $builder = $this->prophesize('\StoutLogic\AcfBuilder\FieldsBuilder');
        $transform = new Transform\ConditionalLogic($builder->reveal());
        $this->assertSame(['conditional_logic'], $transform->getKeys());
    }

    public function testTransformValue()
    {
        $field = $this->prophesize('\StoutLogic\AcfBuilder\FieldBuilder');
        $field
            ->getKey()
            ->willReturn('field_name');

        $builder = $this->prophesize('\StoutLogic\AcfBuilder\FieldsBuilder');
        $builder
            ->getField('name')
            ->willReturn($field->reveal());

        $transform = new Transform\ConditionalLogic($builder->reveal());
        $this->assertSame([[[
            'field' => 'field_name',
            'operator' => '==',
            'value' => 1,
        ]]], $transform->transformValue([[[
            'field' => 'name',
            'operator' => '==',
            'value' => 1,
        ]]]));
    }
}

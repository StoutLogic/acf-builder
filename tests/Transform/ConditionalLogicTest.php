<?php

namespace StoutLogic\AcfBuilder\Tests\Transform;

use StoutLogic\AcfBuilder\FieldsBuilder;
use StoutLogic\AcfBuilder\ConditionalBuilder;
use StoutLogic\AcfBuilder\Transform;
use PHPUnit\Framework\TestCase;

class ConditionalLogicTest extends TestCase
{
    public function testIsRecursive()
    {
        $builder = $this->prophesize(FieldsBuilder::class);
        $transform = new Transform\ConditionalLogic($builder->reveal());
        $this->assertInstanceOf(Transform\RecursiveTransform::class, $transform);
    }

    public function testGetKeys()
    {
        $builder = $this->prophesize(FieldsBuilder::class);
        $transform = new Transform\ConditionalLogic($builder->reveal());
        $this->assertSame(['conditional_logic'], $transform->getKeys());
    }

    public function testTransformValue()
    {
        $builder = $this->prophesize(FieldsBuilder::class);
        $builder
            ->getFieldByName('name')
            ->willReturn([
                'key' => 'field_name',
            ]);

        $conditionalBuilder = $this->prophesize(ConditionalBuilder::class);
        $conditionalBuilder
            ->build()
            ->willReturn([[[
                'field' => 'name',
                'operator' => '==',
                'value' => 1.
            ]]]);

        $transform = new Transform\ConditionalLogic($builder->reveal());
        $this->assertSame([[[
            'field' => 'field_name',
            'operator' => '==',
            'value' => 1.
        ]]], $transform->transformValue($conditionalBuilder->reveal()));
    }
}

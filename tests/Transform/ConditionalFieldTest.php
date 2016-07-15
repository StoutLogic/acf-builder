<?php

namespace StoutLogic\AcfBuilder\Tests\Transform;

use StoutLogic\AcfBuilder\FieldsBuilder;
use StoutLogic\AcfBuilder\Transform;
use PHPUnit\Framework\TestCase;

class ConditionalFieldTest extends TestCase
{
    public function testIsRecursive()
    {
        $builder = $this->prophesize(FieldsBuilder::class);
        $transform = new Transform\ConditionalField($builder->reveal());
        $this->assertInstanceOf(Transform\RecursiveTransform::class, $transform);
    }

    public function testGetKeys()
    {
        $builder = $this->prophesize(FieldsBuilder::class);
        $transform = new Transform\ConditionalField($builder->reveal());
        $this->assertSame(['field'], $transform->getKeys());
    }

    public function testTransformValue()
    {
        $builder = $this->prophesize(FieldsBuilder::class);
        $builder
            ->getFieldByName('value')
            ->willReturn([
                'key' => 'field_key',
            ]);

        $transform = new Transform\ConditionalField($builder->reveal());
        $this->assertSame('field_key', $transform->transformValue('value'));
    }
}

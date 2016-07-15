<?php

namespace StoutLogic\AcfBuilder\Tests\Transform;

use StoutLogic\AcfBuilder\FieldsBuilder;
use StoutLogic\AcfBuilder\ConditionalBuilder;
use StoutLogic\AcfBuilder\Transform;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;

class FlexibleContentLayoutTest extends TestCase
{
    public function testTransformValue()
    {
        $builder = $this->prophesize(FieldsBuilder::class);
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

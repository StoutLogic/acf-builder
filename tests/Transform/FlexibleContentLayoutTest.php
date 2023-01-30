<?php

namespace StoutLogic\AcfBuilder\Tests\Transform;

use PHPUnit\Framework\TestCase;
use StoutLogic\AcfBuilder\Transform;
use Prophecy\PhpUnit\ProphecyTrait;

class FlexibleContentLayoutTest extends TestCase
{
    use ProphecyTrait;

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

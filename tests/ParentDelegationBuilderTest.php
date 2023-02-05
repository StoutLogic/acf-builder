<?php

namespace StoutLogic\AcfBuilder\Tests;

use PHPUnit\Framework\TestCase;
use StoutLogic\AcfBuilder\Builder;

class ParentDelegationBuilderTest extends TestCase
{
    public function testReturningParent()
    {
        $parent = $this
            ->getMockBuilder('StoutLogic\AcfBuilder\ParentDelegationBuilder')
            ->setMethods(['parentMethod', 'build'])
            ->getMockForAbstractClass();
        $child = $this->getMockForAbstractClass('StoutLogic\AcfBuilder\ParentDelegationBuilder');
        $child->setParentContext($parent);

        $parent->expects($this->once())->method('parentMethod');
        $child->parentMethod();
    }

    public function testThrowingException()
    {
        $parent = $this->getMockForAbstractClass('StoutLogic\AcfBuilder\ParentDelegationBuilder');
        $child = $this->getMockForAbstractClass('StoutLogic\AcfBuilder\ParentDelegationBuilder');
        $child->setParentContext($parent);

        $this->expectException('\Exception');
        $child->nonExistantParentMethod();
    }
}

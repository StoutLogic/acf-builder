<?php

namespace Understory\Fields\Tests;

use Understory\Fields\Builder;

class BuilderTest extends \PHPUnit_Framework_TestCase
{
    public function testReturningParent()
    {
        $parent = $this->getMock('Understory\Fields\Builder', ['parentMethod', 'build']);
        $child = $this->getMockForAbstractClass('Understory\Fields\Builder');
        $child->setParentContext($parent);

        $parent->expects($this->once())->method('parentMethod');
        $child->parentMethod();
    }

    public function testThrowingException()
    {
        $parent = $this->getMockForAbstractClass('Understory\Fields\Builder');
        $child = $this->getMockForAbstractClass('Understory\Fields\Builder');
        $child->setParentContext($parent);

        $this->setExpectedException(\Exception::class);
        $child->nonExistantParentMethod();
    }
}

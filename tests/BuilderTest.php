<?php

namespace StoutLogic\AcfBuilder\Tests;

use StoutLogic\AcfBuilder\Builder;

class BuilderTest extends \PHPUnit_Framework_TestCase
{
    public function testReturningParent()
    {
        $parent = $this->getMock('StoutLogic\AcfBuilder\Builder', ['parentMethod', 'build']);
        $child = $this->getMockForAbstractClass('StoutLogic\AcfBuilder\Builder');
        $child->setParentContext($parent);

        $parent->expects($this->once())->method('parentMethod');
        $child->parentMethod();
    }

    public function testThrowingException()
    {
        $parent = $this->getMockForAbstractClass('StoutLogic\AcfBuilder\Builder');
        $child = $this->getMockForAbstractClass('StoutLogic\AcfBuilder\Builder');
        $child->setParentContext($parent);

        $this->setExpectedException(\Exception::class);
        $child->nonExistantParentMethod();
    }
}

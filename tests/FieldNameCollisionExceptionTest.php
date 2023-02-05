<?php

namespace StoutLogic\AcfBuilder\Tests;

use PHPUnit\Framework\TestCase;
use StoutLogic\AcfBuilder\FieldNameCollisionException;
use StoutLogic\AcfBuilder\FieldsBuilder;

class FieldNameCollisionExceptionTest extends TestCase
{
    public function testClassExists()
    {
        $this->assertTrue(class_exists('StoutLogic\AcfBuilder\FieldNameCollisionException'));
    }

    public function testExceptionThrownDuringFieldNameCollision()
    {
        $this->expectException(FieldNameCollisionException::class);
        $builder = new FieldsBuilder('Banner');
        $builder
            ->addText('title')
            ->addWysiwyg('content')
            ->addTextarea('content');
    }

    public function testExceptionThrownDuringFieldNameCollisionUsingRepeaters()
    {
        $this->expectException(FieldNameCollisionException::class);
        $builder = new FieldsBuilder('Banner');
        $builder
            ->addText('title')
            ->addRepeater('slides')
                ->addRadio('slides')
                    ->addChoices(1, 2, 3, 4)
                ->endRepeater()
            ->addRadio('slides')
                ->addChoices(1, 2, 3, 4);
    }

    public function testExceptionThrownDuringFieldNameCollisionUsingFlexibleContent()
    {
        $this->expectException(FieldNameCollisionException::class);
        $builder = new FieldsBuilder('Banner');
        $builder
            ->addText('title')
            ->addFlexibleContent('content')
                ->addLayout('copy')
                    ->addWysiwyg('content')
                ->addLayout('gallery')
                    ->addRepeater('images')
                        ->addImage('image')
                ->endFlexibleContent()
            ->addWysiwyg('content');
    }

    public function testExceptionThrownDuringFieldNameCollisionUsingAddFields()
    {
        $this->expectException(FieldNameCollisionException::class);
        $builder = new FieldsBuilder('Banner');
        $builder
            ->addText('title')
            ->addWysiwyg('content');

        $builder2 = new FieldsBuilder('Section');
        $builder2
            ->addText('headline')
            ->addWysiwyg('content');

        $builder->addFields($builder2);
    }
}

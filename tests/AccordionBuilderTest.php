<?php

namespace StoutLogic\AcfBuilder\Tests;

use StoutLogic\AcfBuilder\AccordionBuilder;

class AccordionBuilderTest extends \PHPUnit_Framework_TestCase
{
    public function testClassExists()
    {
        $this->assertTrue(class_exists('StoutLogic\AcfBuilder\AccordionBuilder'));
    }

    public function testCreateTabBuilder()
    {
        $subject = new AccordionBuilder('settings');
        $this->assertArraySubset([
            'key' => 'field_settings_accordion',
            'name' => 'settings_accordion',
            'label' => 'Settings',
            'type' => 'accordion',
        ], $subject->build());
    }

    public function testEndpoint()
    {
        $subject = new AccordionBuilder('settings');
        $this->assertSame($subject, $subject->endpoint());
        $this->assertArraySubset([
            'key' => 'field_settings_accordion',
            'name' => 'settings_accordion',
            'label' => 'Settings',
            'type' => 'accordion',
            'endpoint' => 1,
        ], $subject->build());

        $this->assertSame($subject, $subject->removeEndpoint());
        $this->assertArraySubset([
            'key' => 'field_settings_accordion',
            'name' => 'settings_accordion',
            'label' => 'Settings',
            'type' => 'accordion',
            'endpoint' => 0,
        ], $subject->build());
    }

    public function testOpen()
    {
        $subject = new AccordionBuilder('settings');
        $this->assertArraySubset([
            'open' => 1,
            'type' => 'accordion',
        ], $subject
            ->setOpen()
            ->build()
        );

        $this->assertArraySubset([
            'open' => 1,
            'type' => 'accordion',
        ], $subject
            ->setOpen(true)
            ->build()
        );

        $this->assertArraySubset([
            'open' => 0,
            'type' => 'accordion',
        ], $subject
            ->setOpen(false)
            ->build()
        );
    }

    public function testMultiExpand()
    {
        $subject = new AccordionBuilder('settings');
        $this->assertArraySubset([
            'multi_expand' => 1,
            'type' => 'accordion',
        ], $subject
            ->setMultiExpand()
            ->build()
        );

        $this->assertArraySubset([
            'multi_expand' => 1,
            'type' => 'accordion',
        ], $subject
            ->setMultiExpand(true)
            ->build()
        );

        $this->assertArraySubset([
            'multi_expand' => 0,
            'type' => 'accordion',
        ], $subject
            ->setMultiExpand(false)
            ->build()
        );
    }
}

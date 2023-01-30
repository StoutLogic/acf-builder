<?php

namespace StoutLogic\AcfBuilder\Tests;

use DMS\PHPUnitExtensions\ArraySubset\ArraySubsetAsserts;
use PHPUnit\Framework\TestCase;
use StoutLogic\AcfBuilder\TabBuilder;

class TabBuilderTest extends TestCase
{
    use ArraySubsetAsserts;

    public function testClassExists()
    {
        $this->assertTrue(class_exists('StoutLogic\AcfBuilder\TabBuilder'));
    }

    public function testCreateTabBuilder()
    {
        $subject = new TabBuilder('settings');
        $this->assertArraySubset([
            'key' => 'field_settings_tab',
            'name' => 'settings_tab',
            'label' => 'Settings',
            'type' => 'tab',
        ], $subject->build());
    }

    public function testEndpoint()
    {
        $subject = new TabBuilder('settings');
        $this->assertSame($subject, $subject->endpoint());
        $this->assertArraySubset([
            'key' => 'field_settings_tab',
            'name' => 'settings_tab',
            'label' => 'Settings',
            'type' => 'tab',
            'endpoint' => 1,
        ], $subject->build());

        $this->assertSame($subject, $subject->removeEndpoint());
        $this->assertArraySubset([
            'key' => 'field_settings_tab',
            'name' => 'settings_tab',
            'label' => 'Settings',
            'type' => 'tab',
            'endpoint' => 0,
        ], $subject->build());
    }
}

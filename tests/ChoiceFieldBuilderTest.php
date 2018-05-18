<?php

namespace StoutLogic\AcfBuilder\Tests;

use StoutLogic\AcfBuilder\ChoiceFieldBuilder;
use StoutLogic\AcfBuilder\FieldsBuilder;

class ChoiceFieldBuilderTest extends \PHPUnit_Framework_TestCase
{
    public function testClassExists()
    {
        $this->assertTrue(class_exists('StoutLogic\AcfBuilder\ChoiceFieldBuilder'));
    }

    public function testAddChoice()
    {
        $subject = new ChoiceFieldBuilder('choice', 'radio');
        $this->assertSame($subject, $subject->addChoice('red'));
        $this->assertArraySubset([
            'choices' => [
                'red' => 'red',
            ]
        ], $subject->build());
    }

    public function testAddChoiceInConstructor()
    {
        $subject = new ChoiceFieldBuilder('choice', 'radio', [
            'choices' => [
                'red',
                ['blue' => 'Blue'],
            ]
        ]);
        $this->assertArraySubset([
            'choices' => [
                'red' => 'red',
                'blue' => 'Blue',
            ]
        ], $subject->build());
    }

    public function testAddChoiceInAdditionToConstructor()
    {
        $subject = new ChoiceFieldBuilder('choice', 'radio', [
            'choices' => [
                'red',
                ['blue' => 'Blue'],
            ]
        ]);
        $this->assertSame($subject, $subject->addChoice('green', 'Green'));
        $this->assertArraySubset([
            'choices' => [
                'red' => 'red',
                'blue' => 'Blue',
                'green' => 'Green',
            ]
        ], $subject->build());
    }

    public function testSetChoices()
    {
        $subject = new ChoiceFieldBuilder('choice', 'radio', [
            'choices' => [
                'red',
                ['blue' => 'Blue'],
            ]
        ]);
        $this->assertSame($subject, $subject->setChoices('green', ['yellow' => 'Yellow']));
        $this->assertArraySubset([
            'choices' => [
                'green' => 'green',
                'yellow' => 'Yellow',
            ]
        ], $subject->build());
    }

    public function testConfigInChoicesWithLabels()
    {
        $subject = new ChoiceFieldBuilder('choice', 'radio', [
            'label' => 'Are you finished?',
            'allow_null' => true,
            'required' => true,
            'choices' => [
                'yes' => 'Yes, please send my report for review!',
                'no' => 'No, save my report for later completion.',
            ]
        ]);

        $config = $subject->build();
        $this->assertArraySubset([
            'choices' => [
                'yes' => 'Yes, please send my report for review!',
                'no' => 'No, save my report for later completion.',
            ]
        ], $config);
    }
}

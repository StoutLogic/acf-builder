<?php

namespace StoutLogic\AcfBuilder\Tests;

use StoutLogic\AcfBuilder\FieldManager;

class FieldManagerTest extends \PHPUnit_Framework_TestCase
{
    private $testFields;
    public function setup()
    {
        $this->testFields['test1'] = [
            'key' => 'field_test1',
            'name' => 'test1',
            'label' => 'Test1',
            'type' => 'text',
        ];
        $this->testFields['test2'] = [
            'key' => 'field_test2',
            'name' => 'test2',
            'label' => 'Test2',
            'type' => 'text',
        ];
        $this->testFields['test3'] = [
            'key' => 'field_test3',
            'name' => 'test3',
            'label' => 'Test3',
            'type' => 'text',
        ];
        $this->testFields['test4'] = [
            'key' => 'field_test4',
            'name' => 'test4',
            'label' => 'Test4',
            'type' => 'text',
        ];
    }

    public function testPushField()
    {
        $subject = new FieldManager();

        $subject->pushField($this->testFields['test2']);

        $this->assertSame([
            $this->testFields['test2'],
        ], $subject->getFields());
    }

    public function testPushFieldWithExistingField()
    {
        $subject = new FieldManager([$this->testFields['test1']]);

        $subject->pushField($this->testFields['test2']);

        $this->assertSame([
            $this->testFields['test1'],
            $this->testFields['test2'],
        ], $subject->getFields());
    }

    public function testInsertingFields()
    {

        $subject = new FieldManager([
            $this->testFields['test1'],
            $this->testFields['test2'],
        ]);

        $subject->insertFields($this->testFields['test3'], 1);

        $this->assertSame([
            $this->testFields['test1'],
            $this->testFields['test3'],
            $this->testFields['test2'],
        ], $subject->getFields());
    }

    public function testGetFieldCount()
    {
        $subject = new FieldManager([
            $this->testFields['test1'],
            $this->testFields['test2'],
            $this->testFields['test3'],
        ]);

        $this->assertEquals(3, $subject->getCount());
    }

    public function testRemovingField()
    {
        $subject = new FieldManager([
            $this->testFields['test1'],
            $this->testFields['test2'],
            $this->testFields['test3'],
        ]);

        $subject->removeField('test2');

        $this->assertEquals(2, $subject->getCount());
        $this->assertSame([
            $this->testFields['test1'],
            $this->testFields['test3'],
        ], $subject->getFields());
    }

    /**
     * @expectedException StoutLogic\AcfBuilder\FieldNotFoundException
     */
    public function testRemovingFieldNotFound()
    {
        $subject = new FieldManager([
            $this->testFields['test1'],
            $this->testFields['test2'],
            $this->testFields['test3'],
        ]);

        $subject->removeField('test4');
    }

    public function testPopField()
    {
        $subject = new FieldManager([
            $this->testFields['test1'],
            $this->testFields['test2'],
        ]);

        $this->assertSame($this->testFields['test2'], $subject->popField());
        $this->assertEquals(1, $subject->getCount());
    }

    public function testPopAndPushField()
    {
        $subject = new FieldManager([
            $this->testFields['test1'],
        ]);

        $field = $subject->popField();
        $subject->pushField($field);

        $this->assertSame([
            $this->testFields['test1'],
        ], $subject->getFields());
        $this->assertEquals(1, $subject->getCount());
    }


    /**
     * @expectedException OutOfRangeException
     */
    public function testPopFieldOnEmptyManter()
    {
        $subject = new FieldManager();

        $subject->popField();
    }

    public function testReplaceField()
    {
        $subject = new FieldManager([
            $this->testFields['test1'],
            $this->testFields['test2'],
            $this->testFields['test3'],
        ]);

        $subject->replaceField('test2', $this->testFields['test4']);
        $this->assertEquals(3, $subject->getCount());
        $this->assertSame([
            $this->testFields['test1'],
            $this->testFields['test4'],
            $this->testFields['test3'],
        ], $subject->getFields());
    }

    public function testReplaceFieldWithMultipleFields()
    {
        $subject = new FieldManager([
            $this->testFields['test1'],
            $this->testFields['test3']
        ]);

        $subject->replaceField('test1', [
            $this->testFields['test2'],
            $this->testFields['test4'],
        ]);

        $this->assertEquals(3, $subject->getCount());
        $this->assertSame([
            $this->testFields['test2'],
            $this->testFields['test4'],
            $this->testFields['test3'],
        ], $subject->getFields());
    }

    public function testFieldNameExists()
    {
        $subject = new FieldManager([
            $this->testFields['test1'],
            $this->testFields['test2'],
            $this->testFields['test3'],
        ]);

        $this->assertTrue($subject->fieldNameExists('test2'));
        $this->assertFalse($subject->fieldNameExists('test4'));
    }

    public function testGetField()
    {
        $subject = new FieldManager([
            $this->testFields['test1'],
            $this->testFields['test2'],
            $this->testFields['test3'],
        ]);

        $this->assertSame($this->testFields['test3'], $subject->getField('test3'));
    }

    public function testModifyField()
    {
        $subject = new FieldManager([
            $this->testFields['test1'],
        ]);

        $subject->modifyField('test1', ['label' => 'new label']);

        $this->assertSame([
            'key' => 'field_test1',
            'name' => 'test1',
            'label' => 'new label',
            'type' => 'text',
        ], $subject->getField('test1'));
    }

    /**
     * @expectedException StoutLogic\AcfBuilder\FieldNameCollisionException
     */
    public function testValidateFieldName()
    {
        $subject = new FieldManager([
            $this->testFields['test1'],
            $this->testFields['test2'],
            $this->testFields['test3'],
        ]);

        $subject->pushField($this->testFields['test1']);
    }
}

<?php

require(dirname(__FILE__) . '/../autoload.php');

use StoutLogic\AcfBuilder\FieldsBuilder;
$builder = new FieldsBuilder('banner');
$builder
    ->addRepeater('slides')
        ->addText('title')
        ->addTextarea('content')
    ->setLocation('post_type', '==', 'page');

print_r($builder->build());

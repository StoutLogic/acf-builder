# ACF Builder

Create configuration arrays for [Advanced Custom Fields Pro](https://www.advancedcustomfields.com/pro/) using the builder pattern and a fluent API.

Quickly create, register, and reuse ACF configurations, and keep them in your source code repository. To read more about registering ACF fields via php consult https://www.advancedcustomfields.com/resources/register-fields-via-php/

[![Latest Stable Version](https://poser.pugx.org/stoutlogic/acf-builder/v/stable)](https://packagist.org/packages/stoutlogic/acf-builder)
[![Build Status](https://api.travis-ci.org/StoutLogic/acf-builder.svg?branch=master)](https://travis-ci.org/StoutLogic/acf-builder)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/StoutLogic/acf-builder/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/StoutLogic/acf-builder/?branch=master)
[![Join the chat at https://gitter.im/StoutLogic/acf-builder](https://badges.gitter.im/StoutLogic/acf-builder.svg)](https://gitter.im/StoutLogic/acf-builder?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

### Simple Example
```php
$banner = new StoutLogic\AcfBuilder\FieldsBuilder('banner');
$banner
    ->addText('title')
    ->addWysiwyg('content')
    ->addImage('background_image')
    ->setLocation('post_type', '==', 'page')
        ->or('post_type', '==', 'post');

add_action('acf/init', function() use ($banner) {
   acf_add_local_field_group($banner->build());
});
```

`$banner->build();` will return:
```php
[
    'key' => 'group_banner',
    'title' => 'Banner',
    'fields' => [
        [
            'key' => 'field_title',
            'name' => 'title',
            'label' => 'Title',
            'type' => 'text'
        ],
        [
            'key' => 'field_content',
            'name' => 'content',
            'label' => 'Content',
            'type' => 'wysiwyg'
        ],
        [
            'key' => 'field_background_image',
            'name' => 'background_image',
            'label' => 'Background Image',
            'type' => 'image'
        ],
    ],
    'location' => [
        [
            [
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'page'
            ]
        ],
        [
            [
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'post'
            ]
        ]
    ]
]
```

As you can see it saves you a lot of typing and is less error-prone. But brevity and correctness isn't the only benefit, you can reuse field configurations in multiple places. For example, a group of fields used for backgrounds:

### Reuse Example

```php

use StoutLogic\AcfBuilder\FieldsBuilder;

$background = new FieldsBuilder('background');
$background
    ->addTab('Background')
    ->addImage('background_image')
    ->addTrueFalse('fixed')
        ->instructions("Check to add a parallax effect where the background image doesn't move when scrolling")
    ->addColorPicker('background_color');

$banner = new FieldsBuilder('banner');
$banner
    ->addTab('Content')
    ->addText('title')
    ->addWysiwyg('content')
    ->addFields($background)
    ->setLocation('post_type', '==', 'page');

$section = new FieldsBuilder('section');
$section
    ->addTab('Content')
    ->addText('section_title')
    ->addRepeater('columns', ['min' => 1, 'layout' => 'block'])
        ->addTab('Content')
        ->addText('title')
        ->addWysiwyg('content')
        ->addFields($background)
        ->endRepeater()
    ->addFields($background)
    ->setLocation('post_type', '==', 'page');
```

Here a `background` field group is created, and then used in two other field groups, including twice in the `section` field group. This can really DRY up your code and keep your admin UI consistent. If you wanted to add a light/dark field for the text color field based on the background used, it would just need to be added in one spot and used everywhere.

## Install
Use composer to install:
```
composer require stoutlogic/acf-builder
```

If your project isn't using composer, you can require the `autoload.php` file.

## Tests
To run the tests you can manually run
```
vendor/bin/phpunit
```
or you can use the built in gulp task to run it on file change
```
npm install
gulp
```

## Requirements
PHP 5.4 and later are supported.

## Documentation
See the [wiki](https://github.com/StoutLogic/acf-builder/wiki) for more thorough documentation. The documentation has its [own repository](https://github.com/StoutLogic/acf-builder-wiki) and accepts pull requests for contributions. Any merges to master will get synced with the wiki here under the main project.

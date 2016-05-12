# ACF Builder
Create configuartion arrays for [Advanced Custom Fields Pro](https://www.advancedcustomfields.com/pro/) using the builder pattern and a fluent API.

Quickly create, register, and reuse ACF configurations, and keep them in your source code repository. To read more about registering ACF fields via php consult https://www.advancedcustomfields.com/resources/register-fields-via-php/

### Simple Example
```php
$banner = new StoutLogic\AcfBuilder\FieldsBuilder('banner');
$banner
    ->addText('title')
    ->addWysiwyg('content')
    ->addImage('background_image')
    ->setLocation('post_type', '==', 'page')
        ->or('post_type', '==', 'post');
       
add_action('acf/init', function() {
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
        'operatore' => '==',
        'value' => 'page'
      ]
    ],
    [
      [
        'param' => 'post_type',
        'operatore' => '==',
        'value' => 'post'
      ]
    ]
  ]
]
```

As you can see it saves you a lot of typing and is less error-prone. But brevity and correctness isn't the only benefit, you can reuse field configurations in multiple places. For example, a group of fields used for backgrounds.

```php

use StoutLogic\AcfBuilder\FieldBuilder;

$background = new FieldBuilder('background');
$background
    ->addTab('Background')
    ->addImage('background_image')
    ->addTrueFalse('fixed')
    ->addColorPicker('background_color');
           
$banner = new FieldBuilder('banner');
$banner
    ->addTab('Content')
    ->addText('title')
    ->addWysiwyg('content')
    ->addFields($background);
           
$section = new FieldBuilder('section');
$section
    ->addTab('Content')
    ->addText('section_title')
    ->addRepeater('columns', ['min' => 1])
        ->addTab('Content')
        ->addText('title')
        ->addWysiwyg('content')
        ->addFields($background)
        ->endRepeater()
    ->addFields($background);
```

Here a `background` field group is created, and then used in two other field groups, including twice in the `section` field group. This can really DRY up your code. If you wanted to add a light/dark field for the text color field based on the background used, it would just need to be added in one spot and used everywhere.

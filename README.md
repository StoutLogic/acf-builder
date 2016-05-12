# ACF Builder
Create configuartion arrays for [Advanced Custom Fields Pro](https://www.advancedcustomfields.com/pro/) using the builder pattern and a fluent API.

Quickly create, register, and reuse ACF configurations, and keep them in your source code repository. To read more about registering ACF fields via php consult https://www.advancedcustomfields.com/resources/register-fields-via-php/

### Simple Example
```php
$banner = new StoutLogic\AcfBuilder\FieldsBuilder('banner');
$banner->addText('title')
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

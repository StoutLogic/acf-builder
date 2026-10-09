<?php

namespace StoutLogic\AcfBuilder;

use StoutLogic\AcfBuilder\Exceptions\FieldNameCollisionException;
use StoutLogic\AcfBuilder\Exceptions\FieldNotFoundException;
use StoutLogic\AcfBuilder\Exceptions\ModifyFieldReturnTypeException;

/**
 * Builds configurations for ACF Field Groups
 *
 * @api
 */
class FieldsBuilder extends ParentDelegationBuilder implements NamedBuilder
{
    /**
     * Field Group Configuration
     *
     * @var array
     */
    protected $config = [];

    /**
     * Manages the Field Configurations
     *
     * @var FieldManager
     */
    protected $fieldManager;

    /**
     * Location configuration for Field Group
     *
     * @var LocationBuilder
     */
    protected $location;

    const DEEP_NESTING_DELIMITER = '->';

    /**
     * Create a field-group builder.
     *
     * @param string $name Field Group name.
     * @param array  $groupConfig Field Group configuration.
     * @api
     */
    public function __construct(
        /**
         * Field Group Name
         */
        protected $name,
        array $groupConfig = []
    ) {
        $this->fieldManager = new FieldManager();
        $this->setGroupConfig('key', $this->name);
        $this->setGroupConfig('title', $this->generateLabel($this->name));

        $this->config = array_merge($this->config, $groupConfig);
    }

    /**
     * Update multiple field group configuration values.
     *
     * @param array $config Group configuration values.
     * @return $this
     * @api
     */
    public function updateGroupConfig($config)
    {
        $this->config = array_merge($this->config, $config);
        return $this;
    }

    /**
     * Set a value for a particular key in the group config
     *
     * @param string $key
     * @param mixed  $value
     * @return $this
     * @api
     */
    public function setGroupConfig($key, $value)
    {
        $this->config[$key] = $value;

        return $this;
    }

    /**
     * Get a value for a particular key in the group config.
     *
     * Returns null if the key isn't defined in the config.
     *
     * @param string $key
     * @return mixed|null
     * @api
     */
    public function getGroupConfig($key)
    {
        if (array_key_exists($key, $this->config)) {
            return $this->config[$key];
        }

        return null;
    }

    /**
     * Get the name of the field group.
     *
     * @return string
     * @api
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Namespace a group key
     * Append the namespace 'group' before the set key.
     *
     * @param  string $key Field Key.
     * @return string      Field Key
     */
    private function namespaceGroupKey($key)
    {
        if (!str_starts_with($key, 'group_')) {
            $key = 'group_' . $key;
        }
        return $key;
    }

    /**
     * Build the final config array. Build any other builders that may exist
     * in the config.
     *
     * @return array Final field config
     * @example
     *
     * ```php
     * $config = $fields->build();
     * ```
     * @api
     */
    public function build()
    {
        return array_merge($this->config, [
            'fields' => $this->buildFields(),
            'location' => $this->buildLocation(),
            'key' => $this->namespaceGroupKey($this->config['key']),
        ]);
    }

    /**
     * Return a fields config array
     *
     * @return array
     */
    private function buildFields()
    {
        $fields = array_map(fn($field) => ($field instanceof Builder) ? $field->build() : $field, $this->getFields());

        return $this->transformFields($fields);
    }

    /**
     * Apply field transforms
     *
     * @param  array $fields
     * @return array Transformed fields config
     */
    private function transformFields($fields)
    {
        $conditionalTransform = new Transform\ConditionalLogic($this);
        $namespaceFieldKeyTransform = new Transform\NamespaceFieldKey($this);

        return $namespaceFieldKeyTransform->transform(
            $conditionalTransform->transform($fields)
        );
    }

    /**
     * Return a locations config array
     *
     * @return array|LocationBuilder
     */
    private function buildLocation()
    {
        $location = $this->getLocation();
        return ($location instanceof Builder) ? $location->build() : $location;
    }

    /**
     * Add multiple fields either via an array or from another builder
     *
     * @param FieldsBuilder|array $fields
     * @return $this
     * @example
     *
     * ```php
     *
     * $backgroundSettings = new FieldsBuilder('background_settings');
     *
     * $backgroundSettings
     *  ->addColorPicker('background_color')
     *  ->addColorPicker('text_color');
     *
     * // reuse the existing background settings
     * $fields->addFields($backgroundSettings);
     * ```
     * @api
     */
    public function addFields($fields)
    {
        if ($fields instanceof FieldsBuilder) {
            $builder = clone $fields;
            $fields = $builder->getFields();
        }

        foreach ($fields as $field) {
            $this->getFieldManager()->pushField($field);
        }

        return $this;
    }

    /**
     * Add a field of a specific type
     *
     * You can use this to add custom field types that are not predefined.
     *
     * @param string $name
     * @param string $type
     * @param array  $args field configuration.
     * @throws FieldNameCollisionException If name already exists.
     * @return FieldBuilder
     *
     * @example
     * ```php
     * $fields->addField('rating', 'star_rating');
     * ```
     * @api
     */
    public function addField($name, $type, array $args = [])
    {
        return $this->initializeField(new FieldBuilder($name, $type, $args));
    }

    /**
     * Add a field of a choice type, allows choices to be added.
     *
     * @param string $name
     * @param string $type  can be `select`, `radio`, `checkbox`.
     * @param array  $args field configuration.
     * @throws FieldNameCollisionException If name already exists.
     * @return FieldBuilder
     * @example
     *
     * ```php
     * $fields->addChoiceField('color', 'select', ['choices' => ['red', 'green', 'blue']]);
     * ```
     * @api
     */
    public function addChoiceField($name, $type, array $args = [])
    {
        return $this->initializeField(new ChoiceFieldBuilder($name, $type, $args));
    }

    /**
     * Initialize the FieldBuilder, add to FieldManager
     *
     * @param  FieldBuilder $field
     * @return FieldBuilder
     */
    protected function initializeField($field)
    {
        $field->setParentContext($this);
        $this->getFieldManager()->pushField($field);
        return $field;
    }

    /**
     * Add a text field.
     *
     * @param string $name
     * @param array  $args {
     *      Field configuration options.
     *
     *     @type string $default_value Default value of the field.
     *     @type int|string $maxlength Maximum number of characters allowed.
     *     @type string $placeholder Placeholder text.
     *     @type string $prepend Text displayed before the input.
     *     @type string $append Text displayed after the input.
     * }
     * @throws FieldNameCollisionException If name already exists.
     * @return FieldBuilder
     * @example
     *
     * ```php
     * $fields->addText('title', [
     *     'default_value'             => '',
     *     'placeholder'               => 'Enter a title',
     *     'maxlength'                 => 80,
     *     'prepend'                   => '',
     *     'append'                    => '',
     * ]);
     * ```
     * @api
     */
    public function addText($name, array $args = [])
    {
        return $this->addField($name, 'text', $args);
    }

    /**
     * Add a textarea field.
     *
     * @param string $name
     * @param array  $args {
     *      Field configuration options.
     *
     *     @type string $default_value Default value of the field.
     *     @type string $new_lines How new lines are rendered: `wpautop`, `br`, or empty for none.
     *     @type int|string $maxlength Maximum number of characters allowed.
     *     @type string $placeholder Placeholder text.
     *     @type int|string $rows Number of textarea rows.
     * }
     * @throws FieldNameCollisionException If name already exists.
     * @return FieldBuilder
     * @example
     *
     * ```php
     * $fields->addTextarea('summary', [
     *     'default_value'             => '',
     *     'rows'                      => 4,
     *     'maxlength'                 => 500,
     *     'placeholder'               => 'Write a summary',
     *     'new_lines'                 => 'wpautop',
     * ]);
     * ```
     * @api
     */
    public function addTextarea($name, array $args = [])
    {
        return $this->addField($name, 'textarea', $args);
    }

    /**
     * Add a number field.
     *
     * @param string $name
     * @param array  $args {
     *      Field configuration options.
     *
     *     @type int|string $default_value Default value of the field.
     *     @type int|string $min Minimum allowed value.
     *     @type int|string $max Maximum allowed value.
     *     @type int|string $step Increment step size.
     *     @type string $placeholder Placeholder text.
     *     @type string $prepend Text displayed before the input.
     *     @type string $append Text displayed after the input.
     * }
     * @throws FieldNameCollisionException If name already exists.
     * @return FieldBuilder
     * @example
     *
     * ```php
     * $fields->addNumber('price', [
     *     'default_value'             => 0,
     *     'prepend'                   => '$',
     *     'min'                       => 0,
     *     'max'                       => 100000,
     *     'step'                      => 0.01,
     * ]);
     * ```
     * @api
     */
    public function addNumber($name, array $args = [])
    {
        return $this->addField($name, 'number', $args);
    }

    /**
     * Add an email field.
     *
     * @param string $name
     * @param array  $args {
     *      Field configuration options.
     *
     *     @type string $default_value Default value of the field.
     *     @type string $placeholder Placeholder text.
     *     @type string $prepend Text displayed before the input.
     *     @type string $append Text displayed after the input.
     * }
     * @throws FieldNameCollisionException If name already exists.
     * @return FieldBuilder
     * @example
     *
     * ```php
     * $fields->addEmail('email', [
     *     'default_value'             => '',
     *     'placeholder'               => 'name@example.com',
     *     'prepend'                   => '',
     *     'append'                    => '',
     *     'required'                  => 1,
     * ]);
     * ```
     * @api
     */
    public function addEmail($name, array $args = [])
    {
        return $this->addField($name, 'email', $args);
    }

    /**
     * Add a URL field.
     *
     * @param string $name
     * @param array  $args {
     *      Field configuration options.
     *
     *     @type string $default_value Default value of the field.
     *     @type string $placeholder Placeholder text.
     * }
     * @throws FieldNameCollisionException If name already exists.
     * @return FieldBuilder
     * @example
     *
     * ```php
     * $fields->addUrl('website', [
     *     'default_value'             => '',
     *     'placeholder'               => 'https://example.com',
     * ]);
     * ```
     * @api
     */
    public function addUrl($name, array $args = [])
    {
        return $this->addField($name, 'url', $args);
    }

    /**
     * Add a password field.
     *
     * @param string $name
     * @param array  $args {
     *      Field configuration options.
     *
     *     @type string $placeholder Placeholder text.
     *     @type string $prepend Text displayed before the input.
     *     @type string $append Text displayed after the input.
     * }
     * @throws FieldNameCollisionException If name already exists.
     * @return FieldBuilder
     * @example
     *
     * ```php
     * $fields->addPassword('password', [
     *     'placeholder'               => 'Enter a password',
     *     'prepend'                   => '',
     *     'append'                    => '',
     * ]);
     * ```
     * @api
     */
    public function addPassword($name, array $args = [])
    {
        return $this->addField($name, 'password', $args);
    }

    /**
     * Add a WYSIWYG field.
     *
     * @param string $name
     * @param array  $args {
     *      Field configuration options.
     *
     *     @type string $default_value Default value of the field.
     *     @type string $tabs Which tabs to display: `visual`, `text`, or `all`.
     *     @type string $toolbar Toolbar to display: `full` or `basic`.
     *     @type int|bool $media_upload Whether to allow the media upload button.
     *     @type int $delay Delay initialization of the editor for performance.
     * }
     * @throws FieldNameCollisionException If name already exists.
     * @return FieldBuilder
     * @example
     *
     * ```php
     * $fields->addWysiwyg('content', [
     *     'default_value'             => '',
     *     'tabs'                      => 'all',
     *     'toolbar'                   => 'basic',
     *     'media_upload'              => 0,
     *     'delay'                     => 0,
     * ]);
     * ```
     * @api
     */
    public function addWysiwyg($name, array $args = [])
    {
        return $this->addField($name, 'wysiwyg', $args);
    }

    /**
     * Add an oEmbed field.
     *
     * @param string $name
     * @param array  $args {
     *      Field configuration options.
     *
     *     @type int|string $width Embed width.
     *     @type int|string $height Embed height.
     * }
     * @throws FieldNameCollisionException If name already exists.
     * @return FieldBuilder
     * @example
     *
     * ```php
     * $fields->addOembed('video', ['width' => 800, 'height' => 450]);
     * ```
     * @api
     */
    public function addOembed($name, array $args = [])
    {
        return $this->addField($name, 'oembed', $args);
    }

    /**
     * Add an image field.
     *
     * @param string $name
     * @param array  $args {
     *      Field configuration options.
     *
     *     @type string $return_format Format of the returned value: `array`, `url`, or `id`.
     *     @type string $preview_size Size of the image shown in the admin.
     *     @type string $library Restrict media library to `all` or `uploadedTo`.
     *     @type int $min_width Minimum image width in pixels.
     *     @type int $min_height Minimum image height in pixels.
     *     @type int $min_size Minimum file size in megabytes.
     *     @type int $max_width Maximum image width in pixels.
     *     @type int $max_height Maximum image height in pixels.
     *     @type int $max_size Maximum file size in megabytes.
     *     @type string $mime_types Comma separated list of allowed file types.
     * }
     * @throws FieldNameCollisionException If name already exists.
     * @return FieldBuilder
     * @example
     *
     * ```php
     * $fields->addImage('image', [
     *     'return_format'             => 'array',
     *     'preview_size'              => 'medium',
     *     'library'                   => 'all',
     *     'min_width'                 => 0,
     *     'min_height'                => 0,
     *     'min_size'                  => 0,
     *     'max_width'                 => 0,
     *     'max_height'                => 0,
     *     'max_size'                  => 0,
     *     'mime_types'                => '',
     * ]);
     * ```
     * @api
     */
    public function addImage($name, array $args = [])
    {
        return $this->addField($name, 'image', $args);
    }

    /**
     * Add a file field.
     *
     * @param string $name
     * @param array  $args {
     *      Field configuration options.
     *
     *     @type string $return_format Format of the returned value: `array`, `url`, or `id`.
     *     @type string $library Restrict media library to `all` or `uploadedTo`.
     *     @type int $min_size Minimum file size in megabytes.
     *     @type int $max_size Maximum file size in megabytes.
     *     @type string $mime_types Comma separated list of allowed file types.
     * }
     * @throws FieldNameCollisionException If name already exists.
     * @return FieldBuilder
     * @example
     *
     * ```php
     * $fields->addFile('download', [
     *     'return_format'             => 'array',
     *     'library'                   => 'all',
     *     'min_size'                  => 0,
     *     'max_size'                  => 0,
     *     'mime_types'                => 'pdf,doc,docx',
     * ]);
     * ```
     * @api
     */
    public function addFile($name, array $args = [])
    {
        return $this->addField($name, 'file', $args);
    }

    /**
     * Add a gallery field.
     *
     * @param string $name
     * @param array  $args {
     *      Field configuration options.
     *
     *     @type string $return_format Format of the returned value: `array`, `url`, or `id`.
     *     @type string $preview_size Size of the images shown in the admin.
     *     @type string $insert Where new attachments are added: `append` or `prepend`.
     *     @type string $library Restrict media library to `all` or `uploadedTo`.
     *     @type int $min Minimum number of attachments.
     *     @type int $max Maximum number of attachments.
     *     @type int $min_width Minimum image width in pixels.
     *     @type int $min_height Minimum image height in pixels.
     *     @type int $min_size Minimum file size in megabytes.
     *     @type int $max_width Maximum image width in pixels.
     *     @type int $max_height Maximum image height in pixels.
     *     @type int $max_size Maximum file size in megabytes.
     *     @type string $mime_types Comma separated list of allowed file types.
     * }
     * @throws FieldNameCollisionException If name already exists.
     * @return FieldBuilder
     * @example
     *
     * ```php
     * $fields->addGallery('gallery', [
     *     'return_format'             => 'array',
     *     'library'                   => 'all',
     *     'min'                       => 1,
     *     'max'                       => 10,
     *     'min_width'                 => 0,
     *     'min_height'                => 0,
     *     'min_size'                  => 0,
     *     'max_width'                 => 0,
     *     'max_height'                => 0,
     *     'max_size'                  => 0,
     *     'mime_types'                => '',
     *     'insert'                    => 'append',
     *     'preview_size'              => 'medium',
     * ]);
     * ```
     * @api
     */
    public function addGallery($name, array $args = [])
    {
        return $this->addField($name, 'gallery', $args);
    }

    /**
     * Add a true/false field.
     *
     * @param string $name
     * @param array  $args {
     *      Field configuration options.
     *
     *     @type string $message Message displayed next to the toggle/checkbox.
     *     @type int|bool $default_value Default value of the field.
     *     @type int|bool $ui Whether to display a stylized switch instead of a checkbox.
     *     @type string $ui_on_text Text shown inside the switch when on.
     *     @type string $ui_off_text Text shown inside the switch when off.
     * }
     * @throws FieldNameCollisionException If name already exists.
     * @return FieldBuilder
     * @example
     *
     * ```php
     * $fields->addTrueFalse('featured', [
     *     'message'                   => 'Feature this item',
     *     'default_value'             => 0,
     *     'ui'                        => 1,
     *     'ui_on_text'                => 'Yes',
     *     'ui_off_text'               => 'No',
     * ]);
     * ```
     * @api
     */
    public function addTrueFalse($name, array $args = [])
    {
        return $this->addField($name, 'true_false', $args);
    }

    /**
     * Add a select field.
     *
     * @param string $name
     * @param array  $args {
     *      Field configuration options.
     *
     *     @type array<string, string> $choices Array of choice value => label pairs.
     *     @type string|array $default_value Default selected value(s).
     *     @type string $return_format Format of the returned value: `value` or `label`.
     *     @type int|bool $multiple Whether multiple choices can be selected.
     *     @type int|bool $allow_null Whether to allow an empty selection.
     *     @type int|bool $ui Whether to use the stylized Select2 UI.
     *     @type int|bool $ajax Whether to load choices via AJAX.
     *     @type string $placeholder Placeholder text for the Select2 UI.
     *     @type int|bool $create_options Whether users can create new choices.
     *     @type int|bool $save_options Whether newly created choices are saved to the field.
     * }
     * @throws FieldNameCollisionException If name already exists.
     * @return FieldBuilder
     * @example
     *
     * ```php
     * $fields->addSelect('color', [
     *     'choices'                   => ['red' => 'Red', 'blue' => 'Blue'],
     *     'default_value'             => [],
     *     'return_format'             => 'value',
     *     'multiple'                  => 0,
     *     'allow_null'                => 0,
     *     'ui'                        => 1,
     *     'ajax'                      => 0,
     *     'create_options'            => 0,
     *     'save_options'              => 0,
     * ]);
     * ```
     * @api
     */
    public function addSelect($name, array $args = [])
    {
        return $this->addChoiceField($name, 'select', $args);
    }

    /**
     * Add a radio field.
     *
     * @param string $name
     * @param array  $args {
     *      Field configuration options.
     *
     *     @type array<string, string> $choices Array of choice value => label pairs.
     *     @type string $default_value Default selected value.
     *     @type string $return_format Format of the returned value: `value` or `label`.
     *     @type int|bool $allow_null Whether to allow an empty selection.
     *     @type int|bool $other_choice Whether to add an "other" choice with a free text field.
     *     @type int|bool $save_other_choice Whether to save the custom "other" choice to the field's choices.
     *     @type string $layout Layout of the radio buttons: `vertical` or `horizontal`.
     * }
     * @throws FieldNameCollisionException If name already exists.
     * @return FieldBuilder
     * @example
     *
     * ```php
     * $fields->addRadio('color', [
     *     'choices'                   => ['red' => 'Red', 'blue' => 'Blue'],
     *     'default_value'             => '',
     *     'return_format'             => 'value',
     *     'allow_null'                => 0,
     *     'other_choice'              => 0,
     *     'save_other_choice'         => 0,
     *     'layout'                    => 'horizontal',
     * ]);
     * ```
     * @api
     */
    public function addRadio($name, array $args = [])
    {
        return $this->addChoiceField($name, 'radio', $args);
    }

    /**
     * Add a checkbox field.
     *
     * @param string $name
     * @param array  $args {
     *      Field configuration options.
     *
     *     @type array<string, string> $choices Array of choice value => label pairs.
     *     @type array $default_value Default selected value(s).
     *     @type string $return_format Format of the returned value: `value` or `label`.
     *     @type int|bool $allow_custom Whether users can add custom values.
     *     @type int|bool $save_custom Whether custom values are saved to the field's choices.
     *     @type string $layout Layout of the checkboxes: `vertical` or `horizontal`.
     *     @type int|bool $toggle Whether to display an "select all" toggle.
     *     @type string $custom_choice_button_text Text for the button used to add a new custom choice.
     * }
     * @throws FieldNameCollisionException If name already exists.
     * @return FieldBuilder
     * @example
     *
     * ```php
     * $fields->addCheckbox('features', [
     *     'choices'                   => ['audio', 'video'],
     *     'default_value'             => [],
     *     'return_format'             => 'value',
     *     'allow_custom'              => 0,
     *     'save_custom'               => 0,
     *     'layout'                    => 'horizontal',
     *     'toggle'                    => 0,
     * ]);
     * ```
     * @api
     */
    public function addCheckbox($name, array $args = [])
    {
        return $this->addChoiceField($name, 'checkbox', $args);
    }

    /**
     * Add a button group field.
     *
     * @param string $name
     * @param array  $args {
     *      Field configuration options.
     *
     *     @type array<string, string> $choices Array of choice value => label pairs.
     *     @type string $default_value Default selected value.
     *     @type string $return_format Format of the returned value: `value` or `label`.
     *     @type int|bool $allow_null Whether to allow an empty selection.
     *     @type string $layout Layout of the buttons: `vertical` or `horizontal`.
     * }
     * @throws FieldNameCollisionException If name already exists.
     * @return FieldBuilder
     * @example
     *
     * ```php
     * $fields->addButtonGroup('alignment', [
     *     'choices'                   => ['left' => 'Left', 'center' => 'Center'],
     *     'default_value'             => '',
     *     'return_format'             => 'value',
     *     'allow_null'                => 0,
     *     'layout'                    => 'horizontal',
     * ]);
     * ```
     * @api
     */
    public function addButtonGroup($name, array $args = [])
    {
        return $this->addChoiceField($name, 'button_group', $args);
    }

    /**
     * Add a post object field.
     *
     * @param string $name
     * @param array  $args {
     *      Field configuration options.
     *
     *     @type array $post_type Post types selectable by this field. Defaults to all if empty.
     *     @type array $taxonomy Restrict choices to posts belonging to these taxonomy terms.
     *     @type int|bool $allow_null Whether to allow an empty selection.
     *     @type int|bool $multiple Whether multiple posts can be selected.
     *     @type string $return_format Format of the returned value: `object` or `id`.
     *     @type int|bool $ui Whether to use the stylized Select2 UI.
     *     @type array $bidirectional_target Field(s) to update on the related post.
     * }
     * @throws FieldNameCollisionException If name already exists.
     * @return FieldBuilder
     * @example
     *
     * ```php
     * $fields->addPostObject('related_post', [
     *     'post_type'                 => ['post'],
     *     'post_status'               => ['publish'],
     *     'taxonomy'                  => [],
     *     'return_format'             => 'object',
     *     'multiple'                  => 0,
     *     'allow_null'                => 0,
     * ]);
     * ```
     * @api
     */
    public function addPostObject($name, array $args = [])
    {
        return $this->addField($name, 'post_object', $args);
    }

    /**
     * Add a page link field.
     *
     * @param string $name
     * @param array  $args {
     *      Field configuration options.
     *
     *     @type array $post_type Post types selectable by this field. Defaults to all if empty.
     *     @type array $taxonomy Restrict choices to posts belonging to these taxonomy terms.
     *     @type int|bool $allow_null Whether to allow an empty selection.
     *     @type int|bool $multiple Whether multiple pages can be selected.
     *     @type int|bool $allow_archives Whether post type archive URLs are selectable.
     * }
     * @throws FieldNameCollisionException If name already exists.
     * @return FieldBuilder
     * @example
     *
     * ```php
     * $fields->addPageLink('related_page', [
     *     'post_type'                 => ['page'],
     *     'post_status'               => ['publish'],
     *     'taxonomy'                  => [],
     *     'allow_archives'            => 1,
     *     'multiple'                  => 0,
     *     'allow_null'                => 0,
     * ]);
     * ```
     * @api
     */
    public function addPageLink($name, array $args = [])
    {
        return $this->addField($name, 'page_link', $args);
    }

    /**
     * Add a relationship field.
     *
     * @param string $name
     * @param array  $args {
     *      Field configuration options.
     *
     *     @type array $post_type Post types selectable by this field. Defaults to all if empty.
     *     @type array $taxonomy Restrict choices to posts belonging to these taxonomy terms.
     *     @type array $filters Filter tools shown above the list: `search`, `post_type`, `taxonomy`.
     *     @type array $elements Extra UI elements to show, e.g. `featured_image`.
     *     @type string $return_format Format of the returned value: `object` or `id`.
     *     @type int $min Minimum number of posts required.
     *     @type int $max Maximum number of posts allowed.
     *     @type array $bidirectional_target Field(s) to update on the related post.
     * }
     * @throws FieldNameCollisionException If name already exists.
     * @return FieldBuilder
     * @example
     *
     * ```php
     * $fields->addRelationship('related_content', [
     *     'post_type'                 => ['post'],
     *     'post_status'               => ['publish'],
     *     'taxonomy'                  => [],
     *     'filters'                   => ['search', 'post_type'],
     *     'return_format'             => 'object',
     *     'min'                       => 0,
     *     'max'                       => 0,
     *     'elements'                  => ['featured_image'],
     * ]);
     * ```
     * @api
     */
    public function addRelationship($name, array $args = [])
    {
        return $this->addField($name, 'relationship', $args);
    }

    /**
     * Add a taxonomy field.
     *
     * @param string $name
     * @param array  $args {
     *      Field configuration options.
     *
     *     @type string $taxonomy Taxonomy to display terms from.
     *     @type int|bool $add_term Whether to allow new terms to be added.
     *     @type int|bool $save_terms Whether to connect selected terms to the post.
     *     @type int|bool $load_terms Whether to load field value from the post's terms.
     *     @type string $field_type Input type: `checkbox`, `multi_select`, `radio`, or `select`.
     *     @type string $return_format Format of the returned value: `object` or `id`.
     *     @type int|bool $multiple Whether multiple terms can be selected.
     *     @type int|bool $allow_null Whether to allow an empty selection.
     *     @type array $bidirectional_target Field(s) to update on the related term.
     * }
     * @throws FieldNameCollisionException If name already exists.
     * @return FieldBuilder
     * @example
     *
     * ```php
     * $fields->addTaxonomy('topics', [
     *     'taxonomy'                  => 'category',
     *     'add_term'                  => 1,
     *     'save_terms'                => 0,
     *     'load_terms'                => 0,
     *     'field_type'                => 'checkbox',
     *     'return_format'             => 'id',
     *     'allow_null'                => 0,
     * ]);
     * ```
     * @api
     */
    public function addTaxonomy($name, array $args = [])
    {
        return $this->addField($name, 'taxonomy', $args);
    }

    /**
     * Add a user field.
     *
     * @param string $name
     * @param array  $args {
     *      Field configuration options.
     *
     *     @type string|array $role Restrict choices to users with these roles. Defaults to all if empty.
     *     @type string $return_format Format of the returned value: `array`, `object`, or `id`.
     *     @type int|bool $multiple Whether multiple users can be selected.
     *     @type int|bool $allow_null Whether to allow an empty selection.
     *     @type array $bidirectional_target Field(s) to update on the related user.
     * }
     * @throws FieldNameCollisionException If name already exists.
     * @return FieldBuilder
     * @example
     *
     * ```php
     * $fields->addUser('editor', [
     *     'role'                      => ['editor'],
     *     'return_format'             => 'array',
     *     'multiple'                  => 0,
     *     'allow_null'                => 0,
     * ]);
     * ```
     * @api
     */
    public function addUser($name, array $args = [])
    {
        return $this->addField($name, 'user', $args);
    }

    /**
     * Add a date picker field.
     *
     * @param string $name
     * @param array  $args {
     *      Field configuration options.
     *
     *     @type string $display_format Format used to display the date in the admin, e.g. `d/m/Y`.
     *     @type string $save_format Format the date is saved as in the database.
     *     @type string $return_format Format of the returned value.
     *     @type int $first_day First day of the week in the date picker, 0 (Sunday) to 6 (Saturday).
     *     @type int|bool $default_to_current_date Whether to default to the current date.
     * }
     * @throws FieldNameCollisionException If name already exists.
     * @return FieldBuilder
     * @example
     *
     * ```php
     * $fields->addDatePicker('published_on', [
     *     'display_format'            => 'd/m/Y',
     *     'save_format'               => 'Y-m-d',
     *     'return_format'             => 'Y-m-d',
     *     'first_day'                 => 1,
     *     'default_to_current_date'   => 0,
     * ]);
     * ```
     * @api
     */
    public function addDatePicker($name, array $args = [])
    {
        return $this->addField($name, 'date_picker', $args);
    }

    /**
     * Add a time picker field.
     *
     * @param string $name
     * @param array  $args {
     *      Field configuration options.
     *
     *     @type string $display_format Format used to display the time in the admin, e.g. `g:i a`.
     *     @type string $return_format Format of the returned value.
     * }
     * @throws FieldNameCollisionException If name already exists.
     * @return FieldBuilder
     * @example
     *
     * ```php
     * $fields->addTimePicker('published_at', [
     *     'display_format'            => 'g:i a',
     *     'return_format'             => 'H:i:s',
     * ]);
     * ```
     * @api
     */
    public function addTimePicker($name, array $args = [])
    {
        return $this->addField($name, 'time_picker', $args);
    }

    /**
     * Add a date-time picker field.
     *
     * @param string $name
     * @param array  $args {
     *      Field configuration options.
     *
     *     @type string $display_format Format used to display the date and time in the admin, e.g. `d/m/Y g:i a`.
     *     @type string $return_format Format of the returned value.
     *     @type int $first_day First day of the week in the date picker, 0 (Sunday) to 6 (Saturday).
     *     @type int|bool $default_to_current_date Whether to default to the current date and time.
     * }
     * @throws FieldNameCollisionException If name already exists.
     * @return FieldBuilder
     * @example
     *
     * ```php
     * $fields->addDateTimePicker('published', [
     *     'display_format'            => 'd/m/Y g:i a',
     *     'return_format'             => 'Y-m-d H:i:s',
     *     'first_day'                 => 1,
     *     'default_to_current_date'   => 0,
     * ]);
     * ```
     * @api
     */
    public function addDateTimePicker($name, array $args = [])
    {
        return $this->addField($name, 'date_time_picker', $args);
    }

    /**
     * Add a color picker field.
     *
     * @param string $name
     * @param array  $args {
     *      Field configuration options.
     *
     *     @type string $default_value Default value of the field, e.g. `#2271b1`.
     *     @type bool $enable_opacity Whether to allow the alpha/opacity channel.
     *     @type string $return_format Format of the returned value: `string` or `array`.
     *     @type bool $show_custom_palette Whether to only display the custom `palette_colors`.
     *     @type string $custom_palette_source Where custom palette colors are sourced from.
     *     @type string|array $palette_colors Colors available in the custom palette.
     *     @type bool $show_color_wheel Whether to display the color wheel/picker.
     * }
     * @throws FieldNameCollisionException If name already exists.
     * @return FieldBuilder
     * @example
     *
     * ```php
     * $fields->addColorPicker('brand_color', ['default_value' => '#2271b1']);
     *
     * Additional color picker settings include `enable_opacity`, `return_format`,
     * `show_custom_palette`, `custom_palette_source`, `palette_colors`, and
     * `show_color_wheel`.
     * ```
     * @api
     */
    public function addColorPicker($name, array $args = [])
    {
        return $this->addField($name, 'color_picker', $args);
    }

    /**
     * Add a Google Map field.
     *
     * @param string $name
     * @param array  $args {
     *      Field configuration options.
     *
     *     @type string $center_lat Default center latitude.
     *     @type string $center_lng Default center longitude.
     *     @type int|string $zoom Default zoom level.
     *     @type int|string $height Height of the map in pixels.
     * }
     * @throws FieldNameCollisionException If name already exists.
     * @return FieldBuilder
     * @example
     *
     * ```php
     * $fields->addGoogleMap('office_location', [
     *     'center_lat'                => '',
     *     'center_lng'                => '',
     *     'zoom'                      => 14,
     *     'height'                    => 400,
     * ]);
     * ```
     * @api
     */
    public function addGoogleMap($name, array $args = [])
    {
        return $this->addField($name, 'google_map', $args);
    }

    /**
     * Add a link field.
     *
     * @param string $name
     * @param array  $args {
     *      Field configuration options.
     *
     *     @type string $return_format Format of the returned value: `array` or `url`.
     * }
     * @throws FieldNameCollisionException If name already exists.
     * @return FieldBuilder
     * @example
     *
     * ```php
     * $fields->addLink('cta_link', ['return_format' => 'array']);
     * ```
     * @api
     */
    public function addLink($name, array $args = [])
    {
        return $this->addField($name, 'link', $args);
    }

    /**
     * Add a range field.
     *
     * @param string $name
     * @param array  $args {
     *      Field configuration options.
     *
     *     @type int|string $default_value Default value of the field.
     *     @type int|string $min Minimum allowed value.
     *     @type int|string $max Maximum allowed value.
     *     @type int|string $step Increment step size.
     *     @type string $prepend Text displayed before the input.
     *     @type string $append Text displayed after the input.
     * }
     * @throws FieldNameCollisionException If name already exists.
     * @return FieldBuilder
     * @example
     *
     * ```php
     * $fields->addRange('opacity', ['min' => 0, 'max' => 100, 'step' => 1]);
     *
     * The range field also supports `default_value`, `prepend`, and `append`.
     * ```
     * @api
     */
    public function addRange($name, array $args = [])
    {
        return $this->addField($name, 'range', $args);
    }

    /**
     * Add a tab field.
     *
     * All fields added after will appear under this tab, until another tab
     * is added.
     *
     * @param string $label Tab label.
     * @param array  $args {
     *      Field configuration options.
     *
     *     @type string $placement Where the tabs are displayed: `top` or `left`.
     *     @type int|bool $endpoint Whether this tab ends the current tab group.
     * }
     * @throws FieldNameCollisionException If name already exists.
     * @return FieldBuilder
     * @example
     *
     * ```php
     * $fields->addTab('Content', ['placement' => 'left']);
     *
     * Set `endpoint` to `1` to end the current tab group.
     * ```
     * @api
     */
    public function addTab($label, array $args = [])
    {
        return $this->initializeField(new TabBuilder($label, 'tab', $args));
    }

    /**
     * Add an accordion field.
     *
     * All fields added after will appear under this accordion, until
     * another accordion is added.
     *
     * @param string $label Accordion label.
     * @param array  $args {
     *      Field configuration options.
     *
     *     @type int|bool $open Whether the accordion is open by default.
     *     @type int|bool $multi_expand Whether multiple accordions can be open at once.
     *     @type int|bool $endpoint Whether this accordion ends the current accordion group.
     * }
     * @throws FieldNameCollisionException If name already exists.
     * @return AccordionBuilder
     * @example
     *
     * ```php
     * $fields->addAccordion('Advanced', ['open' => 1, 'multi_expand' => 1]);
     *
     * The accordion also supports the `endpoint` setting.
     * ```
     * @api
     */
    public function addAccordion($label, array $args = [])
    {
        return $this->initializeField(new AccordionBuilder($label, 'accordion', $args));
    }

    /**
     * Add a message field with the supplied content.
     *
     * @param string $label
     * @param string $message
     * @param array  $args {
     *      Field configuration options.
     *
     *     @type int|bool $esc_html Whether to escape HTML in the message.
     *     @type string $new_lines How new lines are rendered: `wpautop`, `br`, or empty for none.
     * }
     * @throws FieldNameCollisionException If name already exists.
     * @return FieldBuilder
     * @example
     *
     * ```php
     * $fields->addMessage('Notice', 'Remember to save your changes.', [
     *     'new_lines'                 => 'wpautop',
     *     'esc_html'                  => 0,
     * ]);
     * ```
     * @api
     */
    public function addMessage($label, $message, array $args = [])
    {
        $name = $this->generateName($label) . '_message';
        $args = array_merge([
            'label' => $label,
            'message' => $message,
        ], $args);

        return $this->addField($name, 'message', $args);
    }

    /**
     * Add a group field.
     *
     * @param string $name
     * @param array  $args {
     *      Field configuration options.
     *
     *     @type array $sub_fields Sub fields belonging to the group.
     *     @type string $layout Layout of the group: `block`, `table`, or `row`.
     * }
     * @throws FieldNameCollisionException If name already exists.
     * @return GroupBuilder
     * @example
     *
     * ```php
     * $fields->addGroup('author')->addText('name')->endGroup();
     *
     * A group can use the `layout` option with the values supported by ACF.
     * ```
     * @api
     */
    public function addGroup($name, array $args = [])
    {
        return $this->initializeField(new GroupBuilder($name, 'group', $args));
    }

    /**
     * Add a repeater field. Any fields added after will be added to the repeater
     * until `endRepeater` is called.
     *
     * @param string $name
     * @param array  $args {
     *      Field configuration options.
     *
     *     @type array $sub_fields Sub fields belonging to the repeater.
     *     @type int $min Minimum number of rows required.
     *     @type int $max Maximum number of rows allowed.
     *     @type int $rows_per_page Number of rows displayed per page when paginated.
     *     @type string $layout Layout of the rows: `table`, `block`, or `row`.
     *     @type string $button_label Text for the button used to add a new row.
     *     @type string $collapsed Sub field key used as the label when a row is collapsed.
     * }
     * @throws FieldNameCollisionException If name already exists.
     * @return RepeaterBuilder
     * @example
     *
     * ```php
     * $fields->addRepeater('slides', [
     *     'layout'                    => 'block',
     *     'pagination'                => 0,
     *     'rows_per_page'             => 20,
     *     'min'                       => 1,
     *     'max'                       => 7,
     *     'button_label'              => 'Add Slide',
     *     'collapsed'                 => '',
     * ]);
     * ```
     * @api
     */
    public function addRepeater($name, array $args = [])
    {
        return $this->initializeField(new RepeaterBuilder($name, 'repeater', $args));
    }

    /**
     * Add a flexible content field. Once adding a layout with `addLayout`,
     * any fields added after will be added to that layout until another
     * `addLayout` call is made, or until `endFlexibleContent` is called.
     *
     * @param string $name
     * @param array  $args {
     *      Field configuration options.
     *
     *     @type array $layouts Layouts available to this field.
     *     @type int|string $min Minimum number of layouts required.
     *     @type int|string $max Maximum number of layouts allowed.
     *     @type string $button_label Text for the button used to add a new layout.
     * }
     * @throws FieldNameCollisionException If name already exists.
     * @return FlexibleContentBuilder
     * @example
     *
     * ```php
     * $fields->addFlexibleContent('sections', [
     *     'min'                       => 0,
     *     'max'                       => 0,
     *     'button_label'              => 'Add Section',
     * ]);
     * ```
     * @api
     */
    public function addFlexibleContent($name, array $args = [])
    {
        return $this->initializeField(new FlexibleContentBuilder($name, 'flexible_content', $args));
    }

    /**
     * Return the manager responsible for this builder's fields.
     *
     * @return FieldManager
     */
    protected function getFieldManager()
    {
        return $this->fieldManager;
    }

    /**
     * Determine whether a field exists in this builder.
     *
     * @param string $name Field name.
     * @return bool
     * @api
     */
    public function fieldExists($name)
    {
        return $this->getFieldManager()->fieldNameExists($name);
    }

    /**
     * Return all fields currently registered with this builder.
     *
     * @return FieldBuilder[]
     * @api
     */
    public function getFields()
    {
        return $this->getFieldManager()->getFields();
    }

    /**
     * Return the number of fields currently registered with this builder.
     *
     * @return int field count
     */
    public function getCount()
    {
        return $this->getFieldManager()->getCount();
    }

    /**
     * Return a field by name.
     *
     * @param string $name Field name.
     * @return FieldBuilder
     * @throws FieldNotFoundException If the field name doesn't exist.
     * @api
     */
    public function getField($name)
    {
        return $this->getFieldManager()->getField($name);
    }

    /**
     * Modify an already defined field.
     *
     * @param  string         $name   Name of the field.
     * @param  array|\Closure $modify Array of field configs or a closure that accepts
     * a FieldsBuilder and returns a FieldsBuilder.
     * @throws ModifyFieldReturnTypeException If $modify is a closure and doesn't
     * return a FieldsBuilder.
     * @return $this
     * @example
     *
     * ```php
     * $fields->modifyField('title', ['label' => 'Headline']);
     * ```
     * @api
     */
    public function modifyField($name, $modify)
    {
        if ($this->hasDeeplyNestedField($name)) {
            $fieldNames = explode(self::DEEP_NESTING_DELIMITER, $name, 2);
            $this->getField($fieldNames[0])->modifyField($fieldNames[1], $modify);

            return $this;
        }

        if (is_array($modify)) {
            $this->getFieldManager()->modifyField($name, $modify);
            return $this;
        } elseif ($modify instanceof \Closure) {
            $field = $this->getField($name);

            // Initialize Modifying FieldsBuilder.
            $modifyBuilder = new FieldsBuilder('');
            $modifyBuilder->addFields([$field]);

            /**
             * The FieldsBuilder returned by the modifying closure.
             *
             * @var FieldsBuilder
             */
            $modifyBuilder = $modify($modifyBuilder);

            // Check if a FieldsBuilder is returned.
            if (!$modifyBuilder instanceof FieldsBuilder) {
                throw new ModifyFieldReturnTypeException(gettype($modifyBuilder));
            }

            // Insert field(s).
            $this->getFieldManager()->replaceField($name, $modifyBuilder->getFields());
        }

        return $this;
    }

    /**
     * Remove a field by name
     *
     * @param  string $name Field to remove.
     * @return $this
     * @example
     *
     * ```php
     * $fields->removeField('title');
     * ```
     * @api
     */
    public function removeField($name)
    {
        if ($this->hasDeeplyNestedField($name)) {
            $fieldNames = explode(self::DEEP_NESTING_DELIMITER, $name, 2);
            $this->getField($fieldNames[0])->removeField($fieldNames[1]);
            return $this;
        }

        $this->getFieldManager()->removeField($name);

        return $this;
    }

    /**
     * Determine whether a field name refers to a deeply nested field.
     *
     * @param string $name Deeply nested field name.
     * @return bool
     */
    private function hasDeeplyNestedField($name)
    {
        return str_contains($name, static::DEEP_NESTING_DELIMITER);
    }

    /**
     * Set the location of the field group.
     *
     * @param string $param
     * @param string $operator
     * @param string $value
     * @return LocationBuilder
     * @see https://github.com/StoutLogic/acf-builder/wiki/location
     * @see https://www.advancedcustomfields.com/resources/custom-location-rules/
     * @example
     *
     * ```php
     * $fields->setLocation('post_type', '==', 'page');
     * ```
     * @api
     */
    public function setLocation($param, $operator, $value)
    {
        if ($this->getParentContext()) {
            return $this->getParentContext()->setLocation($param, $operator, $value);
        }

        $this->location = new LocationBuilder($param, $operator, $value);
        $this->location->setParentContext($this);

        return $this->location;
    }

    /**
     * Return the configured field-group location builder.
     *
     * @return LocationBuilder|null
     * @api
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Create a field label based on the field's name. Generates title case.
     *
     * @param  string $name
     * @return string label
     */
    protected function generateLabel($name)
    {
        return ucwords(str_replace('_', ' ', $name));
    }

    /**
     * Generates a snaked cased name.
     *
     * @param  string $name
     * @return string
     */
    protected function generateName($name)
    {
        return strtolower(str_replace(' ', '_', $name));
    }


    /**
     * Clone the builder and its field manager.
     *
     * @return void
     * @api
     */
    public function __clone()
    {
        $this->fieldManager = clone $this->fieldManager;
    }
}

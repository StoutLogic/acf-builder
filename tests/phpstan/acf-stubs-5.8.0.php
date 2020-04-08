<?php

/**
*  acf_has_upgrade
*
*  Returns true if this site has an upgrade avaialble.
*
*  @date	24/8/18
*  @since	5.7.4
*
*  @param	void
*  @return	bool
*/
function acf_has_upgrade()
{
}
/**
*  acf_upgrade_all
*
*  Returns true if this site has an upgrade avaialble.
*
*  @date	24/8/18
*  @since	5.7.4
*
*  @param	void
*  @return	bool
*/
function acf_upgrade_all()
{
}
/**
*  acf_get_db_version
*
*  Returns the ACF DB version.
*
*  @date	10/09/2016
*  @since	5.4.0
*
*  @param	void
*  @return	string
*/
function acf_get_db_version()
{
}
/*
*  acf_update_db_version
*
*  Updates the ACF DB version.
*
*  @date	10/09/2016
*  @since	5.4.0
*
*  @param	string $version The new version.
*  @return	void
*/
function acf_update_db_version($version = '')
{
}
/**
*  acf_upgrade_500
*
*  Version 5 introduces new post types for field groups and fields.
*
*  @date	23/8/18
*  @since	5.7.4
*
*  @param	void
*  @return	void
*/
function acf_upgrade_500()
{
}
/**
*  acf_upgrade_500_field_groups
*
*  Upgrades all ACF4 field groups to ACF5
*
*  @date	23/8/18
*  @since	5.7.4
*
*  @param	void
*  @return	void
*/
function acf_upgrade_500_field_groups()
{
}
/**
*  acf_upgrade_500_field_group
*
*  Upgrades a ACF4 field group to ACF5
*
*  @date	23/8/18
*  @since	5.7.4
*
*  @param	object $ofg	The old field group post object.
*  @return	array $nfg	The new field group array.
*/
function acf_upgrade_500_field_group($ofg)
{
}
/**
*  acf_upgrade_500_fields
*
*  Upgrades all ACF4 fields to ACF5 from a specific field group 
*
*  @date	23/8/18
*  @since	5.7.4
*
*  @param	object $ofg	The old field group post object.
*  @param	array $nfg	The new field group array.
*  @return	void
*/
function acf_upgrade_500_fields($ofg, $nfg)
{
}
/**
*  acf_upgrade_500_field
*
*  Upgrades a ACF4 field to ACF5
*
*  @date	23/8/18
*  @since	5.7.4
*
*  @param	array $field The old field.
*  @return	array $field The new field.
*/
function acf_upgrade_500_field($field)
{
}
/**
*  acf_upgrade_550
*
*  Version 5.5 adds support for the wp_termmeta table added in WP 4.4.
*
*  @date	23/8/18
*  @since	5.7.4
*
*  @param	void
*  @return	void
*/
function acf_upgrade_550()
{
}
/**
*  acf_upgrade_550_termmeta
*
*  Upgrades all ACF4 termmeta saved in wp_options to the wp_termmeta table.
*
*  @date	23/8/18
*  @since	5.7.4
*
*  @param	void
*  @return	void
*/
function acf_upgrade_550_termmeta()
{
}
/*
*  acf_wp_upgrade_550_termmeta
*
*  When the database is updated to support term meta, migrate ACF term meta data across.
*
*  @date	23/8/18
*  @since	5.7.4
*
*  @param	string $wp_db_version The new $wp_db_version.
*  @param	string $wp_current_db_version The old (current) $wp_db_version.
*  @return	void
*/
function acf_wp_upgrade_550_termmeta($wp_db_version, $wp_current_db_version)
{
}
/**
*  acf_upgrade_550_taxonomy
*
*  Upgrades all ACF4 termmeta for a specific taxonomy.
*
*  @date	24/8/18
*  @since	5.7.4
*
*  @param	string $taxonomy The taxonomy name.
*  @return	void
*/
function acf_upgrade_550_taxonomy($taxonomy)
{
}
/**
 * acf_add_filter_variations
 *
 * Registers variations for the given filter.
 *
 * @date	26/1/19
 * @since	5.7.11
 *
 * @param	string $filter The filter name.
 * @param	array $variations An array variation keys.
 * @param	int $index The param index to find variation values.
 * @return	void
 */
function acf_add_filter_variations($filter = '', $variations = array(), $index = 0)
{
}
/**
 * acf_add_action_variations
 *
 * Registers variations for the given action.
 *
 * @date	26/1/19
 * @since	5.7.11
 *
 * @param	string $action The action name.
 * @param	array $variations An array variation keys.
 * @param	int $index The param index to find variation values.
 * @return	void
 */
function acf_add_action_variations($action = '', $variations = array(), $index = 0)
{
}
/**
 * _acf_apply_hook_variations
 *
 * Applys hook variations during apply_filters() or do_action().
 *
 * @date	25/1/19
 * @since	5.7.11
 *
 * @param	mixed
 * @return	mixed
 */
function _acf_apply_hook_variations()
{
}
/**
 * acf_add_deprecated_filter
 *
 * Registers a deprecated filter to run during the replacement.
 *
 * @date	25/1/19
 * @since	5.7.11
 *
 * @param	string $deprecated The deprecated hook.
 * @param	string $version The version this hook was deprecated.
 * @param	string $replacement The replacement hook.
 * @return	void
 */
function acf_add_deprecated_filter($deprecated, $version, $replacement)
{
}
/**
 * acf_add_deprecated_action
 *
 * Registers a deprecated action to run during the replacement.
 *
 * @date	25/1/19
 * @since	5.7.11
 *
 * @param	string $deprecated The deprecated hook.
 * @param	string $version The version this hook was deprecated.
 * @param	string $replacement The replacement hook.
 * @return	void
 */
function acf_add_deprecated_action($deprecated, $version, $replacement)
{
}
/**
 * _acf_apply_deprecated_hook
 *
 * Applys a deprecated filter during apply_filters() or do_action().
 *
 * @date	25/1/19
 * @since	5.7.11
 *
 * @param	mixed
 * @return	mixed
 */
function _acf_apply_deprecated_hook()
{
}
// class_exists check
/*
*  acf_add_loop
*
*  alias of acf()->loop->add_loop()
*
*  @type	function
*  @date	6/10/13
*  @since	5.0.0
*
*  @param	void
*  @return	void
*/
function acf_add_loop($loop = array())
{
}
/*
*  acf_update_loop
*
*  alias of acf()->loop->update_loop()
*
*  @type	function
*  @date	6/10/13
*  @since	5.0.0
*
*  @param	void
*  @return	void
*/
function acf_update_loop($i = 'active', $key = \null, $value = \null)
{
}
/*
*  acf_get_loop
*
*  alias of acf()->loop->get_loop()
*
*  @type	function
*  @date	6/10/13
*  @since	5.0.0
*
*  @param	void
*  @return	void
*/
function acf_get_loop($i = 'active', $key = \null)
{
}
/*
*  acf_remove_loop
*
*  alias of acf()->loop->remove_loop()
*
*  @type	function
*  @date	6/10/13
*  @since	5.0.0
*
*  @param	void
*  @return	void
*/
function acf_remove_loop($i = 'active')
{
}
/**
 * acf_new_instance
 *
 * Creates a new instance of the given class and stores it in the instances data store.
 *
 * @date	9/1/19
 * @since	5.7.10
 *
 * @param	string $class The class name.
 * @return	object The instance.
 */
function acf_new_instance($class = '')
{
}
/**
 * acf_get_instance
 *
 * Returns an instance for the given class.
 *
 * @date	9/1/19
 * @since	5.7.10
 *
 * @param	string $class The class name.
 * @return	object The instance.
 */
function acf_get_instance($class = '')
{
}
/**
 * acf_register_store
 *
 * Registers a data store.
 *
 * @date	9/1/19
 * @since	5.7.10
 *
 * @param	string $name The store name.
 * @param	array $data Array of data to start the store with.
 * @return	ACF_Data
 */
function acf_register_store($name = '', $data = \false)
{
}
/**
 * acf_get_store
 *
 * Returns a data store.
 *
 * @date	9/1/19
 * @since	5.7.10
 *
 * @param	string $name The store name.
 * @return	ACF_Data
 */
function acf_get_store($name = '')
{
}
/**
 * acf_switch_stores
 *
 * Triggered when switching between sites on a multisite installation.
 *
 * @date	13/2/19
 * @since	5.7.11
 *
 * @param	int $site_id New blog ID.
 * @param	int prev_blog_id Prev blog ID.
 * @return	void
 */
function acf_switch_stores($site_id, $prev_site_id)
{
}
// class_exists check
/*
*  Public functions
*
*  alias of acf()->validation->function()
*
*  @type	function
*  @date	6/10/13
*  @since	5.0.0
*
*  @param	void
*  @return	void
*/
function acf_add_validation_error($input, $message = '')
{
}
function acf_get_validation_errors()
{
}
function acf_get_validation_error()
{
}
function acf_reset_validation_errors()
{
}
/*
*  acf_validate_save_post
*
*  This function will validate $_POST data and add errors
*
*  @type	function
*  @date	25/11/2013
*  @since	5.0.0
*
*  @param	boolean $show_errors if true, errors will be shown via a wp_die screen
*  @return	boolean
*/
function acf_validate_save_post($show_errors = \false)
{
}
/*
*  acf_validate_values
*
*  This function will validate an array of field values
*
*  @type	function
*  @date	6/10/13
*  @since	5.0.0
*
*  @param	values (array)
*  @param	string $input_prefix
*  @return	void
*/
function acf_validate_values($values, $input_prefix = '')
{
}
/*
*  acf_validate_value
*
*  This function will validate a field's value
*
*  @type	function
*  @date	6/10/13
*  @since	5.0.0
*
*  @param	void
*  @return	void
*/
function acf_validate_value($value, $field, $input)
{
}
/**
 * acf_get_field_group
 *
 * Retrieves a field group for the given identifier.
 *
 * @date	30/09/13
 * @since	5.0.0
 *
 * @param	int|string $id The field group ID, key or name.
 * @return	array|false The field group array.
 */
function acf_get_field_group($id = 0)
{
}
/**
 * acf_get_raw_field_group
 *
 * Retrieves raw field group data for the given identifier.
 *
 * @date	18/1/19
 * @since	5.7.10
 *
 * @param	int|string $id The field ID, key or name.
 * @return	array|false The field group array.
 */
function acf_get_raw_field_group($id = 0)
{
}
/**
 * acf_get_field_group_post
 *
 * Retrieves the field group's WP_Post object.
 *
 * @date	18/1/19
 * @since	5.7.10
 *
 * @param	int|string $id The field group's ID, key or name.
 * @return	array|false The field group's array.
 */
function acf_get_field_group_post($id = 0)
{
}
/**
 * acf_is_field_group_key
 *
 * Returns true if the given identifier is a field group key.
 *
 * @date	6/12/2013
 * @since	5.0.0
 *
 * @param	string $id The identifier.
 * @return	bool
 */
function acf_is_field_group_key($id = '')
{
}
/**
 * acf_validate_field_group
 *
 * Ensures the given field group is valid.
 *
 * @date	18/1/19
 * @since	5.7.10
 *
 * @param	array $field The field group array.
 * @return	array
 */
function acf_validate_field_group($field_group = array())
{
}
/**
 * acf_get_valid_field_group
 *
 * Ensures the given field group is valid.
 *
 * @date		28/09/13
 * @since		5.0.0
 *
 * @param	array $field_group The field group array.
 * @return	array
 */
function acf_get_valid_field_group($field_group = \false)
{
}
/**
 * acf_translate_field_group
 *
 * Translates a field group's settings.
 *
 * @date	8/03/2016
 * @since	5.3.2
 *
 * @param	array $field_group The field group array.
 * @return	array
 */
function acf_translate_field_group($field_group = array())
{
}
/**
 * acf_get_field_groups
 *
 * Returns and array of field_groups for the given $filter.
 *
 * @date	30/09/13
 * @since	5.0.0
 *
 * @param	array $filter An array of args to filter results by.
 * @return	array
 */
function acf_get_field_groups($filter = array())
{
}
/**
 * acf_get_raw_field_groups
 *
 * Returns and array of raw field_group data.
 *
 * @date	18/1/19
 * @since	5.7.10
 *
 * @param	void
 * @return	array
 */
function acf_get_raw_field_groups()
{
}
/**
 * acf_filter_field_groups
 *
 * Returns a filtered aray of field groups based on the given $args.
 *
 * @date	29/11/2013
 * @since	5.0.0
 *
 * @param	array $field_groups An array of field groups.
 * @param	array $args An array of location args.
 * @return	array
 */
function acf_filter_field_groups($field_groups, $args = array())
{
}
/**
 * acf_get_field_group_visibility
 *
 * Returns true if the given field group's location rules match the given $args.
 *
 * @date	7/10/13
 * @since	5.0.0
 *
 * @param	array $field_groups An array of field groups.
 * @param	array $args An array of location args.
 * @return	bool
 */
function acf_get_field_group_visibility($field_group, $args = array())
{
}
/**
 * acf_update_field_group
 *
 * Updates a field group in the database.
 *
 * @date	21/1/19
 * @since	5.7.10
 *
 * @param	array $field_group The field group array.
 * @return	array
 */
function acf_update_field_group($field_group)
{
}
/**
 * _acf_apply_unique_field_group_slug
 *
 * Allows full control over 'acf-field-group' slugs.
 *
 * @date	21/1/19
 * @since	5.7.10
 *
 * @param string $slug          The post slug.
 * @param int    $post_ID       Post ID.
 * @param string $post_status   The post status.
 * @param string $post_type     Post type.
 * @param int    $post_parent   Post parent ID
 * @param string $original_slug The original post slug.
 */
function _acf_apply_unique_field_group_slug($slug, $post_ID, $post_status, $post_type, $post_parent, $original_slug)
{
}
/**
 * acf_flush_field_group_cache
 *
 * Deletes all caches for this field group.
 *
 * @date	22/1/19
 * @since	5.7.10
 *
 * @param	array $field_group The field group array.
 * @return	void
 */
function acf_flush_field_group_cache($field_group)
{
}
/**
 * acf_delete_field_group
 *
 * Deletes a field group from the database.
 *
 * @date	21/1/19
 * @since	5.7.10
 *
 * @param	int|string $id The field group ID, key or name.
 * @return	bool True if field group was deleted.
 */
function acf_delete_field_group($id = 0)
{
}
/**
 * acf_trash_field_group
 *
 * Trashes a field group from the database.
 *
 * @date	2/10/13
 * @since	5.0.0
 *
 * @param	int|string $id The field group ID, key or name.
 * @return	bool True if field group was trashed.
 */
function acf_trash_field_group($id = 0)
{
}
/**
 * acf_untrash_field_group
 *
 * Restores a field_group from the trash.
 *
 * @date	2/10/13
 * @since	5.0.0
 *
 * @param	int|string $id The field_group ID, key or name.
 * @return	bool True if field_group was trashed.
 */
function acf_untrash_field_group($id = 0)
{
}
/**
 * acf_is_field_group
 *
 * Returns true if the given params match a field group.
 *
 * @date	21/1/19
 * @since	5.7.10
 *
 * @param	array $field_group The field group array.
 * @param	mixed $id An optional identifier to search for.
 * @return	bool
 */
function acf_is_field_group($field_group = \false)
{
}
/**
 * acf_duplicate_field_group
 *
 * Duplicates a field group.
 *
 * @date	16/06/2014
 * @since	5.0.0
 *
 * @param	int|string $id The field_group ID, key or name.
 * @param	int $new_post_id Optional post ID to override.
 * @return	array The new field group.
 */
function acf_duplicate_field_group($id = 0, $new_post_id = 0)
{
}
/**
 * acf_get_field_group_style
 *
 * Returns the CSS styles generated from field group settings.
 *
 * @date	20/10/13
 * @since	5.0.0
 *
 * @param	array $field_group The field group array.
 * @return	string.
 */
function acf_get_field_group_style($field_group)
{
}
/**
 * acf_get_field_group_edit_link
 *
 * Checks if the current user can edit the field group and returns the edit url.
 *
 * @date	23/9/18
 * @since	5.7.7
 *
 * @param	int $post_id The field group ID.
 * @return	string
 */
function acf_get_field_group_edit_link($post_id)
{
}
/**
 * acf_prepare_field_group_for_export
 *
 * Returns a modified field group ready for export.
 *
 * @date	11/03/2014
 * @since	5.0.0
 *
 * @param	array $field_group The field group array.
 * @return	array
 */
function acf_prepare_field_group_for_export($field_group = array())
{
}
/**
 * acf_import_field_group
 *
 * Imports a field group into the databse.
 *
 * @date	11/03/2014
 * @since	5.0.0
 *
 * @param	array $field_group The field group array.
 * @return	array The new field group.
 */
function acf_import_field_group($field_group)
{
}
/**
 * acf_decode_post_id
 *
 * Returns an array containing the object type and id for the given post_id string.
 *
 * @date	25/1/19
 * @since	5.7.11
 *
 * @param	int|string $post_id The post id.
 * @return	array()
 */
function acf_decode_post_id($post_id = 0)
{
}
/**
 * acf_get_meta
 *
 * Returns an array of "ACF only" meta for the given post_id.
 *
 * @date	9/10/18
 * @since	5.8.0
 *
 * @param	mixed $post_id The post_id for this data.
 * @return	array
 */
function acf_get_meta($post_id = 0)
{
}
/**
 * acf_get_option_meta
 *
 * Returns an array of meta for the given wp_option name prefix in the same format as get_post_meta().
 *
 * @date	9/10/18
 * @since	5.8.0
 *
 * @param	string $prefix The wp_option name prefix.
 * @return	array
 */
function acf_get_option_meta($prefix = '')
{
}
/**
 * acf_get_metadata
 *
 * Retrieves specific metadata from the database.
 *
 * @date	16/10/2015
 * @since	5.2.3
 *
 * @param	int|string $post_id The post id.
 * @param	string $name The meta name.
 * @param	bool $hidden If the meta is hidden (starts with an underscore).
 * @return	mixed
 */
function acf_get_metadata($post_id = 0, $name = '', $hidden = \false)
{
}
/**
 * acf_update_metadata
 *
 * Updates metadata in the database.
 *
 * @date	16/10/2015
 * @since	5.2.3
 *
 * @param	int|string $post_id The post id.
 * @param	string $name The meta name.
 * @param	mixed $value The meta value.
 * @param	bool $hidden If the meta is hidden (starts with an underscore).
 * @return	int|bool Meta ID if the key didn't exist, true on successful update, false on failure.
 */
function acf_update_metadata($post_id = 0, $name = '', $value = '', $hidden = \false)
{
}
/**
 * acf_delete_metadata
 *
 * Deletes metadata from the database.
 *
 * @date	16/10/2015
 * @since	5.2.3
 *
 * @param	int|string $post_id The post id.
 * @param	string $name The meta name.
 * @param	bool $hidden If the meta is hidden (starts with an underscore).
 * @return	bool
 */
function acf_delete_metadata($post_id = 0, $name = '', $hidden = \false)
{
}
/**
 * acf_copy_postmeta
 *
 * Copies meta from one post to another. Useful for saving and restoring revisions.
 *
 * @date	25/06/2016
 * @since	5.3.8
 *
 * @param	int|string $from_post_id The post id to copy from.
 * @param	int|string $to_post_id The post id to paste to.
 * @return	void
 */
function acf_copy_metadata($from_post_id = 0, $to_post_id = 0)
{
}
/**
 * acf_copy_postmeta
 *
 * Copies meta from one post to another. Useful for saving and restoring revisions.
 *
 * @date	25/06/2016
 * @since	5.3.8
 * @deprecated 5.7.11
 *
 * @param	int $from_post_id The post id to copy from.
 * @param	int $to_post_id The post id to paste to.
 * @return	void
 */
function acf_copy_postmeta($from_post_id = 0, $to_post_id = 0)
{
}
/**
 * acf_get_meta_field
 *
 * Returns a field using the provided $id and $post_id parameters.
 * Looks for a reference to help loading the correct field via name.
 *
 * @date	21/1/19
 * @since	5.7.10
 *
 * @param	string $key The meta name (field name).
 * @param	int|string $post_id The post_id where this field's value is saved.
 * @return	array|false The field array.
 */
function acf_get_meta_field($key = 0, $post_id = 0)
{
}
/**
 * acf_get_metaref
 *
 * Retrieves reference metadata from the database.
 *
 * @date	16/10/2015
 * @since	5.2.3
 *
 * @param	int|string $post_id The post id.
 * @param	string type The reference type (fields|groups).
 * @param	string $name An optional specific name
 * @return	mixed
 */
function acf_get_metaref($post_id = 0, $type = 'fields', $name = '')
{
}
/**
 * acf_update_metaref
 *
 * Updates reference metadata in the database.
 *
 * @date	16/10/2015
 * @since	5.2.3
 *
 * @param	int|string $post_id The post id.
 * @param	string type The reference type (fields|groups).
 * @param	array $references An array of references.
 * @return	int|bool Meta ID if the key didn't exist, true on successful update, false on failure.
 */
function acf_update_metaref($post_id = 0, $type = 'fields', $references = array())
{
}
/**
 * acf_get_field
 *
 * Retrieves a field for the given identifier.
 *
 * @date	17/1/19
 * @since	5.7.10
 *
 * @param	int|string $id The field ID, key or name.
 * @return	array|false The field array.
 */
function acf_get_field($id = 0)
{
}
/**
 * acf_get_raw_field
 *
 * Retrieves raw field data for the given identifier.
 *
 * @date	18/1/19
 * @since	5.7.10
 *
 * @param	int|string $id The field ID, key or name.
 * @return	array|false The field array.
 */
function acf_get_raw_field($id = 0)
{
}
/**
 * acf_get_field_post
 *
 * Retrieves the field's WP_Post object.
 *
 * @date	18/1/19
 * @since	5.7.10
 *
 * @param	int|string $id The field ID, key or name.
 * @return	array|false The field array.
 */
function acf_get_field_post($id = 0)
{
}
/**
 * acf_is_field_key
 *
 * Returns true if the given identifier is a field key.
 *
 * @date	6/12/2013
 * @since	5.0.0
 *
 * @param	string $id The identifier.
 * @return	bool
 */
function acf_is_field_key($id = '')
{
}
/**
 * acf_validate_field
 *
 * Ensures the given field valid.
 *
 * @date	18/1/19
 * @since	5.7.10
 *
 * @param	array $field The field array.
 * @return	array
 */
function acf_validate_field($field = array())
{
}
/**
 * acf_get_valid_field
 *
 * Ensures the given field valid.
 *
 * @date		28/09/13
 * @since		5.0.0
 *
 * @param	array $field The field array.
 * @return	array
 */
function acf_get_valid_field($field = \false)
{
}
/**
 * acf_translate_field
 *
 * Translates a field's settings.
 *
 * @date	8/03/2016
 * @since	5.3.2
 *
 * @param	array $field The field array.
 * @return	array
 */
function acf_translate_field($field = array())
{
}
/**
 * acf_get_fields
 *
 * Returns and array of fields for the given $parent.
 *
 * @date	30/09/13
 * @since	5.0.0
 *
 * @param	int|string|array $parent The field group or field settings. Also accepts the field group ID or key.
 * @return	array
 */
function acf_get_fields($parent)
{
}
/**
 * acf_get_raw_fields
 *
 * Returns and array of raw field data for the given parent id.
 *
 * @date	18/1/19
 * @since	5.7.10
 *
 * @param	int $id The field group or field id.
 * @return	array
 */
function acf_get_raw_fields($id = 0)
{
}
/**
 * acf_get_field_count
 *
 * Return the number of fields for the given field group.
 *
 * @date	17/10/13
 * @since	5.0.0
 *
 * @param	array $parent The field group or field array.
 * @return	int
 */
function acf_get_field_count($parent)
{
}
/**
 * acf_clone_field
 *
 * Allows customization to a field when it is cloned. Used by the clone field.
 *
 * @date	8/03/2016
 * @since	5.3.2
 *
 * @param	array $field The field being cloned.
 * @param	array $clone_field The clone field.
 * @return	array
 */
function acf_clone_field($field, $clone_field)
{
}
/**
 * acf_prepare_field
 *
 * Prepare a field for input.
 *
 * @date	20/1/19
 * @since	5.7.10
 *
 * @param	array $field The field array.
 * @return	array
 */
function acf_prepare_field($field)
{
}
/**
 * acf_render_fields
 *
 * Renders an array of fields. Also loads the field's value.
 *
 * @date	8/10/13
 * @since	5.0.0
 * @since	5.6.9 Changed parameter order.
 *
 * @param	array $fields An array of fields.
 * @param	int|string $post_id The post ID to load values from.
 * @param	string $element The wrapping element type.
 * @param	string $instruction The instruction render position (label|field).
 * @return	void
 */
function acf_render_fields($fields, $post_id = 0, $el = 'div', $instruction = 'label')
{
}
/**
 * acf_render_field_wrap
 *
 * Render the wrapping element for a given field.
 *
 * @date	28/09/13
 * @since	5.0.0
 *
 * @param	array $field The field array.
 * @param	string $element The wrapping element type.
 * @param	string $instruction The instruction render position (label|field).
 * @return	void
 */
function acf_render_field_wrap($field, $element = 'div', $instruction = 'label')
{
}
/**
 * acf_render_field
 *
 * Render the input element for a given field.
 *
 * @date	21/1/19
 * @since	5.7.10
 *
 * @param	array $field The field array.
 * @return	void
 */
function acf_render_field($field)
{
}
/**
 * acf_render_field_label
 *
 * Renders the field's label.
 *
 * @date	19/9/17
 * @since	5.6.3
 *
 * @param	array $field The field array.
 * @return	void
 */
function acf_render_field_label($field)
{
}
/**
 * acf_get_field_label
 *
 * Returns the field's label with appropriate required label.
 *
 * @date	4/11/2013
 * @since	5.0.0
 *
 * @param	array $field The field array.
 * @param	string $context The output context (admin).
 * @return	void
 */
function acf_get_field_label($field, $context = '')
{
}
/**
 * acf_render_field_instructions
 *
 * Renders the field's instructions.
 *
 * @date	19/9/17
 * @since	5.6.3
 *
 * @param	array $field The field array.
 * @return	void
 */
function acf_render_field_instructions($field)
{
}
/**
 * acf_render_field_setting
 *
 * Renders a field setting used in the admin edit screen.
 *
 * @date	21/1/19
 * @since	5.7.10
 *
 * @param	array $field The field array.
 * @param	array $setting The settings field array.
 * @param	bool $global Whether this setting is a global or field type specific one.
 * @return	void
 */
function acf_render_field_setting($field, $setting, $global = \false)
{
}
/**
 * acf_update_field
 *
 * Updates a field in the database.
 *
 * @date	21/1/19
 * @since	5.7.10
 *
 * @param	array $field The field array.
 * @param	array $specific An array of specific field attributes to update.
 * @return	void
 */
function acf_update_field($field, $specific = array())
{
}
/**
 * _acf_apply_unique_field_slug
 *
 * Allows full control over 'acf-field' slugs.
 *
 * @date	21/1/19
 * @since	5.7.10
 *
 * @param string $slug          The post slug.
 * @param int    $post_ID       Post ID.
 * @param string $post_status   The post status.
 * @param string $post_type     Post type.
 * @param int    $post_parent   Post parent ID
 * @param string $original_slug The original post slug.
 */
function _acf_apply_unique_field_slug($slug, $post_ID, $post_status, $post_type, $post_parent, $original_slug)
{
}
/**
 * acf_flush_field_cache
 *
 * Deletes all caches for this field.
 *
 * @date	22/1/19
 * @since	5.7.10
 *
 * @param	array $field The field array.
 * @return	void
 */
function acf_flush_field_cache($field)
{
}
/**
 * acf_delete_field
 *
 * Deletes a field from the database.
 *
 * @date	21/1/19
 * @since	5.7.10
 *
 * @param	int|string $id The field ID, key or name.
 * @return	bool True if field was deleted.
 */
function acf_delete_field($id = 0)
{
}
/**
 * acf_trash_field
 *
 * Trashes a field from the database.
 *
 * @date	2/10/13
 * @since	5.0.0
 *
 * @param	int|string $id The field ID, key or name.
 * @return	bool True if field was trashed.
 */
function acf_trash_field($id = 0)
{
}
/**
 * acf_untrash_field
 *
 * Restores a field from the trash.
 *
 * @date	2/10/13
 * @since	5.0.0
 *
 * @param	int|string $id The field ID, key or name.
 * @return	bool True if field was trashed.
 */
function acf_untrash_field($id = 0)
{
}
/**
 * acf_prefix_fields
 *
 * Changes the prefix for an array of fields by reference.
 *
 * @date	5/9/17
 * @since	5.6.0
 *
 * @param	array $fields An array of fields.
 * @param	string $prefix The new prefix.
 * @return	void
 */
function acf_prefix_fields(&$fields, $prefix = 'acf')
{
}
/**
 * acf_get_sub_field
 *
 * Searches a field for sub fields matching the given selector. 
 *
 * @date	21/1/19
 * @since	5.7.10
 *
 * @param	int|string $id The field ID, key or name.
 * @param	array $field The parent field array.
 * @return	array|false
 */
function acf_get_sub_field($id, $field)
{
}
/**
 * acf_search_fields
 *
 * Searches an array of fields for one that matches the given identifier.
 *
 * @date	12/2/19
 * @since	5.7.11
 *
 * @param	int|string $id The field ID, key or name.
 * @param	array $haystack The array of fields.
 * @return	int|false
 */
function acf_search_fields($id, $fields)
{
}
/**
 * acf_is_field
 *
 * Returns true if the given params match a field.
 *
 * @date	21/1/19
 * @since	5.7.10
 *
 * @param	array $field The field array.
 * @param	mixed $id An optional identifier to search for.
 * @return	bool
 */
function acf_is_field($field = \false, $id = '')
{
}
/**
 * acf_get_field_ancestors
 *
 * Returns an array of ancestor field ID's or keys.
 *
 * @date	22/06/2016
 * @since	5.3.8
 *
 * @param	array $field The field array.
 * @return	array
 */
function acf_get_field_ancestors($field)
{
}
/**
 * acf_duplicate_fields
 *
 * Duplicate an array of fields.
 *
 * @date	16/06/2014
 * @since	5.0.0
 *
 * @param	array $fields An array of fields.
 * @param	int $parent_id The new parent ID.
 * @return	array
 */
function acf_duplicate_fields($fields = array(), $parent_id = 0)
{
}
/**
 * acf_duplicate_field
 *
 * Duplicates a field.
 *
 * @date	16/06/2014
 * @since	5.0.0
 *
 * @param	int|string $id The field ID, key or name.
 * @param	int $parent_id The new parent ID.
 * @return	bool True if field was duplicated.
 */
function acf_duplicate_field($id = 0, $parent_id = 0)
{
}
/**
 * acf_prepare_fields_for_export
 *
 * Returns a modified array of fields ready for export.
 *
 * @date	11/03/2014
 * @since	5.0.0
 *
 * @param	array $fields An array of fields.
 * @return	array
 */
function acf_prepare_fields_for_export($fields = array())
{
}
/**
 * acf_prepare_field_for_export
 *
 * Returns a modified field ready for export.
 *
 * @date	11/03/2014
 * @since	5.0.0
 *
 * @param	array $field The field array.
 * @return	array
 */
function acf_prepare_field_for_export($field)
{
}
/**
 * acf_prepare_field_for_import
 *
 * Returns a modified array of fields ready for import.
 *
 * @date	11/03/2014
 * @since	5.0.0
 *
 * @param	array $fields An array of fields.
 * @return	array
 */
function acf_prepare_fields_for_import($fields = array())
{
}
/**
 * acf_prepare_field_for_import
 *
 * Returns a modified field ready for import.
 * Allows parent fields to modify themselves and also return sub fields.
 *
 * @date	11/03/2014
 * @since	5.0.0
 *
 * @param	array $field The field array.
 * @return	array
 */
function acf_prepare_field_for_import($field)
{
}
/**
 * acf_uniqid
 *
 * Returns a unique numeric based id.
 *
 * @date	9/1/19
 * @since	5.7.10
 *
 * @param	string $prefix The id prefix. Defaults to 'acf'.
 * @return	string
 */
function acf_uniqid($prefix = 'acf')
{
}
/**
 * acf_merge_attributes
 *
 * Merges together two arrays but with extra functionality to append class names.
 *
 * @date	22/1/19
 * @since	5.7.10
 *
 * @param	array $array1 An array of attributes.
 * @param	array $array2 An array of attributes.
 * @return	array
 */
function acf_merge_attributes($array1, $array2)
{
}
/**
 * acf_cache_key
 *
 * Returns a filtered cache key.
 *
 * @date	25/1/19
 * @since	5.7.11
 *
 * @param	string $key The cache key.
 * @return	string
 */
function acf_cache_key($key = '')
{
}
/**
 * acf_request_args
 *
 * Returns an array of $_REQUEST values using the provided defaults.
 *
 * @date	28/2/19
 * @since	5.7.13
 *
 * @param	array $args An array of args.
 * @return	array
 */
function acf_request_args($args = array())
{
}
/**
 * acf_enable_filter
 *
 * Enables a filter with the given name.
 *
 * @date	14/7/16
 * @since	5.4.0
 *
 * @param	string name The modifer name.
 * @return	void
 */
function acf_enable_filter($name = '')
{
}
/**
 * acf_disable_filter
 *
 * Disables a filter with the given name.
 *
 * @date	14/7/16
 * @since	5.4.0
 *
 * @param	string name The modifer name.
 * @return	void
 */
function acf_disable_filter($name = '')
{
}
/**
 * acf_is_filter_enabled
 *
 * Returns the state of a filter for the given name.
 *
 * @date	14/7/16
 * @since	5.4.0
 *
 * @param	string name The modifer name.
 * @return	array
 */
function acf_is_filter_enabled($name = '')
{
}
/**
 * acf_get_filters
 *
 * Returns an array of filters in their current state.
 *
 * @date	14/7/16
 * @since	5.4.0
 *
 * @param	void
 * @return	array
 */
function acf_get_filters()
{
}
/**
 * acf_set_filters
 *
 * Sets an array of filter states.
 *
 * @date	14/7/16
 * @since	5.4.0
 *
 * @param	array $filters An Array of modifers
 * @return	array
 */
function acf_set_filters($filters = array())
{
}
/**
 * acf_disable_filters
 *
 * Disables all filters and returns the previous state.
 *
 * @date	14/7/16
 * @since	5.4.0
 *
 * @param	void
 * @return	array
 */
function acf_disable_filters()
{
}
/**
 * acf_enable_filters
 *
 * Enables all or an array of specific filters and returns the previous state.
 *
 * @date	14/7/16
 * @since	5.4.0
 *
 * @param	array $filters An Array of modifers
 * @return	array
 */
function acf_enable_filters($filters = array())
{
}
/**
 * acf_idval
 *
 * Parses the provided value for an ID.
 *
 * @date	29/3/19
 * @since	5.7.14
 *
 * @param	mixed $value A value to parse.
 * @return	int
 */
function acf_idval($value)
{
}
/**
 * acf_maybe_idval
 *
 * Checks value for potential id value.
 *
 * @date	6/4/19
 * @since	5.7.14
 *
 * @param	mixed $value A value to parse.
 * @return	mixed
 */
function acf_maybe_idval($value)
{
}
/**
 * acf_numericval
 *
 * Casts the provided value as eiter an int or float using a simple hack.
 *
 * @date	11/4/19
 * @since	5.7.14
 *
 * @param	mixed $value A value to parse.
 * @return	int|float
 */
function acf_numval($value)
{
}
/**
 * acf_render_field_wrap_label
 *
 * Renders the field's label.
 *
 * @date	19/9/17
 * @since	5.6.3
 * @deprecated 5.6.5
 *
 * @param	array $field The field array.
 * @return	void
 */
function acf_render_field_wrap_label($field)
{
}
/**
 * acf_render_field_wrap_description
 *
 * Renders the field's instructions.
 *
 * @date	19/9/17
 * @since	5.6.3
 * @deprecated 5.6.5
 *
 * @param	array $field The field array.
 * @return	void
 */
function acf_render_field_wrap_description($field)
{
}
/*
 * acf_get_fields_by_id
 *
 * Returns and array of fields for the given $parent_id.
 *
 * @date	27/02/2014
 * @since	5.0.0.
 * @deprecated	5.7.11
 *
 * @param	int $parent_id The parent ID.
 * @return	array
 */
function acf_get_fields_by_id($parent_id = 0)
{
}
/**
 * acf_update_option
 *
 * A wrapper for the WP update_option but provides logic for a 'no' autoload
 *
 * @date	4/01/2014
 * @since	5.0.0
 * @deprecated	5.7.11
 *
 * @param	string $option The option name.
 * @param	string $value The option value.
 * @param	string $autoload An optional autoload value.
 * @return	bool
 */
function acf_update_option($option = '', $value = '', $autoload = \null)
{
}
/**
 * acf_get_field_reference
 *
 * Finds the field key for a given field name and post_id.
 *
 * @date	26/1/18
 * @since	5.6.5
 * @deprecated	5.6.8
 *
 * @param	string	$field_name	The name of the field. eg 'sub_heading'
 * @param	mixed	$post_id	The post_id of which the value is saved against
 * @return	string	$reference	The field key
 */
function acf_get_field_reference($field_name, $post_id)
{
}
// class_exists check
/**
*  acf_localize_text
*
*  description
*
*  @date	13/4/18
*  @since	5.6.9
*
*  @param	type $var Description. Default.
*  @return	type Description.
*/
function acf_localize_text($text)
{
}
/**
*  acf_localize_data
*
*  description
*
*  @date	13/4/18
*  @since	5.6.9
*
*  @param	type $var Description. Default.
*  @return	type Description.
*/
function acf_localize_data($data)
{
}
/*
*  acf_enqueue_scripts
*
*  
*
*  @type	function
*  @date	6/10/13
*  @since	5.0.0
*
*  @param	void
*  @return	void
*/
function acf_enqueue_scripts($args = array())
{
}
/*
*  acf_enqueue_uploader
*
*  This function will render a WP WYSIWYG and enqueue media
*
*  @type	function
*  @date	27/10/2014
*  @since	5.0.9
*
*  @param	void
*  @return	void
*/
function acf_enqueue_uploader()
{
}
/**
 * acf_get_users
 *
 * Similar to the get_users() function but with extra functionality.
 *
 * @date	9/1/19
 * @since	5.7.10
 *
 * @param	array $args The query args.
 * @return	array
 */
function acf_get_users($args = array())
{
}
/**
 * acf_allow_unfiltered_html
 *
 * Returns true if the current user is allowed to save unfiltered HTML.
 *
 * @date	9/1/19
 * @since	5.7.10
 *
 * @param	void
 * @return	bool
 */
function acf_allow_unfiltered_html()
{
}
// class_exists check
/*
*  Functions
*
*  alias of acf()->form->functions
*
*  @type	function
*  @date	11/06/2014
*  @since	5.0.0
*
*  @param	void
*  @return	void
*/
function acf_form_head()
{
}
function acf_form($args = array())
{
}
function acf_get_form($id = '')
{
}
function acf_register_form($args)
{
}
/*
*  acf_get_taxonomies
*
*  Returns an array of taxonomy names.
*
*  @date	7/10/13
*  @since	5.0.0
*
*  @param	array $args An array of args used in the get_taxonomies() function.
*  @return	array An array of taxonomy names.
*/
function acf_get_taxonomies($args = array())
{
}
/**
*  acf_get_taxonomies_for_post_type
*
*  Returns an array of taxonomies for a given post type(s)
*
*  @date	7/9/18
*  @since	5.7.5
*
*  @param	string|array $post_types The post types to compare against.
*  @return	array
*/
function acf_get_taxonomies_for_post_type($post_types = 'post')
{
}
/*
*  acf_get_taxonomy_labels
*
*  Returns an array of taxonomies in the format "name => label" for use in a select field.
*
*  @date	3/8/18
*  @since	5.7.2
*
*  @param	array $taxonomies Optional. An array of specific taxonomies to return.
*  @return	array
*/
function acf_get_taxonomy_labels($taxonomies = array())
{
}
/**
*  acf_get_term_title
*
*  Returns the title for this term object.
*
*  @date	10/9/18
*  @since	5.0.0
*
*  @param	object $term The WP_Term object.
*  @return	string
*/
function acf_get_term_title($term)
{
}
/**
*  acf_get_grouped_terms
*
*  Returns an array of terms for the given query $args and groups by taxonomy name.
*
*  @date	2/8/18
*  @since	5.7.2
*
*  @param	array $args An array of args used in the get_terms() function.
*  @return	array
*/
function acf_get_grouped_terms($args)
{
}
/**
*  _acf_terms_clauses
*
*  Used in the 'terms_clauses' filter to order terms by taxonomy name.
*
*  @date	2/8/18
*  @since	5.7.2
*
*  @param	array $pieces     Terms query SQL clauses.
*  @param	array $taxonomies An array of taxonomies.
*  @param	array $args       An array of terms query arguments.
*  @return	array $pieces
*/
function _acf_terms_clauses($pieces, $taxonomies, $args)
{
}
/**
*  acf_get_pretty_taxonomies
*
*  Deprecated in favor of acf_get_taxonomy_labels() function.
*
*  @date		7/10/13
*  @since		5.0.0
*  @deprecated	5.7.2
*/
function acf_get_pretty_taxonomies($taxonomies = array())
{
}
/**
*  acf_get_term
*
*  Similar to get_term() but with some extra functionality.
*
*  @date	19/8/18
*  @since	5.7.3
*
*  @param	mixed $term_id The term ID or a string of "taxonomy:slug".
*  @param	string $taxonomy The taxonomyname.
*  @return	WP_Term
*/
function acf_get_term($term_id, $taxonomy = '')
{
}
/**
*  acf_encode_term
*
*  Returns a "taxonomy:slug" string for a given WP_Term.
*
*  @date	27/8/18
*  @since	5.7.4
*
*  @param	WP_Term $term The term object.
*  @return	string
*/
function acf_encode_term($term)
{
}
/**
*  acf_decode_term
*
*  Decodes a "taxonomy:slug" string into an array of taxonomy and slug.
*
*  @date	27/8/18
*  @since	5.7.4
*
*  @param	WP_Term $term The term object.
*  @return	string
*/
function acf_decode_term($string)
{
}
/**
*  acf_get_encoded_terms
*
*  Returns an array of WP_Term objects from an array of encoded strings
*
*  @date	9/9/18
*  @since	5.7.5
*
*  @param	array $values The array of encoded strings.
*  @return	array
*/
function acf_get_encoded_terms($values)
{
}
/**
*  acf_get_choices_from_terms
*
*  Returns an array of choices from the terms provided.
*
*  @date	8/9/18
*  @since	5.7.5
*
*  @param	array $values and array of WP_Terms objects or encoded strings.
*  @param	string $format The value format (term_id, slug).
*  @return	array
*/
function acf_get_choices_from_terms($terms, $format = 'term_id')
{
}
/**
*  acf_get_choices_from_grouped_terms
*
*  Returns an array of choices from the grouped terms provided.
*
*  @date	8/9/18
*  @since	5.7.5
*
*  @param	array $value A grouped array of WP_Terms objects.
*  @param	string $format The value format (term_id, slug).
*  @return	array
*/
function acf_get_choices_from_grouped_terms($value, $format = 'term_id')
{
}
/**
*  acf_get_choice_from_term
*
*  Returns an array containing the id and text for this item.
*
*  @date	10/9/18
*  @since	5.7.6
*
*  @param	object $item The item object such as WP_Post or WP_Term.
*  @param	string $format The value format (term_id, slug)
*  @return	array
*/
function acf_get_choice_from_term($term, $format = 'term_id')
{
}
/*
*  get_field()
*
*  This function will return a custom field value for a specific field name/key + post_id.
*  There is a 3rd parameter to turn on/off formating. This means that an image field will not use 
*  its 'return option' to format the value but return only what was saved in the database
*
*  @type	function
*  @since	3.6
*  @date	29/01/13
*
*  @param	string $selector the field name or key
*  @param	mixed $post_id the post_id of which the value is saved against
*  @param	boolean $format_value whether or not to format the value as described above
*  @return	mixed
*/
function get_field($selector, $post_id = \false, $format_value = \true)
{
}
/*
*  the_field()
*
*  This function is the same as echo get_field().
*
*  @type	function
*  @since	1.0.3
*  @date	29/01/13
*
*  @param	string $selector the field name or key
*  @param	mixed $post_id the post_id of which the value is saved against
*  @return	void
*/
function the_field($selector, $post_id = \false, $format_value = \true)
{
}
/*
*  get_field_object()
*
*  This function will return an array containing all the field data for a given field_name
*
*  @type	function
*  @since	3.6
*  @date	3/02/13
*
*  @param	string $selector the field name or key
*  @param	mixed $post_id the post_id of which the value is saved against
*  @param	boolean $format_value whether or not to format the field value
*  @param	boolean $load_value whether or not to load the field value
*  @return	array $field
*/
function get_field_object($selector, $post_id = \false, $format_value = \true, $load_value = \true)
{
}
/*
*  acf_get_object_field
*
*  This function will return a field for the given selector.
*  It will also review the field_reference to ensure the correct field is returned which makes it useful for the template API
*
*  @type	function
*  @date	4/08/2015
*  @since	5.2.3
*
*  @param	mixed $selector identifyer of field. Can be an ID, key, name or post object
*  @param	mixed $post_id the post_id of which the value is saved against
*  @param	boolean $strict if true, return a field only when a field key is found.
*  @return	array $field
*/
function acf_maybe_get_field($selector, $post_id = \false, $strict = \true)
{
}
/*
*  acf_maybe_get_sub_field
*
*  This function will attempt to find a sub field
*
*  @type	function
*  @date	3/10/2016
*  @since	5.4.0
*
*  @param	int $post_id
*  @return	int $post_id
*/
function acf_maybe_get_sub_field($selectors, $post_id = \false, $strict = \true)
{
}
/*
*  get_fields()
*
*  This function will return an array containing all the custom field values for a specific post_id.
*  The function is not very elegant and wastes a lot of PHP memory / SQL queries if you are not using all the values.
*
*  @type	function
*  @since	3.6
*  @date	29/01/13
*
*  @param	mixed $post_id the post_id of which the value is saved against
*  @param	boolean $format_value whether or not to format the field value
*  @return	array	associative array where field name => field value
*/
function get_fields($post_id = \false, $format_value = \true)
{
}
/*
*  get_field_objects()
*
*  This function will return an array containing all the custom field objects for a specific post_id.
*  The function is not very elegant and wastes a lot of PHP memory / SQL queries if you are not using all the fields / values.
*
*  @type	function
*  @since	3.6
*  @date	29/01/13
*
*  @param	mixed $post_id the post_id of which the value is saved against
*  @param	boolean $format_value whether or not to format the field value
*  @param	boolean $load_value whether or not to load the field value
*  @return	array	associative array where field name => field
*/
function get_field_objects($post_id = \false, $format_value = \true, $load_value = \true)
{
}
/*
*  have_rows
*
*  This function will instantiate a global variable containing the rows of a repeater or flexible content field,
*  after which, it will determine if another row exists to loop through
*
*  @type	function
*  @date	2/09/13
*  @since	4.3.0
*
*  @param	string $field_name the field name
*  @param	mixed $post_id the post_id of which the value is saved against
*  @return	boolean
*/
function have_rows($selector, $post_id = \false)
{
}
/*
*  the_row
*
*  This function will progress the global repeater or flexible content value 1 row
*
*  @type	function
*  @date	2/09/13
*  @since	4.3.0
*
*  @param	void
*  @return	array the current row data
*/
function the_row($format = \false)
{
}
function get_row($format = \false)
{
}
function get_row_index()
{
}
function the_row_index()
{
}
/*
*  get_row_sub_field
*
*  This function is used inside a 'has_sub_field' while loop to return a sub field object
*
*  @type	function
*  @date	16/05/2016
*  @since	5.3.8
*
*  @param	string $selector
*  @return	array
*/
function get_row_sub_field($selector)
{
}
/*
*  get_row_sub_value
*
*  This function is used inside a 'has_sub_field' while loop to return a sub field value
*
*  @type	function
*  @date	16/05/2016
*  @since	5.3.8
*
*  @param	string $selector
*  @return	mixed
*/
function get_row_sub_value($selector)
{
}
/*
*  reset_rows
*
*  This function will find the current loop and unset it from the global array.
*  To bo used when loop finishes or a break is used
*
*  @type	function
*  @date	26/10/13
*  @since	5.0.0
*
*  @param	boolean $hard_reset completely wipe the global variable, or just unset the active row
*  @return	boolean
*/
function reset_rows()
{
}
/*
*  has_sub_field()
*
*  This function is used inside a while loop to return either true or false (loop again or stop).
*  When using a repeater or flexible content field, it will loop through the rows until 
*  there are none left or a break is detected
*
*  @type	function
*  @since	1.0.3
*  @date	29/01/13
*
*  @param	string $field_name the field name
*  @param	mixed $post_id the post_id of which the value is saved against
*  @return	boolean
*/
function has_sub_field($field_name, $post_id = \false)
{
}
function has_sub_fields($field_name, $post_id = \false)
{
}
/*
*  get_sub_field()
*
*  This function is used inside a 'has_sub_field' while loop to return a sub field value
*
*  @type	function
*  @since	1.0.3
*  @date	29/01/13
*
*  @param	string $field_name the field name
*  @return	mixed
*/
function get_sub_field($selector = '', $format_value = \true)
{
}
/*
*  the_sub_field()
*
*  This function is the same as echo get_sub_field
*
*  @type	function
*  @since	1.0.3
*  @date	29/01/13
*
*  @param	string $field_name the field name
*  @return	void
*/
function the_sub_field($field_name, $format_value = \true)
{
}
/*
*  get_sub_field_object()
*
*  This function is used inside a 'has_sub_field' while loop to return a sub field object
*
*  @type	function
*  @since	3.5.8.1
*  @date	29/01/13
*
*  @param	string $child_name the field name
*  @return	array	
*/
function get_sub_field_object($selector, $format_value = \true, $load_value = \true)
{
}
/*
*  get_row_layout()
*
*  This function will return a string representation of the current row layout within a 'have_rows' loop
*
*  @type	function
*  @since	3.0.6
*  @date	29/01/13
*
*  @param	void
*  @return	string
*/
function get_row_layout()
{
}
/*
*  acf_shortcode()
*
*  This function is used to add basic shortcode support for the ACF plugin
*  eg. [acf field="heading" post_id="123" format_value="1"]
*
*  @type	function
*  @since	1.1.1
*  @date	29/01/13
*
*  @param	string $field the field name or key
*  @param	mixed $post_id the post_id of which the value is saved against
*  @param	boolean $format_value whether or not to format the field value
*  @return	string
*/
function acf_shortcode($atts)
{
}
/*
*  update_field()
*
*  This function will update a value in the database
*
*  @type	function
*  @since	3.1.9
*  @date	29/01/13
*
*  @param	string $selector the field name or key
*  @param	mixed $value the value to save in the database
*  @param	mixed $post_id the post_id of which the value is saved against
*  @return	boolean
*/
function update_field($selector, $value, $post_id = \false)
{
}
/*
*  update_sub_field
*
*  This function will update a value of a sub field in the database
*
*  @type	function
*  @date	2/04/2014
*  @since	5.0.0
*
*  @param	mixed $selector the sub field name or key, or an array of ancestors
*  @param	mixed $value the value to save in the database
*  @param	mixed $post_id the post_id of which the value is saved against
*  @return	boolean
*/
function update_sub_field($selector, $value, $post_id = \false)
{
}
/*
*  delete_field()
*
*  This function will remove a value from the database
*
*  @type	function
*  @since	3.1.9
*  @date	29/01/13
*
*  @param	string $selector the field name or key
*  @param	mixed $post_id the post_id of which the value is saved against
*  @return	boolean
*/
function delete_field($selector, $post_id = \false)
{
}
/*
*  delete_sub_field
*
*  This function will delete a value of a sub field in the database
*
*  @type	function
*  @date	2/04/2014
*  @since	5.0.0
*
*  @param	mixed $selector the sub field name or key, or an array of ancestors
*  @param	mixed $value the value to save in the database
*  @param	mixed $post_id the post_id of which the value is saved against
*  @return	boolean
*/
function delete_sub_field($selector, $post_id = \false)
{
}
/*
*  add_row
*
*  This function will add a row of data to a field
*
*  @type	function
*  @date	16/10/2015
*  @since	5.2.3
*
*  @param	string $selector
*  @param	array $row
*  @param	mixed $post_id
*  @return	boolean
*/
function add_row($selector, $row = \false, $post_id = \false)
{
}
/*
*  add_sub_row
*
*  This function will add a row of data to a field
*
*  @type	function
*  @date	16/10/2015
*  @since	5.2.3
*
*  @param	string $selector
*  @param	array $row
*  @param	mixed $post_id
*  @return	boolean
*/
function add_sub_row($selector, $row = \false, $post_id = \false)
{
}
/*
*  update_row
*
*  This function will update a row of data to a field
*
*  @type	function
*  @date	19/10/2015
*  @since	5.2.3
*
*  @param	string $selector
*  @param	int $i
*  @param	array $row
*  @param	mixed $post_id
*  @return	boolean
*/
function update_row($selector, $i = 1, $row = \false, $post_id = \false)
{
}
/*
*  update_sub_row
*
*  This function will add a row of data to a field
*
*  @type	function
*  @date	16/10/2015
*  @since	5.2.3
*
*  @param	string $selector
*  @param	array $row
*  @param	mixed $post_id
*  @return	boolean
*/
function update_sub_row($selector, $i = 1, $row = \false, $post_id = \false)
{
}
/*
*  delete_row
*
*  This function will delete a row of data from a field
*
*  @type	function
*  @date	19/10/2015
*  @since	5.2.3
*
*  @param	string $selector
*  @param	int $i
*  @param	mixed $post_id
*  @return	boolean
*/
function delete_row($selector, $i = 1, $post_id = \false)
{
}
/*
*  delete_sub_row
*
*  This function will add a row of data to a field
*
*  @type	function
*  @date	16/10/2015
*  @since	5.2.3
*
*  @param	string $selector
*  @param	array $row
*  @param	mixed $post_id
*  @return	boolean
*/
function delete_sub_row($selector, $i = 1, $post_id = \false)
{
}
/*
*  Depreceated Functions
*
*  These functions are outdated
*
*  @type	function
*  @date	4/03/2014
*  @since	1.0.0
*
*  @param	void
*  @return	void
*/
function create_field($field)
{
}
function render_field($field)
{
}
function reset_the_repeater_field()
{
}
function the_repeater_field($field_name, $post_id = \false)
{
}
function the_flexible_field($field_name, $post_id = \false)
{
}
function acf_filter_post_id($post_id)
{
}
/*
*  acf_is_array
*
*  This function will return true for a non empty array
*
*  @type	function
*  @date	6/07/2016
*  @since	5.4.0
*
*  @param	array $array
*  @return	boolean
*/
function acf_is_array($array)
{
}
/*
*  acf_is_empty
*
*  This function will return true for an empty var (allows 0 as true)
*
*  @type	function
*  @date	6/07/2016
*  @since	5.4.0
*
*  @param	mixed $value
*  @return	boolean
*/
function acf_is_empty($value)
{
}
/**
*  acf_idify
*
*  Returns an id friendly string
*
*  @date	24/12/17
*  @since	5.6.5
*
*  @param	type $var Description. Default.
*  @return	type Description.
*/
function acf_idify($str = '')
{
}
/**
*  acf_slugify
*
*  Returns a slug friendly string
*
*  @date	24/12/17
*  @since	5.6.5
*
*  @param	type $var Description. Default.
*  @return	type Description.
*/
function acf_slugify($str = '')
{
}
/**
*  acf_has_setting
*
*  alias of acf()->has_setting()
*
*  @date	2/2/18
*  @since	5.6.5
*
*  @param	void
*  @return	void
*/
function acf_has_setting($name = '')
{
}
/**
*  acf_raw_setting
*
*  alias of acf()->get_setting()
*
*  @date	2/2/18
*  @since	5.6.5
*
*  @param	void
*  @return	void
*/
function acf_raw_setting($name = '')
{
}
/*
*  acf_update_setting
*
*  alias of acf()->update_setting()
*
*  @type	function
*  @date	28/09/13
*  @since	5.0.0
*
*  @param	string $name
*  @param	mixed $value
*  @return	void
*/
function acf_update_setting($name, $value)
{
}
/**
*  acf_validate_setting
*
*  Returns the changed setting name if available.
*
*  @date	2/2/18
*  @since	5.6.5
*
*  @param	void
*  @return	void
*/
function acf_validate_setting($name = '')
{
}
/*
*  acf_get_setting
*
*  alias of acf()->get_setting()
*
*  @type	function
*  @date	28/09/13
*  @since	5.0.0
*
*  @param	void
*  @return	void
*/
function acf_get_setting($name, $value = \null)
{
}
/*
*  acf_append_setting
*
*  This function will add a value into the settings array found in the acf object
*
*  @type	function
*  @date	28/09/13
*  @since	5.0.0
*
*  @param	string $name
*  @param	mixed $value
*  @return	void
*/
function acf_append_setting($name, $value)
{
}
/**
*  acf_get_data
*
*  Returns data.
*
*  @date	28/09/13
*  @since	5.0.0
*
*  @param	string $name
*  @return	mixed
*/
function acf_get_data($name)
{
}
/**
*  acf_set_data
*
*  Sets data.
*
*  @date	28/09/13
*  @since	5.0.0
*
*  @param	string $name
*  @param	mixed $value
*  @return	void
*/
function acf_set_data($name, $value)
{
}
/*
*  acf_init
*
*  alias of acf()->init()
*
*  @type	function
*  @date	28/09/13
*  @since	5.0.0
*
*  @param	void
*  @return	void
*/
function acf_init()
{
}
/*
*  acf_get_compatibility
*
*  This function will return true or false for a given compatibility setting
*
*  @type	function
*  @date	20/01/2015
*  @since	5.1.5
*
*  @param	string $name
*  @return	boolean
*/
function acf_get_compatibility($name)
{
}
/*
*  acf_has_done
*
*  This function will return true if this action has already been done
*
*  @type	function
*  @date	16/12/2015
*  @since	5.3.2
*
*  @param	string $name
*  @return	boolean
*/
function acf_has_done($name)
{
}
/*
*  acf_get_path
*
*  This function will return the path to a file within the ACF plugin folder
*
*  @type	function
*  @date	28/09/13
*  @since	5.0.0
*
*  @param	string $path the relative path from the root of the ACF plugin folder
*  @return	string
*/
function acf_get_path($path = '')
{
}
/**
*  acf_get_url
*
*  This function will return the url to a file within the ACF plugin folder
*
*  @date	12/12/17
*  @since	5.6.8
*
*  @param	string $path The relative path from the root of the ACF plugin folder
*  @return	string
*/
function acf_get_url($path = '')
{
}
/*
*  acf_get_dir
*
*  Deprecated in 5.6.8. Use acf_get_url() instead.
*
*  @date	28/09/13
*  @since	5.0.0
*
*  @param	string
*  @return	string
*/
function acf_get_dir($path = '')
{
}
/*
*  acf_include
*
*  This function will include a file
*
*  @type	function
*  @date	10/03/2014
*  @since	5.0.0
*
*  @param	int $post_id
*  @return	int $post_id
*/
function acf_include($file)
{
}
/**
*  acf_include_once
*
*  Includes a file one time only.
*
*  @date	24/8/18
*  @since	5.7.4
*
*  @param	string $file The relative file path.
*  @return	void
*/
function acf_include_once($file = '')
{
}
/*
*  acf_get_external_path
*
*  This function will return the path to a file within an external folder
*
*  @type	function
*  @date	22/2/17
*  @since	5.5.8
*
*  @param	string $file
*  @param	string $path
*  @return	string
*/
function acf_get_external_path($file, $path = '')
{
}
/*
*  acf_get_external_dir
*
*  This function will return the url to a file within an external folder
*
*  @type	function
*  @date	22/2/17
*  @since	5.5.8
*
*  @param	string $file
*  @param	string $path
*  @return	string
*/
function acf_get_external_dir($file, $path = '')
{
}
/**
*  acf_plugin_dir_url
*
*  This function will calculate the url to a plugin folder.
*  Different to the WP plugin_dir_url(), this function can calculate for urls outside of the plugins folder (theme include).
*
*  @date	13/12/17
*  @since	5.6.8
*
*  @param	type $var Description. Default.
*  @return	type Description.
*/
function acf_plugin_dir_url($file)
{
}
/*
*  acf_parse_args
*
*  This function will merge together 2 arrays and also convert any numeric values to ints
*
*  @type	function
*  @date	18/10/13
*  @since	5.0.0
*
*  @param	array $args
*  @param	array $defaults
*  @return	array $args
*/
function acf_parse_args($args, $defaults = array())
{
}
/*
*  acf_parse_types
*
*  This function will convert any numeric values to int and trim strings
*
*  @type	function
*  @date	18/10/13
*  @since	5.0.0
*
*  @param	mixed $var
*  @return	mixed $var
*/
function acf_parse_types($array)
{
}
/*
*  acf_parse_type
*
*  description
*
*  @type	function
*  @date	11/11/2014
*  @since	5.0.9
*
*  @param	int $post_id
*  @return	int $post_id
*/
function acf_parse_type($v)
{
}
/*
*  acf_get_view
*
*  This function will load in a file from the 'admin/views' folder and allow variables to be passed through
*
*  @type	function
*  @date	28/09/13
*  @since	5.0.0
*
*  @param	string $view_name
*  @param	array $args
*  @return	void
*/
function acf_get_view($path = '', $args = array())
{
}
/*
*  acf_merge_atts
*
*  description
*
*  @type	function
*  @date	2/11/2014
*  @since	5.0.9
*
*  @param	int $post_id
*  @return	int $post_id
*/
function acf_merge_atts($atts, $extra = array())
{
}
/*
*  acf_nonce_input
*
*  This function will create a basic nonce input
*
*  @type	function
*  @date	24/5/17
*  @since	5.6.0
*
*  @param	int $post_id
*  @return	int $post_id
*/
function acf_nonce_input($nonce = '')
{
}
/*
*  acf_extract_var
*
*  This function will remove the var from the array, and return the var
*
*  @type	function
*  @date	2/10/13
*  @since	5.0.0
*
*  @param	array $array
*  @param	string $key
*  @return	mixed
*/
function acf_extract_var(&$array, $key, $default = \null)
{
}
/*
*  acf_extract_vars
*
*  This function will remove the vars from the array, and return the vars
*
*  @type	function
*  @date	8/10/13
*  @since	5.0.0
*
*  @param	int $post_id
*  @return	int $post_id
*/
function acf_extract_vars(&$array, $keys)
{
}
/*
*  acf_get_sub_array
*
*  This function will return a sub array of data
*
*  @type	function
*  @date	15/03/2016
*  @since	5.3.2
*
*  @param	int $post_id
*  @return	int $post_id
*/
function acf_get_sub_array($array, $keys)
{
}
/**
*  acf_get_post_types
*
*  Returns an array of post type names.
*
*  @date	7/10/13
*  @since	5.0.0
*
*  @param	array $args Optional. An array of key => value arguments to match against the post type objects. Default empty array.
*  @return	array A list of post type names.
*/
function acf_get_post_types($args = array())
{
}
function acf_get_pretty_post_types($post_types = array())
{
}
/*
*  acf_get_post_type_label
*
*  This function will return a pretty label for a specific post_type
*
*  @type	function
*  @date	5/07/2016
*  @since	5.4.0
*
*  @param	string $post_type
*  @return	string
*/
function acf_get_post_type_label($post_type)
{
}
/*
*  acf_verify_nonce
*
*  This function will look at the $_POST['_acf_nonce'] value and return true or false
*
*  @type	function
*  @date	15/10/13
*  @since	5.0.0
*
*  @param	string $nonce
*  @return	boolean
*/
function acf_verify_nonce($value)
{
}
/*
*  acf_verify_ajax
*
*  This function will return true if the current AJAX request is valid
*  It's action will also allow WPML to set the lang and avoid AJAX get_posts issues
*
*  @type	function
*  @date	7/08/2015
*  @since	5.2.3
*
*  @param	void
*  @return	boolean
*/
function acf_verify_ajax()
{
}
/*
*  acf_get_image_sizes
*
*  This function will return an array of available image sizes
*
*  @type	function
*  @date	23/10/13
*  @since	5.0.0
*
*  @param	void
*  @return	array
*/
function acf_get_image_sizes()
{
}
function acf_get_image_size($s = '')
{
}
/**
 * acf_version_compare
 *
 * Similar to the version_compare() function but with extra functionality.
 *
 * @date	21/11/16
 * @since	5.5.0
 *
 * @param	string $left The left version number.
 * @param	string $compare The compare operator.
 * @param	string $right The right version number.
 * @return	bool
 */
function acf_version_compare($left = '', $compare = '>', $right = '')
{
}
/*
*  acf_get_full_version
*
*  This function will remove any '-beta1' or '-RC1' strings from a version
*
*  @type	function
*  @date	24/11/16
*  @since	5.5.0
*
*  @param	string $version
*  @return	string
*/
function acf_get_full_version($version = '1')
{
}
/*
*  acf_get_terms
*
*  This function is a wrapper for the get_terms() function
*
*  @type	function
*  @date	28/09/2016
*  @since	5.4.0
*
*  @param	array $args
*  @return	array
*/
function acf_get_terms($args)
{
}
/*
*  acf_get_taxonomy_terms
*
*  This function will return an array of available taxonomy terms
*
*  @type	function
*  @date	7/10/13
*  @since	5.0.0
*
*  @param	array $taxonomies
*  @return	array
*/
function acf_get_taxonomy_terms($taxonomies = array())
{
}
/*
*  acf_decode_taxonomy_terms
*
*  This function decodes the $taxonomy:$term strings into a nested array
*
*  @type	function
*  @date	27/02/2014
*  @since	5.0.0
*
*  @param	array $terms
*  @return	array
*/
function acf_decode_taxonomy_terms($strings = \false)
{
}
/*
*  acf_decode_taxonomy_term
*
*  This function will return the taxonomy and term slug for a given value
*
*  @type	function
*  @date	31/03/2014
*  @since	5.0.0
*
*  @param	string $string
*  @return	array
*/
function acf_decode_taxonomy_term($value)
{
}
/**
 * acf_array
 *
 * Casts the value into an array.
 *
 * @date	9/1/19
 * @since	5.7.10
 *
 * @param	mixed $val The value to cast.
 * @return	array
 */
function acf_array($val = array())
{
}
/*
*  acf_get_array
*
*  This function will force a variable to become an array
*
*  @type	function
*  @date	4/02/2014
*  @since	5.0.0
*
*  @param	mixed $var
*  @return	array
*/
function acf_get_array($var = \false, $delimiter = '')
{
}
/*
*  acf_get_numeric
*
*  This function will return numeric values
*
*  @type	function
*  @date	15/07/2016
*  @since	5.4.0
*
*  @param	mixed $value
*  @return	mixed
*/
function acf_get_numeric($value = '')
{
}
/**
 * acf_get_posts
 *
 * Similar to the get_posts() function but with extra functionality.
 *
 * @date	3/03/15
 * @since	5.1.5
 *
 * @param	array $args The query args.
 * @return	array
 */
function acf_get_posts($args = array())
{
}
/*
*  _acf_query_remove_post_type
*
*  This function will remove the 'wp_posts.post_type' WHERE clause completely
*  When using 'post__in', this clause is unneccessary and slow.
*
*  @type	function
*  @date	4/03/2015
*  @since	5.1.5
*
*  @param	string $sql
*  @return	$sql
*/
function _acf_query_remove_post_type($sql)
{
}
/*
*  acf_get_grouped_posts
*
*  This function will return all posts grouped by post_type
*  This is handy for select settings
*
*  @type	function
*  @date	27/02/2014
*  @since	5.0.0
*
*  @param	array $args
*  @return	array
*/
function acf_get_grouped_posts($args)
{
}
function _acf_orderby_post_type($ordeby, $wp_query)
{
}
function acf_get_post_title($post = 0, $is_search = \false)
{
}
function acf_order_by_search($array, $search)
{
}
/*
*  acf_get_pretty_user_roles
*
*  description
*
*  @type	function
*  @date	23/02/2016
*  @since	5.3.2
*
*  @param	int $post_id
*  @return	int $post_id
*/
function acf_get_pretty_user_roles($allowed = \false)
{
}
/*
*  acf_get_grouped_users
*
*  This function will return all users grouped by role
*  This is handy for select settings
*
*  @type	function
*  @date	27/02/2014
*  @since	5.0.0
*
*  @param	array $args
*  @return	array
*/
function acf_get_grouped_users($args = array())
{
}
/**
 * acf_json_encode
 *
 * Returns json_encode() ready for file / database use.
 *
 * @date	29/4/19
 * @since	5.0.0
 *
 * @param	array $json The array of data to encode.
 * @return	string
 */
function acf_json_encode($json)
{
}
/*
*  acf_str_exists
*
*  This function will return true if a sub string is found
*
*  @type	function
*  @date	1/05/2014
*  @since	5.0.0
*
*  @param	string $needle
*  @param	string $haystack
*  @return	boolean
*/
function acf_str_exists($needle, $haystack)
{
}
/*
*  acf_debug
*
*  description
*
*  @type	function
*  @date	2/05/2014
*  @since	5.0.0
*
*  @param	int $post_id
*  @return	int $post_id
*/
function acf_debug()
{
}
function acf_debug_start()
{
}
function acf_debug_end()
{
}
/*
*  acf_encode_choices
*
*  description
*
*  @type	function
*  @date	4/06/2014
*  @since	5.0.0
*
*  @param	int $post_id
*  @return	int $post_id
*/
function acf_encode_choices($array = array(), $show_keys = \true)
{
}
function acf_decode_choices($string = '', $array_keys = \false)
{
}
/*
*  acf_str_replace
*
*  This function will replace an array of strings much like str_replace
*  The difference is the extra logic to avoid replacing a string that has alread been replaced
*  This is very useful for replacing date characters as they overlap with eachother
*
*  @type	function
*  @date	21/06/2016
*  @since	5.3.8
*
*  @param	int $post_id
*  @return	int $post_id
*/
function acf_str_replace($string = '', $search_replace = array())
{
}
/*
*  acf_split_date_time
*
*  This function will split a format string into seperate date and time
*
*  @type	function
*  @date	26/05/2016
*  @since	5.3.8
*
*  @param	string $date_time
*  @return	array $formats
*/
function acf_split_date_time($date_time = '')
{
}
/*
*  acf_convert_date_to_php
*
*  This fucntion converts a date format string from JS to PHP
*
*  @type	function
*  @date	20/06/2014
*  @since	5.0.0
*
*  @param	string $date
*  @return	string
*/
function acf_convert_date_to_php($date = '')
{
}
/*
*  acf_convert_date_to_js
*
*  This fucntion converts a date format string from PHP to JS
*
*  @type	function
*  @date	20/06/2014
*  @since	5.0.0
*
*  @param	string $date
*  @return	string
*/
function acf_convert_date_to_js($date = '')
{
}
/*
*  acf_convert_time_to_php
*
*  This fucntion converts a time format string from JS to PHP
*
*  @type	function
*  @date	20/06/2014
*  @since	5.0.0
*
*  @param	string $time
*  @return	string
*/
function acf_convert_time_to_php($time = '')
{
}
/*
*  acf_convert_time_to_js
*
*  This fucntion converts a date format string from PHP to JS
*
*  @type	function
*  @date	20/06/2014
*  @since	5.0.0
*
*  @param	string $time
*  @return	string
*/
function acf_convert_time_to_js($time = '')
{
}
/*
*  acf_update_user_setting
*
*  description
*
*  @type	function
*  @date	15/07/2014
*  @since	5.0.0
*
*  @param	int $post_id
*  @return	int $post_id
*/
function acf_update_user_setting($name, $value)
{
}
/*
*  acf_get_user_setting
*
*  description
*
*  @type	function
*  @date	15/07/2014
*  @since	5.0.0
*
*  @param	int $post_id
*  @return	int $post_id
*/
function acf_get_user_setting($name = '', $default = \false)
{
}
/*
*  acf_in_array
*
*  description
*
*  @type	function
*  @date	22/07/2014
*  @since	5.0.0
*
*  @param	int $post_id
*  @return	int $post_id
*/
function acf_in_array($value = '', $array = \false)
{
}
/*
*  acf_get_valid_post_id
*
*  This function will return a valid post_id based on the current screen / parameter
*
*  @type	function
*  @date	8/12/2013
*  @since	5.0.0
*
*  @param	mixed $post_id
*  @return	mixed $post_id
*/
function acf_get_valid_post_id($post_id = 0)
{
}
/*
*  acf_get_post_id_info
*
*  This function will return the type and id for a given $post_id string
*
*  @type	function
*  @date	2/07/2016
*  @since	5.4.0
*
*  @param	mixed $post_id
*  @return	array $info
*/
function acf_get_post_id_info($post_id = 0)
{
}
/*
acf_log( acf_get_post_id_info(4) );
acf_log( acf_get_post_id_info('post_4') );
acf_log( acf_get_post_id_info('user_123') );
acf_log( acf_get_post_id_info('term_567') );
acf_log( acf_get_post_id_info('category_204') );
acf_log( acf_get_post_id_info('comment_6') );
acf_log( acf_get_post_id_info('options_lol!') );
acf_log( acf_get_post_id_info('option') );
acf_log( acf_get_post_id_info('options') );
*/
/*
*  acf_isset_termmeta
*
*  This function will return true if the termmeta table exists
*  https://developer.wordpress.org/reference/functions/get_term_meta/
*
*  @type	function
*  @date	3/09/2016
*  @since	5.4.0
*
*  @param	int $post_id
*  @return	int $post_id
*/
function acf_isset_termmeta($taxonomy = '')
{
}
/*
*  acf_get_term_post_id
*
*  This function will return a valid post_id string for a given term and taxonomy
*
*  @type	function
*  @date	6/2/17
*  @since	5.5.6
*
*  @param	string $taxonomy
*  @param	int $term_id
*  @return	string
*/
function acf_get_term_post_id($taxonomy, $term_id)
{
}
/*
*  acf_upload_files
*
*  This function will walk througfh the $_FILES data and upload each found
*
*  @type	function
*  @date	25/10/2014
*  @since	5.0.9
*
*  @param	array $ancestors an internal parameter, not required
*  @return	void
*/
function acf_upload_files($ancestors = array())
{
}
/*
*  acf_upload_file
*
*  This function will uploade a $_FILE
*
*  @type	function
*  @date	27/10/2014
*  @since	5.0.9
*
*  @param	array $uploaded_file array found from $_FILE data
*  @return	int $id new attachment ID
*/
function acf_upload_file($uploaded_file)
{
}
/*
*  acf_update_nested_array
*
*  This function will update a nested array value. Useful for modifying the $_POST array
*
*  @type	function
*  @date	27/10/2014
*  @since	5.0.9
*
*  @param	array $array target array to be updated
*  @param	array $ancestors array of keys to navigate through to find the child
*  @param	mixed $value The new value
*  @return	boolean
*/
function acf_update_nested_array(&$array, $ancestors, $value)
{
}
/*
*  acf_is_screen
*
*  This function will return true if all args are matched for the current screen
*
*  @type	function
*  @date	9/12/2014
*  @since	5.1.5
*
*  @param	int $post_id
*  @return	int $post_id
*/
function acf_is_screen($id = '')
{
}
/*
*  acf_maybe_get
*
*  This function will return a var if it exists in an array
*
*  @type	function
*  @date	9/12/2014
*  @since	5.1.5
*
*  @param	array $array the array to look within
*  @param	key $key the array key to look for. Nested values may be found using '/'
*  @param	mixed $default the value returned if not found
*  @return	int $post_id
*/
function acf_maybe_get($array = array(), $key = 0, $default = \null)
{
}
function acf_maybe_get_POST($key = '', $default = \null)
{
}
function acf_maybe_get_GET($key = '', $default = \null)
{
}
/*
*  acf_get_attachment
*
*  This function will return an array of attachment data
*
*  @type	function
*  @date	5/01/2015
*  @since	5.1.5
*
*  @param	mixed $post either post ID or post object
*  @return	array
*/
function acf_get_attachment($attachment)
{
}
/*
*  acf_get_truncated
*
*  This function will truncate and return a string
*
*  @type	function
*  @date	8/08/2014
*  @since	5.0.0
*
*  @param	string $text
*  @param	int $length
*  @return	string
*/
function acf_get_truncated($text, $length = 64)
{
}
/*
*  acf_get_current_url
*
*  This function will return the current URL.
*
*  @date	23/01/2015
*  @since	5.1.5
*
*  @param	void
*  @return	string
*/
function acf_get_current_url()
{
}
/**
*  acf_str_join
*
*  Joins together 2 strings removing any overlapping characters.
*  Useful for urls. Eg: 'test.local/foo/' + '/foo/bar/' = 'test.local/foo/bar/'
*
*  @date	19/11/18
*  @since	5.8.0
*
*  @param	string $s1 The first string.
*  @param	string $s2 The seccond string.
*  @return	string
*/
function acf_str_join($s1 = '', $s2 = '')
{
}
/*
*  acf_current_user_can_admin
*
*  This function will return true if the current user can administrate the ACF field groups
*
*  @type	function
*  @date	9/02/2015
*  @since	5.1.5
*
*  @param	int $post_id
*  @return	int $post_id
*/
function acf_current_user_can_admin()
{
}
/*
*  acf_get_filesize
*
*  This function will return a numeric value of bytes for a given filesize string
*
*  @type	function
*  @date	18/02/2015
*  @since	5.1.5
*
*  @param	mixed $size
*  @return	int
*/
function acf_get_filesize($size = 1)
{
}
/*
*  acf_format_filesize
*
*  This function will return a formatted string containing the filesize and unit
*
*  @type	function
*  @date	18/02/2015
*  @since	5.1.5
*
*  @param	mixed $size
*  @return	int
*/
function acf_format_filesize($size = 1)
{
}
/*
*  acf_get_valid_terms
*
*  This function will replace old terms with new split term ids
*
*  @type	function
*  @date	27/02/2015
*  @since	5.1.5
*
*  @param	int|array $terms
*  @param	string $taxonomy
*  @return	$terms
*/
function acf_get_valid_terms($terms = \false, $taxonomy = 'category')
{
}
/*
*  acf_esc_html_deep
*
*  Navigates through an array and escapes html from the values.
*
*  @type	function
*  @date	10/06/2015
*  @since	5.2.7
*
*  @param	mixed $value
*  @return	$value
*/
/*
function acf_esc_html_deep( $value ) {
	
	// array
	if( is_array($value) ) {
		
		$value = array_map('acf_esc_html_deep', $value);
	
	// object
	} elseif( is_object($value) ) {
		
		$vars = get_object_vars( $value );
		
		foreach( $vars as $k => $v ) {
			
			$value->{$k} = acf_esc_html_deep( $v );
		
		}
		
	// string
	} elseif( is_string($value) ) {

		$value = esc_html($value);

	}
	
	
	// return
	return $value;

}
*/
/*
*  acf_validate_attachment
*
*  This function will validate an attachment based on a field's resrictions and return an array of errors
*
*  @type	function
*  @date	3/07/2015
*  @since	5.2.3
*
*  @param	array $attachment attachment data. Cahnges based on context
*  @param	array $field field settings containing restrictions
*  @param	string $context $file is different when uploading / preparing
*  @return	array $errors
*/
function acf_validate_attachment($attachment, $field, $context = 'prepare')
{
}
function _acf_settings_uploader($uploader)
{
}
/*
*  acf_translate_keys
*
*  description
*
*  @type	function
*  @date	7/12/2015
*  @since	5.3.2
*
*  @param	int $post_id
*  @return	int $post_id
*/
/*
function acf_translate_keys( $array, $keys ) {
	
	// bail early if no keys
	if( empty($keys) ) return $array;
	
	
	// translate
	foreach( $keys as $k ) {
		
		// bail ealry if not exists
		if( !isset($array[ $k ]) ) continue;
		
		
		// translate
		$array[ $k ] = acf_translate( $array[ $k ] );
		
	}
	
	
	// return
	return $array;
	
}
*/
/*
*  acf_translate
*
*  This function will translate a string using the new 'l10n_textdomain' setting
*  Also works for arrays which is great for fields - select -> choices
*
*  @type	function
*  @date	4/12/2015
*  @since	5.3.2
*
*  @param	mixed $string string or array containins strings to be translated
*  @return	$string
*/
function acf_translate($string)
{
}
/*
*  acf_maybe_add_action
*
*  This function will determine if the action has already run before adding / calling the function
*
*  @type	function
*  @date	13/01/2016
*  @since	5.3.2
*
*  @param	int $post_id
*  @return	int $post_id
*/
function acf_maybe_add_action($tag, $function_to_add, $priority = 10, $accepted_args = 1)
{
}
/*
*  acf_is_row_collapsed
*
*  This function will return true if the field's row is collapsed
*
*  @type	function
*  @date	2/03/2016
*  @since	5.3.2
*
*  @param	int $post_id
*  @return	int $post_id
*/
function acf_is_row_collapsed($field_key = '', $row_index = 0)
{
}
/*
*  acf_get_attachment_image
*
*  description
*
*  @type	function
*  @date	24/10/16
*  @since	5.5.0
*
*  @param	int $post_id
*  @return	int $post_id
*/
function acf_get_attachment_image($attachment_id = 0, $size = 'thumbnail')
{
}
/*
*  acf_get_post_thumbnail
*
*  This function will return a thumbail image url for a given post
*
*  @type	function
*  @date	3/05/2016
*  @since	5.3.8
*
*  @param	obj $post
*  @param	mixed $size
*  @return	string
*/
function acf_get_post_thumbnail($post = \null, $size = 'thumbnail')
{
}
/*
*  acf_get_browser
*
*  This functino will return the browser string for major browsers
*
*  @type	function
*  @date	17/01/2014
*  @since	5.0.0
*
*  @param	void
*  @return	string
*/
function acf_get_browser()
{
}
/*
*  acf_is_ajax
*
*  This function will reutrn true if performing a wp ajax call
*
*  @type	function
*  @date	7/06/2016
*  @since	5.3.8
*
*  @param	void
*  @return	boolean
*/
function acf_is_ajax($action = '')
{
}
/*
*  acf_format_date
*
*  This function will accept a date value and return it in a formatted string
*
*  @type	function
*  @date	16/06/2016
*  @since	5.3.8
*
*  @param	string $value
*  @return	string $format
*/
function acf_format_date($value, $format)
{
}
/**
 * acf_clear_log
 *
 * Deletes the debug.log file.
 *
 * @date	21/1/19
 * @since	5.7.10
 *
 * @param	type $var Description. Default.
 * @return	type Description.
 */
function acf_clear_log()
{
}
/*
*  acf_log
*
*  description
*
*  @type	function
*  @date	24/06/2016
*  @since	5.3.8
*
*  @param	int $post_id
*  @return	int $post_id
*/
function acf_log()
{
}
/**
*  acf_dev_log
*
*  Used to log variables only if ACF_DEV is defined
*
*  @date	25/8/18
*  @since	5.7.4
*
*  @param	mixed
*  @return	void
*/
function acf_dev_log()
{
}
/*
*  acf_doing
*
*  This function will tell ACF what task it is doing
*
*  @type	function
*  @date	28/06/2016
*  @since	5.3.8
*
*  @param	string $event
*  @param	context (string)
*  @return	void
*/
function acf_doing($event = '', $context = '')
{
}
/*
*  acf_is_doing
*
*  This function can be used to state what ACF is doing, or to check
*
*  @type	function
*  @date	28/06/2016
*  @since	5.3.8
*
*  @param	string $event
*  @param	context (string)
*  @return	boolean
*/
function acf_is_doing($event = '', $context = '')
{
}
/*
*  acf_is_plugin_active
*
*  This function will return true if the ACF plugin is active
*  - May be included within a theme or other plugin
*
*  @type	function
*  @date	13/07/2016
*  @since	5.4.0
*
*  @param	int $basename
*  @return	int $post_id
*/
function acf_is_plugin_active()
{
}
/*
*  acf_send_ajax_results
*
*  This function will print JSON data for a Select2 AJAX query
*
*  @type	function
*  @date	19/07/2016
*  @since	5.4.0
*
*  @param	array $response
*  @return	void
*/
function acf_send_ajax_results($response)
{
}
/*
*  acf_is_sequential_array
*
*  This function will return true if the array contains only numeric keys
*
*  @source	http://stackoverflow.com/questions/173400/how-to-check-if-php-array-is-associative-or-sequential
*  @type	function
*  @date	9/09/2016
*  @since	5.4.0
*
*  @param	array $array
*  @return	boolean
*/
function acf_is_sequential_array($array)
{
}
/*
*  acf_is_associative_array
*
*  This function will return true if the array contains one or more string keys
*
*  @source	http://stackoverflow.com/questions/173400/how-to-check-if-php-array-is-associative-or-sequential
*  @type	function
*  @date	9/09/2016
*  @since	5.4.0
*
*  @param	array $array
*  @return	boolean
*/
function acf_is_associative_array($array)
{
}
/*
*  acf_add_array_key_prefix
*
*  This function will add a prefix to all array keys
*  Useful to preserve numeric keys when performing array_multisort
*
*  @type	function
*  @date	15/09/2016
*  @since	5.4.0
*
*  @param	array $array
*  @param	string $prefix
*  @return	array
*/
function acf_add_array_key_prefix($array, $prefix)
{
}
/*
*  acf_remove_array_key_prefix
*
*  This function will remove a prefix to all array keys
*  Useful to preserve numeric keys when performing array_multisort
*
*  @type	function
*  @date	15/09/2016
*  @since	5.4.0
*
*  @param	array $array
*  @param	string $prefix
*  @return	array
*/
function acf_remove_array_key_prefix($array, $prefix)
{
}
/*
*  acf_strip_protocol
*
*  This function will remove the proticol from a url 
*  Used to allow licences to remain active if a site is switched to https 
*
*  @type	function
*  @date	10/01/2017
*  @since	5.5.4
*  @author	Aaron 
*
*  @param	string $url
*  @return	string 
*/
function acf_strip_protocol($url)
{
}
/*
*  acf_connect_attachment_to_post
*
*  This function will connect an attacment (image etc) to the post 
*  Used to connect attachements uploaded directly to media that have not been attaced to a post
*
*  @type	function
*  @date	11/01/2017
*  @since	5.8.0 Added filter to prevent connection.
*  @since	5.5.4
*
*  @param	int $attachment_id The attachment ID.
*  @param	int $post_id The post ID.
*  @return	bool True if attachment was connected.
*/
function acf_connect_attachment_to_post($attachment_id = 0, $post_id = 0)
{
}
/*
*  acf_encrypt
*
*  This function will encrypt a string using PHP
*  https://bhoover.com/using-php-openssl_encrypt-openssl_decrypt-encrypt-decrypt-data/
*
*  @type	function
*  @date	27/2/17
*  @since	5.5.8
*
*  @param	string $data
*  @return	string
*/
function acf_encrypt($data = '')
{
}
/*
*  acf_decrypt
*
*  This function will decrypt an encrypted string using PHP
*  https://bhoover.com/using-php-openssl_encrypt-openssl_decrypt-encrypt-decrypt-data/
*
*  @type	function
*  @date	27/2/17
*  @since	5.5.8
*
*  @param	string $data
*  @return	string
*/
function acf_decrypt($data = '')
{
}
/**
*  acf_parse_markdown
*
*  A very basic regex-based Markdown parser function based off [slimdown](https://gist.github.com/jbroadway/2836900).
*
*  @date	6/8/18
*  @since	5.7.2
*
*  @param	string $text The string to parse.
*  @return	string
*/
function acf_parse_markdown($text = '')
{
}
/**
*  acf_get_sites
*
*  Returns an array of sites for a network.
*
*  @date	29/08/2016
*  @since	5.4.0
*
*  @param	void
*  @return	array
*/
function acf_get_sites()
{
}
/**
*  acf_convert_rules_to_groups
*
*  Converts an array of rules from ACF4 to an array of groups for ACF5
*
*  @date	25/8/18
*  @since	5.7.4
*
*  @param	array $rules An array of rules.
*  @param	string $anyorall The anyorall setting used in ACF4. Defaults to 'any'.
*  @return	array
*/
function acf_convert_rules_to_groups($rules, $anyorall = 'any')
{
}
/**
*  acf_register_ajax
*
*  Regsiters an ajax callback.
*
*  @date	5/10/18
*  @since	5.7.7
*
*  @param	string $name The ajax action name.
*  @param	array $callback The callback function or array.
*  @param	bool $public Whether to allow access to non logged in users.
*  @return	void
*/
function acf_register_ajax($name = '', $callback = \false, $public = \false)
{
}
/**
*  acf_str_camel_case
*
*  Converts a string into camelCase.
*  Thanks to https://stackoverflow.com/questions/31274782/convert-array-keys-from-underscore-case-to-camelcase-recursively
*
*  @date	24/10/18
*  @since	5.8.0
*
*  @param	string $string The string ot convert.
*  @return	string
*/
function acf_str_camel_case($string = '')
{
}
/**
*  acf_array_camel_case
*
*  Converts all aray keys to camelCase.
*
*  @date	24/10/18
*  @since	5.8.0
*
*  @param	array $array The array to convert.
*  @return	array
*/
function acf_array_camel_case($array = array())
{
}
/**
*  acf_is_block_editor
*
*  Returns true if the current screen uses the block editor.
*
*  @date	13/12/18
*  @since	5.8.0
*
*  @return	bool
*/
function acf_is_block_editor()
{
}
/*
*  acf_esc_html
*
*  This function will encode <script> tags for safe output
*
*  @type	function
*  @date	25/6/17
*  @since	5.6.0
*
*  @param	string (string)
*  @return	string
*/
function acf_esc_html($string = '')
{
}
/**
*  acf_clean_atts
*
*  This function will remove empty attributes
*
*  @date	3/10/17
*  @since	5.6.3
*
*  @param	array $atts
*  @return	array
*/
function acf_clean_atts($atts = array())
{
}
/**
*  acf_get_atts
*
*  This function will return an array of HTML attributes
*
*  @date	2/10/17
*  @since	5.6.3
*
*  @param	void
*  @return	void
*/
/*
function acf_get_atts( $array, $keys ) {
	
	// vars
	$atts = array();
	
	
	// append attributes
	foreach( $keys as $k ) {
		if( isset($array[ $k ]) ) $atts[ $k ] = $array[ $k ];
	}
	
	
	// modify special attributes
	foreach( array('readonly', 'disabled', 'required') as $k ) {
		$atts[ $k ] = $atts[ $k ] ? $k : '';
	}
	
	
	// clean up blank attributes
	foreach( $atts as $k => $v ) {
		if( $v === '' ) unset( $atts[ $k ] );
	}
	
	
	// return
	return $atts;
	
}
*/
/*
*  acf_esc_atts
*
*  This function will escape an array of attributes and return as HTML
*
*  @type	function
*  @date	27/6/17
*  @since	5.6.0
*
*  @param	array $atts
*  @return	string
*/
function acf_esc_atts($atts = array())
{
}
/*
*  acf_esc_atts_e
*
*  This function will echo acf_esc_atts
*
*  @type	function
*  @date	27/6/17
*  @since	5.6.0
*
*  @param	array $atts
*  @return	void
*/
function acf_esc_atts_e($atts = array())
{
}
/*
*  acf_get_text_input
*
*  This function will return HTML for a text input
*
*  @type	function
*  @date	3/02/2014
*  @since	5.0.0
*
*  @param	$atts
*  @return	string
*/
function acf_get_text_input($atts = array())
{
}
/*
*  acf_text_input
*
*  This function will output HTML for a text input
*
*  @type	function
*  @date	3/02/2014
*  @since	5.0.0
*
*  @param	$atts
*  @return	void
*/
function acf_text_input($atts = array())
{
}
/*
*  acf_get_hidden_input
*
*  This function will return HTML for a hidden input
*
*  @type	function
*  @date	3/02/2014
*  @since	5.0.0
*
*  @param	$atts
*  @return	string
*/
function acf_get_hidden_input($atts = array())
{
}
/*
*  acf_hidden_input
*
*  This function will output HTML for a generic input
*
*  @type	function
*  @date	3/02/2014
*  @since	5.0.0
*
*  @param	$atts
*  @return	void
*/
function acf_hidden_input($atts = array())
{
}
/*
*  acf_get_textarea_input
*
*  This function will return HTML for a textarea input
*
*  @type	function
*  @date	3/02/2014
*  @since	5.0.0
*
*  @param	$atts
*  @return	string
*/
function acf_get_textarea_input($atts = array())
{
}
/*
*  acf_textarea_input
*
*  This function will output HTML for a textarea input
*
*  @type	function
*  @date	3/02/2014
*  @since	5.0.0
*
*  @param	$atts
*  @return	void
*/
function acf_textarea_input($atts = array())
{
}
/*
*  acf_get_checkbox_input
*
*  This function will return HTML for a checkbox input
*
*  @type	function
*  @date	3/02/2014
*  @since	5.0.0
*
*  @param	$atts
*  @return	string
*/
function acf_get_checkbox_input($atts = array())
{
}
/*
*  acf_checkbox_input
*
*  This function will output HTML for a checkbox input
*
*  @type	function
*  @date	3/02/2014
*  @since	5.0.0
*
*  @param	$atts
*  @return	void
*/
function acf_checkbox_input($atts = array())
{
}
/*
*  acf_get_radio_input
*
*  This function will return HTML for a radio input
*
*  @type	function
*  @date	3/02/2014
*  @since	5.0.0
*
*  @param	$atts
*  @return	string
*/
function acf_get_radio_input($atts = array())
{
}
/*
*  acf_radio_input
*
*  This function will output HTML for a radio input
*
*  @type	function
*  @date	3/02/2014
*  @since	5.0.0
*
*  @param	$atts
*  @return	void
*/
function acf_radio_input($atts = array())
{
}
/*
*  acf_get_select_input
*
*  This function will return HTML for a select input
*
*  @type	function
*  @date	3/02/2014
*  @since	5.0.0
*
*  @param	$atts
*  @return	string
*/
function acf_get_select_input($atts = array())
{
}
/*
*  acf_walk_select_input
*
*  This function will return the HTML for a select input's choices
*
*  @type	function
*  @date	27/6/17
*  @since	5.6.0
*
*  @param	int $post_id
*  @return	int $post_id
*/
function acf_walk_select_input($choices = array(), $values = array(), $depth = 0)
{
}
/*
*  acf_select_input
*
*  This function will output HTML for a select input
*
*  @type	function
*  @date	3/02/2014
*  @since	5.0.0
*
*  @param	$atts
*  @return	void
*/
function acf_select_input($atts = array())
{
}
/*
function acf_test_esc_html( $string = '' ) {
	
	$s = '';
	
	
	$time_start = microtime(true);
	$s .= wp_kses_post( $string );
	$s .= ' = ('. (microtime(true) - $time_start) .')';
	
	$s .= '-----';

	
	$time_start = microtime(true);
	$s .= str_replace(array('<script', '</script'), array(htmlspecialchars('<script'), htmlspecialchars('</script')), $string);
	$s .= ' = ('. (microtime(true) - $time_start) .')';
	

	$time_start = microtime(true);
	if( strpos($string, '<script') ) {
		$s .= str_replace(array('<script', '</script'), array(htmlspecialchars('<script'), htmlspecialchars('</script')), $string);
	}
	$s .= ' = ('. (microtime(true) - $time_start) .')';
	
	return $s;
	
}
*/
/*
*  acf_get_file_input
*
*  This function will return HTML for a file input
*
*  @type	function
*  @date	3/02/2014
*  @since	5.0.0
*
*  @param	$atts
*  @return	string
*/
function acf_get_file_input($atts = array())
{
}
/*
*  acf_file_input
*
*  This function will output HTML for a file input
*
*  @type	function
*  @date	3/02/2014
*  @since	5.0.0
*
*  @param	$atts
*  @return	void
*/
function acf_file_input($atts = array())
{
}
/*
*  acf_esc_attr
*
*  Deprecated since 5.6.0
*
*  @type	function
*  @date	1/10/13
*  @since	5.0.0
*
*  @param	array $atts
*  @return	void
*/
function acf_esc_attr($atts)
{
}
/*
*  acf_esc_attr_e
*
*  Deprecated since 5.6.0
*
*  @type	function
*  @date	1/10/13
*  @since	5.0.0
*
*  @param	array $atts
*  @return	void
*/
function acf_esc_attr_e($atts)
{
}
// class_exists check
/*
*  acf_register_admin_tool
*
*  alias of acf()->admin_tools->register_tool()
*
*  @type	function
*  @date	31/5/17
*  @since	5.6.0
*
*  @param	void
*  @return	void
*/
function acf_register_admin_tool($class)
{
}
/*
*  acf_get_admin_tools_url
*
*  This function will return the admin URL to the tools page
*
*  @type	function
*  @date	31/5/17
*  @since	5.6.0
*
*  @param	void
*  @return	void
*/
function acf_get_admin_tools_url()
{
}
/*
*  acf_get_admin_tool_url
*
*  This function will return the admin URL to the tools page
*
*  @type	function
*  @date	31/5/17
*  @since	5.6.0
*
*  @param	void
*  @return	void
*/
function acf_get_admin_tool_url($tool = '')
{
}
// class_exists check
/**
*  acf_new_admin_notice
*
*  Instantiates and returns a new model.
*
*  @date	23/12/18
*  @since	5.8.0
*
*  @param	array $data Optional data to set.
*  @return	ACF_Admin_Notice
*/
function acf_new_admin_notice($data = \false)
{
}
/**
 * acf_render_admin_notices
 *
 * Renders all admin notices HTML.
 *
 * @date	10/1/19
 * @since	5.7.10
 *
 * @param	void
 * @return	void
 */
function acf_render_admin_notices()
{
}
/**
 * acf_add_admin_notice
 *
 * Creates and returns a new notice.
 *
 * @date		17/10/13
 * @since		5.0.0
 *
 * @param	string $text The admin notice text.
 * @param	string $class The type of notice (warning, error, success, info).
 * @return	ACF_Admin_Notice
 */
function acf_add_admin_notice($text = '', $type = 'info')
{
}
/**
 * acf_enable_local
 *
 * Enables the local filter.
 *
 * @date	22/1/19
 * @since	5.7.10
 *
 * @param	void
 * @return	void
 */
function acf_enable_local()
{
}
/**
 * acf_disable_local
 *
 * Disables the local filter.
 *
 * @date	22/1/19
 * @since	5.7.10
 *
 * @param	void
 * @return	void
 */
function acf_disable_local()
{
}
/**
 * acf_is_local_enabled
 *
 * Returns true if local fields are enabled.
 *
 * @date	23/1/19
 * @since	5.7.10
 *
 * @param	void
 * @return	bool
 */
function acf_is_local_enabled()
{
}
/**
 * acf_get_local_store
 *
 * Returns either local store or a dummy store for the given name.
 *
 * @date	23/1/19
 * @since	5.7.10
 *
 * @param	string $name The store name (fields|groups).
 * @return	ACF_Data
 */
function acf_get_local_store($name = '')
{
}
/**
 * acf_reset_local
 *
 * Resets the local data.
 *
 * @date	22/1/19
 * @since	5.7.10
 *
 * @param	void
 * @return	void
 */
function acf_reset_local()
{
}
/**
 * acf_get_local_field_groups
 *
 * Returns all local field groups.
 *
 * @date	22/1/19
 * @since	5.7.10
 *
 * @param	void
 * @return	array
 */
function acf_get_local_field_groups()
{
}
/**
 * acf_have_local_field_groups
 *
 * description
 *
 * @date	22/1/19
 * @since	5.7.10
 *
 * @param	type $var Description. Default.
 * @return	type Description.
 */
function acf_have_local_field_groups()
{
}
/**
 * acf_count_local_field_groups
 *
 * description
 *
 * @date	22/1/19
 * @since	5.7.10
 *
 * @param	type $var Description. Default.
 * @return	type Description.
 */
function acf_count_local_field_groups()
{
}
/**
 * acf_add_local_field_group
 *
 * Adds a local field group.
 *
 * @date	22/1/19
 * @since	5.7.10
 *
 * @param	array $field_group The field group array.
 * @return	void
 */
function acf_add_local_field_group($field_group)
{
}
/**
 * register_field_group
 *
 * See acf_add_local_field_group().
 *
 * @date	22/1/19
 * @since	5.7.10
 *
 * @param	array $field_group The field group array.
 * @return	void
 */
function register_field_group($field_group)
{
}
/**
 * acf_remove_local_field_group
 *
 * Removes a field group for the given key.
 *
 * @date	22/1/19
 * @since	5.7.10
 *
 * @param	string $key The field group key.
 * @return	bool
 */
function acf_remove_local_field_group($key = '')
{
}
/**
 * acf_is_local_field_group
 *
 * Returns true if a field group exists for the given key.
 *
 * @date	22/1/19
 * @since	5.7.10
 *
 * @param	string $key The field group key.
 * @return	bool
 */
function acf_is_local_field_group($key = '')
{
}
/**
 * acf_is_local_field_group_key
 *
 * Returns true if a field group exists for the given key.
 *
 * @date	22/1/19
 * @since	5.7.10
 *
 * @param	string $key The field group group key.
 * @return	bool
 */
function acf_is_local_field_group_key($key = '')
{
}
/**
 * acf_get_local_field_group
 *
 * Returns a field group for the given key.
 *
 * @date	22/1/19
 * @since	5.7.10
 *
 * @param	string $key The field group key.
 * @return	array|null
 */
function acf_get_local_field_group($key = '')
{
}
/**
 * acf_add_local_fields
 *
 * Adds an array of local fields.
 *
 * @date	22/1/19
 * @since	5.7.10
 *
 * @param	array $fields An array of un prepared fields.
 * @return	array
 */
function acf_add_local_fields($fields = array())
{
}
/**
 * acf_get_local_fields
 *
 * Returns all local fields for the given parent.
 *
 * @date	22/1/19
 * @since	5.7.10
 *
 * @param	string $parent The parent key.
 * @return	array
 */
function acf_get_local_fields($parent = '')
{
}
/**
 * acf_have_local_fields
 *
 * Returns true if local fields exist.
 *
 * @date	22/1/19
 * @since	5.7.10
 *
 * @param	string $parent The parent key.
 * @return	bool
 */
function acf_have_local_fields($parent = '')
{
}
/**
 * acf_count_local_fields
 *
 * Returns the number of local fields for the given parent.
 *
 * @date	22/1/19
 * @since	5.7.10
 *
 * @param	string $parent The parent key.
 * @return	int
 */
function acf_count_local_fields($parent = '')
{
}
/**
 * acf_add_local_field
 *
 * Adds a local field.
 *
 * @date	22/1/19
 * @since	5.7.10
 *
 * @param	array $field The field array.
 * @param	bool $prepared Whether or not the field has already been prepared for import.
 * @return	void
 */
function acf_add_local_field($field, $prepared = \false)
{
}
/**
 * _acf_generate_local_key
 *
 * Generates a unique key based on the field's parent.
 *
 * @date	22/1/19
 * @since	5.7.10
 *
 * @param	string $key The field key.
 * @return	bool
 */
function _acf_generate_local_key($field)
{
}
/**
 * acf_remove_local_field
 *
 * Removes a field for the given key.
 *
 * @date	22/1/19
 * @since	5.7.10
 *
 * @param	string $key The field key.
 * @return	bool
 */
function acf_remove_local_field($key = '')
{
}
/**
 * acf_is_local_field
 *
 * Returns true if a field exists for the given key or name.
 *
 * @date	22/1/19
 * @since	5.7.10
 *
 * @param	string $key The field group key.
 * @return	bool
 */
function acf_is_local_field($key = '')
{
}
/**
 * acf_is_local_field_key
 *
 * Returns true if a field exists for the given key.
 *
 * @date	22/1/19
 * @since	5.7.10
 *
 * @param	string $key The field group key.
 * @return	bool
 */
function acf_is_local_field_key($key = '')
{
}
/**
 * acf_get_local_field
 *
 * Returns a field for the given key.
 *
 * @date	22/1/19
 * @since	5.7.10
 *
 * @param	string $key The field group key.
 * @return	array|null
 */
function acf_get_local_field($key = '')
{
}
/**
 * _acf_apply_get_local_field_groups
 *
 * Appends local field groups to the provided array. 
 *
 * @date	23/1/19
 * @since	5.7.10
 *
 * @param	array $field_groups An array of field groups.
 * @return	array
 */
function _acf_apply_get_local_field_groups($groups = array())
{
}
/**
 * _acf_apply_is_local_field_key
 *
 * Returns true if is a local key.
 *
 * @date	23/1/19
 * @since	5.7.10
 *
 * @param	bool $bool The result.
 * @param	string $id The identifier.
 * @return	bool
 */
function _acf_apply_is_local_field_key($bool, $id)
{
}
/**
 * _acf_apply_is_local_field_group_key
 *
 * Returns true if is a local key.
 *
 * @date	23/1/19
 * @since	5.7.10
 *
 * @param	bool $bool The result.
 * @param	string $id The identifier.
 * @return	bool
 */
function _acf_apply_is_local_field_group_key($bool, $id)
{
}
/**
 * _acf_do_prepare_local_fields
 *
 * Local fields that are added too early will not be correctly prepared by the field type class. 
 *
 * @date	23/1/19
 * @since	5.7.10
 *
 * @param	void
 * @return	void
 */
function _acf_do_prepare_local_fields()
{
}
// class_exists check
/*
*  acf_save_post_revision
*
*  This function will copy meta from a post to it's latest revision
*
*  @type	function
*  @date	26/09/2016
*  @since	5.4.0
*
*  @param	int $post_id
*  @return	void
*/
function acf_save_post_revision($post_id = 0)
{
}
/*
*  acf_get_post_latest_revision
*
*  This function will return the latest revision for a given post
*
*  @type	function
*  @date	25/06/2016
*  @since	5.3.8
*
*  @param	int $post_id
*  @return	int $post_id
*/
function acf_get_post_latest_revision($post_id)
{
}
// class_exists check
/*
*  acf_register_field_type
*
*  alias of acf()->fields->register_field_type()
*
*  @type	function
*  @date	31/5/17
*  @since	5.6.0
*
*  @param	void
*  @return	void
*/
function acf_register_field_type($class)
{
}
/*
*  acf_register_field_type_info
*
*  alias of acf()->fields->register_field_type_info()
*
*  @type	function
*  @date	31/5/17
*  @since	5.6.0
*
*  @param	void
*  @return	void
*/
function acf_register_field_type_info($info)
{
}
/*
*  acf_get_field_type
*
*  alias of acf()->fields->get_field_type()
*
*  @type	function
*  @date	31/5/17
*  @since	5.6.0
*
*  @param	void
*  @return	void
*/
function acf_get_field_type($name)
{
}
/*
*  acf_get_field_types
*
*  alias of acf()->fields->get_field_types()
*
*  @type	function
*  @date	31/5/17
*  @since	5.6.0
*
*  @param	void
*  @return	void
*/
function acf_get_field_types($args = array())
{
}
/**
*  acf_get_field_types_info
*
*  Returns an array containing information about each field type
*
*  @date	18/6/18
*  @since	5.6.9
*
*  @param	type $var Description. Default.
*  @return	type Description.
*/
function acf_get_field_types_info($args = array())
{
}
/*
*  acf_is_field_type
*
*  alias of acf()->fields->is_field_type()
*
*  @type	function
*  @date	31/5/17
*  @since	5.6.0
*
*  @param	void
*  @return	void
*/
function acf_is_field_type($name = '')
{
}
/*
*  acf_get_field_type_prop
*
*  This function will return a field type's property
*
*  @type	function
*  @date	1/10/13
*  @since	5.0.0
*
*  @param	void
*  @return	array
*/
function acf_get_field_type_prop($name = '', $prop = '')
{
}
/*
*  acf_get_field_type_label
*
*  This function will return the label of a field type
*
*  @type	function
*  @date	1/10/13
*  @since	5.0.0
*
*  @param	void
*  @return	array
*/
function acf_get_field_type_label($name = '')
{
}
/*
*  acf_field_type_exists (deprecated)
*
*  deprecated in favour of acf_is_field_type()
*
*  @type	function
*  @date	1/10/13
*  @since	5.0.0
*
*  @param	string $type
*  @return	boolean
*/
function acf_field_type_exists($type = '')
{
}
/*
*  acf_get_grouped_field_types
*
*  Returns an multi-dimentional array of field types "name => label" grouped by category
*
*  @type	function
*  @date	1/10/13
*  @since	5.0.0
*
*  @param	void
*  @return	array
*/
function acf_get_grouped_field_types()
{
}
// class_exists check
/*
*  acf_register_location_rule
*
*  alias of acf()->locations->register_location()
*
*  @type	function
*  @date	31/5/17
*  @since	5.6.0
*
*  @param	void
*  @return	void
*/
function acf_register_location_rule($class)
{
}
/*
*  acf_get_location_rule
*
*  alias of acf()->locations->get_location()
*
*  @type	function
*  @date	31/5/17
*  @since	5.6.0
*
*  @param	void
*  @return	void
*/
function acf_get_location_rule($name)
{
}
/*
*  acf_get_location_rule_types
*
*  alias of acf()->locations->get_locations()
*
*  @type	function
*  @date	31/5/17
*  @since	5.6.0
*
*  @param	void
*  @return	void
*/
function acf_get_location_rule_types()
{
}
/**
*  acf_validate_location_rule
*
*  Returns a valid location rule array.
*
*  @date	28/8/18
*  @since	5.7.4
*
*  @param	$rule array The rule array.
*  @return	array
*/
function acf_validate_location_rule($rule = \false)
{
}
/*
*  acf_get_location_rule_operators
*
*  This function will return the operators for a given rule
*
*  @type	function
*  @date	30/5/17
*  @since	5.6.0
*
*  @param	array $rule
*  @return	array
*/
function acf_get_location_rule_operators($rule)
{
}
/*
*  acf_get_location_rule_values
*
*  This function will return the values for a given rule 
*
*  @type	function
*  @date	30/5/17
*  @since	5.6.0
*
*  @param	array $rule
*  @return	array
*/
function acf_get_location_rule_values($rule)
{
}
/*
*  acf_match_location_rule
*
*  This function will match a given rule to the $screen
*
*  @type	function
*  @date	30/5/17
*  @since	5.6.0
*
*  @param	array $rule
*  @param	array $screen
*  @return	boolean
*/
function acf_match_location_rule($rule, $screen, $field_group)
{
}
/*
*  acf_get_location_screen
*
*  This function will return a valid location screen array
*
*  @type	function
*  @date	30/5/17
*  @since	5.6.0
*
*  @param	array $screen
*  @param	array $field_group
*  @return	array
*/
function acf_get_location_screen($screen = array(), $field_group = \false)
{
}
/**
*  acf_get_valid_location_rule
*
*  Deprecated in 5.7.4. Use acf_validate_location_rule() instead.
*
*  @date	30/5/17
*  @since	5.6.0
*
*  @param	$rule array The rule array.
*  @return	array
*/
function acf_get_valid_location_rule($rule)
{
}
/*
 * acf_get_locale
 *
 * Returns the current locale.
 *
 * @date	16/12/16
 * @since	5.5.0
 *
 * @param	void
 * @return	string
 */
function acf_get_locale()
{
}
/**
 * acf_load_textdomain
 *
 * Loads the plugin's translated strings similar to load_plugin_textdomain().
 *
 * @date	8/1/19
 * @since	5.7.10
 *
 * @param	string $locale The plugin's current locale.
 * @return	void
 */
function acf_load_textdomain($domain = 'acf')
{
}
/**
 * _acf_apply_language_cache_key
 *
 * Applies the current language to the cache key.
 *
 * @date	23/1/19
 * @since	5.7.11
 *
 * @param	string $key The cache key.
 * @return	string
 */
function _acf_apply_language_cache_key($key)
{
}
/**
 * acf_get_post_templates
 *
 * Returns an array of post_type => templates data.
 *
 * @date	29/8/17
 * @since	5.6.2
 *
 * @param	void
 * @return	array
 */
function acf_get_post_templates()
{
}
/*
*  acf_updates
*
*  The main function responsible for returning the one true acf_updates instance to functions everywhere.
*  Use this function like you would a global variable, except without needing to declare the global.
*
*  Example: <?php $acf_updates = acf_updates(); ?>
*
*  @date	9/4/17
*  @since	5.5.12
*
*  @param	void
*  @return	object
*/
function acf_updates()
{
}
/*
*  acf_register_plugin_update
*
*  Alias of acf_updates()->add_plugin().
*
*  @type	function
*  @date	12/4/17
*  @since	5.5.10
*
*  @param	array $plugin
*  @return	void
*/
function acf_register_plugin_update($plugin)
{
}
// class_exists check
/**
 * acf_setup_meta
 *
 * Adds postmeta to storage.
 *
 * @date	8/10/18
 * @since	5.8.0
 * @see		ACF_Local_Meta::add() for list of parameters.
 *
 * @return	array
 */
function acf_setup_meta($meta = array(), $post_id = 0, $is_main = \false)
{
}
/**
 * acf_reset_meta
 *
 * Removes postmeta to storage.
 *
 * @date	8/10/18
 * @since	5.8.0
 * @see		ACF_Local_Meta::remove() for list of parameters.
 *
 * @return	void
 */
function acf_reset_meta($post_id = 0)
{
}
/**
 * acf_get_reference
 *
 * Retrieves the field key for a given field name and post_id.
 *
 * @date	26/1/18
 * @since	5.6.5
 *
 * @param	string $field_name The name of the field. eg 'sub_heading'.
 * @param	mixed $post_id The post_id of which the value is saved against.
 * @return	string The field key.
 */
function acf_get_reference($field_name, $post_id)
{
}
/**
 * acf_get_value
 *
 * Retrieves the value for a given field and post_id.
 *
 * @date	28/09/13
 * @since	5.0.0
 *
 * @param	int|string $post_id The post id.
 * @param	array $field The field array.
 * @return	mixed.
 */
function acf_get_value($post_id = 0, $field)
{
}
/**
 * acf_format_value
 *
 * Returns a formatted version of the provided value.
 *
 * @date	28/09/13
 * @since	5.0.0
 *
 * @param	mixed $value The field value.
 * @param	int|string $post_id The post id.
 * @param	array $field The field array.
 * @return	mixed.
 */
function acf_format_value($value, $post_id, $field)
{
}
/**
 * acf_update_value
 *
 * Updates the value for a given field and post_id.
 *
 * @date	28/09/13
 * @since	5.0.0
 *
 * @param	mixed $value The new value.
 * @param	int|string $post_id The post id.
 * @param	array $field The field array.
 * @return	bool.
 */
function acf_update_value($value = \null, $post_id = 0, $field)
{
}
/**
 * acf_update_values
 *
 * Updates an array of values.
 *
 * @date	26/2/19
 * @since	5.7.13
 *
 * @param	array values The array of values.
 * @param	int|string $post_id The post id.
 * @return	void
 */
function acf_update_values($values = array(), $post_id = 0)
{
}
/**
 * acf_flush_value_cache
 *
 * Deletes all cached data for this value.
 *
 * @date	22/1/19
 * @since	5.7.10
 *
 * @param	int|string $post_id The post id.
 * @param	string $field_name The field name.
 * @return	void
 */
function acf_flush_value_cache($post_id = 0, $field_name = '')
{
}
/**
 * acf_delete_value
 *
 * Deletes the value for a given field and post_id.
 *
 * @date	28/09/13
 * @since	5.0.0
 *
 * @param	int|string $post_id The post id.
 * @param	array $field The field array.
 * @return	bool.
 */
function acf_delete_value($post_id, $field)
{
}
/**
 * acf_preview_value
 *
 * Return a human friendly 'preview' for a given field value.
 *
 * @date	28/09/13
 * @since	5.0.0
 *
 * @param	mixed $value The new value.
 * @param	int|string $post_id The post id.
 * @param	array $field The field array.
 * @return	bool.
 */
function acf_preview_value($value, $post_id, $field)
{
}
/**
 * acf_set_form_data
 *
 * Sets data about the current form.
 *
 * @date	6/10/13
 * @since	5.0.0
 *
 * @param	string $name The store name.
 * @param	array $data Array of data to start the store with.
 * @return	ACF_Data
 */
function acf_set_form_data($name = '', $data = \false)
{
}
/**
 * acf_get_form_data
 *
 * Gets data about the current form.
 *
 * @date	6/10/13
 * @since	5.0.0
 *
 * @param	string $name The store name.
 * @return	mixed
 */
function acf_get_form_data($name = '')
{
}
/**
 * acf_form_data
 *
 * Called within a form to set important information and render hidden inputs.
 *
 * @date	15/10/13
 * @since	5.0.0
 *
 * @param	void
 * @return	void
 */
function acf_form_data($data = array())
{
}
/**
 * acf_save_post
 *
 * Saves the $_POST data.
 *
 * @date	15/10/13
 * @since	5.0.0
 *
 * @param	int|string $post_id The post id.
 * @param	array $values An array of values to override $_POST.
 * @return	bool True if save was successful.
 */
function acf_save_post($post_id = 0, $values = \null)
{
}
/**
 * _acf_do_save_post
 *
 * Private function hooked into 'acf/save_post' to actually save the $_POST data.
 * This allows developers to hook in before and after ACF has actually saved the data.
 *
 * @date	11/1/19
 * @since	5.7.10
 *
 * @param	int|string $post_id The post id.
 * @return	void
 */
function _acf_do_save_post($post_id = 0)
{
}
// class_exists check
/*
*  acf_write_json_field_group
*
*  This function will save a field group to a json file within the current theme
*
*  @type	function
*  @date	5/12/2014
*  @since	5.1.5
*
*  @param	array $field_group
*  @return	boolean
*/
function acf_write_json_field_group($field_group)
{
}
/*
*  acf_delete_json_field_group
*
*  This function will delete a json field group file
*
*  @type	function
*  @date	5/12/2014
*  @since	5.1.5
*
*  @param	string $key
*  @return	boolean
*/
function acf_delete_json_field_group($key)
{
}
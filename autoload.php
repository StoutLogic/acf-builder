<?php

namespace StoutLogic\AcfBuilder;

/**
 * Autoloader for use without composer.
 *
 * Simply require this file somewhere in your code.
 *
 * To learn more about PHP namespaces see:
 * http://php.net/manual/en/language.namespaces.php
 * 
 * To learn more about autoloading, see
 * http://php.net/manual/en/function.autoload.php
 *
 * If your project is using composer, ignore this file.
 * To learn more about composer see:
 * https://getcomposer.org and http://composer.rarst.net
 */

spl_autoload_register(function($cls) {
    $cls = ltrim($cls, '\\');
    if (strpos($cls, __NAMESPACE__) !== 0) {
        return;
    }

    $classWithoutBaseNamespace = str_replace(__NAMESPACE__, '', $cls);

    // Load files from 'src' directory based on their class name without
    // the StoutLogic\AcfBuilder namespace.
    $path = dirname(__FILE__).
            DIRECTORY_SEPARATOR.
            'src'.
            str_replace('\\', DIRECTORY_SEPARATOR, $classWithoutBaseNamespace).
            '.php';

    require_once($path);
});

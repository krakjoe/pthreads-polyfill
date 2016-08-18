<?php
/**
 * Load pthreads constants.
 *
 * @see http://php.net/manual/en/pthreads.constants.php
 */

if (!extension_loaded('pthreads')) {
    /**
     * The default options for all Threads, causes pthreads to copy the environment
     * when new Threads are started
     * @link http://php.net/manual/en/pthreads.constants.php
     */
    if (!defined('PTHREADS_INHERIT_ALL')) {
        define('PTHREADS_INHERIT_ALL', 1118481);
    }

    /**
     * Do not inherit anything when new Threads are started
     * @link http://php.net/manual/en/pthreads.constants.php
     */
    if (!defined('PTHREADS_INHERIT_NONE')) {
        define('PTHREADS_INHERIT_NONE', 0);
    }

    /**
     * Inherit INI entries when new Threads are started
     * @link http://php.net/manual/en/pthreads.constants.php
     */
    if (!defined('PTHREADS_INHERIT_INI')) {
        define('PTHREADS_INHERIT_INI', 1);
    }

    /**
     * Inherit user declared constants when new Threads are started
     * @link http://php.net/manual/en/pthreads.constants.php
     */
    if (!defined('PTHREADS_INHERIT_CONSTANTS')) {
        define('PTHREADS_INHERIT_CONSTANTS', 16);
    }

    /**
     * Inherit user declared classes when new Threads are started
     * @link http://php.net/manual/en/pthreads.constants.php
     */
    if (!defined('PTHREADS_INHERIT_CLASSES')) {
        define('PTHREADS_INHERIT_CLASSES', 4096);
    }

    /**
     * Inherit user declared functions when new Threads are started
     * @link http://php.net/manual/en/pthreads.constants.php
     */
    if (!defined('PTHREADS_INHERIT_FUNCTIONS')) {
        define('PTHREADS_INHERIT_FUNCTIONS', 256);
    }

    /**
     * Inherit included file information when new Threads are started
     * @link http://php.net/manual/en/pthreads.constants.php
     */
    if (!defined('PTHREADS_INHERIT_INCLUDES')) {
        define('PTHREADS_INHERIT_INCLUDES', 65536);
    }

    /**
     * Inherit all comments when new Threads are started
     * @link http://php.net/manual/en/pthreads.constants.php
     */
    if (!defined('PTHREADS_INHERIT_COMMENTS')) {
        define('PTHREADS_INHERIT_COMMENTS', 1048576);
    }

    /**
     * Allow new Threads to send headers to standard output (normally prohibited)
     * @link http://php.net/manual/en/pthreads.constants.php
     */
    if (!defined('PTHREADS_ALLOW_HEADERS')) {
        define('PTHREADS_ALLOW_HEADERS', 16777216);
    }
}

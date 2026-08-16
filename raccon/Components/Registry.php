<?php
class Registry
{
	private static $_storage = array();

	/**
	 * Store a value by key.
	 */
	public static function set($key, $value)
	{
		return self::$_storage[$key] = $value;
	}

	/**
	 * Get a value by key.
	 */
	public static function get($key, $default = null)
	{
		return (isset(self::$_storage[$key])) ? self::$_storage[$key] : $default;
	}

	/**
	 * Remove a value by key.
	 */
	public static function remove($key)
	{
		unset(self::$_storage[$key]);
		return true;
	}

	/**
	 * Clear all stored values.
	 */
	public static function clean()
	{
		self::$_storage = array();
		return true;
	}
}

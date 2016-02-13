<?php

namespace Okneloper\Session;

/**
 * Class Session
 * OOP Access to PHP's $_SESSION with namespaces.
 *
 * @package Okneloper\Session
 *
 */
class Session
{
    protected static $defaultNamespace = '_default';

    /**
     * @return string
     */
    public static function getDefaultNamespace()
    {
        return static::$defaultNamespace;
    }

    /**
     * @param string $defaultNamespace
     */
    public static function setDefaultNamespace($defaultNamespace)
    {
        static::$defaultNamespace = $defaultNamespace;
    }


    public static function start()
    {
        if (isset($_SESSION)) {
            return;
        }
        session_start();
    }

    /**
     * @param $namespace
     *
     * @return Session
     */
    public static function newInstance($namespace = null)
    {
        static::start();
        return new static($namespace);
    }

    /**
     * @var string
     */
    protected $namespace;

    /**
     * Session constructor.
     * @param null|string $namespace
     */
    public function __construct($namespace = null)
    {
        if ($namespace === null) {
            $namespace = static::$defaultNamespace;
        }
        $this->namespace = $namespace;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function __get($key)
    {
        if (!isset($_SESSION[$this->namespace]) || !isset($_SESSION[$this->namespace][$key])) {
            return null;
        }
        return $_SESSION[$this->namespace][$key];
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return mixed
     */
    public function __set($key, $value)
    {
        if (!isset($_SESSION[$this->namespace])) {
            $_SESSION[$this->namespace] = array();
        }
        return $_SESSION[$this->namespace][$key] = $value;
    }

    /**
     * @param $key
     */
    public function __unset($key)
    {
        if (!isset($_SESSION[$this->namespace])) {
            return;
        }
        unset($_SESSION[$this->namespace][$key]);
    }

    /**
     * Unset all the data and the namespace from session
     */
    public function clear()
    {
        if (isset($_SESSION[$this->namespace])) {
            unset($_SESSION[$this->namespace]);
        }
    }
}

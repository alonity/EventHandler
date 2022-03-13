<?php

/**
 * Event Handler class
 *
 *
 * @author Qexy admin@qexy.org
 *
 * @copyright © 2022 Alonity
 *
 * @package alonity\eventhandler
 *
 * @license MIT
 *
 * @version 1.1.0
 *
 */

namespace alonity\events;

class Handler {
    const VERSION = '1.1.0';

    private static $events = [];

    /**
     * Event listen
     *
     * @param string $eventName
     *
     * @param callable $callback
     *
     * @param string|int|null $keyname
    */
    public static function listen(string $eventName, callable $callback, $keyname = null){
        if(!isset(self::$events[$eventName])){
            self::$events[$eventName] = [];
        }

        if(!is_null($keyname)){
            self::$events[$eventName][$keyname] = $callback;
        }else{
            self::$events[$eventName][] = $callback;
        }
    }

    /**
     * Emit event
     *
     * @param string $name
     *
     * @param array|null $params
     *
     * @param string|int|null
     *
     * @return bool
    */
    public static function emit(string $name, array $params = null, $keyname = null) : bool {
        $events = self::$events;

        if(!isset($events[$name])){
            return false;
        }

        if(!is_null($keyname)){
            $events[$name][$keyname]($params);

            return true;
        }

        foreach($events[$name] as $event){
            $event($params);
        }

        return true;
    }

    /**
     * @param string $name
     *
     * @return bool
    */
    public static function removeListener(string $name) : bool {
        if(isset(self::$events[$name])){
            unset(self::$events[$name]);

            return true;
        }

        return false;
    }

    /**
     * @param array $names
     *
     * @return integer
    */
    public static function removeListeners(array $names) : int {
        $count = 0;

        foreach($names as $name){
            if(isset(self::$events[$name])){
                unset(self::$events[$name]);
                $count++;
            }
        }

        return $count;
    }

    /**
     * Remove all listeners
     * Return count of removed
     *
     * @return integer
     */
    public static function removeAll() : int {
        $count = count(self::$events);

        self::$events = [];

        return $count;
    }

    /**
     * Get all listeners names
     *
     * @return array
     */
    public static function getListenters() : array {
        return array_keys(self::$events);
    }
}

?>
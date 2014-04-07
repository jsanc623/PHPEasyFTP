<?php

namespace jsanc623\PHPEasyFTP;


/**
 * Class Error
 *
 * @package jsanc623\PHPEasyFTP
 */
class Error {

    static public $log_file = "/var/log/PHPEasyFTP.err.log";

    /**
     * @param $message
     * @param $line
     * @param $file
     * @param $trace
     */
    public static function LogAndDie( $message, $line = "", $file = "", $trace = "" ) {
        self::writeToLog( $message, $line, $file, $trace );
        die( "<b>(" . $line . " " . $file . ")</b> Caught exception: " . $message );
    }

    /**
     * @param        $message
     * @param string $line
     * @param string $file
     * @param string $trace
     */
    public static function JustLog( $message, $line = "", $file = "", $trace = "" ) {
        self::writeToLog( $message, $line, $file, $trace );
    }

    /**
     * @param        $message
     * @param string $line
     * @param string $file
     * @param string $trace
     */
    private static function writeToLog( $message, $line = "", $file = "", $trace = "" ) {
        $handler = fopen( self::$log_file, "a" );
        fwrite( $handler, microtime( true ) . " " . $line . " " . $file . " " . $message . " " . $trace );
        fclose( $handler );
    }

}
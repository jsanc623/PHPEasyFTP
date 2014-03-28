<?php

namespace jsanc623\PHPEasyFTP;

use jsanc623\PHPEasyFTP\Error;
use jsanc623\PHPEasyFTP\Connection;

/**
 * Class FTP
 *
 * @package jsanc623\PHPEasyFTP
 */
class FTP {
    protected $connection;

    /**
     *
     */
    public function __construct($server, $username, $password, $port){
        $this->connection = new Connection( $server, $username, $password, $port );
    }

    /**
     * @param $source
     * @param $destination
     */
    public function Upload( $source, $destination ){
        FileManager::UploadFile( $this->connection, $source, $destination );
    }


}
<?php

namespace jsanc623\PHPEasyFTP;

use jsanc623\PHPEasyFTP\Error;

/**
 * Class Connection
 *
 * @package jsanc623\PHPEasyFTP
 */
class Connection {

    /**
     * @var string
     */
    private $ftp_server;

    /**
     * @var int
     */
    private $ftp_port = 22;

    /**
     * @var int
     */
    private $ftp_timeout = 60;

    /**
     * @var string
     */
    private $ftp_username = "";

    /**
     * @var string
     */
    private $ftp_password = "";

    /**
     * @var string
     */
    private $connection_id = "";

    /**
     * @var string
     */
    private $connection_result = "";

    /**
     *
     */
    public function __construct( $server, $username, $password, $port = 22 ) {
        $this->ftp_server   = $server;
        $this->ftp_username = $username;
        $this->ftp_password = $password;
        $this->ftp_port     = $port;

        $this->createConnection();
        $this->loginConnection();

        if ( ( !$this->connection_id ) || ( !$this->connection_result ) ) {
            Error::LogAndDie( 'Connection failed due to unknown failure.', 28, 'jsanc623\PHPEasyFTP\Connection.php' );
        }

        return $this->getConnectionId();
    }

    /**
     * @return string
     */
    public function getConnectionId() {
        return $this->connection_id;
    }

    /**
     * @return string
     */
    public function getConnectionResult() {
        return $this->connection_result;
    }

    /**
     * @return bool
     */
    public function CloseConnection() {
        Error::JustLog( "Connection " . $this->connection_id . " closed." );
        return ftp_close($this->connection_id);
    }

    /**
     * @return resource
     */
    private function createConnection() {
        try {
            $this->connection_id = ftp_connect( $this->ftp_server, $this->ftp_port, $this->ftp_timeout );
        } catch ( \Exception $e ) {
            Error::LogAndDie( $e->getMessage(), $e->getLine(), $e->getFile(), $e->getTraceAsString() );
        }

        Error::JustLog( "Connection " . $this->connection_id . " opened." );
        return $this->connection_id;
    }

    /**
     * @return bool
     */
    private function loginConnection() {
        try {
            $this->connection_result = ftp_login( $this->connection_id, $this->ftp_username, $this->ftp_password );
        } catch ( \Exception $e ) {
            Error::LogAndDie( $e->getMessage(), $e->getLine(), $e->getFile(), $e->getTraceAsString() );
        }

        Error::JustLog( "Connection " . $this->connection_id . " logged in." );
        return $this->connection_result;
    }

}
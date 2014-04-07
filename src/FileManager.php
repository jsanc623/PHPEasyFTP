<?php

namespace jsanc623\PHPEasyFTP;


/**
 * Class FileManager
 *
 * @package jsanc623\PHPEasyFTP
 */
class FileManager {

    /**
     * @param $connection_id
     * @param $source
     * @param $destination
     * @return bool
     */
    public static function UploadFile( $connection_id, $source, $destination ) {
        if ( ftp_put( $connection_id, $destination, $source, FTP_BINARY ) ) {
            Error::JustLog( "Upload successful: " . $source . " to " . $destination );

            return true;
        } else {
            Error::JustLog( "Failed to upload " . $source . " to " . $destination );
        }
    }

    public static function DownloadFile( $connection_id, $source, $destination ) {
        if ( ftp_get( $connection_id, $destination, $source, FTP_BINARY ) ) {
            Error::JustLog( "Upload successful: " . $source . " to " . $destination );

            return true;
        } else {
            Error::JustLog( "Failed to upload " . $source . " to " . $destination );
        }

        return true;
    }
}
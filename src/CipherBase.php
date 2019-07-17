<?php

namespace Drupal\super_cipher;

/**
 * Provider base class for other cipher libraries.
 */
abstract class CipherBase {

    /**
     * Generates key for 
     */
    public function generateKey($input, $method = 'md5') {
        
        // Generating based on selected method
        switch($method) {

            case 'sha256':
            $key = hash('sha256', $input);
            break;

            case 'md5': 
            default:
            $key = md5($input);
            break;
        }       

        return $key;
    }

    /**
     * Encrypt function declaration to be implemented by child class.
     */
    abstract protected function encrypt($string, $key);

    /**
     * Decrypt function declaration to be implemented by child class.
     */  
    abstract protected function decrypt($string, $key);
}
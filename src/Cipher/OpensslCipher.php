<?php

namespace Drupal\super_cipher\Cipher;

use Drupal\super_cipher\CipherBase;

/**
 * Class interface of OpenSSL encryption functionality
 */
class OpensslCipher extends CipherBase {

    /**
     * Encryption method
     */
    private $encrypt_method = 'AES-256-CBC';
    
    /**
     * Initialization Vector
     */
    private $iv = "";

    /**
     * Constructor for OpensslCipher objects.
     *
     */     
    public function __construct($encrypt_method) {
        $this->encrypt_method = $encrypt_method;
    }

    /**
     * Set Initialization Vector
     */
    public function setIV($iv_input) {  
        $this->iv = substr(hash('sha256', $iv_input), 0, 16);      
    }

    /**
     * Returns encrypted string using openssl functionality
     */
    public function encrypt($string, $key) {
        // Encrypt the User string
        $output = openssl_encrypt($string, $this->encrypt_method, $key, 0, $this->iv);
        $output = base64_encode($output);

        return $output;
    }
    
    /**
     * Returns decrypted string using openssl functionality
     */
    public function decrypt($string, $key) {
        // Decrypt the User string
        $output = openssl_decrypt(base64_decode($string), $this->encrypt_method, $key, 0, $this->iv);

        return $output;
    }
}
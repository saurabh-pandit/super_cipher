<?php

namespace Drupal\super_cipher\Cipher;

use Drupal\super_cipher\CipherBase;

/**
 * Class interface of Mencrypt encryption functionality
 */
class McryptCipher extends CipherBase {

   /**
     * Encryption method
     */
    private $encrypt_method = 'rijndael-256';
    
    /**
     * Initialization Vector
     */
    private $iv = "";

    /**
     * Constructor for Mcrypt objects.
     *
     */     
    public function __construct($encrypt_method) {
        $this->encrypt_method = $encrypt_method;
    }

    /**
     * Returns encrypted string using mencrypt functionality
     */
    public function encrypt($string, $key) {
        //Open the module
        $mcrypt = mcrypt_module_open($this->encrypt_method, '', 'cbc', '');
        //Define initialization vector
        $this->iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($mcrypt), MCRYPT_DEV_RANDOM);
        // Encrypt the string
        mcrypt_generic_init($mcrypt, $key, $this->iv);
        $output = mcrypt_generic($mcrypt, $string);
        mcrypt_generic_deinit($mcrypt);
        mcrypt_module_close($mcrypt);
        
        return $output;
    }
    
    /**
     * Returns decrypted string using mencrypt functionality
     */
    public function decrypt($string, $key) {             
        // Open the module
        $mcrypt = mcrypt_module_open($this->encrypt_method, '', 'cbc', '');
        //Open buffers
        mcrypt_generic_init($mcrypt, $key, $this->iv);
        // Decrypting the string
        $output = mdecrypt_generic($mcrypt, $string);
        mcrypt_generic_deinit($mcrypt);
        mcrypt_module_close($mcrypt);
        return $output;
    }
}
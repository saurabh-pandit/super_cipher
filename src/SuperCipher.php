<?php

namespace Drupal\super_cipher;

use Drupal\super_cipher\Cipher\McryptCipher;
use Drupal\super_cipher\Cipher\OpensslCipher;

/**
 * Factory class to initialize Cipher classes.
 */
class SuperCipher {

    /**
     * Initialize MencryptCipher instance
     */
    public static function createMcrypt($encrypt_method) {
        return new McryptCipher($encrypt_method);
    }
    
    /**
     * Initialize OpensslCipher instance
     */
    public static function createOpenssl($encrypt_method) {
        return new OpensslCipher($encrypt_method);
    }
}
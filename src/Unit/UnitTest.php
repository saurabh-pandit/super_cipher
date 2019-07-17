<?php

namespace Drupal\Tests\super_cipher\Unit;
use Drupal\Tests\UnitTestCase;
use Drupal\super_cipher\SuperCipher;

/**
 * Simple test to ensure that asserts pass.
 *
 * @group phpunit_example
 */
class UnitTest extends UnitTestCase {

  /**
   * @covers Drupal\super_cipher\OpensslCipher
   */
  public function testOpenssl() {

    // Sample text
    $input_text = 'This is not encoded';
    $openssl_obj = SuperCipher::createOpenssl('AES-256-CBC');
    $key = $openssl_obj->generateKey('This is a secret key', 'md5');
    $openssl_obj->setIV('This is my secret iv');
    $encrypted = $openssl_obj->encrypt($input_text, $key);
    $output = $openssl_obj->decrypt($encrypted, $key);

    // Checking if decrypted text is same as encrypted text
    $this->assertEquals($input_text, $output);
  }

  /**
   * @covers Drupal\super_cipher\McryptCipher
   */
  public function testMcrypt() {

    $input_text = 'This is not encoded';
    $mcrypt_obj = SuperCipher::createMcrypt('rijndael-256');
    $key = $mcrypt_obj->generateKey('This is a secret key', 'md5');
    $encrypted = $mcrypt_obj->encrypt($input_text, $key);
    $output = $mcrypt_obj->decrypt($encrypted, $key);
    
    // Checking if decrypted text is same as encrypted text
    $this->assertEquals($input_text, $output);
  }

}
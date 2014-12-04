<?php
namespace RNCryptor;

class CryptorTest extends \PHPUnit_Framework_TestCase {

	// relative to __DIR__
	const TEXT_FILENAME = 'lorem-ipsum.txt';

	const SAMPLE_PLAINTEXT = 'What\'s your name?  My name is Tilgath Pilesar.  Why are you crying?';
	const SAMPLE_PASSWORD = 'do-not-write-this-down';
	
	const SAMPLE_PLAINTEXT_V2_BLOCKSIZE = 'Lorem ipsum dolor sit amet, cons';

    public static function main() {
        $suite  = new PHPUnit_Framework_TestSuite(get_called_class());
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

  	public function testCanDecryptSelfEncryptedDefaultVersion() {
  		$encryptor = new Encryptor();
  		$encrypted = $encryptor->encrypt(self::SAMPLE_PLAINTEXT, self::SAMPLE_PASSWORD);
  		
  		$decryptor = new Decryptor();
  		$decrypted = $decryptor->decrypt($encrypted, self::SAMPLE_PASSWORD);
  		$this->assertEquals(self::SAMPLE_PLAINTEXT, $decrypted);
  	}

  	public function testCanDecryptSelfEncryptedStringEqualToBlockSizeMultiple() {
  		$encryptor = new Encryptor();
  		$encrypted = $encryptor->encrypt(self::SAMPLE_PLAINTEXT_V2_BLOCKSIZE, self::SAMPLE_PASSWORD);
  	
  		$decryptor = new Decryptor();
  		$decrypted = $decryptor->decrypt($encrypted, self::SAMPLE_PASSWORD);
  		$this->assertEquals(self::SAMPLE_PLAINTEXT_V2_BLOCKSIZE, $decrypted);
  	}

  	public function testCanDecryptSelfEncryptedVersion0() {
  		$encryptor = new Encryptor();
  		$encrypted = $encryptor->encrypt(self::SAMPLE_PLAINTEXT, self::SAMPLE_PASSWORD, 0);
  		
  		$decryptor = new Decryptor();
  		$decrypted = $decryptor->decrypt($encrypted, self::SAMPLE_PASSWORD);
  		$this->assertEquals(self::SAMPLE_PLAINTEXT, $decrypted);
  	}

  	public function testCanDecryptSelfEncryptedVersion1() {
  		$encryptor = new Encryptor();
  		$encrypted = $encryptor->encrypt(self::SAMPLE_PLAINTEXT, self::SAMPLE_PASSWORD, 1);
  		
  		$decryptor = new Decryptor();
  		$decrypted = $decryptor->decrypt($encrypted, self::SAMPLE_PASSWORD);
  		$this->assertEquals(self::SAMPLE_PLAINTEXT, $decrypted);
  	}
  	
  	public function testCanDecryptSelfEncryptedVersion2() {
  		$encryptor = new Encryptor();
  		$encrypted = $encryptor->encrypt(self::SAMPLE_PLAINTEXT, self::SAMPLE_PASSWORD, 2);
  	
  		$decryptor = new Decryptor();
  		$decrypted = $decryptor->decrypt($encrypted, self::SAMPLE_PASSWORD);
  		$this->assertEquals(self::SAMPLE_PLAINTEXT, $decrypted);
  	}

  	public function testCanDecryptLongText() {

  		$text = file_get_contents(__DIR__ . '/_files/lorem-ipsum.txt');
  	
  		$encryptor = new Encryptor();
  		$encrypted = $encryptor->encrypt($text, self::SAMPLE_PASSWORD);
  	
  		$decryptor = new Decryptor();
  		$decrypted = $decryptor->decrypt($encrypted, self::SAMPLE_PASSWORD);
  		$this->assertEquals($text, $decrypted);
  	}

  	public function testVersion1TruncatesMultibytePasswords() {
  		$password1 = '中文密码';
  		$encryptor = new Encryptor();
  		$encrypted = $encryptor->encrypt(self::SAMPLE_PLAINTEXT, $password1, 1);

  		// Yikes, it's truncated! So with an all-multibyte password
  		// like above, we can replace the last half of the string
  		// with whatver we want, and decryption will still work.
  		$password2 = '中文中文';
  		$decryptor = new Decryptor();
  		$decrypted = $decryptor->decrypt($encrypted, $password2);
  		$this->assertEquals(self::SAMPLE_PLAINTEXT, $decrypted);
  	
  		$decryptor = new Decryptor();
  		$decrypted = $decryptor->decrypt($encrypted, $password1);
  		$this->assertEquals(self::SAMPLE_PLAINTEXT, $decrypted);
  	}

  	public function testVersion2TruncatesMultibytePasswords() {
  		$password1 = '中文密码';
  		$encryptor = new Encryptor();
  		$encrypted = $encryptor->encrypt(self::SAMPLE_PLAINTEXT, $password1, 2);

  		// Yikes, it's truncated! So with an all-multibyte password
  		// like above, we can replace the last half of the string
  		// with whatver we want, and decryption will still work.
  		$password2 = '中文中文';
  		$decryptor = new Decryptor();
  		$decrypted = $decryptor->decrypt($encrypted, $password2);
  		$this->assertEquals(self::SAMPLE_PLAINTEXT, $decrypted);

  		$decryptor = new Decryptor();
  		$decrypted = $decryptor->decrypt($encrypted, $password1);
  		$this->assertEquals(self::SAMPLE_PLAINTEXT, $decrypted);
  	}

  	public function testVersion3AcceptsMultibytePasswords() {
  		$password1 = '中文密码';
  		$encryptor = new Encryptor();
  		$encrypted = $encryptor->encrypt(self::SAMPLE_PLAINTEXT, $password1, 3);

  		$password2 = '中文中文';
  		$decryptor = new Decryptor();
  		$decrypted = $decryptor->decrypt($encrypted, $password2);
  		$this->assertFalse($decrypted);

  		$decryptor = new Decryptor();
  		$decrypted = $decryptor->decrypt($encrypted, $password1);
  		$this->assertEquals(self::SAMPLE_PLAINTEXT, $decrypted);
  	}

  	public function testCannotUseWithUnsupportedSchemaVersions() {
  		$fakeSchemaNumber = 57;
  		$encrypted = $this->_generateEncryptedStringWithUnsupportedSchemaNumber($fakeSchemaNumber);
  		$decryptor = new Decryptor();
  		$this->setExpectedException('Exception');
  		$decryptor->decrypt($encrypted, self::SAMPLE_PASSWORD);
  	}

  	private function _generateEncryptedStringWithUnsupportedSchemaNumber($fakeSchemaNumber) {
  		$encryptor = new Encryptor();
  		$plaintext = 'The price of ice is nice for mice';
  		$encrypted = $encryptor->encrypt($plaintext, self::SAMPLE_PASSWORD);

  		$encryptedBinary = base64_decode($encrypted);
  		$encryptedBinary = chr($fakeSchemaNumber) . substr($encryptedBinary, 1, strlen($encryptedBinary - 1));
  		return base64_encode($encryptedBinary);
  	}
}

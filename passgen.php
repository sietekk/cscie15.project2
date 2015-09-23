<?php
require 'simplehttpgetrequest.php';

class PasswordGenerator {

    const __minNumberOfWords = 1;
    const __maxNumberOfWords = 10;
    const __defaultNumberOfWords = 3;
    const __specialChars = array('!', '@', '#', '$', '%', '^', '&', '*', '(', ')');
    const __delimeters = array(' ', '-');

    protected $__wordApiURL;

    protected $__numberOfWords;
    protected $__delimeter;
    protected $__showNumber = false;
    protected $__showSpecialChar = false;    
    protected $__wordList = array();

    public function __construct($params = null) {
        $this->__numberOfWords = (isset($params['number_of_words']) && $params['number_of_words']) ? $params['number_of_words'] : self::__defaultNumberOfWords;
        $this->__showDelimeter = isset($params['show_delimeter']) && $params['show_delimeter'];
        $this->__showNumber = isset($params['show_number']) && $params['show_number'];
        $this->__showSpecialChar = isset($params['show_special_char']) && $params['show_special_char'];
        $this->__delimeter = self::__delimeters[array_rand(self::__delimeters)];
    }

    public function generate() {
        if (!$this->__wordApiURL) {
            throw new PasswordGeneratorException('No URL specified. Please specify a valid URL with setWordApiURL().');
        }

        for ($i = self::__minNumberOfWords; $i <= $this->__numberOfWords; $i++) {
            $wordApiInterface = new SimpleHttpGetRequest();
            $wordApiInterface->setURL($this->__wordApiURL);
            $data = trim($wordApiInterface->get());
            $status = $wordApiInterface->getStatus();
            
            if ($status == '200') {
                $this->__wordList[] = $data;
            } else {
                throw new PasswordGeneratorException('Data not received! Status not 200.');
            }
        }

        $this->__wordList[] = $this->__showNumber ? mt_rand(0, 100) : '';
        $this->__wordList[] = $this->__showSpecialChar ? self::__specialChars[array_rand(self::__specialChars)] : '';

        return implode($this->__delimeter, $this->__wordList);
    }

    public function setWordApiURL($url = null) {
        if ($url === null) {
            throw new PasswordGeneratorException('No URL specified. Please specify a valid URL.');
        }

        $this->__wordApiURL = $url;
    }

    public function validateNumberOfWords($number = null) {
        if ($number === null) {
            throw new PasswordGeneratorException('No value specified. Please specify a valid number.');
        }

        if (!is_int($number) || $number < self::__minNumberOfWords || $number > self::__maxNumberOfWords) {
            return false;
        } else {
            return true;
        }
    }
}

/**
 * Exception Classes
 */
class PasswordGeneratorException extends Exception {
    public function __construct($message)
    {
        $this->message = $message;
    }
}
?>

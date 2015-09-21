<?php
require 'simplehttpgetrequest.php';

class PasswordGenerator {

    protected const $__minNumberOfWords = 1;
    protected const $__maxNumberOfWords = 10;
    protected const $__specialChars = array('!', '@', '#', '$', '%', '^', '&', '*', '(', ')');
    protected const $__delimeters = array(' ', '-', ',', '/', '_');

    protected $__wordApiURL;

    protected $__numberOfWords = 3;
    protected $__delimeter;
    protected $__showNumber = false;
    protected $__showSpecialChar = false;    
    protected $__wordList = array();

    public function __construct($params) {
        $this->__numberOfWords = isset($params['number_of_words']) && $params['number_of_words'];
        $this->__showDelimeter = isset($params['show_delimeter']) && $params['show_delimeter'];
        $this->__showNumber = isset($params['show_number']) && $params['show_number'];
        $this->__showSpecialChar = isset($params['show_special_char']) && $params['show_special_char'];
        $this->__delimeter = $this->__delimeters[array_rand($this->__delimeters)];
    }

    public function generate() {
        if (!$this->wordApiURL) {
            throw new PasswordGeneratorException('No URL specified. Please specify a valid URL with setWordApiURL.');
        }

        $wordApiInterface = new SimpleHttpGetRequest();
        $wordApiInterface->setURL($this->__wordApiURL);

        for ($i = 0; $i <= ($this->__numberOfWords-1); $i++) {
            $this->__wordList[] = $wordApiInferface->get();
            $this->__wordList[] = $this->__delimeter;
        }

        $this->__wordList[] = $this->__showNumber && rand(0, 100);
        $this->__wordList[] = $this->__showSpecialChar && $this->__specialChars[array_rand($this->__specialChars)];

        return implode($this->__wordList);
    }

    public function setWordApiURL($url = null) {
        if ($url === null) {
            throw new PasswordGeneratorException('No URL specified. Please specify a valid URL.');
        }

        $this->__wordApiURL = $url;
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

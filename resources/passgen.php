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
        $this->__showNumber = isset($params['random_number']) && $params['random_number'];
        $this->__showSpecialChar = isset($params['random_special_character']) && $params['random_special_character'];

        if (isset($params['number_of_words']) && $params['number_of_words'] && self::validateNumberOfWords($params['number_of_words'])) {
            $this->__numberOfWords = $params['number_of_words'];
        } else {
            $this->__numberOfWords = self::__defaultNumberOfWords;
        }

        if (isset($params['delimeter_choice']) && $params['delimeter_choice'] && $params['delimeter_choice'] === 'dash') {
            $this->__delimeter = '-';
        } elseif (isset($params['delimeter_choice']) && $params['delimeter_choice'] && $params['delimeter_choice'] === 'space') {
            $this->__delimeter = ' ';
        } else {
            $this->__delimeter = self::__delimeters[array_rand(self::__delimeters)];
        }
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
            
            if ($status === 200) {
                $this->__wordList[] = $data;
            } else {
                throw new PasswordGeneratorException('Data not received! Status not 200.');
            }
        }

        if ($this->__showNumber) {
            $this->__wordList[] = mt_rand(0, 100);
        }

        if ($this->__showSpecialChar) {
            $this->__wordList[] = self::__specialChars[array_rand(self::__specialChars)];
        }

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

        $number = (int) $number;

        if ($number < self::__minNumberOfWords || $number > self::__maxNumberOfWords) {
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

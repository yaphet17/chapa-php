<?php

namespace Chapa\Exceptions;

use RuntimeException;

/**
 * Runtime exception that is thrown for invalid post data.
 */
class InvalidPostDataException extends RuntimeException{

    /**
     * @return string
     */
    public function stackTrace(){
        return 'Error on line ' . $this->getLine() . '  on ' . $this->getFile()
                . '. ' . $this->getMessage();
    }
}
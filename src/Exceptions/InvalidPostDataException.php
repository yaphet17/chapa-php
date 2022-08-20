<?php

namespace Chapa\Exceptions;

use RuntimeException;

class InvalidPostDataException extends RuntimeException{

    public function stackTrace(){
        return 'Error on line ' . $this->getLine() . '  on ' . $this->getFile()
                . '. ' . $this->getMessage();
    }
}
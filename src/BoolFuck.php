<?php

class BoolFuck
{
    private $input = array();
    private $output = '';
    private $outputBuffer = '';
    private $register = array(0);
    private $pointer = 0;
    private $instructions = array();
    private $instructionPointer = 0;
    private $debug = false;

    public function setInput($input)
    {
        $bin = '';
        foreach (str_split($input) as $character) {
            $bin .= str_pad(strrev(decbin(ord($character))), 8, 0);
        }
        $this->input = str_split($bin);
    }

    public function run($instructions)
    {
        $this->instructions = str_split($instructions);
        $instruction = $this->getNextInstruction(0);
        while ($instruction) {
            switch ($instruction) {
                case ',':
                    $this->readInput();
                    break;
                case ';':
                    $this->writeOutput();
                    break;
                case '+':
                    $this->switchData();
                    break;
                    break;
                case '[':
                    $this->startLoop();
                    break;
                case ']':
                    $this->endLoop();
                    break;
                case '>':
                    $this->movePointer(1);
                    break;
                case '<':
                    $this->movePointer(-1);
                    break;
            }
            if ($this->debug) {
                echo $this->instructionPointer . ':' . $instruction . ':' . $this->register[$this->pointer] . ':' . $this->pointer . ':' . $this->output . "\n";
            }
            $instruction = $this->getNextInstruction();
        }
        if ($this->outputBuffer) {
            $this->output .= chr(bindec(strrev(str_pad($this->outputBuffer, 8, 0))));
        }
        return $this->output;
    }

    private function getNextInstruction($direction = 1)
    {
        $this->instructionPointer += $direction;
        if (isset($this->instructions[$this->instructionPointer])) {
            return $this->instructions[$this->instructionPointer];
        }
        return false;
    }

    private function readInput()
    {
        $input = array_shift($this->input);
        if ($input == 1) {
            $this->register[$this->pointer] = 1;
        } else {
            $this->register[$this->pointer] = 0;
        }
    }

    private function writeOutput()
    {
        $this->outputBuffer .= $this->register[$this->pointer];
        if (strlen($this->outputBuffer) == 8) {
            $this->output .= chr(bindec(strrev($this->outputBuffer)));
            $this->outputBuffer = '';
        }
    }

    private function movePointer($steps) {
        $this->pointer += $steps;
        if (!isset($this->register[$this->pointer])) {
            $this->register[$this->pointer] = 0;
        }
    }

    private function switchData()
    {
        if ($this->register[$this->pointer] == 0) {
            $this->register[$this->pointer] = 1;
        } else {
            $this->register[$this->pointer] = 0;
        }
    }

    private function startLoop()
    {
        if ($this->register[$this->pointer] == 0) {
            $loopLevel = 1;
            while ($loopLevel > 0) {
                $instruction = $this->getNextInstruction();
                if ($instruction == '[') {
                    $loopLevel++;
                } elseif ($instruction == ']') {
                    $loopLevel--;
                }
            }
        }
    }

    private function endLoop()
    {
        if ($this->register[$this->pointer] != 0) {
            $loopLevel = 1;
            while ($loopLevel > 0) {
                $instruction = $this->getNextInstruction(-1);
                if ($instruction == ']') {
                    $loopLevel++;
                } elseif ($instruction == '[') {
                    $loopLevel--;
                }
            }
        }
    }
}

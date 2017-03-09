<?php

class BrainFuck
{
    private $input = array();
    private $output = '';
    private $register = array(0);
    private $pointer = 0;
    private $instructions = array();
    private $instructionPointer = 0;
    private $debug = false;

    public function setInput($input)
    {
        $this->input = str_split($input);
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
                case '.':
                    $this->writeOutput();
                    break;
                case '+':
                    $this->incrementData(1);
                    break;
                case '-':
                    $this->incrementData(-1);
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
        $inputChar = array_shift($this->input);
        $this->register[$this->pointer] = ord($inputChar);
    }

    private function writeOutput()
    {
        if ($this->register[$this->pointer] > 0 && $this->register[$this->pointer] <= 255) {
            $this->output .= chr($this->register[$this->pointer]);
        }
    }

    private function movePointer($steps) {
        $this->pointer += $steps;
        if ($this->pointer < 0) {
            $this->pointer = 0;
        }
        if (!isset($this->register[$this->pointer])) {
            $this->register[$this->pointer] = 0;
        }
    }

    private function incrementData($value)
    {
        $this->register[$this->pointer] += $value;
        if ($this->register[$this->pointer] > 255) {
            $this->register[$this->pointer] -= 256;
        } elseif ($this->register[$this->pointer] < 0) {
            $this->register[$this->pointer] += 256;
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

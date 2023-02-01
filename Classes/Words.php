<?php

Class Words
{
	public function __construct(string $string, int $length = 10)
	{
		$this->output = '';
		$this->length = $length;
		$this->string = $string;
	}

	public function wrap(): string
	{
		while (strlen($this->string)  > 0) {
			$subString = substr($this->string, 0, $this->length);
			$remainingString = substr($this->string, $this->length, strlen($this->string));

			$nextSpace = strpos($remainingString, ' ');
			$previousSpace = strrpos($subString, ' ');

			if (($nextSpace !== false && $nextSpace == 0) || $previousSpace === false) {
				$outputStr = $subString;
				$startIndex = $this->length;
				
				if ($previousSpace == true && strrpos($outputStr, ' ') < strlen($outputStr)) {
					$startIndex = $this->length + 1;
				}
			} else {
				if (strlen($this->string) > $this->length) {
					$startIndex = $previousSpace;
					$outputStr = substr($this->string, 0, $previousSpace);
				} else {
					$startIndex = $this->length; 
					$outputStr = substr($this->string, 0, $this->length);
				}

				if (strrpos($outputStr, ' ') < strlen($outputStr)) {
					$startIndex = $startIndex + 1;
				}
			}

			$this->string = substr($this->string, $startIndex, strlen($this->string));
			$this->output .= $outputStr;
			$this->output .= "\n";
		}

		return $this->output;
	}
}

<?php

class main
{
    public static bool $reverseString = true;

    public static bool $preserveCamelCase = true;

    public static function run(string $text, $unicodeCategory = 'L'): string
    {
        $parts = preg_split("/(\p{{$unicodeCategory}}+)/u", $text, -1, PREG_SPLIT_DELIM_CAPTURE);

        if  ($parts === false) {
            return $text;
        }

        foreach  ($parts as $i => $part) {
            if  ($part !== '' && preg_match("/^\p{{$unicodeCategory}}+$/u", $part)) {
                $parts[$i] = self::prepareWord($part);
             }
         }

        return implode('', $parts);
    }

    protected static function prepareWord(string $word): string
    {
        if (!self::$reverseString) {
            return $word;
        }

        $chars = self::splitChars($word);
        $arrayRegister = self::$preserveCamelCase ? self::getArrayRegister($chars) : [];
        $reversed = array_reverse(self::toLower($chars));

        return $arrayRegister ? self::applyCurrentRegister($reversed, $arrayRegister) : implode('', $reversed);
    }

    protected static function splitChars(string $word): array
    {
        return preg_split('//u', $word, -1, PREG_SPLIT_NO_EMPTY);
    }

    protected static function getArrayRegister(array $chars): array
    {
        $arrayRegister = [];
        foreach ($chars as $ch) {
            $arrayRegister[] = $ch === mb_strtoupper($ch, 'UTF-8');
        }
        return $arrayRegister;
    }

    protected static function toLower(array $chars): array
    {
        $result = [];
        foreach ($chars as $ch) {
            $result[] = mb_strtolower($ch, 'UTF-8');
        }
        return $result;
    }

    protected static function applyCurrentRegister(array $chars, array $arrayRegister): string
    {
        $result = [];
        foreach ($chars as $i => $ch) {
            if (isset($arrayRegister[$i]) && $arrayRegister[$i]) {
                $result[] = mb_strtoupper($ch, 'UTF-8');
            } else {
                $result[] = $ch;
            }
        }
        return implode('', $result);
    }
}

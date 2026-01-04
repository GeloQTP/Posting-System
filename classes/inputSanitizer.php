<?php

class inputSanitizer
{
    public function sanitizeText($text)
    {
        $text = filter_var($text, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        return ($text);
    }

    function hashPassword($passcode)
    {
        $hashedPassword = password_hash($passcode, PASSWORD_BCRYPT);
        return ($hashedPassword);
    }
}

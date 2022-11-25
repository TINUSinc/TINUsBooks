<?php
    function generate_string() {
        $permitted_chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789abcdefghijklmnopqrstuvwxyz';
        $length = strlen($permitted_chars);
        $random_string = "";
        for($i = 0; $i < 6; $i++) {
            $random_character = $permitted_chars[random_int(0, ($length - 1))];
            $random_string .= $random_character;
        }
        return $random_string;
    }

    echo generate_string();
?>
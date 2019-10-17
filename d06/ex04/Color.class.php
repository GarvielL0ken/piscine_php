<?php
    class Color {
        public $red;
        public $green;
        public $blue;
        static $verbose = false;

        function __construct($rgb)
        {
            if (array_key_exists('red', $rgb) && array_key_exists('green', $rgb) && array_key_exists('blue', $rgb))
            {
                $this->red = $rgb['red'];
                $this->green = $rgb['green'];
                $this->blue = $rgb['blue'];
            }
            else if (array_key_exists('rgb', $rgb))
            {
                $this->red =   ($rgb['rgb'] >> 16) % 256;
                $this->green = ($rgb['rgb'] >>  8) % 256;
                $this->blue =  ($rgb['rgb'])       % 256;
            }
            if (Self::$verbose)
                print("$this constructed.\n");
        }

        function __destruct()
        {
            if (Self::$verbose)
                print("$this destructed.\n");
        }

        function __toString()
        {
            return(vsprintf("Color( red: %3d, green: %3d, blue: %3d )", array($this->red, $this->green, $this->blue)));
        }

        function add($obj_color)
        {
            $new_red   = $this->red   + $obj_color->red;
            $new_green = $this->green + $obj_color->green;
            $new_blue  = $this->blue  + $obj_color->blue;
            $new_color = new Color(array('red' => $new_red, 'green' => $new_green, 'blue' => $new_blue));
            return ($new_color);
        }

        function sub($obj_color)
        {
            $new_red   = $this->red   - $obj_color->red;
            $new_green = $this->green - $obj_color->green;
            $new_blue  = $this->blue  - $obj_color->blue;
            $new_color = new Color(array('red' => $new_red, 'green' => $new_green, 'blue' => $new_blue));
            return ($new_color);
        }

        function mult($val)
        {
            $new_red   = $this->red   * $val;
            $new_green = $this->green * $val;
            $new_blue  = $this->blue  * $val;
            $new_color = new Color(array('red' => $new_red, 'green' => $new_green, 'blue' => $new_blue));
            return ($new_color);
        }

        public static function doc()
        {
            return ( "\n" . file_get_contents('./Color.doc.txt') . "\n");
        }
    }
?>
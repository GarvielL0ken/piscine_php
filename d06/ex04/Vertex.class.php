<?php
    require_once 'Color.class.php';
    
    class Vertex
    {
        static $verbose = false;
        private $_x;
        private $_z;
        private $_y;
        private $_w;
        private $_color;

        function __construct($arr_data)
        {
            $this->_x = $arr_data['x'];
            $this->_y = $arr_data['y'];
            $this->_z = $arr_data['z'];
            if (array_key_exists('w', $arr_data))
                $this->_w = $arr_data['w'];
            else
                $this->_w = 1.0;
            if (array_key_exists('color', $arr_data))
                $this->_color = $arr_data['color'];
            else
                $this->_color = new Color(array('red' => 255, 'green' => 255, 'blue' => 255));
            if (Self::$verbose)
                print("$this constructed\n");
        }

        function __destruct()
        {
            if (Self::$verbose)
                print("$this destructed\n");
        }

        function __toString()
        {
            if (SELF::$verbose)
                return(vsprintf("Vertex( x: %0.2f, y: %0.2f, z:%0.2f, w:%0.2f, $this->_color )", array($this->_x, $this->_y, $this->_z, $this->_w, $this->_color)));
            return(vsprintf("Vertex( x: %0.2f, y: %0.2f, z:%0.2f, w:%0.2f )", array($this->_x, $this->_y, $this->_z, $this->_w)));
        }

        function __get($name)
        {
            return ($this->$name);
        }

        function __set($name, $value)
        {
            $this->$name = $value;
        }

        public static function doc()
        {
            return ( "\n" . file_get_contents('./Vertex.doc.txt') . "\n");
        }
    }
?>
<?php
    require_once 'Color.class.php';
    require_once 'Vertex.class.php';
    
    class Vector
    {
        static  $verbose = false;
        private $_x;
        private $_y;
        private $_z;
        private $_w;

        function __construct($arr_data)
        {   
            if ($arr_data['orig'])
            {
                $vert_orig = new Vertex(array('x' => $arr_data['orig']->_x, 'y' => $arr_data['orig']->_y, 'z' => $arr_data['orig']->_z, 'w' => $arr_data['orig']->_w));
            }
            $this->_x = $arr_data['dest']->_x;
            $this->_y = $arr_data['dest']->_y;
            $this->_z = $arr_data['dest']->_z;
            $this->_w = $arr_data['dest']->_w;
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
            return (vsprintf("Vector( x:%0.2f, y:%0.2f, z:%0.2f, w:%0.2f )", array($this->_x, $this->_y, $this->_z, $this->_w)));
        }

        function __get($name)
        {
            return ($this->$name);
        }

        public static function doc()
        {
            return ( "\n" . file_get_contents('./Vector.doc.txt') . "\n");
        }
    }
?>
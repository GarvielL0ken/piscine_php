<?php
    require_once 'Vertex.class.php';
    require_once 'Vector.class.php';
    require_once 'Matrix.class.php';

    class Camera
    {
        static  $verbose = false;
        private $_origin;
        private $_tT;
        private $_orientation;
        private $_width;
        private $_height;
        private $_fov;
        private $_near;
        private $_far;
        
        function __construct($arr_data)
        {
            $this->_origin = $arr_data['origin'];
            $vct = new Vector(array('dest' => $this->_origin));

            $this->_tT = new Matrix(array("preset" => Matrix::TRANSLATION, 'vtc' => $vct->opposite()));
            $this->_orientation = $arr_data['orientation'];
            $this->_width = $arr_data['width'];
            $this->_height = $arr_data['height'];
            $this->_fov = $arr_data['fov'];
            $this->_near = $arr_data['near'];
            $this->_far = $arr_data['far'];

            if (SELF::$verbose)
                print("Camera instance constructed\n");
        }

        function __destruct()
        {
            print("Camera instance destructed\n");
        }

        function __toString()
        {
            return ("+ Origin: $this->_origin" . "+ tT:\n$this->_tT");
        }

        public static function doc()
        {
            return ( "\n" . file_get_contents('./Camera.doc.txt') . "\n");
        }
    }
?>
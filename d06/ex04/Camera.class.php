<?php
    require_once 'Vertex.class.php';
    require_once 'Vector.class.php';
    require_once 'Matrix.class.php';

    class Camera
    {
        static  $verbose = false;
        private $_origin;
        private $_tT;
        private $_tR;
        private $_mtx_mult;
        private $_Proj;
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
            $mtx = $arr_data['orientation'];
            $this->_tR = new Matrix(array('preset' => $mtx->_preset, 'angle' => $mtx->_angle));
            $arr_data['preset'] = MATRIX::PROJECTION;
            $arr_data['fov'] = 60;
            $arr_data['ratio'] = $arr_data['width'] / $arr_data['height'];
            $this->_Proj = new MATRIX($arr_data);
            $this->_mtx_mult = $this->_tR->mult($this->_tT);

            if (SELF::$verbose)
                print("Camera instance constructed\n");
        }

        function __destruct()
        {
            print("Camera instance destructed\n");
        }

        function __toString()
        {
            return ("Camera(\n" . 
                    "+ Origin: $this->_origin\n" .
                    "+ tT:\n" .
                    "$this->_tT" .
                    "+ tR:\n" .
                    "$this->_tR" .
                    "+ tR->mult( tT ):\n" .
                    "$mtx_mult" .
                    "+ Proj:\n" .
                    "$this->_Proj" .
                    ")"
                    );
        }

        public static function doc()
        {
            return ( "\n" . file_get_contents('./Camera.doc.txt') . "\n");
        }
    }
?>
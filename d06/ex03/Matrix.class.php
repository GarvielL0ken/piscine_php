<?php

    require_once 'Vertex.class.php';
    require_once 'Vector.class.php';

    class Matrix
    {
        const IDENTITY =    'IDENTITY';
        const SCALE =       'SCALE';
        const RX =          'RX';
        const RY =          'RY';
        const RZ =          'RZ';
        const TRANSLATION = 'TRANLATION';
        const PROJECTION =  'PROJECTION';
        static $verbose =   false;
        private $_matrix;

        function __construct($arr_data)
        {
            $this->_matrix = array( 'x' => array(0.0, 0.0, 0.0, 0.0),
                                    'y' => array(0.0, 0.0, 0.0, 0.0), 
                                    'z' => array(0.0, 0.0, 0.0, 0.0), 
                                    'w' => array(0.0, 0.0, 0.0, 0.0));
            if ($arr_data['preset'] == SELF::IDENTITY)
            {
                $this->_matrix['x'][0] = 1.0;
                $this->_matrix['y'][1] = 1.0;
                $this->_matrix['z'][2] = 1.0;
                $this->_matrix['w'][3] = 1.0;
            }
            if (SELF::$verbose)
                print("Matrix " . $arr_data['preset'] . " instance constructed\n");
        }

        function __toString()
        {
            return (vsprintf("M | vtcX | vtcY | vtcZ | vtxO\n" .
                             "-----------------------------\n" .
                             $this->arr_to_string($this->_matrix['x'], 'x') .
                             $this->arr_to_string($this->_matrix['y'], 'y') .
                             $this->arr_to_string($this->_matrix['z'], 'z') .
                             $this->arr_to_string($this->_matrix['w'], 'w')
                             , array()));
        }

        function __get($name)
        {
            return ($this->$name);
        }

        function __set($name, $value)
        {
            $this->$name = $value;
        }

        private function arr_to_string($arr, $name)
        {
            print_r($arr);
            return (vsprintf("%s | %0.2f | %0.2f | %0.2f | %0.2f\n", 
                        array($name, $arr[0], $arr[1], $arr[2], $arr[3])));
        }

        public static function doc()
        {
            return ( "\n" . file_get_contents('./Matrix.doc.txt') . "\n");
        }
    }
?>
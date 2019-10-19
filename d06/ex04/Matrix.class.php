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
        const TRANSLATION = 'TRANSLATION';
        const PROJECTION =  'PROJECTION';
        static $verbose =   false;
        private $_preset;
        private $_matrix;
        private $_scale;
        private $_angle;
        private $_vct;
        private $_fov;
        private $_ratio;
        private $_near;
        private $_far;

        function __construct($arr_data)
        {
            $this->initialize_matrix();
            $this->_preset = $arr_data['preset'];
            if ($arr_data['preset'] == SELF::IDENTITY)
                $this->scale(1);
            if ($arr_data['preset'] == SELF::SCALE)
                $this->scale($arr_data['scale']);
            if ($arr_data['preset'] == SELF::RX)
                $this->rotate($arr_data['angle'], 'x');
            if ($arr_data['preset'] == SELF::RY)
                $this->rotate($arr_data['angle'], 'y');
            if ($arr_data['preset'] == SELF::RZ)
                $this->rotate($arr_data['angle'], 'z');
            if ($arr_data['preset'] == SELF::TRANSLATION)
                $this->translate($arr_data['vtc']);
            if ($arr_data['preset'] == SELF::PROJECTION)
                $this->project($arr_data['fov'], $arr_data['ratio'], $arr_data['near'], $arr_data['far']); 
            if (SELF::$verbose)
                print("Matrix " . $arr_data['preset'] . " instance constructed\n");
        }

        function __toString()
        {
            return (vsprintf("M |  vtcX  |  vtcY  |  vtcZ  |  vtxO \n" .
                             "-------------------------------------\n" .
                             $this->arr_to_string($this->_matrix['x'], 'x') .
                             $this->arr_to_string($this->_matrix['y'], 'y') .
                             $this->arr_to_string($this->_matrix['z'], 'z') .
                             $this->arr_to_string($this->_matrix['w'], 'w')
                             , array()));
        }

        private function arr_to_string($arr, $name)
        {
            return (vsprintf("%s | %6.2f | %6.2f | %6.2f | %6.2f\n", 
                        array($name, $arr['vctX'], $arr['vctY'], $arr['vctZ'], $arr['vtxO'])));
        }

        function __get($name)
        {
            return ($this->$name);
        }

        function __set($name, $value)
        {
            $this->$name = $value;
        }

        private function initialize_matrix()
        {
            $this->_matrix = array( 'x' => array('vctX' => 1.0, 'vctY' => 0.0, 'vctZ' => 0.0, 'vtxO' => 0.0),
                                    'y' => array('vctX' => 0.0, 'vctY' => 1.0, 'vctZ' => 0.0, 'vtxO' => 0.0), 
                                    'z' => array('vctX' => 0.0, 'vctY' => 0.0, 'vctZ' => 1.0, 'vtxO' => 0.0), 
                                    'w' => array('vctX' => 0.0, 'vctY' => 0.0, 'vctZ' => 0.0, 'vtxO' => 1.0));
        }

        private function scale($value)
        {
            $this->_scale = $value;
            $this->_matrix['x']['vctX'] *= $value;
            $this->_matrix['y']['vctY'] *= $value;
            $this->_matrix['z']['vctZ'] *= $value;
        }

        private function rotate($angle, $axis)
        {
            $this->_angle = $angle;
            if ($axis == 'x')
            {
                $this->_matrix['x']['vctX'] = 1;
                $this->_matrix['y']['vctY'] = cos($angle);
                $this->_matrix['y']['vctZ'] = -sin($angle);
                $this->_matrix['z']['vctY'] = sin($angle);
                $this->_matrix['z']['vctZ'] = cos($angle);
            }
            else if ($axis == 'y')
            {
                $this->_matrix['y']['vctY'] = 1;
                $this->_matrix['x']['vctX'] = cos($angle);
                $this->_matrix['x']['vctZ'] = sin($angle);
                $this->_matrix['z']['vctX'] = -sin($angle);
                $this->_matrix['z']['vctZ'] = cos($angle);
            }
            else if ($axis == 'z')
            {
                $this->_matrix['z']['vctZ'] = 1;
                $this->_matrix['x']['vctX'] = cos($angle);
                $this->_matrix['x']['vctY'] = -sin($angle);
                $this->_matrix['y']['vctX'] = sin($angle);
                $this->_matrix['y']['vctY'] = cos($angle);
            }
        }

        private function translate($vct)
        {
            $this->_vct = $vct;
            $this->_matrix['x']['vtxO'] += $vct->_x;
            $this->_matrix['y']['vtxO'] += $vct->_y;
            $this->_matrix['z']['vtxO'] += $vct->_z;
        }

        private function project($fov, $ratio, $near, $far)
        {
            $this->_fov = $fov;
            $this->_ration = $ratio;
            $this->_near = $near;
            $this->_far = $far;
            $this->_matrix['y']['vctY'] = 1 / tan(0.5 * deg2rad($fov));
            $this->_matrix['x']['vctX'] = $this->_matrix['y']['vctY'] / $ratio; 
            $this->_matrix['z']['vctZ'] = -1 * (($far + $near) / ($far - $near));
            $this->_matrix['z']['vtxO'] = -1 * (2 * $far * $near / ($far - $near));
            $this->_matrix['w']['vctZ'] = -1;
            $this->_matrix['w']['vtxO'] = 0;
        }

        private function get_data()
        {
            $arr_data = array('preset' => $this->_preset);
            $preset = $arr_data['preset'];
            if ($preset == MATRIX::SCALE)
                $arr_data['scale'] = $this->_scale;
            if ($preset == MATRIX::RX || $preset == MATRIX::RY || $preset == MATRIX::RZ)
                $arr_data['angle'] = $this->_angle;
            if ($preset == MATRIX::TRANSLATION)
                $arr_data['vtc'] = $this->_vct;
            if ($preset == MATRIX::PROJECTION)
            {
                $arr_data['fov'] = $this->_fov;
                $arr_data['ratio'] = $this->_ratio;
                $arr_data['near'] = $this->_near;
                $arr_data['far'] = $this->_far;
            }
            return ($arr_data);
        }

        public function mult($rhs)
        {
            $arr_data = $this->get_data();
            $new_matrix = new Matrix($arr_data);
            $arr_columns = array('vctX', 'vctY', 'vctZ', 'vtxO');
            $arr_rows = array('x', 'y', 'z', 'w');
            $this_row_index = 0;
            foreach($new_matrix->_matrix as $row)
            {
                $column_index = 0;
                $arr_sum = array(0, 0, 0, 0);
                foreach($row as $column)
                {
                    $sum = 0;
                    $row_index = 0;
                    //print("(");
                    foreach ($row as $a)
                    {
                        $row_key = $arr_rows[$row_index];
                        $column_key = $arr_columns[$column_index];
                        $b = $rhs->_matrix[$row_key][$column_key];
                        //print($a . "*[" . $row_key . "][" . $column_key . "]");
                        //print($a . " * " . $b);
                        //printf('%5.f * %5.2f', $a, $b);
                        $sum += $a * $b;
                        if ($row_index < 3)
                            //print(" + ");
                        $row_index++;
                    }
                    $arr_sum[$column_index] = $sum;
                    $column_index++;
                    //print(") ");
                }
                $new_matrix->_matrix[$arr_rows[$this_row_index]]['vctX'] = $arr_sum[0];
                $new_matrix->_matrix[$arr_rows[$this_row_index]]['vctY'] = $arr_sum[1];
                $new_matrix->_matrix[$arr_rows[$this_row_index]]['vctZ'] = $arr_sum[2];
                $new_matrix->_matrix[$arr_rows[$this_row_index]]['vtxO'] = $arr_sum[3];
                $this_row_index++;
                //print ("\n");
            }
            return ($new_matrix);
        }

        public function transformVertex($vtxA)
        {
            $vtxB = new Vertex(array('x' => 0, 'y' => 0, 'z' => 0, 'w' => 1, 'color' => $vtxA->_color));
            $vtxB->_x = $this->get_row_transform($vtxA, 'x');
            $vtxB->_y = $this->get_row_transform($vtxA, 'y');
            $vtxB->_z = $this->get_row_transform($vtxA, 'z');
            $vtxB->_w = $this->get_row_transform($vtxA, 'w');
            return ($vtxB);
        }

        private function get_row_transform($vtxA, $row)
        {
            $arr_row = $this->_matrix[$row];
            $x = $vtxA->_x;
            $y = $vtxA->_y;
            $z = $vtxA->_z;
            $w = $vtxA->_w;
            $sum = $x * $arr_row['vctX'] + $y  * $arr_row['vctY'] + $z  * $arr_row['vctZ'] + $w  * $arr_row['vtxO'];
            return ($sum);
        }

        public static function doc()
        {
            return ( "\n" . file_get_contents('./Matrix.doc.txt') . "\n");
        }
    }
?>
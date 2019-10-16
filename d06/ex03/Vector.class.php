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
                $vert_orig = new Vertex(array('x' => $arr_data['orig']->_x, 'y' => $arr_data['orig']->_y, 'z' => $arr_data['orig']->_z, 'w' => $arr_data['orig']->_w));
            else
                $vert_orig = new Vertex(array('x' => 0.0, 'y' => 0, 'z' => 0));
            $this->_x = $arr_data['dest']->_x - $vert_orig->_x;
            $this->_y = $arr_data['dest']->_y - $vert_orig->_y;
            $this->_z = $arr_data['dest']->_z - $vert_orig->_z;
            $this->_w = 0;
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

        public function magnitude()
        {
            $x = $this->_x;
            $y = $this->_y;
            $z = $this->_z;
            $square = ($x ** 2) + ($y ** 2) + ($z ** 2);
            return (sqrt($square));
        }

        public function normalize()
        {
            $mag = $this->magnitude();
            $norm_x = ($this->_x) / $mag;
            $norm_y = ($this->_y) / $mag;
            $norm_z = ($this->_z) / $mag;
            $norm_vert = new Vertex(array('x' => $norm_x, 'y' => $norm_y, 'z' => $norm_z));
            $norm_vec = new Vector(array('dest' => $norm_vert));
            return ($norm_vec);
        }

        public function add($vect)
        {
            $sum_x = $this->_x + $vect->_x;
            $sum_y = $this->_y + $vect->_y;
            $sum_z = $this->_z + $vect->_z;
            $sum_vertex = new Vertex(array('x' => $sum_x, 'y' => $sum_y, 'z' => $sum_z));
            $sum_vector = new Vector(array('dest' => $sum_vertex));
            return ($sum_vector);
        }

        public function sub($vect)
        {
            $sub_x = $this->_x - $vect->_x;
            $sub_y = $this->_y - $vect->_y;
            $sub_z = $this->_z - $vect->_z;
            $sub_vertex = new Vertex(array('x' => $sub_x, 'y' => $sub_y, 'z' => $sub_z));
            $sub_vector = new Vector(array('dest' => $sub_vertex));
            return ($sub_vector); 
        }

        public function opposite()
        {
            $opp_x = $this->_x * -1;
            $opp_y = $this->_y * -1;
            $opp_z = $this->_z * -1;
            $opp_vertex = new Vertex(array('x' => $opp_x, 'y' => $opp_y, 'z' => $opp_z));
            $opp_vector = new Vector(array('dest' => $opp_vertex));
            return ($opp_vector); 
        }

        public function scalarProduct($k)
        {
            $prod_x = $this->_x * $k;
            $prod_y = $this->_y * $k;
            $prod_z = $this->_z * $k;
            $prod_vertex = new Vertex(array('x' => $prod_x, 'y' => $prod_y, 'z' => $prod_z));
            $prod_vector = new Vector(array('dest' => $prod_vertex));
            return ($prod_vector); 
        }

        public function dotProduct($rhs)
        {
            $prod_x = $this->_x * $rhs->_x;
            $prod_y = $this->_y * $rhs->_y;
            $prod_z = $this->_z * $rhs->_z;
            return ($prod_x + $prod_y + $prod_z);
        }

        public function cos($rhs)
        {
            $dot = $this->dotProduct($rhs);
            $mag = $this->magnitude() * $rhs->magnitude();
            $cos_theta = $dot / $mag;
            return ($cos_theta);
        }

        public function crossProduct($rhs)
        {
            $prod_x = $this->_y * $rhs->_z - $this->_z * $rhs->_y;
            $prod_y = $this->_z * $rhs->_x - $this->_x * $rhs->_z;
            $prod_z = $this->_x * $rhs->_y - $this->_y * $rhs->_x;
            $prod_vertex = new Vertex(array('x' => $prod_x, 'y' => $prod_y, 'z' => $prod_z));
            $prod_vector = new Vector(array('dest' => $prod_vertex));
            return ($prod_vector); 
        }
    }
?>
<?php
    class NightsWatch
    {
        private $_recruits;

        function __construct()
        {
            $this->_recruits = array();
        }

        public function recruit($new_recruit)
        {
            array_push($this->_recruits , $new_recruit);
        }

        public function fight()
        {
            foreach ($this->_recruits as $recruit)
            {
                $interfaces = (class_implements($recruit));
                if (array_key_exists('IFighter', $interfaces))
                    $recruit->fight();
            }
        }
    }
?>
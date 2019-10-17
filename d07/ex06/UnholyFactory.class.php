<?php
    class UnholyFactory
    {
        private $_types;

        function __construct()
        {
            $this->_types = array();
        }

        public function absorb($obj)
        {
            print("(Factory ");
            if (array_key_exists($obj->type, $this->_types))
                print("already ");
            if (get_parent_class($obj) == "Fighter")
            {
                $this->_types[$obj->type] = $obj;
                print("absorbed a fighter of type " . $obj->type);
            }
            else
                print("can't absorb this, it's not a fighter");
            print(")\n");
        }

        public function fabricate($rf)
        {
            print("(Factory ");
            $class = null;
            if (array_key_exists($rf, $this->_types))
            {
                print("fabricates a fighter of type " . $rf);
                $class = get_class($this->_types[$rf]);
            }
            else
                print("hasn't absored any fighter of type " . $rf);
            print (")\n");
            if ($class)
                return new $class();
        }
    }
?>
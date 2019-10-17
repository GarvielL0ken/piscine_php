<?php
    class Lannister
    {
        public function sleepWith($obj)
        {
            $arr_parents = $this->get_parents($obj);
            print($this->get_string($arr_parents[0], $arr_parents[1], $obj));
        }

        private function get_parents($obj)
        {
            $this_parent = get_parent_class($this);
            $obj_parent = get_parent_class($obj);
            return (array($this_parent, $obj_parent));
        }

        public function get_string($this_parent, $obj_parent, $obj)
        {
            if (strcmp($this_parent, $obj_parent) == 0)
                return("Not even if I'm drunk !\n");
            else
                return("Let's do this.\n");
        }
    }
?>
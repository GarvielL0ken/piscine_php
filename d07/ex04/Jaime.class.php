<?php
    require_once ('Lannister.class.php');

    class Jaime extends Lannister
    {
        public function get_string($this_parent, $obj_parent, $obj)
        {
            $obj_class = get_class($obj);
            if (strcmp($obj_class, 'Cersei') == 0)
                return("With peasure, but only in a tower in Winterfell, then.\n");
            else if (strcmp($this_parent, $obj_parent) == 0)
                return("Not even if I'm drunk !\n");
            else
                return("Let's do this.\n");
        }
    }
?>
<?php
    class Targaryen
    {
        public function getBurned()
        {
            if ($this->resistsFire())
                return (vsprintf("emerges naked but unharmed", array()));
            else
                return (vsprintf("burns alive", array()));
        }

        public function resistsFire()
        {
            return (false);
        }
    }
?>
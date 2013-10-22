<?php

class Bullet
{
    public function getSizeFor($weight)
    {
        if (count($weight) > 100) {
            return 3;
        }

        if (count($weight) > 10) {
            return 5;
        }

        return 7;
    }
}

<?php

class Bullet
{
    public function getSizeFor($weight)
    {
        if (count($weight) > 100) {
            return 5;
        }

        if (count($weight) > 10) {
            return 7;
        }

        return 10;
    }
}

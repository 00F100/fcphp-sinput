<?php

namespace FcPhp\SInput\Interfaces
{
    interface ISRule
    {
        /**
         * Method to process rule and return string processed
         *
         * @param string $content Content to process
         * @return string
         */
        public function run(string $content) :string;
    }
}

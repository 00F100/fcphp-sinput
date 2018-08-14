<?php

namespace FcPhp\SInput\Rules
{
    use FcPhp\SInput\Interfaces\ISRule;

    class StripTags implements ISRule
    {
        /**
         * Method to process rule and return string processed
         *
         * @param string $content Content to process
         * @return string
         */
        public function run(string $content) :string
        {
            return strip_tags($content);
        }
    }
}

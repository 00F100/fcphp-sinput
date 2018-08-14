<?php

namespace FcPhp\SInput\Interfaces
{
    use FcPhp\SInput\Interfaces\ISRule;
    use FcPhp\SInput\Interfaces\ISInput;
    
    interface ISInput
    {

        /**
         * Method to add rule
         *
         * @param string $name Name of rule
         * @param FcPhp\SInput\Interfaces\ISRule $callback Instance of ISRule
         * @return FcPhp\SInput\Interfaces\ISInput
         */
        public function addRule(string $name, ISRule $callback) :ISInput;

        /**
         * Method to add rule
         *
         * @param array $rules Rules to apply into content
         * @param array|string $content Content to process
         * @return FcPhp\SInput\Interfaces\ISInput
         */
        public function executeRules(array $rules, &$content) :ISInput;
    }
}

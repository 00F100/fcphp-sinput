<?php

namespace FcPhp\SInput
{
    use FcPhp\SInput\Interfaces\ISRule;
    use FcPhp\SInput\Interfaces\ISInput;

    class SInput implements ISInput
    {
        /**
         * @var array $rules Rules available
         */
        private $rules = [];

        /**
         * Method to add rule
         *
         * @param string $name Name of rule
         * @param FcPhp\SInput\Interfaces\ISRule $callback Instance of ISRule
         * @return FcPhp\SInput\Interfaces\ISInput
         */
        public function addRule(string $name, ISRule $callback) :ISInput
        {
            $this->rules[$name] = $callback;
            return $this;
        }

        /**
         * Method to add rule
         *
         * @param array $rules Rules to apply into content
         * @param array|string $content Content to process
         * @return FcPhp\SInput\Interfaces\ISInput
         */
        public function executeRules(array $rules, &$content) :ISInput
        {
            foreach($rules as $rule) {
                if(isset($this->rules[$rule])) {
                    $this->executeRule($this->rules[$rule], $content);
                }
            }
            return $this;
        }

        /**
         * Execute rule into content
         *
         * @param array $rules Rules to apply into content
         * @param FcPhp\SInput\Interfaces\ISRule $rule Instance of rule to apply
         * @return void
         */
        private function executeRule(ISRule $rule, &$content) :void
        {
            if(is_array($content)) {
                foreach($content as $index => $value) {
                    if(is_array($value)) {
                        unset($content[$index]);
                        $content[$rule->run($index)] = $value;
                        $this->executeRule($rule, $content[$rule->run($index)]);
                    }else{
                        if(is_int($index)) {
                            $content[$index] = $rule->run($value);
                        }else{
                            unset($content[$index]);
                            $content[$rule->run($index)] = $rule->run($value);
                        }
                    }
                }
            }else{
                $content = $rule->run($content);
            }
        }
    }
}

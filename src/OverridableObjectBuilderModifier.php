<?php

namespace DarkAxi0m\Propel\Behavior\Authable;

use Propel\Generator\Util\PhpParser;
//TODO Testing... https://github.com/donkeycode/propel-uuid-behavior/tree/master/tests

class OverridableObjectBuilderModifier
{
    /**
     * @var UuidBehavior
     */
    private $behavior;

    public function __construct(\Propel\Generator\Model\Behavior $behavior)
    {
        $this->behavior = $behavior;
    }

    public function objectMethods($builder)
    {
        return $this->behavior->renderTemplate('objectMethods', array(
            'algo' => $this->behavior->getParameter('algo'),
            'column' =>  $this->behavior->getParameter('hash_column'),
            'setcolumn' => $this->behavior->getColumnSetter(),
        ), __DIR__ . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR);
    }



    public function objectFilter(&$script)
    {
        if ($this->behavior->getParameter('hide_column')) {

            $column = $this->behavior->getParameter('hash_column');
            $getcolumn = $this->behavior->getColumnGetter();
            //$setcolumn = $this->behavior->getColumnSetter();  //TODO decied if this should/can be blocked
            $newfunc = <<<EOS


    /**
     * Get the [$column] column value. Allways returns '*********' if not null
     * This will break a few functions, like copyInto
     * 
     * @return string|null
     */
    public function $getcolumn()
    {
        if ( empty(\$this->$column) )
            return null;
        return '********';
    }

EOS;
            $parser = new PhpParser($script, true);
            $parser->replaceMethod($getcolumn, $newfunc);
            $script = $parser->getCode();
        }
    }
}

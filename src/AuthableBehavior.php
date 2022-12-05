<?php

/**
 * MIT License. This file is part of the Propel package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DarkAxi0m\Propel\Behavior\Authable;

use Propel\Generator\Builder\Om\AbstractOMBuilder;
use Propel\Generator\Model\Behavior;


/**
 * lala update later
 *
 * @author Chris Chase
 **/
class AuthableBehavior extends Behavior
{

    private $objectBuilderModifier;

    const DEFAULT_HASH_COLUMN = 'authhash';
    const DEFAULT_ALGO = 'PASSWORD_DEFAULT';
    const DEFAULT_HIDE_COLUMNS = true;
    
    /**
     * @var array<string, mixed>
     */
    protected $parameters = [
        'hash_column' => self::DEFAULT_HASH_COLUMN,
        'algo' => self::DEFAULT_ALGO,
        'hide_column' => self::DEFAULT_HIDE_COLUMNS  //disabled the getHash fucntion, 
    ];

    /**
     * Add the create_column and update_columns to the current table
     *
     * @return void
     */
    public function modifyTable(): void
    {
        $column = $this->getParameter('hash_column');
        if (!$this->getTable()->hasColumn($column)) {

            $this->getTable()->addColumn([
                'name' =>  $column,
                'type' => 'VARCHAR',
                'size' => 255
            ]);
        }
    }

 

    /**
     * Get the setter of the column of the behavior
     *
     * @return string The related setter, e.g. 'setHash'
     */
    public function getColumnSetter(): string
    {
        return 'set' . $this->getColumnForParameter('hash_column')->getPhpName();
    }

    /**
     * Get the getter of the column of the behavior
     *
     * @return string The related setter, e.g. 'getHash'
     */
    public function getColumnGetter(): string
    {
        return 'get' . $this->getColumnForParameter('hash_column')->getPhpName();
    }


    /**
     * {@inheritdoc}
     */
    public function getObjectBuilderModifier()
    {
        if (null === $this->objectBuilderModifier) {
            $this->objectBuilderModifier = new OverridableObjectBuilderModifier($this);
        }

        return $this->objectBuilderModifier;
    }


 
}

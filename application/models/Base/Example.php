<?php

/**
 * Application_Model_Base_Example
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $id
 * @property integer $someint
 * @property time $sometime
 * @property string $sometext
 * @property date $somedate
 * @property timestamp $sometimestamp
 * @property boolean $someboolean
 * @property decimal $somedecimal
 * @property clob $someclob
 * @property blob $someblob
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Application_Model_Base_Example extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('example');
        $this->hasColumn('id', 'string', 32, array(
             'type' => 'string',
             'fixed' => 1,
             'primary' => true,
             'length' => '32',
             ));
        $this->hasColumn('someint', 'integer', 10, array(
             'type' => 'integer',
             'unsigned' => true,
             'length' => '10',
             ));
        $this->hasColumn('sometime', 'time', 25, array(
             'type' => 'time',
             'default' => '12:34:05',
             'notnull' => true,
             'length' => '25',
             ));
        $this->hasColumn('sometext', 'string', 12, array(
             'type' => 'string',
             'length' => '12',
             ));
        $this->hasColumn('somedate', 'date', 25, array(
             'type' => 'date',
             'length' => '25',
             ));
        $this->hasColumn('sometimestamp', 'timestamp', 25, array(
             'type' => 'timestamp',
             'length' => '25',
             ));
        $this->hasColumn('someboolean', 'boolean', 25, array(
             'type' => 'boolean',
             'length' => '25',
             ));
        $this->hasColumn('somedecimal', 'decimal', 18, array(
             'type' => 'decimal',
             'length' => '18',
             ));
        $this->hasColumn('someclob', 'clob', 2147483647, array(
             'type' => 'clob',
             'length' => '2147483647',
             ));
        $this->hasColumn('someblob', 'blob', 2147483647, array(
             'type' => 'blob',
             'length' => '2147483647',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}
<?php
namespace App\Ecommerce;

use Pimcore\Bundle\EcommerceFrameworkBundle\IndexService\Config\DefaultMysql;

class MyConfig extends DefaultMysql
{

    public function getTablename()
    {
        return '__test_index';
    }

    public function getRelationTablename()
    {
        return '__test_index_relations';
    }

}
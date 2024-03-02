<?php

namespace Epaphrodites\database\gearShift\schema;


trait makeUpGearShift
{
    /**
     * Create table category
     * create 29/02/2024 17:55:30
     */
    public function createCategoryTable()
    {
        return $this->createTable('category', function ($table) {

            $table->addColumn('idcategory', 'INTEGER(11)', ['AUTO_INCREMENT', 'PRIMARY KEY']);
            $table->addColumn('nameCategory', 'VARCHAR(100)');
            $table->db(1);
        });
    }

    /**
     * Create table client
     * create 29/02/2024 17:56:10
     */
    public function createClientTable()
    {
        return $this->createTable('client', function ($table) {

            $table->addColumn('idclient', 'INTEGER(11)', ['AUTO_INCREMENT', 'PRIMARY KEY']);
            $table->addColumn('nameClient', 'VARCHAR(100)');
            $table->addColumn('surnameClient', 'VARCHAR(100)');
            $table->db(1);
        });
    }

    /**
     * Create table commande
     * create 29/02/2024 17:56:23
     */
    public function createCommandeTable()
    {
        return $this->createTable('commande', function ($table) {

            $table->addColumn('idcommande', 'INTEGER(11)', ['AUTO_INCREMENT', 'PRIMARY KEY']);
            $table->addColumn('libelleCommande', 'VARCHAR(100)');
            $table->addColumn('date', 'DATETIME');
            $table->addColumn('etat', 'INTEGER(1)');
            $table->addColumn('idClient', 'INTEGER(11)');
            $table->addColumn('idProductCommand', 'INTEGER(11)');
            $table->addIndex('idClient');
            $table->addIndex('idProductCommand');
            $table->db(1);
        });
    }

    /**
     * Create table commandfournisseur
     * create 29/02/2024 17:56:48
     */
    public function createCommandfournisseurTable()
    {
        return $this->createTable('commandfournisseur', function ($table) {

            $table->addColumn('idcommandfournisseur', 'INTEGER(11)', ['AUTO_INCREMENT', 'PRIMARY KEY']);
            $table->addColumn('libellefourni', 'VARCHAR(100)');
            $table->addColumn('datefourni', 'DATETIME');
            $table->addColumn('idFourni', 'INTEGER(11)');
            $table->addIndex('idFourni');

            $table->db(1);
        });
    }
    /**
     * Create table fournisseur
     * create 29/02/2024 17:57:10
     */
    public function createFournisseurTable()
    {
        return $this->createTable('fournisseur', function ($table) {

            $table->addColumn('idfournisseur', 'INTEGER(11)', ['AUTO_INCREMENT', 'PRIMARY KEY']);
            $table->addColumn('nameFourni', 'VARCHAR(100)');
            $table->addColumn('surnameFourni', 'VARCHAR(100)');
            $table->addColumn('emailFourni', 'VARCHAR(100)');
            $table->addColumn('contactFourni', 'VARCHAR(100)');
            $table->addColumn('idEntreprisefour', 'INTEGER(11)');
            $table->addIndex('idEntreprisefour');
            $table->db(1);
        });
    }

    /**
     * Create table product
     * create 29/02/2024 17:57:49
     */
    public function createProductTable()
    {
        return $this->createTable('product', function ($table) {

            $table->addColumn('idproduct', 'INTEGER(11)', ['AUTO_INCREMENT', 'PRIMARY KEY']);
            $table->addColumn('libelleProduct', 'VARCHAR(100)');
            $table->addColumn('descriptionProduct', 'VARCHAR(100)');
            $table->addColumn('quantityProduct', 'VARCHAR(100)');
            $table->addColumn('priceProduct', 'INTEGER(11)');
            $table->addColumn('idCategoryProduct', 'INTEGER(11)');
            $table->addColumn('imageProduct', 'VARCHAR(100)');
            $table->addIndex('idCategoryProduct');

            $table->db(1);
        });
    }

    /**
     * Create table entreprise
     * create 29/02/2024 18:17:57
     */
    public function createEntrepriseTable()
    {
        return $this->createTable('entreprise', function ($table) {

            $table->addColumn('identreprise', 'INTEGER', ['PRIMARY KEY', 'AUTO_INCREMENT']);
            $table->addColumn('nameEntreprise', 'VARCHAR(100)');
            $table->addColumn('contactEntreprise', 'VARCHAR(100)');
            $table->addColumn('emailEntreprise', 'VARCHAR(100)');
            $table->db(1);
        });
    }
}

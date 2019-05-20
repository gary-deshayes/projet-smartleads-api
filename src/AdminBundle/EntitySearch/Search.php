<?php

namespace App\AdminBundle\EntitySearch;

class Search {

    /**
     * var string|null
     */
    private $search;

    /**
     * var int|null
     */
    private $limit;

    /**
     * Récupérer la recherche
     */ 
    public function getSearch()
    {
        return $this->search;
    }

    /**
     * Définir la recherche
     *
     * @return  self
     */ 
    public function setSearch($search)
    {
        $this->search = $search;

        return $this;
    }

    /**
     * Retourne la limite de pagination
     */
    public function getLimit(){
        return $this->limit;
    }

    /**
     * Définit la limite de pagination
     */
    public function setLimit($limit){
        $this->limit = $limit;

        return $this;
    }
}
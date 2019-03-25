<?php

namespace App\AdminBundle\EntitySearch;

class Search {

    /**
     * var string|null
     */
    private $search;

    /**
     * Get var string|null
     */ 
    public function getSearch()
    {
        return $this->search;
    }

    /**
     * Set var string|null
     *
     * @return  self
     */ 
    public function setSearch($search)
    {
        $this->search = $search;

        return $this;
    }
}
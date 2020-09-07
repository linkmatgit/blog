<?php

namespace App\Helper\Paginator;

use Doctrine\ORM\Query;

interface PaginatorInterface {

    public function allowSort(string ...$field):self;

    public function paginate(Query $query):iterable;

}
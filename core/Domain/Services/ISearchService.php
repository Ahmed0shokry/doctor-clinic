<?php
namespace AppCore\Domain\Services;

use Illuminate\Database\Eloquent\Collection;

interface ISearchService
{
    public function search($queryParameters): Collection;
}

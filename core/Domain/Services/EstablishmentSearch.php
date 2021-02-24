<?php


namespace AppCore\Domain\Services;


use App\Models\Establishment;
use Elasticsearch\Client;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

class EstablishmentSearch implements ISearchService
{

    private $search;

    public function __construct(Client $client) {
        $this->search = $client;
    }

    public function search( $queryParameters = []): Collection
    {
        $items = $this->searchOnElasticsearch($queryParameters);

        return $this->buildCollection($items);
    }




    private function searchOnElasticsearch($queryParameters): array
    {
        //todo : each technique like (autocomplete , match_phrase and so on ) depends on the situation
        $instance = new Establishment();
        return $this->search->search([
            'index' => $instance->getSearchIndex(),
            'body' => $this->getSearchQuery($queryParameters),
        ]);
    }
    private function getSearchQuery($queryParameters) {

        $query = [];
        $this->setPaginationParams($queryParameters, $query);
        $this->setQuerySearchSkeleton();
        $this->setSearchConditions($queryParameters, $query);
        return $query;
    }
    /**
     * @param $queryParameters
     * @param array $query
     */
    private function setPaginationParams($queryParameters,array & $query): void
    {
        $query['size'] = 10;
        //$query['size'] = $queryParameters['size'];
        $query['from'] = $queryParameters['from'];
    }

    private function setQuerySearchSkeleton(): void
    {
        $query = ['query' => ['bool' => []]];
    }

    /**
     * @param $queryParameters
     * @param array $query
     */
    private function setSearchConditions($queryParameters, array & $query): void
    {
        if (!$this->areThereConditionsToSearch($queryParameters)) {
            $this->getAllItems($query);
            return;
        }
        if ($this->isTermSearchExists($queryParameters))
            $this->setSearchTerm($queryParameters, $query);
        if ($this->isSectionIdFilterExists($queryParameters))
            $this->setSectionIdFilter($queryParameters, $query);
        if ($this->isSpecialityFilterExists($queryParameters))
            $this->setSpecialityFilter($queryParameters, $query);
        if ($this->isGenderFilterExists($queryParameters))
            $this->setGenderFilter($queryParameters, $query);
        if ($this->isCountryFilterExists($queryParameters))
            $this->setCountryFilter($queryParameters, $query);
        if ($this->isCityFilterExists($queryParameters))
            $this->setCityFilter($queryParameters, $query);
        if ($this->isAreaFilterExists($queryParameters))
            $this->setAreaFilter($queryParameters, $query);
//        dd($query);
    }

    /**
     * @param $queryParameters
     * @return bool
     */
    private function areThereConditionsToSearch($queryParameters): bool
    {
        return $this->isTermSearchExists($queryParameters)
            || $this->isSectionIdFilterExists($queryParameters)
            || $this->isSpecialityFilterExists($queryParameters)
            || $this->isGenderFilterExists($queryParameters)
            || $this->isCountryFilterExists($queryParameters)
            || $this->isCityFilterExists($queryParameters)
            || $this->isAreaFilterExists($queryParameters);
    }

    /**
     * @param $queryParameters
     * @return bool
     */
    private function isTermSearchExists($queryParameters): bool
    {
        return isset($queryParameters['query']) && !empty($queryParameters['query']);
    }

    /**
     * @param $queryParameters
     * @return bool
     */
    private function isSectionIdFilterExists($queryParameters): bool
    {
        return isset($queryParameters['sectionId']) && !empty($queryParameters['sectionId']);
    }

    /**
     * @param $queryParameters
     * @return bool
     */
    private function isSpecialityFilterExists($queryParameters): bool
    {
        return isset($queryParameters['speciality']) && !empty($queryParameters['speciality']);
    }

    /**
     * @param $queryParameters
     * @return bool
     */
    private function isGenderFilterExists($queryParameters): bool
    {
        return isset($queryParameters['gender']) && !empty($queryParameters['gender']);
    }

    /**
     * @param $queryParameters
     * @return bool
     */
    private function isCountryFilterExists($queryParameters): bool
    {
        return isset($queryParameters['country']) && !empty($queryParameters['country']);
    }

    /**
     * @param $queryParameters
     * @return bool
     */
    private function isCityFilterExists($queryParameters): bool
    {
        return isset($queryParameters['city']) && !empty($queryParameters['city']);
    }

    /**
     * @param $queryParameters
     * @return bool
     */
    private function isAreaFilterExists($queryParameters): bool
    {
        return isset($queryParameters['area']) && !empty($queryParameters['area']);
    }

    /**
     * @param array $query
     * @return array
     */
    private function getAllItems(array & $query): array
    {
        $query['query']['match_all'] = (object)[];
        return $query;
    }

    /**
     * @param $queryParameters
     * @param array $query
     */
    private function setSearchTerm($queryParameters, array & $query): void
    {
        $query['query']['bool']['must'] = [
            'match' => [
                'name' => ['query' => $queryParameters['query'], "fuzziness" => "AUTO"]
            ]
        ];
    }

    private function setSectionIdFilter ($queryParameters, array & $query) {
        $query['query']['bool']['filter'][] = ['term'=>['section._id' => $queryParameters['sectionId']]];
    }
    private function setSpecialityFilter ($queryParameters, array & $query) {
        $query['query']['bool']['filter'][] = ['term'=>['specialities' => $queryParameters['speciality']]];
    }

    private function setGenderFilter($queryParameters, array & $query) {
        $query['query']['bool']['filter'][] = ['term'=>['gender' => $queryParameters['gender']]];
    }

    private function setCountryFilter($queryParameters, array & $query) {
        $query['query']['bool']['filter'][] = ['term'=>['branches.country.id' => $queryParameters['country']]];
    }

    private function setCityFilter($queryParameters, array & $query) {
        $query['query']['bool']['filter'][] = ['term'=>['branches.city.id' => $queryParameters['city']]];
    }

    private function setAreaFilter($queryParameters, array & $query) {
        $query['query']['bool']['filter'][] = ['term'=>['branches.area.id' => $queryParameters['area']]];
    }
    private function buildCollection(array $items): Collection
    {
        /**
         * The data comes in a structure like this:
         * [
         *      'hits' => [
         *          'hits' => [
         *              [ '_source' => 1 ],
         *              [ '_source' => 2 ],
         *          ]
         *      ]
         * ]
         *
         * And we only care about the _source of the documents.
         */
        $hits = Arr::pluck($items['hits']['hits'], '_source') ?: [];
        $total = $items['hits']['total']['value'];
        $hitsWithTotal = (!empty($hits))?
            array_merge(['items' => $hits], ['total' => $total]) : [];
//        $sources = array_map(function ($source) {
//            $source['tags'] = json_encode($source['tags']);
//            return $source;
//        }, $hits);

        // We have to convert the results array into Eloquent Models.
        return Establishment::hydrate($hitsWithTotal);
    }

}

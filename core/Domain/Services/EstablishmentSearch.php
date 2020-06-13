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
        $items = $this->search->search([
            'index' => $instance->getSearchIndex(),
//            'type' => $instance->getSearchType(),
            //'body' => $this->getQueryBody($queryParameters['term']),
            'body' => $this->searchByTermAndSectionFilter($queryParameters),
        ]);

        return $items;
    }

    /**
     * @param string $searchTerm
     * @return \array[][]
     */
    private function getQueryBody(string $searchTerm): array
    {
        return [
            'query' => [
                'multi_match' => [
                    'fields' => ['name'],
                    'query' => $searchTerm,
                    "fuzziness" => "AUTO",
                ],
            ],
        ];
    }
    private function searchByTermAndSectionFilter($queryParameters) {
        return [
            'size' => $queryParameters['size'],
            'from' => $queryParameters['from'],
            'query' => [
//                'match_all'=>(object)[],
                'bool' => [
                    'must' => [
                        'match' => [
                            'name' => ['query' => $queryParameters['query'] , "fuzziness" => "AUTO"]
                            //'name' => ['query' => '' , 'fuzziness' => 'AUTO']
                        ],
                    ],
                    'filter' => ['term'=> ['section._id' => $queryParameters['sectionId']]]
                ],
            ],
        ];
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

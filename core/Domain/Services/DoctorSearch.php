<?php


namespace AppCore\Domain\Services;


use App\Models\Doctor;
use Elasticsearch\Client;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

class DoctorSearch implements ISearchService
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
        $instance = new Doctor();
        $items = $this->search->search([
            'index' => $instance->getSearchIndex(),
            'body' => $this->getSearchQuery($queryParameters),
        ]);

        return $items;
    }

    private function getSearchQuery($queryParameters) {
//        $queryToSearchByName = [
//            'size' => $queryParameters['size'],
//            'from' => $queryParameters['from'],
//            'query' => [
//                'bool' => [
//                    'must' => [
//                        'match' => [
//                            'name' => ['query' => $queryParameters['query'] , "fuzziness" => "AUTO"]
//                        ],
//                    ],
//                ],
//            ],
//        ];

        $queryToSearchByName = [
            'size' => $queryParameters['size'],
            'from' => $queryParameters['from'],
            'query' => [
                'bool' => [
                    'must' => [
                        'match' => [
                            'name' => ['query' => $queryParameters['query'] , "fuzziness" => "AUTO"]
                        ]
                    ]
                ],
            ],
        ];

        if(isset($queryParameters['speciality']))
        {
            $this->setSpecialityFilter($queryToSearchByName, $queryParameters);
        }
        return $queryToSearchByName;
    }
    private function setSpecialityFilter($queryToSearchByName, $queryParameters) {

        $queryToSearchByName['query']['bool']['filter'] = ['term'=> ['specialities' => $queryParameters['speciality']]];
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
        return Doctor::hydrate($hitsWithTotal);
    }

}

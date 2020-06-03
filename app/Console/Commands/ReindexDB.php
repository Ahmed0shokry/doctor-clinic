<?php

namespace App\Console\Commands;

use Elasticsearch\Client;
use Illuminate\Console\Command;

class ReindexDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:reindex';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'reindex all collections';

    /**
     * @var \Elasticsearch\Client
     */
    private $client;

    /**
     * Create a new command instance.
     *
     * @param \Elasticsearch\Client $client
     */
    public function __construct(Client $client)
    {
        parent::__construct();
        $this->client = $client;
    }

    public function handle()
    {
        $this->info('Indexing all collections. Might take a while...');

        $models = $this->getAllModels();
        foreach ($models as $model) {
            $this->indexSingleModel($model);
        }
        $this->info("\nall is Done!");

    }

    public function getAllModels(){
        $modelsPath = app()->path().'/Models';
        $modelsFullData = $this->getModelsData($modelsPath);
        return $this->extractNameAndPath($modelsFullData);
    }


    /**
     * @param string $modelsPath
     * $return array
     */
    private function getModelsData(string $modelsPath)
    {
        return \Illuminate\Support\Facades\File::allFiles($modelsPath);
    }

    /**
     * @param $modelsFullData
     * @return array
     */
    private function extractNameAndPath($modelsFullData): array
    {
        $models = [];
        foreach ($modelsFullData as $model) {
            $modelName = substr($model->getFilename(), 0, -4);
            $modelsPathStartAt = strpos($model->getPath(), 'Models');
            $modelPathFromModelsDirectory = substr($model->getPath(), $modelsPathStartAt);
            array_push($models, ["path" => $modelPathFromModelsDirectory, "name" => $modelName]);
        }
        return $models;
    }

    /**
     * @param $model
     */
    private function indexSingleModel($model): void
    {
        $modelName = $model['name'];
        $this->info("Indexing $modelName model. wait a while...");

        $modelFullNameSpace = $this->getModelFullNamespace($model, $modelName);
        foreach ($modelFullNameSpace::get() as $modelData) {
            $this->client->index([
                'index' => $modelData->getSearchIndex(),
                'type' => $modelData->getSearchType(),
                'id' => $modelData->id,
                'body' => $this->toSearchableArray($modelData->toSearchArray()),
            ]);

            // PHPUnit-style feedback
            $this->output->write('.');
        }
        $this->info("\n $modelName is Done!");
    }

    private function toSearchableArray($array)
    {

        if(isset($array['_id'])) {
            $array['id'] = $array['_id'];
            unset($array['_id']);
        }
        return $array;
    }

    /**
     * @param $model
     * @param $modelName
     * @return string
     */
    private function getModelFullNamespace($model, $modelName): string
    {
        $pathWithBackwardSlash = str_replace('/', '\\', $model['path']);
        return "App\\" . $pathWithBackwardSlash . "\\" . $modelName;
    }
}

<?php

namespace App\Transformers;

use App\Exceptions\CollectionTypeException;
use Illuminate\Support\Collection as SupportCollect;
use Illuminate\Database\Eloquent\Collection as DatabaseCollection;

abstract class SimpleTransformer
{

    /**
     * If set, ensure each item in the collection is the same class
     *
     * @var null
     */
    protected $expectedClass = null;

    /**
     *
     * Transform a collection, or a single item
     *
     * @param $transformData (Collection | (Model | Array))
     * @return array
     * @throws \Throwable CollectionTypeException
     */
    public function transform($transformData) : array
    {
        if ($transformData instanceof DatabaseCollection || $transformData instanceof SupportCollect) {
            if ($this->expectedClass !== null) {
                $badModels = [];
                foreach ($transformData as $model) {
                    if (!($model instanceof $this->expectedClass)) {
                        $badModels[] = "Invalid class found " . get_class($model);
                    }
                }
                throw_if(!empty($badModels), new CollectionTypeException(implode(PHP_EOL, $badModels)));
                return $transformData->transform(function ($item) {
                    return $this->mapItem($item);
                })->toArray();
            }
        }

        return $this->mapItem($transformData);
    }

    abstract protected function mapItem($item) : array;

}
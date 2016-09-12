<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Elasticquent\ElasticquentTrait;

class Item extends Model
{
    use ElasticquentTrait;

    /**
     * @return array
     */
    public static function customSearch($title, $published, $dateFrom, $dateTo)
    {
        $params = array();

        if (!empty($title)) {
            $params['body']['query']['match']['title'] = $title;
        } else {
            $params['body']['query']['match_all'] = array();
        }

        if ($dateFrom && $dateTo)
        {
            //$params['body']['query']['constant_score']['filter']['range']['created_at']['gt'] = $dateFrom;
            //$params['body']['query']['constant_score']['filter']['range']['updated_at']['lt'] = $dateTo;
        }
        // Published or not filter
        if ($published) {
            //$params['body']['query']['constant_score']['filter']['exists']['field'] = 'published_at';
        }

        $results = self::complexSearch($params);

        return $results;
    }
}

<?php
class ParserController
{
    private $component;

    public function __construct()
    {
        $this->component = Registry::get('load');     
    }

    public function actionParseReviews()
    {
        
        $modelReviews = $this->component->load('models_catalog_reviews');
        
        $parseData = array(
            'id'            => 'container',
            'tag'           => 'div',
            'sleep'         => (int)6,
            'select_data'   => array(
                array(
                    'selector' => 'one_reviews_text',
                    'attribute' => 'class',
                ),
                array(
                    'selector' => 'one_reviews_name',
                    'attribute' => 'class',
                ),
                array(
                    'selector' => 'one_reviews_date',
                    'attribute' => 'class',
                )
            )
        );


        for ($page = 1;; $page++) {

            $url = 'https://myxa.cc/reviews/page/' . $page . '/';

            $result = Parser::getElementsByClass($url, $parseData);

            if ($result) {

                $returnReviews = array_chunk($result, count($parseData['select_data']), false);

                $dataRevies = array();

                foreach ($returnReviews as $review) {
                    $dataRevies[] = array(
                        'author'    => htmlspecialchars($review['0'], ENT_QUOTES),
                        'date'      => Date::getDate($review['1'], "Y-m-d H:m:s"),
                        'text'      => htmlspecialchars($review['2'], ENT_QUOTES)
                    );
                }

                $modelReviews->addReviews($dataRevies);
                
                if ($returnReviews != true) {
                    break;
                }
            } else {
                break;
            }
        }

        return true;
    }
}

<?php
class reviews{
    private $db;

    public function __construct()
    {
        $this->db = Registry::get('db');
    }

    public function addReviews($data = array())
    {
        if ($data) {
            $query = 'INSERT INTO reviews ( reviews_author, reviews_text, reviews_email, reviews_date ) VALUES ';
            
            foreach ($data as $key => $review) {
                $query .= '( "' . strval($review['author']) . '", "' . strval($review['text']) . '", "' . null . '", "' . strval($review['date']) . '" ) ';
                if ((count($data) - 1) != $key) {
                    $query .= ', ';
                }
            }
            
            $this->db->query($query);
        }
    }

    public function getReviews($reviewsParam = '')
    {
        $query = 'SELECT reviews_id, reviews_author, reviews_text, reviews_email, reviews_date '
        . 'FROM reviews '
        . 'ORDER BY reviews.reviews_date DESC';

        if ($reviewsParam) {
            $limit  = $reviewsParam['limit'];
            $page   = $reviewsParam['page'];
            $offset = ((int)$reviewsParam['page'] - 1) * (int)$reviewsParam['limit'];
            $query .= ' LIMIT :limit OFFSET :offset';

            $queryParam = array(
                'limit' => array(
                    'data' => $limit,
                    'type' => PDO::PARAM_INT
                ),
                'offset' => array(
                    'data' => $offset,
                    'type' => PDO::PARAM_INT
                )
            );
        } else {
            $queryParam = '';
        }

        $result = $this->db->query($query, $queryParam)->rows;

        if ($result) {
            return $result;
        } else {
            return [];
        }

    }

    public function getLastReviews($limit)
    {
        $query = 'SELECT reviews_id, reviews_author, reviews_text, reviews_date '
        . 'FROM reviews '
        . 'LIMIT :limit';

        $queryParam = array(
            'limit' => array(
                'data' => $limit,
                'type' => PDO::PARAM_INT
            )
        );

        $result = $this->db->query($query, $queryParam)->rows;

        if ($result) {
            return $result;
        } else {
            return [];
        }
    }
    
    public function getReviewsTotal()
    {
        $query = 'SELECT * FROM reviews';

        $result = $this->db->query($query)->num_rows;

        if ($result) {
            return $result;
        } else {
            return [];
        }
    }
}
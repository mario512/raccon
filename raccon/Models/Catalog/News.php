<?php
class News
{
    private $db;

    public function __construct()
    {
        $this->db = Registry::get('db');    
    }
    
    public function getNews($newsParam = '')
    {
        
        $query = 'SELECT nw.news_id, nw.news_title, nw.news_text, nw.news_category_id, nw.news_date, '
        . 'nwc.news_category_name '
        . 'FROM news nw '
        . 'LEFT JOIN news_category nwc ON nw.news_category_id = nwc.news_category_id '
        . 'ORDER BY nw.news_date DESC';
        
        if ($newsParam) {
            $limit  = $newsParam['limit'];
            $page   = $newsParam['page'];
            $offset = ((int)$newsParam['page'] - 1) * (int)$newsParam['limit'];
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

    public function getNewsById($newsId)
    {
        $query = 'SELECT nw.news_id, nw.news_title, nw.news_text, nw.news_date, nw.news_category_id, '
        . 'nwc.news_category_name '
        . 'FROM news nw '
        . 'LEFT JOIN news_category nwc ON nw.news_category_id = nwc.news_category_id '
        . 'WHERE nw.news_id = :news_id';

        $queryParam = array(
            'news_id' => array(
                'data' => $newsId,
                'type' => PDO::PARAM_INT
            )
        );

        $result = $this->db->query($query, $queryParam)->row;

        if ($result) {
            return $result;
        } else {
            return [];
        }
    }

    public function getLastNews($limit) {
        
        $query = 'SELECT news_id, news_title, news_text, news_date, news_category_id '
        . 'FROM news '
        . 'ORDER BY news.news_date DESC '
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

    public function getNewsTotal()
    {
        $query = 'SELECT * FROM news';

        $result = $this->db->query($query)->num_rows;

        if ($result) {
            return $result;
        } else {
            return [];
        }
    }
}
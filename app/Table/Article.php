<?php

namespace App\Table;

use App\App;

class Article extends Table {

    protected static $table = 'article';

    public static function getLast(){
        return self::query("
            SELECT article.id, article.titre, contenu, categorie.titre AS categorie 
            FROM article
            LEFT JOIN categorie 
              ON categorie_id = categorie.id
              ");
    }

    public static function lastByCategory($id){
        return self::query("
            SELECT article.id, article.titre, contenu, categorie.titre AS categorie 
            FROM article
            LEFT JOIN categorie 
              ON categorie_id = categorie.id
            WHERE categorie_id = ?
              ",[$id]);
    }

    public function getUrl(){
        return ('index.php?p=article&id='.$this->id);
    }
    public function getExtrait(){
        $html = '<p>'.substr($this->contenu, 0, 100).'...</p>';
        $html .= '<p><a href="'.$this->getUrl().'">Voir la suite</a></p>';
        return ($html);
    }
}
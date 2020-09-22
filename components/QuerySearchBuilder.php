<?php


namespace app\components;


class QuerySearchBuilder
{
    public static function makeSearch (&$query, $fields, $term) {
        $terms = explode(' ', $term);
        array_map('trim', $terms);
        $afields = explode(',', $fields);
        array_map('trim', $afields);

        for ($i = 0, $ct = count($terms); $i < $ct; $i++) {
            $parms = [];
            $term = $terms[$i];
            $filterterm = '';
            $sep = '';
            for ($j = 0, $ct2 = count ($afields); $j < $ct2; $j++) {
                $field = $afields[$j];
                $parmname = str_replace ('.', '', 'st' . $field . $i);
                $filterterm .= $sep . $field . ' LIKE :' . $parmname;
                $parms[$parmname] = '%' . $term . '%';
                $sep = ' OR ';
            }
            $query->andWhere ($filterterm, $parms);
        }
        return $query;
    }
}
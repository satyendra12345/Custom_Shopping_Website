<?php


namespace app\components\grid;

use yii\grid\DataColumn;


class TSumColumn extends DataColumn {
    public function getDataCellValue($model, $key, $index)
    {
        $value = parent::getDataCellValue($model, $key, $index);
        if ( is_numeric($value))
        {
            $this->footer += $value;
        }
        
        return $value;
    }
}
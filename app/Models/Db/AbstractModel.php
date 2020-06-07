<?php

namespace App\Models\Db;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

abstract class AbstractModel extends Model
{
    use SoftDeletes;

    abstract function getSequenceTable();

	/**
     * 自身のseqテーブルを利用してユニークなIDを生成する
     */
    public function generatePkId()
    {
        $ret = DB::select("SELECT LAST_VALUE FROM ". $this->getSequenceTable());
        $curVal = isset($ret[0]) ? $ret[0]->last_value : 0;

        do
        {
            // LAST_VALUEに3桁の乱数を追加
            $id = $curVal. sprintf('%03d', mt_rand(1, 999));

            // 重複がないか確認
            $select = $this->getSelect();
            $object = $select->selectOneFromId($id);
            if (!$object) break;
        } while(true);

         // sequenceテーブルを+1する
         DB::select("SELECT SETVAL('". $this->getSequenceTable()."', ".($curVal+1).")");

        return $id;
    }

    /*
     * レプリケーション マスターコネクション取得
     * return Model;
     */
    public static function getMasterName()
    {
        return "pgsql";
    }
    public static function getMaster()
    {
        $instance = new static();
        $instance->setConnection(static::getMasterName());
        return $instance;
    }

    /*
     * レプリケーション スレーブコネクション取得
     * database.php pgsql_slaveに追加すれば自動的に選択候補に含まれる
     * return Model;
     */
    public static function getSlaveName()
    {
        return "pgsql";
    }
    public static function getSlave()
    {
        $instance = new static();
        $instance->setConnection(static::getSlaveName());

        return $instance;
    }
}

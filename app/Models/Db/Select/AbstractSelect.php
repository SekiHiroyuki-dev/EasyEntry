<?php

namespace App\Models\Db\Select;

use Illuminate\Database\Eloquent\Collection;

abstract class AbstractSelect
{
    private $_model = null;

    private $_forLock = false;

    private $_withTrashed = false;

    /**
     * モデルクラス名を返す
     */
    abstract protected static function getModelName();


    private function __construct()
    {
        $this->_initProperty();
    }

    private function _initProperty()
    {
        $this->_forLock = false;
        $this->_withTrashed = false;
    }

    /**
     * マスタに対してクエリを流します
     */
    public static function getMaster()
    {
        $instance = new static();
        $instance->_model = static::getModelName()::getMaster();

        return $instance;
    }

    /**
     * スレーブに対してクエリを流します
     */
    public static function getSlave()
    {
        $instance = new static();
        $instance->_model = static::getModelName()::getSlave();

        return $instance;
    }

    /**
     * Eloquent
     */
    protected function getModel()
    {
        return $this->_model;
    }

    /**
     * Eloquent
     */
    protected function getQuery()
    {
        $query = $this->_model->query();
        // ロックをかける
        if ($this->_forLock) {
            $query->sharedLock();
        }
        if ($this->_withTrashed) {
            $query->withTrashed();
        }
        // プロパティを元に戻す
        $this->_initProperty();
        return $query;
    }


    /**
     * IDから取得
     * @param unknown $id
     */
    public function selectOneFromId($id)
    {
        $model = $this->getModel();
        return $this->getQuery()->where($model->getKeyName(), $id)->first();
    }

    /**
     * IDのリストから取得
     * @param array $idList
     */
    public function selectFromIdList(array $idList): Collection
    {
        if ( ! count($idList)) return new Collection();
        $model = $this->getModel();
        return $this->getQuery()->whereIn($model->getKeyName(), $idList)->orderBy($model->getKeyName(), 'DESC')->get();
    }

    /**
     * 全件取得
     */
    public function selectAll()
    {
        return $this->getQuery()->get();
    }

    /**
     * 全件数取得
     */
    public function countAll()
    {
        return $this->getQuery()->count();
    }

    /**
     * 全件取得(件数指定)
     */
    public function selectAllWithOffsetAndLimit($offset = 0, $limit = 0)
    {
        $model = $this->getModel();
        $query = $this->getQuery()->orderBy($model->getKeyName(), 'DESC');
        $query = $query->skip($offset);
        if ($limit) $query = $query->take($limit);

        return $query->get();
    }

    /**
     * ロックをかける
     */
    public function forLock()
    {
        $this->_forLock = true;
        return $this;
    }

    /**
     * ソフトデリートも取得する
     */
    public function withTrashed()
    {
        $this->_withTrashed = true;
        return $this;
    }
}

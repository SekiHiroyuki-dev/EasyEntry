<?php

namespace App\Models\Db\Select;

use App\Models\Db\Select\AbstractSelect;

class MemberSelect extends AbstractSelect
{
	public static function getModelName()
    {
        return 'App\Models\Db\Member';
    }

    /**
     * ログインIDで担当者情報を取得
     *
     * @param string $loingId
     * @return App\Models\Db\Member;
     */
    public function selectOneFromLoginId($loginId)
    {
        return $this->getQuery()->where('login_id', $loginId)->first();
    }
}

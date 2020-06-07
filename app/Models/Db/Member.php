<?php

namespace App\Models\Db;

use App\Models\Db\AbstractModel;

class Member extends AbstractModel
{
	const SEQUENCE_TABLE = 'members_id_seq';

	public function getSequenceTable()
    {
        return self::SEQUENCE_TABLE;
    }
}

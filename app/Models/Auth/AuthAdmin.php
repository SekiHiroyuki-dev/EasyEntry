<?php

namespace App\Models\Auth;

use Session;
use App\Models\Auth\AbstractAuth;
use App\Models\Db\Select\MemberSelect;
use App\Exceptions\Auth\AuthFailedException;

class AuthAdmin extends AbstractAuth
{
	private const SESSION_KEY = "member_id";

	public static function isAuthed(): bool
	{
		if (Session::get(static::SESSION_KEY) !== null) {
			return true;
		}
		return false;
	}

	public static function id(): int
	{
		if (! static::isAuthed()) {
			return 0;
		}
		return Session::get(static::SESSION_KEY);
	}

	/**
	 * ログイン
	 *
	 * @param array $params
     * @throws AuthenticationException
     */
	public static function auth(array $params)
	{
		try {
			$loginId = $params['login_id'];
			$loginPassword = $params['login_password'];

			$member = MemberSelect::getSlave()->selectOneFromLoginId($loginId);
			if (is_null($member)) {
				throw new AuthFailedException('ログイン認証:ユーザー情報の取得に失敗しました');
			}

		//	if (! password_verify($loginPassword)) {
		//		throw new AuthFailedException('ログイン認証:認証に失敗しました');
		//	}

			// オーナーIDをセット
			Session::flush();
			Session::regenerate();
			Session::put(static::SESSION_KEY, $member->id);

			return redirect(route('admin.index'));

		} catch (AuthFailedException $afe) {
			return redirect('/NG');
			//return back()->withInput()->withErrors(["error" => $afe->getMessage()]);
		}
	}

    /**
     * セッション開放
     */
    public static function release(): void
    {
        Session::flush();
    }
}

<?php
namespace app\components;

class Status {

	const ACTIVE = 1;
	const NOACTIVE = 0;

	public static function get($val = null) {
		$arr = [
			static::ACTIVE => 'Активный',
			static::NOACTIVE => 'Не активный',
		];
		if (!is_null($val)) {
			if (array_key_exists($val, $arr)) {
				return $arr[$val];
			}
			return null;
		}
		return $arr;
	}

	public static function label($val) {
		$arr = [
			static::ACTIVE => '<span class="label label-success">' . static::get(static::ACTIVE) . '</span>',
			static::NOACTIVE => '<span class="label label-danger">' . static::get(static::NOACTIVE) . '</span>',
		];
		if (array_key_exists($val, $arr)) {
			return $arr[$val];
		}
		return '';
	}

	public static function list() {
		return [static::ACTIVE, static::NOACTIVE];
	}

}
<?php 

namespace app\rbac;

/**
 * Roles
 */
class Roles
{

	const ADMIN = 'admin';
	const VEKTAN= 'vektan';
	const LATUZ = 'latuz';

	public static function get($val = null)
	{

		$arr = [
			self::ADMIN => 'Админ', 
			self::VEKTAN=> 'Вектан',
			self::LATUZ => 'Латуз',
		];

		if (!is_null($val)) {

			if (array_key_exists($val, $arr)) {

				return $arr[$val];

			}

			return null;

		}

		return $arr;
		
	}

	public static function label($val)
	{

		$arr = [
			self::ADMIN => '<span class="label label-primary">'.self::get(self::ADMIN).'</span>',
			self::VEKTAN=> '<span class="label label-warning">'.self::get(self::VEKTAN).'</span>',
			self::LATUZ => '<span class="label label-info">'.self::get(self::LATUZ).'</span>',
		];

		if (array_key_exists($val, $arr)) {

			return $arr[$val];

		}

		return '';
		
	}

	public static function list()
	{
		return [static::ADMIN, static::VEKTAN, static::LATUZ];
	}

}
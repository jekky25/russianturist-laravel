<?php

namespace App\Helpers;

final class CacheKeys
{

	public static function itemById($id): string
	{
		return 'item_' . $id;
	}

	public static function countryById($id): string
	{
		return 'country_' . $id;
	}

	public static function countryByName($name): string
	{
		return 'country_name_' . $name;
	}

	public static function countryAllOrderBy($orderBy): string
	{
		return 'country_all_order_by' . $orderBy;
	}

	public static function configById($id): string
	{
		return 'config_' . $id;
	}

	public static function configAll(): string
	{
		return 'config_all';
	}

	public static function hotelById($id): string
	{
		return 'hotel_' . $id;
	}

	public static function hotelByName($name): string
	{
		return 'hotel_name_' . $name;
	}

	public static function hotelByLimit(): string
	{
		return 'hotel_limit';
	}

	public static function hotelOfCountry($countryId): string
	{
		return 'hotel_of_country_' . $countryId;
	}

	public static function hotelOfCity($cityId): string
	{
		return 'hotel_of_city_' . $cityId;
	}
}

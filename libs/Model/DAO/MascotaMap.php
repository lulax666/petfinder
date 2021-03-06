<?php
/** @package    Petfinder::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * MascotaMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the MascotaDAO to the mascota datastore.
 *
 * WARNING: THIS IS AN AUTO-GENERATED FILE
 *
 * This file should generally not be edited by hand except in special circumstances.
 * You can override the default fetching strategies for KeyMaps in _config.php.
 * Leaving this file alone will allow easy re-generation of all DAOs in the event of schema changes
 *
 * @package Petfinder::Model::DAO
 * @author ClassBuilder
 * @version 1.0
 */
class MascotaMap implements IDaoMap, IDaoMap2
{

	private static $KM;
	private static $FM;
	
	/**
	 * {@inheritdoc}
	 */
	public static function AddMap($property,FieldMap $map)
	{
		self::GetFieldMaps();
		self::$FM[$property] = $map;
	}
	
	/**
	 * {@inheritdoc}
	 */
	public static function SetFetchingStrategy($property,$loadType)
	{
		self::GetKeyMaps();
		self::$KM[$property]->LoadType = $loadType;
	}

	/**
	 * {@inheritdoc}
	 */
	public static function GetFieldMaps()
	{
		if (self::$FM == null)
		{
			self::$FM = Array();
			self::$FM["Pkmascota"] = new FieldMap("Pkmascota","mascota","pkmascota",true,FM_TYPE_INT,11,null,true);
			self::$FM["Nombre"] = new FieldMap("Nombre","mascota","nombre",false,FM_TYPE_VARCHAR,30,null,false);
            self::$FM["Genero"] = new FieldMap("Genero","mascota","genero",false,FM_TYPE_VARCHAR,15,null,false);
			self::$FM["Tamano"] = new FieldMap("Tamano","mascota","tamano",false,FM_TYPE_VARCHAR,30,null,false);
			self::$FM["Color"] = new FieldMap("Color","mascota","color",false,FM_TYPE_VARCHAR,30,null,false);
			self::$FM["FktipoMascota"] = new FieldMap("FktipoMascota","mascota","fktipo_mascota",false,FM_TYPE_INT,11,null,false);
			self::$FM["Fkraza"] = new FieldMap("Fkraza","mascota","fkraza",false,FM_TYPE_INT,11,null,false);
			self::$FM["Estado"] = new FieldMap("Estado","mascota","estado",false,FM_TYPE_INT,11,"0",false);

		}
		return self::$FM;
	}

	/**
	 * {@inheritdoc}
	 */
	public static function GetKeyMaps()
	{
		if (self::$KM == null)
		{
			self::$KM = Array();
		}
		return self::$KM;
	}

}

?>
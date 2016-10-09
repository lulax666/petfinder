<?php
/** @package Petfinder::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/Phreezable.php");
require_once("NotificacionMap.php");

/**
 * NotificacionDAO provides object-oriented access to the notificacion table.  This
 * class is automatically generated by ClassBuilder.
 *
 * WARNING: THIS IS AN AUTO-GENERATED FILE
 *
 * This file should generally not be edited by hand except in special circumstances.
 * Add any custom business logic to the Model class which is extended from this DAO class.
 * Leaving this file alone will allow easy re-generation of all DAOs in the event of schema changes
 *
 * @package Petfinder::Model::DAO
 * @author ClassBuilder
 * @version 1.0
 */
class NotificacionDAO extends Phreezable
{
	/** @var int */
	public $Pknotificacion;

	/** @var string */
	public $Fecha;

	/** @var string */
	public $Hora;

	/** @var int */
	public $FkusuarioDestino;

	/** @var int */
	public $Fkposter;

	/** @var int */
	public $Visto;



}
?>
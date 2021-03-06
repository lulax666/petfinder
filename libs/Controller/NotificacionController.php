<?php
/** @package    PETFINDER::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/Notificacion.php");

/**
 * NotificacionController is the controller class for the Notificacion object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package PETFINDER::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class NotificacionController extends AppBaseController
{

	/**
	 * Override here for any controller-specific functionality
	 *
	 * @inheritdocs
	 */
	protected function Init()
	{
		parent::Init();

		// TODO: add controller-wide bootstrap code
		
		// TODO: if authentiation is required for this entire controller, for example:
		// $this->RequirePermission(ExampleUser::$PERMISSION_USER,'SecureExample.LoginForm');
	}

	/**
	 * Displays a list view of Notificacion objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for Notificacion records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new NotificacionCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('Pknotificacion,Fecha,Hora,FkusuarioDestino,Fkposter,Visto'
				, '%'.$filter.'%')
			);

			// TODO: this is generic query filtering based only on criteria properties
			foreach (array_keys($_REQUEST) as $prop)
			{
				$prop_normal = ucfirst($prop);
				$prop_equals = $prop_normal.'_Equals';

				if (property_exists($criteria, $prop_normal))
				{
					$criteria->$prop_normal = RequestUtil::Get($prop);
				}
				elseif (property_exists($criteria, $prop_equals))
				{
					// this is a convenience so that the _Equals suffix is not needed
					$criteria->$prop_equals = RequestUtil::Get($prop);
				}
			}

			$output = new stdClass();

			// if a sort order was specified then specify in the criteria
 			$output->orderBy = RequestUtil::Get('orderBy');
 			$output->orderDesc = RequestUtil::Get('orderDesc') != '';
 			if ($output->orderBy) $criteria->SetOrder($output->orderBy, $output->orderDesc);

			$page = RequestUtil::Get('page');

			if ($page != '')
			{
				// if page is specified, use this instead (at the expense of one extra count query)
				$pagesize = $this->GetDefaultPageSize();

				$notificaciones = $this->Phreezer->Query('Notificacion',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $notificaciones->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $notificaciones->TotalResults;
				$output->totalPages = $notificaciones->TotalPages;
				$output->pageSize = $notificaciones->PageSize;
				$output->currentPage = $notificaciones->CurrentPage;
			}
			else
			{
				// return all results
				$notificaciones = $this->Phreezer->Query('Notificacion',$criteria);
				$output->rows = $notificaciones->ToObjectArray(true, $this->SimpleObjectParams());
				$output->totalResults = count($output->rows);
				$output->totalPages = 1;
				$output->pageSize = $output->totalResults;
				$output->currentPage = 1;
			}


			$this->RenderJSON($output, $this->JSONPCallback());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method retrieves a single Notificacion record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('pknotificacion');
			$notificacion = $this->Phreezer->Get('Notificacion',$pk);
			$this->RenderJSON($notificacion, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new Notificacion record and render response as JSON
	 */
	public function Create()
	{
		try
		{
						
			$json = json_decode(RequestUtil::GetBody());

			if (!$json)
			{
				throw new Exception('The request body does not contain valid JSON');
			}

			$notificacion = new Notificacion($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $notificacion->Pknotificacion = $this->SafeGetVal($json, 'pknotificacion');

			$notificacion->Fecha = $this->SafeGetVal($json, 'fecha');
			$notificacion->Hora = $this->SafeGetVal($json, 'hora');
			$notificacion->FkusuarioDestino = $this->SafeGetVal($json, 'fkusuarioDestino');
			$notificacion->Fkposter = $this->SafeGetVal($json, 'fkposter');
			$notificacion->Visto = $this->SafeGetVal($json, 'visto');

			$notificacion->Validate();
			$errors = $notificacion->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$notificacion->Save();

                $this->EnviarNotificacion();


				$this->RenderJSON($notificacion, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

    public function EnviarNotificacion(){

    }

	/**
	 * API Method updates an existing Notificacion record and render response as JSON
	 */
	public function Update()
	{
		try
		{
						
			$json = json_decode(RequestUtil::GetBody());

			if (!$json)
			{
				throw new Exception('The request body does not contain valid JSON');
			}

			$pk = $this->GetRouter()->GetUrlParam('pknotificacion');
			$notificacion = $this->Phreezer->Get('Notificacion',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $notificacion->Pknotificacion = $this->SafeGetVal($json, 'pknotificacion', $notificacion->Pknotificacion);

			$notificacion->Fecha = $this->SafeGetVal($json, 'fecha', $notificacion->Fecha);
			$notificacion->Hora = $this->SafeGetVal($json, 'hora', $notificacion->Hora);
			$notificacion->FkusuarioDestino = $this->SafeGetVal($json, 'fkusuarioDestino', $notificacion->FkusuarioDestino);
			$notificacion->Fkposter = $this->SafeGetVal($json, 'fkposter', $notificacion->Fkposter);
			$notificacion->Visto = $this->SafeGetVal($json, 'visto', $notificacion->Visto);

			$notificacion->Validate();
			$errors = $notificacion->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$notificacion->Save();
				$this->RenderJSON($notificacion, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing Notificacion record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('pknotificacion');
			$notificacion = $this->Phreezer->Get('Notificacion',$pk);

			$notificacion->Delete();

			$output = new stdClass();

			$this->RenderJSON($output, $this->JSONPCallback());

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}
}

?>

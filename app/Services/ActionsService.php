<?php

namespace App\Services;

use App\Models\PlatformObject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ActionsService{

	public static function generateActions($objectName, $roleId, $status) {
		$isUserAdmin = false;
		$canAddEditDuplicate = false;
        $canExport = false;
        $canDuplicate = false;
		$canDelete = false;
		if ( $roleId > 0 ) {
			if ($roleId == 1)
				$isUserAdmin = true;
			else {
				//Take this to common method?
				$permissions = PlatformObject::
					where('role_id', $roleId)
					->where('name', $objectName)
					->first();
				if ($permissions !== null) {
					$canExport = ($permissions->can_export ? true : false);
					$canAddEditDuplicate = ($permissions->can_add_edit ? true : false);
					$canDelete = ($permissions->can_delete ? true : false);
				}
			}
		}
		// Set actions
		$actions = [ 'v' => ['title' => '<i class="ph ph-eye"></i>', 'action' => 'viewObject', 'class' => 'btn-dark'] ];
		if ($status == 1) {
			if ($isUserAdmin || $canAddEditDuplicate){
				$actions['e'] = ['title' => '<i class="ph ph-pencil-simple"></i>', 'action' => 'editObject', 'class' => 'btn-outline-dark'];
				$actions['dp'] = ['title' => '<i class="ph ph-copy"></i>', 'action' => 'duplicateObject', 'class' => 'btn-info'];
			}
			
			if ($isUserAdmin || $canDelete)
				$actions['d'] = ['title' => '<i class="ph ph-trash-simple"></i>', 'action' => 'toggleObjectStatus', 'class' => 'btn-danger', 'additional_params' => [0]];

			if ($isUserAdmin || $canExport)
				$actions['ex'] = ['title' => '<i class="ph ph-printer"></i>', 'action' => 'exportObject', 'class' => 'btn-primary'];
	}

        return $actions;
	}

	public static function getPermissions($objectName, $roleId){
		if ( $roleId == 1 ) {
			return "1111";
		}else {
			// Common code for authorization
			$permissions = PlatformObject::
				where('role_id', $roleId)
				->where('name', $objectName)
				->first();
			$all_permissions = "1";
			if ($permissions !== null) {
				$all_permissions .= ($permissions->can_export ? "1" : "0");
				$all_permissions .= ($permissions->can_add_edit_duplicate ? "1" : "0");
				$all_permissions .= ($permissions->can_delete ? "1" : "0");
				
				return $all_permissions;
			} else
				return null;
		}
	}
}

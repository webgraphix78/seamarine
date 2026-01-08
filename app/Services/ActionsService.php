<?php

namespace App\Services;

use App\Models\PlatformObject;
use Illuminate\Support\Facades\Log;

class ActionsService{

	public static function generateActions($objectName, $roles, $status) {
		$platformObject = null;
		$canAddEditDuplicate = -1;
        $canExport = -1;
		$canDelete = -1;
		$roleIds = is_array($roles) ? $roles : ( $roles !== null ? [ $roles ] : [] );
		if ( !empty($roles) ) {
			$platformObject = PlatformObject::where('name', $objectName)->first();
			if( $platformObject == null )
				return null;
			$permissions = $platformObject->permissions;
			// If permissions stored as JSON string, decode it
            if (is_string($permissions)) {
                $permissions = json_decode($permissions, true);
            }
			if ($permissions !== null && is_array($permissions) && count($permissions) > 0) {
				foreach($permissions as $permission) {
					if (is_string($permission)) {
						$permission = json_decode($permission, true);
					}
					if (!is_array($permission) || !isset($permission['role_id'])) {
						continue;
					}
					// Log::info("message1  " . $roles);
					// Log::info("message 2 " . $permission['role_id']);
					if( $permission['role_id'] == $roles){
						$canExport = $permission['can_export'];
						$canAddEditDuplicate = $permission['can_add_edit_duplicate'];
						$canDelete = $permission['can_delete'];
						break;
					}
				}
			}
		}
		// Set actions
		$actions = [ 'v' => ['title' => '<i class="ph ph-eye"></i>', 'action' => 'viewObject', 'class' => 'btn-dark'] ];
		if( $canAddEditDuplicate === 1 ){
			$actions['e'] = ['title' => '<i class="ph ph-pencil-simple"></i>', 'action' => 'editObject', 'class' => 'btn-outline-dark'];
			if( $roleIds != [4] ){
				$actions['dp'] = ['title' => '<i class="ph ph-copy"></i>', 'action' => 'duplicateObject', 'class' => 'btn-info'];
			}
		}
		if ($canExport === 1 || $roleIds == [2])
			$actions['ex'] = ['title' => '<i class="ph ph-printer"></i>', 'action' => 'exportObject', 'class' => 'btn-primary'];

		if( $roleIds != [4] && $roleIds != [2] ){
			if ($canDelete === 1 && $status == 1) {
				$actions['d'] = ['title' => '<i class="ph ph-trash-simple"></i>', 'action' => 'toggleObjectStatus', 'class' => 'btn-danger', 'additional_params' => [0], 'hint' => 'Delete'];
			}else{
				$actions['d'] = ['title' => '<i class="ph ph-check"></i>', 'action' => 'toggleObjectStatus', 'class' => 'btn-success', 'additional_params' => [1], 'hint' => 'Activate'];
			}
		}
        return $actions;
	}

	public static function getPermissions($objectName, $roleIds = []){
		$canAddEditDuplicate = -1;
        $canExport = -1;
		$canDelete = -1;
		$canUpload = -1;
		// Normalize roleIds to array
        $roleIds = is_array($roleIds) ? $roleIds : ($roleIds !== null ? [$roleIds] : []);

        // If admin role present, return all-allowed
        if (in_array(1, $roleIds, true)) {
            return "1111";
		}else {
			// Common code for authorization
			$platformObject = PlatformObject::where('name', $objectName)->first();
			if( $platformObject == null )
				return null;
			$permissions = $platformObject->permissions;
			if (is_string($permissions)) {
				$permissions = json_decode($permissions, true);
			}
			if ($permissions !== null && is_array($permissions) && count($permissions) > 0) {
				foreach($permissions as $permission) {
					if (is_string($permission)) {
						$permission = json_decode($permission, true);
					}
					if (!is_array($permission) || !isset($permission['role_id'])) {
						continue;
					}
					if (in_array($permission['role_id'], $roleIds)) {
						$canExport = $permission['can_export'];
						$canAddEditDuplicate = $permission['can_add_edit_duplicate'];
						$canDelete = $permission['can_delete'];
						$canUpload = $permission['can_upload'];
						break;
					}
				}
			}
			$all_permissions = '';
			if ($permissions !== null) {
				$all_permissions .= ($canExport ? "1" : "0");
				$all_permissions .= ($canAddEditDuplicate ? "1" : "0");
				$all_permissions .= ($canDelete ? "1" : "0");
				$all_permissions .= ($canUpload ? "1" : "0");

				return $all_permissions;
			} else
				return null;
		}
	}
}

<?php

namespace App\Http\Resources;

use App\Models\PlatformObject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class OnhireUnitnrResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array{
		$input = $request->all();
		$isUserAdmin = false;
		$canEdit = false;
		$canDelete = false;
		if( isset($input['current_user_id']) && $input['current_user_id'] > 0 ){
			$currentUser = \App\Models\User::find($input['current_user_id']);
			if( $currentUser->role_id == 1 )
				$isUserAdmin = true;
			else{
				$platformObject = PlatformObject::where('title', 'Role')->first();
				$permissions = DB::table('role_object_mapping')
					->where('role_id', $currentUser->role_id)
					->where('platform_object_id', $platformObject->id)
					->first();
				if( $permissions !== null ){
					$canEdit .= ($permissions->can_add_edit ? true: false);
					$canDelete .= ($permissions->can_delete ? true: false);
				}
			}
		}
		// Set actions
		$actions = [];
		if( $this->status == 1 ){
			$actions = [
				'v' => [ 'title' => 'View', 'action' => 'viewObject', 'class' => 'btn-dark' ]
			];
			if( $canEdit )
				$actions['e'] = [ 'title' => 'Edit', 'action' => 'editObject', 'class' => 'btn-outline-dark' ];

			if( $isUserAdmin || $canDelete )
				$actions['d'] = [ 'title' => 'Deactivate', 'action' => 'toggleObjectStatus', 'class' => 'btn-secondary', 'additional_params' => [0] ];
		}
		else{
			if( $isUserAdmin || $canEdit )
				$actions['e'] = [ 'title' => 'Edit', 'action' => 'editObject', 'class' => 'btn-outline-dark' ];
			if( $isUserAdmin || $canDelete )
				$actions['r'] = [ 'title' => 'Activate', 'action' => 'toggleObjectStatus', 'class' => 'btn-success', 'additional_params' => [1] ];
		};
		return [
			'id' => $this->id,
			'onhire_id' => $this->onhire_id,
'unit_nr_1' => $this->unit_nr_1,
'unit_nr_1_calibration' => $this->unit_nr_1_calibration,
'unit_nr_1_calibration_value' => $this->unit_nr_1_calibration_value,
'unit_nr_2' => $this->unit_nr_2,
'unit_nr_2_manlid_swing' => $this->unit_nr_2_manlid_swing,
'unit_nr_2_manlid_swing_value' => $this->unit_nr_2_manlid_swing_value,
'unit_nr_2_manlid_swing_other' => $this->unit_nr_2_manlid_swing_other,
'unit_nr_3' => $this->unit_nr_3,
'unit_nr_3_collapsible' => $this->unit_nr_3_collapsible,
'unit_nr_4' => $this->unit_nr_4,
'unit_nr_4_dipstick' => $this->unit_nr_4_dipstick,
'unit_nr_4_dipstick_value' => $this->unit_nr_4_dipstick_value,
'unit_nr_5' => $this->unit_nr_5,
'unit_nr_5_topcover' => $this->unit_nr_5_topcover,
'unit_nr_6' => $this->unit_nr_6,
'unit_nr_6_walkway' => $this->unit_nr_6_walkway,
'unit_nr_7' => $this->unit_nr_7,
'unit_nr_7_manlid_gasket' => $this->unit_nr_7_manlid_gasket,
'unit_nr_7_manlid_gasket_other' => $this->unit_nr_7_manlid_gasket_other,
'unit_nr_8' => $this->unit_nr_8,
'unit_nr_8_grounding' => $this->unit_nr_8_grounding,
'unit_nr_9' => $this->unit_nr_9,
'unit_nr_9_bottomplate' => $this->unit_nr_9_bottomplate,
'unit_nr_10' => $this->unit_nr_10,
'unit_nr_10_pti_date' => $this->unit_nr_10_pti_date,
'created_by' => $this->created_by,

			'status' => $this->status,
			'created_by' => $this->created_by,
			'current_user_admin' => ( $isUserAdmin ? 1 : 0 ),
			'actions' => $actions
		];
    }
}

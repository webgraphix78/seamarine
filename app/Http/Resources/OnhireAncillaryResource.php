<?php

namespace App\Http\Resources;

use App\Models\PlatformObject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class OnhireAncillaryResource extends JsonResource
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
'ancf_1' => $this->ancf_1,
'ancf_1_cladding' => $this->ancf_1_cladding,
'ancf_2' => $this->ancf_2,
'ancf_2_ladder' => $this->ancf_2_ladder,
'ancf_2_ladder_type' => $this->ancf_2_ladder_type,
'ancf_3' => $this->ancf_3,
'ancf_3_placard' => $this->ancf_3_placard,
'ancf_4' => $this->ancf_4,
'ancf_4_decals' => $this->ancf_4_decals,
'ancf_5' => $this->ancf_5,
'ancf_5_tgauge' => $this->ancf_5_tgauge,
'ancf_5_other' => $this->ancf_5_other,
'ancf_5_temperature' => $this->ancf_5_temperature,
'ancf_5_ttype' => $this->ancf_5_ttype,
'ancf_6' => $this->ancf_6,
'ancf_6_doc_tube' => $this->ancf_6_doc_tube,
'ancf_7' => $this->ancf_7,
'ancf_7_steam_tube' => $this->ancf_7_steam_tube,
'ancf_7_steam_tube_value_1' => $this->ancf_7_steam_tube_value_1,
'ancf_7_steam_tube_value_2' => $this->ancf_7_steam_tube_value_2,
'ancf_8' => $this->ancf_8,
'ancf_8_steam_acc' => $this->ancf_8_steam_acc,
'ancf_8_steam_acc_value' => $this->ancf_8_steam_acc_value,
'ancf_9' => $this->ancf_9,
'ancf_9_bottom_comp' => $this->ancf_9_bottom_comp,
'ancf_10' => $this->ancf_10,
'ancf_10_electrical' => $this->ancf_10_electrical,
'ancf_10_manufacturer' => $this->ancf_10_manufacturer,
'created_by' => $this->created_by,

			'status' => $this->status,
			'created_by' => $this->created_by,
			'current_user_admin' => ( $isUserAdmin ? 1 : 0 ),
			'actions' => $actions
		];
    }
}

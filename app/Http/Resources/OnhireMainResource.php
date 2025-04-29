<?php

namespace App\Http\Resources;

use App\Models\PlatformObject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class OnhireMainResource extends JsonResource
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
'bd_x' => $this->bd_x,
'bd_x_value' => $this->bd_x_value,
'bd_other' => $this->bd_other,
'bd_butterfly_ball' => $this->bd_butterfly_ball,
'bd_butterfly_ball_sn' => $this->bd_butterfly_ball_sn,
'bd_tir_strip' => $this->bd_tir_strip,
'bd_spacers' => $this->bd_spacers,
'fv_x' => $this->fv_x,
'fv_x_value' => $this->fv_x_value,
'fv_other' => $this->fv_other,
'fv_option' => $this->fv_option,
'fv_tir_strip' => $this->fv_tir_strip,
'bocp_x' => $this->bocp_x,
'bocp_x_value' => $this->bocp_x_value,
'bocp_3_bsp' => $this->bocp_3_bsp,
'bocp_cap' => $this->bocp_cap,
'rt_x' => $this->rt_x,
'rt_type' => $this->rt_type,
'rt_fusible_link' => $this->rt_fusible_link,
'td_x' => $this->td_x,
'td_dn' => $this->td_dn,
'td_dn_value_1' => $this->td_dn_value_1,
'td_dn_value_2' => $this->td_dn_value_2,
'td_dn_other' => $this->td_dn_other,
'td_butterfly_ball' => $this->td_butterfly_ball,
'td_tir_strip' => $this->td_tir_strip,
'td_siphon_tube' => $this->td_siphon_tube,
'tl_x' => $this->tl_x,
'tl_dn' => $this->tl_dn,
'tl_dn_value_1' => $this->tl_dn_value_1,
'tl_dn_value_2' => $this->tl_dn_value_2,
'tl_dn_other' => $this->tl_dn_other,
'tl_butterfly_ball' => $this->tl_butterfly_ball,
'tl_tir_strip' => $this->tl_tir_strip,
'av_x' => $this->av_x,
'av_value_inch' => $this->av_value_inch,
'av_value' => $this->av_value,
'av_other' => $this->av_other,
'av_butterfly_ball' => $this->av_butterfly_ball,
'avc_type' => $this->avc_type,
'avc_tir_strip' => $this->avc_tir_strip,
'avc_cap_blank_v1' => $this->avc_cap_blank_v1,
'avc_cap_blank_v2' => $this->avc_cap_blank_v2,
'avc_cap_blank_v3' => $this->avc_cap_blank_v3,
'avc_air_pressure_gauge' => $this->avc_air_pressure_gauge,
'srv1_x' => $this->srv1_x,
'srv1_value1' => $this->srv1_value1,
'srv1_other' => $this->srv1_other,
'srv1_value2' => $this->srv1_value2,
'srv1_value3' => $this->srv1_value3,
'srv1_pressure' => $this->srv1_pressure,
'srv1_vac' => $this->srv1_vac,
'srv1_serial' => $this->srv1_serial,
'srv1_tir_strip' => $this->srv1_tir_strip,
'srv1_flame_screen' => $this->srv1_flame_screen,
'srv2_x' => $this->srv2_x,
'srv2_value1' => $this->srv2_value1,
'srv2_other' => $this->srv2_other,
'srv2_value2' => $this->srv2_value2,
'srv2_value3' => $this->srv2_value3,
'srv2_pressure' => $this->srv2_pressure,
'srv2_vac' => $this->srv2_vac,
'srv2_serial' => $this->srv2_serial,
'srv2_tir_strip' => $this->srv2_tir_strip,
'srv2_flame_screen' => $this->srv2_flame_screen,
'rd1_x' => $this->rd1_x,
'rd1_manufacture' => $this->rd1_manufacture,
'rd1_bar' => $this->rd1_bar,
'rd1_size' => $this->rd1_size,
'rd2_x' => $this->rd2_x,
'rd2_manufacture' => $this->rd2_manufacture,
'rd2_bar' => $this->rd2_bar,
'rd2_size' => $this->rd2_size,
'srv1_mano_x' => $this->srv1_mano_x,
'srv1_mano_value1' => $this->srv1_mano_value1,
'srv1_mano_bar' => $this->srv1_mano_bar,
'srv2_mano_x' => $this->srv2_mano_x,
'srv2_mano_value' => $this->srv2_mano_value,
'srv2_mano_bar' => $this->srv2_mano_bar,
'gps' => $this->gps,
'camera' => $this->camera,
'created_by' => $this->created_by,

			'status' => $this->status,
			'created_by' => $this->created_by,
			'current_user_admin' => ( $isUserAdmin ? 1 : 0 ),
			'actions' => $actions
		];
    }
}

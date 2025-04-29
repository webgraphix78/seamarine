<?php

namespace App\Http\Resources;

use App\Models\PlatformObject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Services\ActionsService;

class ReferEquipmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array{
		$input = $request->all();
		$actions = [];
		
		if (isset($input['current_user_id']) && $input['current_user_id'] > 0) {
			$currentUser = \App\Models\User::find($input['current_user_id']);
			$actions = ActionsService::generateActions(\App\Models\ReferEquipment::class, $currentUser->role_id, $this->status);
		};
		return [
			'id' => $this->id,
			'ref_no' => $this->ref_no,
			'company_id' => $this->company_id,
			'rel_company_id' => $this->rel_company_id,
			'inspection_date' => $this->inspection_date,
			'inspection_location_id' => $this->inspection_location_id,
			'rel_inspection_location_id' => $this->rel_inspection_location_id,
			'customer_id' => $this->customer_id,
			'rel_customer_id' => $this->rel_customer_id,
			'tank_no' => $this->tank_no,
			'shipping_agency' => $this->shipping_agency,
			'container_type' => $this->container_type,
			'booking_no' => $this->booking_no,
			'model' => $this->model,
			'serial' => $this->serial,
			'in_service' => $this->in_service,
			'date_of_last_pretrip' => $this->date_of_last_pretrip,
			'run_through' => $this->run_through,
			'temperature_set_pti' => $this->temperature_set_pti,
			'temperature_set_rechecked' => $this->temperature_set_rechecked,
			'exterior' => $this->exterior,
			'exterior_right' => $this->exterior_right,
			'exterior_left' => $this->exterior_left,
			'exterior_front' => $this->exterior_front,
			'exterior_roof' => $this->exterior_roof,
			'exterior_under' => $this->exterior_under,
			'exterior_rear' => $this->exterior_rear,
			'exterior_rear_door_right' => $this->exterior_rear_door_right,
			'exterior_rear_door_left' => $this->exterior_rear_door_left,
			'seaworthiness' => $this->seaworthiness,
			'interior' => $this->interior,
			'interior_right' => $this->interior_right,
			'interior_left' => $this->interior_left,
			'interior_front' => $this->interior_front,
			'interior_ceiling' => $this->interior_ceiling,
			'interior_floor' => $this->interior_floor,
			'interior_rear' => $this->interior_rear,
			'interior_rear_door_right' => $this->interior_rear_door_right,
			'interior_rear_door_left' => $this->interior_rear_door_left,
			'clean_free_from_odour' => $this->clean_free_from_odour,
			'cable_440' => $this->cable_440,
			'controller' => $this->controller,
			'transformer' => $this->transformer,
			'mcb' => $this->mcb,
			'compressor' => $this->compressor,
			'unit_bolts_fasteners' => $this->unit_bolts_fasteners,
			'power_plug_440' => $this->power_plug_440,
			'contactors' => $this->contactors,
			'battery' => $this->battery,
			'display_board' => $this->display_board,
			'wiring_terminals' => $this->wiring_terminals,
			'refg_run_through' => $this->refg_run_through,
			'comments' => $this->comments,
			'surveyor_id' => $this->surveyor_id,
			'rel_surveyor_id' => $this->rel_surveyor_id,
			'deleted_at' => $this->deleted_at,
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,

			'current_user_admin' => 1,
			'actions' => $actions
		];
    }
}

<?php

namespace App\Http\Resources;

use App\Models\PlatformObject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Services\ActionsService;

class PrvResource extends JsonResource
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
			$actions = ActionsService::generateActions(\App\Models\Prv::class, $currentUser->role_id, $this->status);
		};
		return [
			'id' => $this->id,
			'ref' => $this->ref,
			'date_of_issue' => $this->date_of_issue,
			'company_id' => $this->company_id,
			'rel_company_id' => $this->rel_company_id,
			'customer_id' => $this->customer_id,
			'rel_customer_id' => $this->rel_customer_id,
			'inspection_location_id' => $this->inspection_location_id,
			'rel_inspection_location_id' => $this->rel_inspection_location_id,
			'address' => $this->address,
			'tank_no' => $this->tank_no,
			'inspection_date' => $this->inspection_date,
			'address_2' => $this->address_2,
			'mfg' => $this->mfg,
			'serial_no' => $this->serial_no,
			'full_flow_rate' => $this->full_flow_rate,
			'op' => $this->op,
			'vaccum_set' => $this->vaccum_set,
			'bursting_disc' => $this->bursting_disc,
			'surveyor_id' => $this->surveyor_id,
			'rel_surveyor_id' => $this->rel_surveyor_id,
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,
			'status' => $this->status,
			'current_user_admin' => ( $currentUser->role_id ? 1 : 0 ),
			'actions' => $actions
		];
    }
}

<?php

namespace App\Http\Resources;

use App\Models\PlatformObject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Services\ActionsService;

class CscreResource extends JsonResource
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
			$actions = ActionsService::generateActions(\App\Models\Cscre::class, $currentUser->role_id, $this->status);
		};
		return [
			'id' => $this->id,
			'ref_no' => $this->ref_no,
			'company_id' => $this->company_id,
			'rel_company_id' => $this->rel_company_id,
			'customer_name' => $this->customer_name,
			'serial_no' => $this->serial_no,
			'company_name' => $this->company_name,
			'inspection_date' => $this->inspection_date,
			'inspection_location' => $this->inspection_location,
			'address' => $this->address,
			'container_no' => $this->container_no,
			'iso_type' => $this->iso_type,
			'csc_approval_no' => $this->csc_approval_no,
			'mfg_type' => $this->mfg_type,
			'mfg' => $this->mfg,
			'mfg_date' => $this->mfg_date,
			'customs_no' => $this->customs_no,
			'csc_reinspection_date' => $this->csc_reinspection_date,
			'comments' => $this->comments,
			'max_gross_weight' => $this->max_gross_weight,
			'tare_weight' => $this->tare_weight,
			'stacking_weight' => $this->stacking_weight,
			'racking_test_force' => $this->racking_test_force,
			'issue_date' => $this->issue_date,
			'surveyor_name' => $this->surveyor_name,
			'status' => $this->status,
			'deleted_at' => $this->deleted_at,
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,

			'current_user_admin' =>1,
			'actions' => $actions
		];
    }
}

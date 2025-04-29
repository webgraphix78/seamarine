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
			'request_of_name' => $this->request_of_name,
			'attend' => $this->attend,
			'of_name' => $this->of_name,
			'attend_day' => $this->attend_day,
			'attend_month' => $this->attend_month,
			'unit_no' => $this->unit_no,
			'csc_approval_no' => $this->csc_approval_no,
			'mfg' => $this->mfg,
			'mfg_date' => $this->mfg_date,
			'mfg_serial_no' => $this->mfg_serial_no,
			'container_type' => $this->container_type,
			'iso_type' => $this->iso_type,
			'next_csc_inspection_date' => $this->next_csc_inspection_date,
			'csc_reinspection_date' => $this->csc_reinspection_date,
			'survey_without_prejudice' => $this->survey_without_prejudice,
			'deleted_at' => $this->deleted_at,
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,

			'current_user_admin' =>1,
			'actions' => $actions
		];
    }
}

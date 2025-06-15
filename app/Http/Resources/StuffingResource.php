<?php

namespace App\Http\Resources;

use App\Models\PlatformObject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Services\ActionsService;

class StuffingResource extends JsonResource
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
			$actions = ActionsService::generateActions(\App\Models\Stuffing::class, $currentUser->role_id, $this->status);
		};
		return [
			'id' => $this->id,
			'ref_no' => $this->ref_no,
			'company_id' => $this->company_id,
			'rel_company_id' => $this->rel_company_id,
			'customer_id' => $this->customer_id,
			'rel_customer_id' => $this->rel_customer_id,
			'issue_date' => $this->issue_date,
			'dispatch_date' => $this->dispatch_date,
			'cfs_receipt_date' => $this->cfs_receipt_date,
			'product_name' => $this->product_name,
			'quantity_kg' => $this->quantity_kg,
			'packages_received' => $this->packages_received,
			'preshipment_invoice' => $this->preshipment_invoice,
			'excise_invoice' => $this->excise_invoice,
			'vehicle_nos' => $this->vehicle_nos,
			'goods_condition_check' => $this->goods_condition_check,
			'unloading_datetime' => $this->unloading_datetime,
			'unloading_photos' => $this->unloading_photos,
			'goods_condition_cfs' => $this->goods_condition_cfs,
			'cfs_area_clean' => $this->cfs_area_clean,
			'action_taken' => $this->action_taken,
			'goods_storage_location' => $this->goods_storage_location,
			'pallets_condition' => $this->pallets_condition,
			'palletization_done' => $this->palletization_done,
			'shipping_marks_done' => $this->shipping_marks_done,
			'shrink_wrapping_done' => $this->shrink_wrapping_done,
			'labeling_done' => $this->labeling_done,
			'packaging_photos' => $this->packaging_photos,
			'packaging_done_time' => $this->packaging_done_time,
			'container_seal_no' => $this->container_seal_no,
			'fumigation_done' => $this->fumigation_done,
			'stuffing_photos' => $this->stuffing_photos,
			'stuffing_done' => $this->stuffing_done,
			'lashing_done' => $this->lashing_done,
			'sealing_done' => $this->sealing_done,
			'container_done_time' => $this->container_done_time,
			'surveyor_id' => $this->surveyor_id,
			'rel_surveyor_id' => $this->rel_surveyor_id,
			'deleted_at' => $this->deleted_at,
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,
			'status' => $this->status,

			'current_user_admin' => ( $currentUser->role_id ? 1 : 0 ),
			'actions' => $actions
		];
    }
}

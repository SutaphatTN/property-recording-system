<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property string $model_name
 * @property string $tank_number
 * @property string $machine_number
 * @property string $color
 * @property string $receiving_company
 * @property string $sending_company
 * @property string $cost_price
 * @property string $sell_price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\ReceivingFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Receiving newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Receiving newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Receiving query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Receiving whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Receiving whereCostPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Receiving whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Receiving whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Receiving whereMachineNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Receiving whereModelName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Receiving whereReceivingCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Receiving whereSellPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Receiving whereSendingCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Receiving whereTankNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Receiving whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperReceiving {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property int|null $is_admin
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperUser {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string|null $images
 * @property string $assetCode
 * @property string $assetName
 * @property string $detail_property
 * @property int $company_id
 * @property int $branch_id
 * @property string $location_sub
 * @property int $department_id
 * @property int $position_id
 * @property string $purchase_date
 * @property string $expiration_date
 * @property string $purchase_price
 * @property string $purchase_reason
 * @property string $status
 * @property string $presenter
 * @property string $asset_status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\branch $branch
 * @property-read \App\Models\company $company
 * @property-read \App\Models\department $department
 * @property-read \App\Models\asset_maintenance|null $maintenance
 * @property-read \App\Models\position $position
 * @method static \Illuminate\Database\Eloquent\Builder<static>|asset_information newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|asset_information newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|asset_information query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|asset_information whereAssetCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|asset_information whereAssetName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|asset_information whereAssetStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|asset_information whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|asset_information whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|asset_information whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|asset_information whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|asset_information whereDetailPropoty($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|asset_information whereExpirationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|asset_information whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|asset_information whereImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|asset_information whereLocationSub($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|asset_information wherePositionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|asset_information wherePresenter($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|asset_information wherePurchaseDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|asset_information wherePurchasePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|asset_information wherePurchaseReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|asset_information whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|asset_information whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperasset_information {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $asset_id
 * @property string $repair_date
 * @property string $repair_price
 * @property string $repair_reason
 * @property string $presenter
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|asset_maintenance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|asset_maintenance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|asset_maintenance query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|asset_maintenance whereAssetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|asset_maintenance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|asset_maintenance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|asset_maintenance wherePresenter($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|asset_maintenance whereRepairDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|asset_maintenance whereRepairPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|asset_maintenance whereRepairReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|asset_maintenance whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperasset_maintenance {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $branch_name
 * @method static \Illuminate\Database\Eloquent\Builder<static>|branch newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|branch newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|branch query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|branch whereBranchName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|branch whereId($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperbranch {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $company_name
 * @method static \Illuminate\Database\Eloquent\Builder<static>|company newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|company newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|company query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|company whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|company whereId($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelpercompany {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $department_name
 * @method static \Illuminate\Database\Eloquent\Builder<static>|department newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|department newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|department query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|department whereDepartmentName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|department whereId($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperdepartment {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $position_name
 * @method static \Illuminate\Database\Eloquent\Builder<static>|position newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|position newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|position query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|position whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|position wherePositionName($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperposition {}
}


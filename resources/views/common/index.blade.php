@extends('layouts.adminapp')

@section('content')

<?php $currentUserId = '';?>
@isset($current_user_id)
	<?php $currentUserId = (strlen($current_user_id) > 0?'current_user_id="'.$current_user_id.'"':"");?>
@endisset
<?php $allPermissions = '';?>
@isset($all_permissions)
	<?php $allPermissions = (strlen($all_permissions) > 0?'all_permissions="'.$all_permissions.'"':"");?>
@endisset
<?php $objectIdVal = '';?>
@isset($objectId)
	<?php $objectIdVal = (strlen($objectId) > 0?'id="'.$objectId.'"':"");?>
@endisset
<?php $paramVal1 = '';?>
@isset($param1)
	<?php $paramVal1 = 'param1="'.(is_array($param1)?json_encode($param1):$param1).'"';?>
@endisset
<?php $paramVal2 = '';?>
@isset($param2)
	<?php $paramVal2 = 'param2="'.(is_array($param2)?json_encode($param2):$param2).'"';?>
@endisset
<?php $paramVal3 = '';?>
@isset($param3)
	<?php $paramVal3 = 'param3="'.(is_array($param3)?json_encode($param3):$param3).'"';?>
@endisset

<?php $modeStr = '';?>
@isset($mode)
	<?php $modeStr = 'mode="'.(strlen($mode) > 0?$mode:"").'"';?>
@endisset

<{{ $component }} {!! $paramVal1 !!} {!! $paramVal2 !!} {!! $paramVal3 !!} {!! $modeStr !!} {!! $objectIdVal !!} {!! $currentUserId !!} {!! $allPermissions !!}></{{ $component }}>

@endsection

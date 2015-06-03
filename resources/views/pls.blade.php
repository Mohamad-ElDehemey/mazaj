@foreach($lists as $list)
<?php 
	$found = false;
	if($list->tracks->count())
		foreach ($list->tracks as $track) {
			
			if($track->id == $id)
				$found = true;
			
			
		}
?>
<div class="list container-fluid" listid="$list->id">
	<div class="row">
		<div class="col-lg-8">

			<a href="{!!URL::to('/')!!}/playlist/id/{!!$list->id!!}" class="list-name">{!!$list->name!!}</a>

		</div>
	
	@if(!$found)
		<div class="col-lg-4">
			<button type="button" class="btn btn-success btn-sm add-to-list-btn pull-right" action='add' list='{!!$list->id!!}'><span class="glyphicon glyphicon-ok"></span></button>
		</div>
	@else
		<div class="col-lg-4">
			<button type="button" class="btn btn-danger btn-sm add-to-list-btn pull-right" action='remove' list='{!!$list->id!!}'><span class="glyphicon glyphicon-remove"></span></button>
		</div>
	@endif
	</div>
</div>
@endforeach
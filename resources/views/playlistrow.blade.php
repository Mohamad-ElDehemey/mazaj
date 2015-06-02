	<div class="list container-fluid" listid="{!!$list->id!!}">
		<div class="row">
			<div class="col-lg-8">

				<a href="{!!URL::to('/')!!}playlist/id/{!!$list->id!!}" class="list-name">{!!$list->name!!}</a>

			</div>
			<div class="col-lg-4">
				<button type="button" class="btn btn-success btn-sm add-to-list pull-right"><span class="glyphicon glyphicon-ok"></span></button>
			</div>
		</div>
	</div>
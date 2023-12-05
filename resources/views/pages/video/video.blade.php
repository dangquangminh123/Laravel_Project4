@extends('layout')

@section('sidebar')
	@include('pages.include.attribute');
@endsection

@section('content')   
    <div class="features_items"><!--features_items-->
		<h2 class="title text-center">Videos</h2>
			@foreach($all_videos as $key => $videos)
					
				<div class="col-sm-4">	
					<div class="product-image-wrapper">
						<style type="text/css">
						.single-products.single-products-video{
							height: 450px;
						}
						</style>
						<form>
							@csrf
							<div class="single-products single-products-video">
								<div class="productinfo text-center">
									<form>
										@csrf
										<a href="">
											<img src="{{asset('public/uploads/videos/'.$videos->video_images)}}" width="200" height="150"
											alt="{{$videos->video_title}}" />
											<h2>{{$videos->video_title}}</h2>
											<p>{{$videos->video_desc}}</p>
										</a>
										<button type="button" class="btn btn-primary watch-video" data-toggle="modal"
										data-target="#modal_video" id="{{$videos->video_id}}">
											Xem video
										</button>
									</form>
								</div>
							</div>
						</form>
					</div>
				</div>
			@endforeach				
		</div>
	<ul class="pagination pagination-sm m-t-none m-b-none">
		{{$all_videos->links()}}
	</ul>

		
		<!-- Modal -->
	<div class="modal fade" id="modal_video" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
				<h5 class="modal-title" id="video_title">Modal title</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div id="video_desc"></div>
					<div id="video_link"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Đòng video</button>
				</div>
			</div>
		</div>
  	</div>

@endsection
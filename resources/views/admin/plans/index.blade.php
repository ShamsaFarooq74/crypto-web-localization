@extends('layouts.master')
@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Toolbar-->
	<div class="toolbar" id="kt_toolbar">
		<!--begin::Container-->
		<div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
					<li class="breadcrumb-item " aria-current="page">SubScription Plan</li>
				</ol>
			</nav>
		</div>
		<!--end::Container-->
	</div>
	<!--end::Toolbar-->
	<!--begin::Post-->
	<div class="post d-flex flex-column-fluid" id="kt_post">
		<!--begin::Container-->
		<div id="kt_content_container" class="container-xxl">
			<!--begin::Row-->
			<div class="container">
				<!--begin::Tables Widget 9-->
				<div class="card mb-5 mb-xl-8">
					<!--begin::Header-->
					<div class="card-header border-0 pt-5">
						<h3 class="card-title align-items-start flex-column">
							<span class="card-label fw-bolder fs-3 mb-1">Subscription Plan Statistics</span>
							<span class="text-muted mt-1 fw-bold fs-7">Total {{ $plan_count }} Subscription Plans
							are</span>
						</h3>
						<div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top"
						data-bs-trigger="hover">
						<a href="{{ route('plan.create') }}" class="btn btn-sm btn-light btn-active-primary">
							<!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
							<span class="svg-icon svg-icon-3">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
								viewBox="0 0 24 24" fill="none">
								<rect opacity="0.5" x="11.364" y="20.364" width="16" height="2"
								rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
								<rect x="4.36396" y="11.364" width="16" height="2" rx="1"
								fill="black" />
							</svg>
						</span>
						<!--end::Svg Icon-->Create SubScription Plan
					</a>
				</div>
			</div>
			<!--end::Header-->
			<!--begin::Body-->
			<div class="card-body py-3">
				<!--begin::Table container-->
				<div class="table-responsive">
					<!--begin::Table-->
					<table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
						<!--begin::Table head-->
						<thead>
							<tr class="fw-bolder text-muted">
								<th class="fw-bold">#</th>
								<th class="min-w-100px">Name (English)</th>
								<th class="min-w-100px">Name (Arabic)</th>
								<th class="min-w-100px">Price</th>
								<th class="min-w-100px">Description(English)</th>
								<th class="min-w-100px">Description (Arabic)</th>
								<th class="min-w-100px text-end">Actions</th>
							</tr>
						</thead>
						<!--end::Table head-->
						<!--begin::Table body-->
						<tbody>
							@foreach ($plans as $key => $plan)
							<tr>
								<td>
									<p class="text-dark fw-bolder text-hover-primary d-block fs-6 ">
										{{ ++$key }}.
									</p>
								</td>
								<td>
									<p class="text-dark fw-bolder text-hover-primary d-block fs-6 ">
										{{ $plan->nameEN }}
									</p>
								</td>
								<td>
									<p class="text-dark fw-bolder text-hover-primary d-block fs-6 ">
										{{ $plan->nameAR }}
									</p>
								</td>
								<td>
									<p class="text-dark fw-bolder text-hover-primary d-block fs-6 ">
										{{ $plan->price }} <span
										class="text-uppercase">{{ $plan->currency }}</span>
									</p>
								</td>
								<td>
									<p class="text-dark fw-bolder text-hover-primary d-block fs-6 ">
										{{ substr($plan->descriptionEN, 0, 12) . '...' }}
									</p>
								</td>
								<td>
									<p class="text-dark fw-bolder text-hover-primary d-block fs-6 ">
										{{ substr($plan->descriptionAR, 0, 12) . '...' }}
									</p>
								</td>

								<td>
									<div class="d-flex justify-content-end flex-shrink-0">
										<div class="menu-item px-3">
											<div class="menu-content px-3">
												<label
												class="form-check form-switch form-check-custom form-check-solid">
												<input
												class="toggle-class form-check-input w-30px h-20px"
												data-id={{ $plan->id }} type="checkbox"
												{{ $plan->status == 1 ? 'checked' : '' }}
												data-on="Active" data-off="InActive" />
												<span class="form-check-label text-muted fs-7"></span>
											</label>
										</div>
									</div>
									<form action="{{ route('plan.edit', $plan->id) }}" method="post">
										@csrf
										@method('GET')
										<button type="submit"
										class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
										<!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
										<span class="svg-icon svg-icon-3">
											<svg xmlns="http://www.w3.org/2000/svg" width="24"
											height="24" viewBox="0 0 24 24" fill="none">
											<path opacity="0.3"
											d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z"
											fill="black" />
											<path
											d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z"
											fill="black" />
										</svg>
									</span>

									<!--end::Svg Icon-->
								</button>
							</form>
							<form action="{{ route('plan.destroy', $plan->id) }}"
								method="post" id="delete-form">
								@csrf
								@method('DELETE')
								<a onclick="confirmDelete()"
								class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
								<!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
								<span class="svg-icon svg-icon-3">
									<svg xmlns="http://www.w3.org/2000/svg" width="24"
									height="24" viewBox="0 0 24 24" fill="none">
									<path
									d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z"
									fill="black" />
									<path opacity="0.5"
									d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z"
									fill="black" />
									<path opacity="0.5"
									d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z"
									fill="black" />
								</svg>
							</span>
							<!--end::Svg Icon-->
						</a>
					</form>
				</div>
			</td>
		</tr>
		@endforeach
	</tbody>
	<!--end::Table body-->
</table>
<!--end::Table-->
</div>
<!--end::Table container-->
</div>
<!--begin::Body-->
</div>
<!--end::Tables Widget 9-->

</div>


<!--end::Row-->
</div>
<!--end::Container-->
</div>
<!--end::Post-->
</div>
@endsection
@section('scripts')
<script>
	$(function() {
		$('.toggle-class').change(function() {
			var status = $(this).prop('checked') == true ? 1 : 0;
			var plan_id = $(this).data('id');
			$.ajax({
				type: "GET",
				dataType: "json",
				url: '{{ route('plan.status') }}',
				data: {
					'status': status,
					'plan_id': plan_id
				},
				success: function(response) {

					$('#message').html(toastr["success"](response.message));

				}
			});
		})
	})
</script>
@endsection

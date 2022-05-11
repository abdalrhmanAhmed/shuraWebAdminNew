@extends('layouts.master')
@section('css')
<!--  Owl-carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />
<!-- Maps css -->
<link href="{{URL::asset('assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="left-content">
						<div>
						  <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">مرحباً {{auth()->user()->name}}، أهلاً بعودتك</h2>
						  <p class="mg-b-0">لوحة مراقبة أداء النظام و العمليات</p>
						</div>
					</div>
					<div class="main-dashboard-header-right">
						<div>
							<label class="tx-13">التقييم العام</label>
							<div class="main-star">
								<i class="typcn typcn-star active"></i> 
								<i class="typcn typcn-star active"></i>
								 <i class="typcn typcn-star active"></i>
								  <i class="typcn typcn-star active"></i>
								   <i class="typcn typcn-star"></i> <span>(0)</span>
							</div>
						</div>
						<div>
							<label class="tx-13">عدد الطلبات</label>
							<h5>0</h5>
						</div>
						<div>
							<label class="tx-13">الطلبات المعلقة</label>
							<h5>0</h5>
						</div>
					</div>
				</div>
				<!-- /breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row row-sm">
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-primary-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">طلبات اليوم</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white">$0</h4>
										</div>
										<span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-up text-white"></i>
											<span class="text-white op-7"> +0</span>
										</span>
									</div>
								</div>
							</div>
							<span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
						</div>
					</div>
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-danger-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">دخل اليوم</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white">$0</h4>
										</div>
										<span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-down text-white"></i>
											<span class="text-white op-7"> 0%</span>
										</span>
									</div>
								</div>
							</div>
							<span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
						</div>
					</div>
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-success-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">الدخل الكلي</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white">$0</h4>
										</div>
										<span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-up text-white"></i>
											<span class="text-white op-7"> 0%</span>
										</span>
									</div>
								</div>
							</div>
							<span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
						</div>
					</div>
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-warning-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">العدد الكلي للطلبات</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white">$0</h4>
										</div>
										<span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-down text-white"></i>
											<span class="text-white op-7"> 0</span>
										</span>
									</div>
								</div>
							</div>
							<span id="compositeline4" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
						</div>
					</div>
				</div>
				<!-- row closed -->

				<!-- row opened -->
				<div class="row row-sm">
					<div class="col-md-12 col-lg-12 col-xl-7">
						<div class="card">
							<div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mb-0">حالات الطلبات</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
								<p class="tx-12 text-muted mb-0">تتبع حالات الطلبات ، متابعة حركة الطلبات علي عامل الزمن .</p>
							</div>
							<div class="card-body">
								<div class="total-revenue">
									<div>
									  <h4>0</h4>
									  <label><span class="bg-primary"></span>الطلبات المقبولة</label>
									</div>
									<div>
									  <h4>0</h4>
									  <label><span class="bg-danger"></span>الطلبات المعلقة</label>
									</div>
									<div>
									  <h4>0</h4>
									  <label><span class="bg-warning"></span>الطلبات المرفوضة</label>
									</div>
								  </div>
								<div id="bar" class="sales-bar mt-4"></div>
							</div>
						</div>
					</div>
					<div class="col-lg-12 col-xl-5">
						<div class="card card-dashboard-map-one">
							<label class="main-content-label">حركة الطلبات علي الخريطة</label>
							<span class="d-block mg-b-20 text-muted tx-12">أكثر المواقع طلب للخدامات علي الخريطة</span>
							<div class="">
								<div class="vmap-wrapper ht-180" id="vmap2"></div>
							</div>
						</div>
					</div>
				</div>
				<!-- row closed -->

				<!-- row opened -->
				<div class="row row-sm">
					<div class="col-xl-4 col-md-12 col-lg-12">
						<div class="card">
							<div class="card-header pb-1">
								<h3 class="card-title mb-2">أبرز المستشارين</h3>
								<p class="tx-12 mb-0 text-muted">أبرز المستشارين في القائمة </p>
							</div>
							<div class="card-body p-0 customers mt-1">
								<div class="list-group list-lg-group list-group-flush">
									{{-- <div class="list-group-item list-group-item-action" href="#">
										<div class="media mt-0">
											<img class="avatar-lg rounded-circle ml-3 my-auto" src="{{URL::asset('assets/img/faces/3.jpg')}}" alt="Image description">
											<div class="media-body">
												<div class="d-flex align-items-center">
													<div class="mt-0">
														<h5 class="mb-1 tx-15">Samantha Melon</h5>
														<p class="mb-0 tx-13 text-muted">User ID: #1234 <span class="text-success ml-2">Paid</span></p>
													</div>
													<span class="mr-auto wd-45p fs-16 mt-2">
														<div id="spark1" class="wd-100p"></div>
													</span>
												</div>
											</div>
										</div>
									</div> --}}
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-4 col-md-12 col-lg-6">
						<div class="card">
							<div class="card-header pb-1">
								<h3 class="card-title mb-2">أبرز النشاطات</h3>
								<p class="tx-12 mb-0 text-muted">أبرز النشاطات التي تساعد في اتخاذ القرارات التي تقود الي تحقيق أهداف العمل .</p>
							</div>
							<div class="product-timeline card-body pt-2 mt-1">
								<ul class="timeline-1 mb-0">
									<li class="mt-0"> <i class="ti-pie-chart bg-primary-gradient text-white product-icon"></i> <span class="font-weight-semibold mb-4 tx-14 ">عدد الأقسام</span> <a href="#" class="float-left tx-11 text-muted">الآن</a>
										<p class="mb-0 text-muted tx-12">0 أقسام</p>
									</li>
									<li class="mt-0"> <i class="mdi mdi-cart-outline bg-danger-gradient text-white product-icon"></i> <span class="font-weight-semibold mb-4 tx-14 ">عدد الخدمات</span> <a href="#" class="float-left tx-11 text-muted">الآن</a>
										<p class="mb-0 text-muted tx-12">0 خدمات</p>
									</li>
									<li class="mt-0"> <i class="ti-bar-chart-alt bg-success-gradient text-white product-icon"></i> <span class="font-weight-semibold mb-4 tx-14 ">عدد المستشارين</span> <a href="#" class="float-left tx-11 text-muted">الآن</a>
										<p class="mb-0 text-muted tx-12">0 مستشارين</p>
									</li>
									<li class="mt-0"> <i class="ti-wallet bg-warning-gradient text-white product-icon"></i> <span class="font-weight-semibold mb-4 tx-14 ">عدد المستخدمين</span> <a href="#" class="float-left tx-11 text-muted">الآن</a>
										<p class="mb-0 text-muted tx-12">0 المستخدمين</p>
									</li>
									<li class="mt-0"> <i class="si si-eye bg-purple-gradient text-white product-icon"></i> <span class="font-weight-semibold mb-4 tx-14 ">عدد الطلبات</span> <a href="#" class="float-left tx-11 text-muted">الآن</a>
										<p class="mb-0 text-muted tx-12">0 طلبات</p>
									</li>
									<li class="mt-0"> <i class="ti-wallet bg-warning-gradient text-white product-icon"></i> <span class="font-weight-semibold mb-4 tx-14 ">عدد الحركات في المحافظ</span> <a href="#" class="float-left tx-11 text-muted">الآن</a>
										<p class="mb-0 text-muted tx-12">0 حركة</p>
									</li>
									
								</ul>
							</div>
						</div>
					</div>
					<div class="col-xl-4 col-md-12 col-lg-6">
						<div class="card">
							<div class="card-header pb-0">
								<h3 class="card-title mb-2">الطلبات الحالية</h3>
								<p class="tx-12 mb-0 text-muted">نسبة الطلبات المكتملة الي نسبة الطلبات المعلقة و المرفوضة</p>
							</div>
							<div class="card-body sales-info ot-0 pt-0 pb-0">
								<div id="chart" class="ht-150"></div>
								<div class="row sales-infomation pb-0 mb-0 mx-auto wd-100p">
									<div class="col-md-6 col">
										<p class="mb-0 d-flex"><span class="legend bg-primary brround"></span>الطلبات المكتملة</p>
										<h3 class="mb-1">0</h3>
										<div class="d-flex">
											<p class="text-muted ">آخر 6 شهور</p>
										</div>
									</div>
									<div class="col-md-6 col">
										<p class="mb-0 d-flex"><span class="legend bg-info brround"></span>المرفوضة أو المعلقة</p>
											<h3 class="mb-1">0</h3>
										<div class="d-flex">
											<p class="text-muted">آخر 6 شهور</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="card ">
							<div class="card-body">
								<div class="row">
									<div class="col-md-6">
										<div class="d-flex align-items-center pb-2">
											<p class="mb-0">نسبة الأرباح</p>
										</div>
										<h4 class="font-weight-bold mb-2">$0</h4>
										<div class="progress progress-style progress-sm">
											<div class="progress-bar bg-primary-gradient wd-80p" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="78"></div>
										</div>
									</div>
									<div class="col-md-6 mt-4 mt-md-0">
										<div class="d-flex align-items-center pb-2">
											<p class="mb-0">المستخدمين النشطين</p>
										</div>
										<h4 class="font-weight-bold mb-2">0</h4>
										<div class="progress progress-style progress-sm">
											<div class="progress-bar bg-danger-gradient wd-75" role="progressbar"  aria-valuenow="45" aria-valuemin="0" aria-valuemax="45"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- row close -->

				<!-- row opened -->
				<div class="row row-sm row-deck">
					<div class="col-md-12 col-lg-4 col-xl-4">
						<div class="card card-dashboard-eight pb-2">
							<h6 class="card-title">أكثر المستخدمين نشاطاً</h6><span class="d-block mg-b-10 text-muted tx-12">أكثر المستخدمين النشطين علي التطبيق</span>
							<div class="list-group">
								<div class="list-group-item border-top-0">
									<i class="flag-icon flag-icon-sd flag-icon-squared"></i>
									<p>SDN</p><span>0</span>
								</div>
								<div class="list-group-item">
									<i class="flag-icon flag-icon-ae flag-icon-squared"></i>
									<p>UAE</p><span>0</span>
								</div>
								<div class="list-group-item">
									<i class="flag-icon flag-icon-gb flag-icon-squared"></i>
									<p>UK</p><span>0</span>
								</div>
								<div class="list-group-item">
									<i class="flag-icon flag-icon-sa flag-icon-squared"></i>
									<p>KSA</p><span>0</span>
								</div>
								<div class="list-group-item">
									<i class="flag-icon flag-icon-us flag-icon-squared"></i>
									<p>USA</p><span>0</span>
								</div>
								<div class="list-group-item border-bottom-0 mb-0">
									<i class="flag-icon flag-icon-qa flag-icon-squared"></i>
									<p>QTR</p><span>0</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12 col-lg-8 col-xl-8">
						<div class="card card-table-two">
							<div class="d-flex justify-content-between">
								<h4 class="card-title mb-1">المحافظ الإلكترونية</h4>
								<i class="mdi mdi-dots-horizontal text-gray"></i>
							</div>
							<span class="tx-12 tx-muted mb-3 ">آخر 5 حركات علي المحافظ</span>
							<div class="table-responsive country-table">
								<table class="table table-striped table-bordered mb-0 text-sm-nowrap text-lg-nowrap text-xl-nowrap">
									<thead>
										<tr>
											<th class="wd-lg-25p">التاريخ</th>
											<th class="wd-lg-25p tx-right">من محفظة</th>
											<th class="wd-lg-25p tx-right">الي محفظة</th>
											<th class="wd-lg-25p tx-right">المبلغ</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>05 Dec 2019</td>
											<td class="tx-right tx-medium tx-inverse">34</td>
											<td class="tx-right tx-medium tx-inverse">$658.20</td>
											<td class="tx-right tx-medium tx-danger">-$45.10</td>
										</tr>
										<tr>
											<td>06 Dec 2019</td>
											<td class="tx-right tx-medium tx-inverse">26</td>
											<td class="tx-right tx-medium tx-inverse">$453.25</td>
											<td class="tx-right tx-medium tx-danger">-$15.02</td>
										</tr>
										<tr>
											<td>07 Dec 2019</td>
											<td class="tx-right tx-medium tx-inverse">34</td>
											<td class="tx-right tx-medium tx-inverse">$653.12</td>
											<td class="tx-right tx-medium tx-danger">-$13.45</td>
										</tr>
										<tr>
											<td>08 Dec 2019</td>
											<td class="tx-right tx-medium tx-inverse">45</td>
											<td class="tx-right tx-medium tx-inverse">$546.47</td>
											<td class="tx-right tx-medium tx-danger">-$24.22</td>
										</tr>
										<tr>
											<td>09 Dec 2019</td>
											<td class="tx-right tx-medium tx-inverse">31</td>
											<td class="tx-right tx-medium tx-inverse">$425.72</td>
											<td class="tx-right tx-medium tx-danger">-$25.01</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
		</div>
		<!-- Container closed -->
@endsection
@section('js')
<!--Internal  Chart.bundle js -->
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<!-- Moment js -->
<script src="{{URL::asset('assets/plugins/raphael/raphael.min.js')}}"></script>
<!--Internal  Flot js-->
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js')}}"></script>
<script src="{{URL::asset('assets/js/dashboard.sampledata.js')}}"></script>
<script src="{{URL::asset('assets/js/chart.flot.sampledata.js')}}"></script>
<!--Internal Apexchart js-->
<script src="{{URL::asset('assets/js/apexcharts.js')}}"></script>
<!-- Internal Map -->
<script src="{{URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<script src="{{URL::asset('assets/js/modal-popup.js')}}"></script>
<!--Internal  index js -->
<script src="{{URL::asset('assets/js/index.js')}}"></script>
<script src="{{URL::asset('assets/js/jquery.vmap.sampledata.js')}}"></script>	
@endsection
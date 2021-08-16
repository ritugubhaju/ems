@extends ('frontend.layouts.app')
@section('content')

<!-- START SECTION BREADCRUMB -->
<section class="page-title-light breadcrumb_section parallax_bg overlay_bg_50" >
	<div class="container">
    	<div class="row align-items-center">
        	<div class="col-sm-6">
            	<div class="page-title">
            	
                </div>
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb justify-content-sm-end">
                  <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Home</a></li>
                  </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- END SECTION BANNER -->

<section class="small_pb">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8">
                    <div class="text-center animation animated fadeInUp" data-animation="fadeInUp" data-animation-delay="0.01s" style="animation-delay: 0.01s; opacity: 1;">
                        <div class="heading_s1 text-center">
                            <h2>Create Customer</h2>
                        </div>
                        <div class="small_divider"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="box_shadow1 radius_all_10">
                        <div class="row no-gutters">
                            <div class="col-md-12 animation animated fadeInLeft" data-animation="fadeInLeft" data-animation-delay="0.02s" style="animation-delay: 0.02s; opacity: 1;">
                               
                                <div class="padding_eight_all">
                                    <div class="field_form">
                                        <form method="POST" name="enq" action="{{route('customerform.store')}}">
                                            @csrf
                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <input required="required" placeholder="Enter Name" id="first-name" class="form-control" name="name" type="text">
                                                </div>
                                                <div class="form-group col-12">
                                                    <input required="required" placeholder="Enter Email" id="email" class="form-control" name="email" type="email">
                                                </div>
                                                <div class="form-group col-12">
                                                    <input required="required" placeholder="Enter Password" id="password" class="form-control" name="password" type="password">
                                                </div>
                                                <div class="col-lg-12">
                                                    <button type="submit" title="Submit Your Message!" class="btn btn-default" name="submit" value="Submit">Submit</button>
                                                </div>
                                                <div class="col-lg-12 text-center">
                                                    <div id="alert-msg" class="alert-msg text-center"></div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

   
@endsection
@extends('backend.layouts.admin.admin')

@section('content')
    <section>
        <div class="section-body">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h1 class="text-bold text-center">WELCOME</h1>
                    </div>
                </div>

                <div class="tools">
                    <a class="btn btn-primary ink-reaction" href="{{ route('studentform') }}">
                        <i class="md md-add"></i>
                        Student Register
                    </a>
                </div>
            </div>

           
        </div>

    </section>


@endsection

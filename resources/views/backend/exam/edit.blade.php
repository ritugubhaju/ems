@extends('backend.layouts.admin.admin')

@section('title', 'exam')

@section('content')
<section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('exam.update',$exam->slug)}}"
                  method="POST" enctype="multipart/form-data" novalidate>
            @method('PUT')
            @include('backend.exam.partials.form', ['header' => 'Edit exam <span class="text-primary">('.($exam->title).')</span>'])
            </form>
        </div>
</section>
@stop


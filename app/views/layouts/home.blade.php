@include('home.partials._header',['categories'=>$categories])
<div class="inner-pad clearfix">
    {{ BreadCrumbs::render() }}
@yield('content')
</div>
@include('home.partials._footer')
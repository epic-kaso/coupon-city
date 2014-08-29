@include('home.partials._header',['categories'=>$categories])
<div class="inner-pad clearfix">
    <div class="breadcrumb mb">
        <a href="" class="bread-home">Home</a>/
        <a href="">Categories</a>/
        <a href="">Food &amp; Drinks</a>/
        &nbsp;&nbsp;Ladies and Women Fashion
    </div>
@yield('content')
</div>
@include('home.partials._footer')


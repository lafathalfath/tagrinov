@extends('layouts.admin') 
@section('content')
<script>
    const title = document.getElementsByTagName('title')[0];
    title.innerHTML += ' | Dashboard';
</script>
<div class="container">
    <h2 class="mb-4">Dashboard</h2>

</div>

@endsection

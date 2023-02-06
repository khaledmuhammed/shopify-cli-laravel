@if(Session::has('message'))
<p>test</p>
<div class="alert {{ Session::get('alert-class', 'alert-info') }}">
    {{ Session::get('message') }}
</div>
@endif
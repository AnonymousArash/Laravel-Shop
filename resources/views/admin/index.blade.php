@extends('layouts/admin')

@section('content')


<form method="post" action="<?= url('admin/create') ?>">

{{ csrf_field() }}

<input type="text" name="fname">

<input type="text" name="lname">

<input type="submit">

</form>

@endsection
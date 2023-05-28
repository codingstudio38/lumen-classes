<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>produccts list</title>
<link rel="stylesheet" href="{{ url('/') }}/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


<script src="{{ url('/') }}/js/jquery.min.js"></script>
<script src="{{ url('/') }}/js/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="{{ url('/') }}/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
<section>
    <table class="table">
  <thead>
  <tr>
      <th scope="col"></th>
      <th scope="col"><a href="{{ route('export-all-products') }}" class="btn btn-outline-primary btn-sm">Export</a></th>

      <th scope="col" colspan="2">
      <form action="{{ route('import-products') }}" method="post" enctype="multipart/form-data">
<div class="form-group">
  <input type="file" class="form-control" name="import_file" id="import_file" required>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-success btn-sm" >Import</button>
</div>

      </form>
      </th>
  </tr>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Product name</th>
      <th scope="col">quantity</th>
      <th scope="col">created at</th>
    </tr>
  </thead>
  <tbody>
@foreach ($list as $key => $row)
    <tr>
      <th scope="row"><?=$row->id;?></th>
      <td><?=$row->product_name;?></td>
      <td><?=$row->product_name;?></td>
      <td><?=$row->created_at;?></td>
    </tr>
@endforeach

  </tbody>
  <tfoot>
    <tr>
        <td colspan="4" align="center">
      {{$list->links('paginate.pager8'); }}

        </td>
    </tr>
  </tfoot>
</table>
</section>
    </div>
</body>
</html>
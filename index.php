<?php include('connection.php'); ?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="css/bootstrap5.0.1.min.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/datatables-1.10.25.min.css" />
  <title>Data Buku Tamu</title>
  <style type="text/css">
  .btnAdd {
    text-align: right;
    width: 83%;
    margin-bottom: 20px;
  }
  </style>
</head>

<body>
  <div class="container-fluid">
    <h2 class="text-center mt-5 mb-2">DATA BUKU Tamu</h2>
    <p class="datatable design text-center mb-3">PHP, AJAX, JQUERY, MYSQL</p>
    <div class="row">
      <div class="container">
        <div class="btnAdd">
          <a href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addUserModal"
            class="btn btn-success btn-sm">Tambah Tamu</a>
        </div>
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-8">
            <table id="example" class="table">
              <thead>
                <th>Id</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Website</th>
                <th>Tanggal/Waktu</th>
                <th>Komentar</th>
                <th>Aksi</th>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
          <div class="col-md-2"></div>
        </div>
      </div>
    </div>
  </div>

  <script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
  <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>

  <script type="text/javascript">
  $(document).ready(function() {
    $('#example').DataTable({
      "fnCreatedRow": function(nRow, aData, iDataIndex) {
        $(nRow).attr('id', aData[0]);
      },
      'serverSide': 'true',
      'processing': 'true',
      'paging': 'true',
      'order': [],
      'ajax': {
        'url': 'fetch_data.php',
        'type': 'post',
      },
      "aoColumnDefs": [{
          "bSortable": false,
          "aTargets": [5]
        },

      ]
    });
  });
  $(document).on('submit', '#addUser', function(e) {
    e.preventDefault();
    var name = $('#addGuestField').val();
    var email = $('#addEmailField').val();
    var website = $('#addWebsiteField').val();
    var comment = $('#addCommentField').val();
    if (name != '' && email != '' && website != '' && comment != '') {
      $.ajax({
        url: "add_user.php",
        type: "post",
        data: {
          name: name,
          email: email,
          website: website,
          comment: comment
        },
        success: function(data) {
          var json = JSON.parse(data);
          var status = json.status;
          if (status == 'true') {
            mytable = $('#example').DataTable();
            mytable.draw();
            $('#addUserModal').modal('hide');
          } else {
            alert('failed');
          }
        }
      });
    } else {
      alert('Fill all the required fields');
    }
  });
  $(document).on('submit', '#updateUser', function(e) {
    e.preventDefault();
    //var tr = $(this).closest('tr');
    var name = $('#nameField').val();
    var email = $('#emailField').val();
    var website = $('#websiteField').val();
    var comment = $('#commentField').val();
    var trid = $('#trid').val();
    var id = $('#id').val();
    if (name != '' && email != '' && website != '' && comment != '') {
      $.ajax({
        url: "update_user.php",
        type: "post",
        data: {
          name: name,
          email: email,
          website: website,
          comment: comment,
          id: id
        },
        success: function(data) {
          var json = JSON.parse(data);
          var status = json.status;
          if (status == 'true') {
            table = $('#example').DataTable();
            var button = '<td><a href="javascript:void();" data-id="' + id +
              '" class="btn btn-info btn-sm editbtn">Edit</a>  <a href="#!"  data-id="' + id +
              '"  class="btn btn-danger btn-sm deleteBtn">Delete</a></td>';
            var row = table.row("[id='" + trid + "']");
            row.row("[id='" + trid + "']").data([id, name, email, website, comment, button]);
            $('#exampleModal').modal('hide');
          } else {
            alert('failed');
          }
        }
      });
    } else {
      alert('Fill all the required fields');
    }
  });
  $('#example').on('click', '.editbtn ', function(event) {
    var table = $('#example').DataTable();
    var trid = $(this).closest('tr').attr('id');
    // console.log(selectedRow);
    var id = $(this).data('id');
    $('#exampleModal').modal('show');

    $.ajax({
      url: "get_single_data.php",
      data: {
        id: id
      },
      type: 'post',
      success: function(data) {
        var json = JSON.parse(data);
        $('#nameField').val(json.name);
        $('#emailField').val(json.email);
        $('#websiteField').val(json.website);
        $('#commentField').val(json.comment);
        $('#id').val(id);
        $('#trid').val(trid);
      }
    })
  });

  $(document).on('click', '.deleteBtn', function(event) {
    var table = $('#example').DataTable();
    event.preventDefault();
    var id = $(this).data('id');
    if (confirm("Are you sure want to delete this User ? ")) {
      $.ajax({
        url: "delete_user.php",
        data: {
          id: id
        },
        type: "post",
        success: function(data) {
          var json = JSON.parse(data);
          status = json.status;
          if (status == 'success') {
            //table.fnDeleteRow( table.$('#' + id)[0] );
            //$("#example tbody").find(id).remove();
            //table.row($(this).closest("tr")) .remove();
            $("#" + id).closest('tr').remove();
          } else {
            alert('Failed');
            return;
          }
        }
      });
    } else {
      return null;
    }
  })
  </script>
  <!-- Update Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Tamu</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="updateUser">
            <input type="hidden" name="id" id="id" value="">
            <input type="hidden" name="trid" id="trid" value="">
            <div class="mb-3 row">
              <label for="nameField" class="col-md-3 form-label">Nama</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="nameField" name="name">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="emailField" class="col-md-3 form-label">Email</label>
              <div class="col-md-9">
                <input type="email" class="form-control" id="emailField" name="email">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="websiteField" class="col-md-3 form-label">Website</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="websiteField" name="website">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="commentField" class="col-md-3 form-label">Komentar</label>
              <div class="col-md-9">
                <textarea name="comment" id="commentField" cols="30" rows="10"></textarea>
              </div>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Add user Modal -->
  <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Tamu</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="addUser" action="">
            <div class="mb-3 row">
              <label for="addGuestField" class="col-md-3 form-label">Nama</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="addGuestField" name="name">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addEmailField" class="col-md-3 form-label">Email</label>
              <div class="col-md-9">
                <input type="email" class="form-control" id="addEmailField" name="email">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addWebsiteField" class="col-md-3 form-label">Website</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="addWebsiteField" name="website">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addCommentField" class="col-md-3 form-label">Komentar</label>
              <div class="col-md-9">
                <textarea name="comment" id="addCommentField" cols="30" rows="10"></textarea>
              </div>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
<script type="text/javascript"></script>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>CRUD operations in Laravel 5.3</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
    <script src="/js/select/bootstrap-select.min.js"></script>
</head>
<body>
<meta name="csrf-token" content="{{ csrf_token() }}">


<div class="container">
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <input id="ye" size="10" class="form-control" type="text" value="65.2" readonly>
    <input id="delivCost" size="10" class="form-control" type="text" value="2420" readonly>

    <button type="button" class="btn btn-info btn-sm pull-right" onclick="fun_add_new()">Add</button>
    <button type="button" class="btn btn-info btn-sm pull-right" onclick="CountSum()">Summ</button>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Товар</th>
            <th>Количесво</th>
            <th>Цена (y.e.)</th>
            <th>Цена (p.)</th>
            <th>Цена + Доставка</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $x)
            <tr id="tr_id{{ $x -> id }}">
                <td>
                    <select id="fid{{ $x -> id }}" onchange="fun_update('{{ $x -> id }}')"
                            class="selectpicker show-tick" data-live-search="true">
                        @foreach($dataType as $y)
                            @if( $y->id == $x->first_name)
                                <option selected value="{{ $y -> id }}">{{ $y-> name }}</option>
                            @else
                                <option value="{{ $y -> id }}">{{ $y-> name }}</option>
                            @endif
                        @endforeach

                        @if($x->first_name == 0)
                            <option selected disabled>Выберите товар</option>
                        @endif
                    </select>
                </td>
                <td>
                    <div class="input-group" id="count">
                        <input class="form-control" size="4"
                               type="text" id="lid{{$x -> id}}"
                               value="{{$x -> last_name}}"
                               onBlur="fun_update('{{$x -> id}}')"
                               onclick="$(this).select()"
                               oninput="yeToRub('{{$x -> id}}')"
                               onkeyup="this.value=this.value.replace(/[^\d\.]+/g,'')">
                    </div>
                </td>
                <td>
                    <div class="input-group" id="ye">
                        <input class="form-control" size="4"
                               type="text" id="eid{{$x -> id}}"
                               value="{{$x -> email}}"
                               onBlur="fun_update('{{$x -> id}}')"
                               onclick="$(this).select()"
                               oninput="yeToRub('{{$x -> id}}')"
                               onkeyup="this.value=this.value.replace(/[^\d\.]+/g,'')">
                        <span class="input-group-addon">y.e.</span>
                    </div>
                </td>
                <td>
                    <div class="input-group">
                        <input id="rub_id{{$x -> id}}" class="form-control" type="text"
                               value="{{$x -> last_name * $x -> email}}" readonly>
                        <span class="input-group-addon">p.</span>
                    </div>
                </td>
                <td>
                    <div class="input-group">
                        <input class="form-control" type="text" placeholder="" readonly>
                        <span class="input-group-addon">p.</span>
                    </div>
                </td>
                <td>
                    <button class="btn btn-danger" onclick="fun_delete('{{$x -> id}}')">Удалить</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <input type="hidden" name="hidden_add" id="hidden_add" value="{{url('crud/add')}}">
    <input type="hidden" name="hidden_delete" id="hidden_delete" value="{{url('crud/delete')}}">
    <input type="hidden" name="hidden_update" id="hidden_update" value="{{url('crud/update')}}">

    <!-- Add Modal start -->
    <div class="modal fade" id="addModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Record</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ url('crud') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="form-group">
                                <label for="first_name">First Name:</label>
                                <input type="text" class="form-control" id="first_name" name="first_name">
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name:</label>
                                <input type="text" class="form-control" id="last_name" name="last_name">
                            </div>
                            <label for="email">Email address:</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>

                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
    <!-- add code ends -->

    <!-- View Modal start -->
    <div class="modal fade" id="viewModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">View</h4>
                </div>
                <div class="modal-body">
                    <p><b>First Name : </b><span id="view_fname" class="text-success"></span></p>
                    <p><b>Last Name : </b><span id="view_lname" class="text-success"></span></p>
                    <p><b>Email : </b><span id="view_email" class="text-success">bhaskar.panja@quadone.com</span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"></button>
                </div>
            </div>

        </div>
    </div>
    <!-- view modal ends -->

    <!-- Edit Modal start -->
    <div class="modal fade" id="editModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ url('crud/update') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="form-group">
                                <label for="edit_first_name">First Name:</label>
                                <input type="text" class="form-control" id="edit_first_name" name="edit_first_name">
                            </div>
                            <div class="form-group">
                                <label for="edit_last_name">Last Name:</label>
                                <input type="text" class="form-control" id="edit_last_name" name="edit_last_name">
                            </div>
                            <label for="edit_email">Email address:</label>
                            <input type="email" class="form-control" id="edit_email" name="edit_email">
                        </div>

                        <button type="submit" class="btn btn-default">Update</button>
                        <input type="hidden" id="edit_id" name="edit_id">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>

            </div>

        </div>
    </div>
    <!-- Edit code ends -->

</div>
<script type="text/javascript">

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function yeToRub(id) {
        $("#rub_id" + id).val(parseFloat($("#eid" + id).val()) * parseFloat($("#ye").val()));
    }


    function fun_update(id) {

        var update_url = $("#hidden_update").val();
        var fn = $("#fid" + id + " option:selected").val();
        var ln = $("#lid" + id).val();
        var em = $("#eid" + id).val();
        $.ajax({
            url: update_url,
            type: "POST",
            dataType: "JSON",
            data: {
                "id": id,
                "fn": fn,
                "ln": ln,
                "em": em,
            },
            beforeSend: function () {
                //console.log();
            },
            success: function () {
            }
        });
    }

    // добавление нового
    function fun_add_new() {
        var hidden_add = $("#hidden_add").val();

        $.ajax({
            url: hidden_add,
            type: "POST",
            data: {
                "id": 0,
                "fn": 0,
                "ln": 0,
                "em": 0,
            },
            beforeSend: function () {
                //console.log();
            },
            success: function () {
                location.reload();
            },
            error: function () {
            }
        });
    }

    function fun_delete(id) {
        var conf = confirm("Are you sure want to delete??");
        if (conf) {
            var delete_url = $("#hidden_delete").val();
            $.ajax({
                url: delete_url,
                type: "POST",

                data: {"id": id, _token: "{{ csrf_token() }}"},
                success: function () {
                    $("#tr_id" + id).remove();
                }
            });
        }
        else {
            return false;
        }
    }

    // сумма элементов
    function CountSum() {
        var sum = 0;
        $('div#ye').each(function () {
            var inputVal = $('input', this).val();
            sum += (inputVal) * 1;
            console.log(sum);
        });
    }

</script>
</body>
</html>
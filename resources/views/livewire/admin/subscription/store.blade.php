<div>
    <div class="container-fluid">
        <div class="card-body  ">
            <table class="  table  ">
                <tr>
                    <th scope="col" class="col-lg-10">@lang('Name')</th>
                    <th scope="col" class="col-lg-2"> </th>
                </tr>
                <tr>
                    <td>
                        <input   type="text" class="form-control">

                    </td>
                    <td>
                        <div class="btn btn-success btn-lg " style="width:100%;"> <i class="fa fa-plus"></i>
                        </div>
                    </td>
                </tr>
                @foreach ($datas as $index => $data)
                    <tr>
                        <td>
                            <input type="text" class="form-control">
                        </td>
                        <td>
                            <div class="btn btn-danger btn-lg col-lg-12"> <i class="fa fa-minus"></i>
                            </div>
                        </td>
                    </tr>
               @endforeach
            </table>
        </div>

    </div>
</div>

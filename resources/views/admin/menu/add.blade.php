@extends('admin.main')

@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
    <form action="" method="POST">
        <div class="card-body">
            <div class="form-group">
                <label for="menu">Tên danh mục</label>
                <input type="text" name="name" class="form-control" placeholder="Nhập tên danh mục">
            </div>

            <div class="form-group">
                <label for="menu">Danh mục</label>
                <select class="form-control" name="parent_id">
                    <option value="0">Danh muc cha</option>
                    @foreach ($menus as $menu)
                        <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="menu">Mô tả</label>
                <textarea class="form-control" name="description"></textarea>
            </div>

            <div class="form-group">
                <label for="menu">Mô tả chi tiết</label>
                <textarea class="form-control" name="content" id="content"></textarea>
            </div>

            <div class="form-group">
                <label for="">Kích hoạt</label>

                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="active" name="active" value="1"
                        checked="">
                    <label for="active" class="custom-control-label">Active</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="noactive" name="active" value="0">
                    <label for="noactive" class="custom-control-label">No Active</label>
                </div>

            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Tạo danh mục</button>
        </div>
        @csrf
    </form>
@endsection

@section('footer')
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection

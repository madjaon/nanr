@extends('admin.layouts.master')

@section('title', 'Sửa post type')

@section('content')

<div class="row margin-bottom">
	<div class="col-xs-12">
		<a href="{{ route('admin.posttype.index') }}" class="btn btn-success">Danh sách post type</a>
		<a href="{{ route('admin.posttype.create') }}" class="btn btn-primary">Thêm post type</a>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<form method="POST" action="{{ route('admin.posttype.update', $data->id) }}" accept-charset="UTF-8">
				<input name="_method" type="hidden" value="PUT">
				{!! method_field('PUT') !!}
				{!! csrf_field() !!}
				<div class="box-header">
					<h3 class="box-title">Sửa post type</h3>
				</div>
				<div class="box-body">
					<div class="form-group">
						<label for="name">Name</label>
						<div class="row">
							<div class="col-sm-8">
								<input name="name" type="text" value="{{ $data->name }}" class="form-control" onkeyup="convert_to_slug(this.value);">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="slug">Slug</label>
						<div class="row">
							<div class="col-sm-8">
								<input name="slug" type="text" value="{{ $data->slug }}" class="form-control">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="parent_id">Mục cha (seri)</label>
						<div class="row">
							<div class="col-sm-8">
							{!! Form::select('parent_id', $postTypes, $data->parent_id, array('class' =>'form-control')) !!}
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="home">Home</label>
						<p>Hiển thị ra trang chủ hay không?</p>
						<div class="row">
							<div class="col-sm-8">
							{!! Form::select('home', CommonOption::statusArray(), $data->home, array('class' =>'form-control')) !!}
							</div>
						</div>
					</div>
					<div class="form-group" style="display: none;">
						<label for="type">Type</label>
						<p>Thể loại post? (hiển thị 2 tab ngoài trang chủ)</p>
						<div class="row">
							<div class="col-sm-8">
							{!! Form::select('type', CommonOption::statusArray(), $data->type, array('class' =>'form-control')) !!}
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-sm-4">
								<label for="display">Display</label>
								<p>Kiểu hiển thị trên trang chủ</p>
								{!! Form::select('display', CommonOption::displayTypeArray(), $data->display, array('class' =>'form-control', 'onchange' => 'loadRelation()')) !!}
							</div>
							<div class="col-sm-4">
								<label for="relation_id">Relation</label>
								<p>Lựa chọn thể loại có kiểu 2, khi Display chọn kiểu 3 (cột bên cạnh kiểu 2 trên trang chủ)</p>
								{!! Form::select('relation_id', array_add($relationArray, '0', '-- chọn'), $data->relation_id, array('class' =>'form-control')) !!}
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="limited">Limited</label>
						<p>Số items hiển thị trên trang chủ</p>
						<div class="row">
							<div class="col-sm-8">
								<input name="limited" type="text" value="{{ $data->limited }}" class="form-control">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="sort_by">Sắp xếp</label>
						<p>Kiểu sắp xếp danh sách posts (trang chủ)</p>
						<div class="row">
							<div class="col-sm-8">
							{!! Form::select('sort_by', CommonOption::postSortByArray(), $data->sort_by, array('class' =>'form-control')) !!}
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="grid">Grid or List</label>
						<p>Trang thể loại hiển thị dạng ô lưới (không kích hoạt) hay dạng danh sách (kích hoạt)</p>
						<div class="row">
							<div class="col-sm-8">
							{!! Form::select('grid', CommonOption::statusArray(), $data->grid, array('class' =>'form-control')) !!}
							</div>
						</div>
					</div>
					<div class="form-group" style="display: none;">
						<label for="color">Color</label>
						<div class="row">
							<div class="col-sm-8">
								<input name="color" type="text" value="{{ $data->color }}" class="form-control">
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-8">
							@include('admin.common.inputStatusLang', array('isEdit' => true))
							@include('admin.common.inputContent', array('isEdit' => true))
							@include('admin.common.inputMeta', array('isEdit' => true))
						</div>
					</div>
					
				</div>
				<div class="box-footer">
					<input type="submit" class="btn btn-primary" value="Lưu lại" />
					<input type="reset" class="btn btn-default" value="Nhập lại" />
				</div>
			</form>
		</div>
	</div>
</div>

@include('admin.posttype.script')

@stop
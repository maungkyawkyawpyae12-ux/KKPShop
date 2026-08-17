@extends('layouts.admin')
@section('content')
 
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header">
            <h4>Create Item</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('backend.items.store')}}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Code No -->
<div class="mb-3">
    <label class="form-label">Code No</label>
    <input type="text"
           name="code_no"
           value="{{old('code_no')}}"
           class="form-control"
           placeholder="eg. 1234">

   </div>

<!-- Item Name -->
<div class="mb-3">
    <label class="form-label">Item Name</label>
    <input type="text"
           name="name"
           value="{{ old('name')}}"
           class="form-control ">

   </div>

<!-- Image -->
<div class="mb-3">
    <label class="form-label">Image</label>
    <input type="file"
           accept="image/*"
           name="image"
           class="form-control">

 </div>

<!-- Price -->
<div class="mb-3">
    <label class="form-label">Price</label>
    <input type="number"
           name="price"
           value="{{old('price')}}"
           class="form-control">

    
</div>

<!-- Discount -->
<div class="mb-3">
    <label class="form-label">Discount (%)</label>
    <input type="number"
           name="discount"
           value="{{old('discount')}}"
           class="form-control">
</div>

         {{-- On Stock --}}
                <div class="mb-3">

                    <label for="on_stock"
                           class="form-label">
                        In Stock
                    </label>

                    <select class="form-select"
                            id="on_stock"
                            name="on_stock">

                        <option value="">
                            Choose Stock Status
                        </option>

                        <option value="Yes"
                            {{ old('on_stock') == 'Yes' ? 'selected' : '' }}>
                            Yes
                        </option>

                        <option value="No"
                            {{ old('on_stock') == 'No' ? 'selected' : '' }}>
                            No
                        </option>

                    </select>

                </div>

<!-- In Stock -->
   <!-- <div class="mb-3">
        <label for="on_stock" class="form-label">In Stock</label>
        <select class="form-select" id="on_stock" name="on_stock"  value="">
          <option value="">Choose Stock status</option>
          <option value="Yes" selected>Yes</option>
          <option value="No">No</option>
        </select>
              </div> -->
<!-- Description -->
<div class="mb-3">
    <label class="form-label">Description</label>
    <textarea name="description"
              rows="4"
              class="form-control ">{{ old('discription') }}</textarea>

    </div>

<!-- Category -->
<div class="mb-3">
    <label class="form-label">Category</label>

    <select name="category_id"
            class="form-select">

        <option value="">Choose Category</option>
        @foreach($categories as $category)
            <option value="{{$category->id}}">
                {{$category->name}}
            </option>
        @endforeach
    </select>
</div>

                <!-- Buttons -->
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">
                        Save Item
                    </button>

                    <a href="{{ route('backend.items.index') }}" class="btn btn-secondary">
                        Cancel
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

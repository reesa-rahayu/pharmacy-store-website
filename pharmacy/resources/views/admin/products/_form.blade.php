@csrf

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label>Name</label>
        <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}"
            class="w-full border rounded p-2 dark:bg-gray-700 dark:text-white">
        @error('name')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label>Price</label>
        <input type="number" step="0.01" name="price" value="{{ old('price', $product->price ?? '') }}"
            class="w-full border rounded p-2 dark:bg-gray-700 dark:text-white">
        @error('price')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label>Stock</label>
        <input type="number" name="stock" value="{{ old('stock', $product->stock ?? '') }}"
            class="w-full border rounded p-2 dark:bg-gray-700 dark:text-white">
        @error('stock')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label>Category</label>
        <select name="category_id" class="w-full border rounded p-2 dark:bg-gray-700 dark:text-white">
            <option value="">Select Category</option>
            @foreach (\App\Models\Category::all() as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id ?? '') == $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="mt-4">
    <label>Description</label>
    <textarea name="description" rows="4" class="w-full border rounded p-2 dark:bg-gray-700 dark:text-white">{{ old('description', $product->description ?? '') }}</textarea>
    @error('description')
        <p class="text-red-500 text-sm">{{ $message }}</p>
    @enderror
</div>

<div class="mt-4">
    <label>Image</label>
    <input type="file" name="image" class="w-full border p-2 dark:bg-gray-700 dark:text-white">
    @if (!empty($product->image))
        <img src="{{ asset('storage/' . $product->image) }}" class="w-20 mt-2 rounded">
    @endif
    @error('image')
        <p class="text-red-500 text-sm">{{ $message }}</p>
    @enderror
</div>

<div class="mt-4">
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        {{ $button ?? 'Save' }}
    </button>
</div>

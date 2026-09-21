@extends('admin.layouts.app')

@section('title', 'Edit Food')

@section('content')

    <div class="admin-page">

        {{-- Page Header --}}
        <div class="admin-page-header">

            <div>
                <h1>Edit Food</h1>
                <p>Update your food menu item.</p>
            </div>

            <a href="{{ route('foods.index') }}" class="admin-btn admin-btn-secondary">
                ← Back to Foods
            </a>

        </div>


        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="admin-alert admin-alert-error">

                <strong>Please fix the following errors:</strong>

                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>
        @endif


        {{-- Edit Food Card --}}
        <div class="admin-form-card">

            <form action="{{ route('foods.update', $food->id) }}" method="POST">

                @csrf
                @method('PUT')


                {{-- Food Name --}}
                <div class="admin-form-group">

                    <label for="name">
                        Food Name
                    </label>

                    <input type="text" id="name" name="name" value="{{ old('name', $food->name) }}"
                        placeholder="Enter food name" required>

                    @error('name')
                        <span class="admin-input-error">
                            {{ $message }}
                        </span>
                    @enderror

                </div>


                {{-- Category + Price --}}
                <div class="admin-form-row">

                    <div class="admin-form-group">

                        <label for="category">
                            Category
                        </label>

                        <select id="category" name="category" required>
                            <option value="">Select category</option>

                            <option value="Breakfast" {{ old('category') == 'Breakfast' ? 'selected' : '' }}>
                                Breakfast
                            </option>

                            <option value="Snacks" {{ old('category') == 'Snacks' ? 'selected' : '' }}>
                                Snacks
                            </option>

                            <option value="Fast Food" {{ old('category') == 'Fast Food' ? 'selected' : '' }}>
                                Fast Food
                            </option>

                            <option value="Main Course" {{ old('category') == 'Main Course' ? 'selected' : '' }}>
                                Main Course
                            </option>

                            <option value="Beverages" {{ old('category') == 'Beverages' ? 'selected' : '' }}>
                                Beverages
                            </option>

                            <option value="Desserts" {{ old('category') == 'Desserts' ? 'selected' : '' }}>
                                Desserts
                            </option>

                        </select>

                        @error('category')
                            <span class="admin-input-error">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>


                    <div class="admin-form-group">

                        <label for="price">
                            Price (₹)
                        </label>

                        <input type="number" id="price" name="price" value="{{ old('price', $food->price) }}"
                            placeholder="Enter price" min="0" step="0.01" required>

                        @error('price')
                            <span class="admin-input-error">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>

                </div>


                {{-- Description --}}
                <div class="admin-form-group">

                    <label for="description">
                        Description
                    </label>

                    <textarea id="description" name="description" rows="5" placeholder="Enter food description...">{{ old('description', $food->description) }}</textarea>

                    @error('description')
                        <span class="admin-input-error">
                            {{ $message }}
                        </span>
                    @enderror

                </div>


                {{-- Availability --}}
                <div class="admin-availability-box">

                    <label class="admin-checkbox-label">

                        <input type="checkbox" id="is_available" name="is_available" value="1"
                            {{ old('is_available', $food->is_available) ? 'checked' : '' }}>

                        <span>

                            <strong>
                                Food is available
                            </strong>

                            <small>
                                Customers can see and order this food.
                            </small>

                        </span>

                    </label>

                </div>


                {{-- Form Actions --}}
                <div class="admin-form-actions">

                    <a href="{{ route('foods.index') }}" class="admin-btn admin-btn-secondary">
                        Cancel
                    </a>

                    <button type="submit" class="admin-btn admin-btn-primary">
                        Update Food
                    </button>

                </div>

            </form>

        </div>

    </div>

@endsection

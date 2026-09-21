@extends('admin.layouts.app')

@section('title', $food->name . ' - Food Details')

@section('content')

    <div class="admin-page">

        {{-- Page Header --}}
        <div class="admin-page-header">

            <div>
                <span class="food-detail-label">
                    Food Details
                </span>

                <h1>
                    {{ $food->name }}
                </h1>

                <p>
                    View complete information about this food item.
                </p>
            </div>

            <a
                href="{{ route('foods.index') }}"
                class="admin-btn admin-btn-secondary"
            >
                ← Back to Foods
            </a>

        </div>


        {{-- Food Details Card --}}
        <div class="food-detail-card">


            {{-- Food Header --}}
            <div class="food-detail-card-header">

                <div class="food-detail-icon">
                    🍽️
                </div>

                <div>

                    <h2>
                        {{ $food->name }}
                    </h2>

                    <span class="food-category">
                        {{ $food->category }}
                    </span>

                </div>

            </div>


            {{-- Details Grid --}}
            <div class="food-detail-grid">


                {{-- Food Name --}}
                <div class="food-detail-box">

                    <span class="food-detail-title">
                        Food Name
                    </span>

                    <strong class="food-detail-value">
                        {{ $food->name }}
                    </strong>

                </div>


                {{-- Category --}}
                <div class="food-detail-box">

                    <span class="food-detail-title">
                        Category
                    </span>

                    <strong class="food-detail-value">
                        {{ $food->category }}
                    </strong>

                </div>


                {{-- Price --}}
                <div class="food-detail-box">

                    <span class="food-detail-title">
                        Price
                    </span>

                    <strong class="food-detail-value food-price">
                        ₹{{ number_format($food->price, 2) }}
                    </strong>

                </div>


                {{-- Status --}}
                <div class="food-detail-box">

                    <span class="food-detail-title">
                        Status
                    </span>

                    <div>

                        @if ($food->is_available)

                            <span class="food-status available">
                                Available
                            </span>

                        @else

                            <span class="food-status unavailable">
                                Unavailable
                            </span>

                        @endif

                    </div>

                </div>

            </div>


            {{-- Description --}}
            <div class="food-description-box">

                <span class="food-detail-title">
                    Description
                </span>

                <p>
                    {{ $food->description ?: 'No description available.' }}
                </p>

            </div>


            {{-- Card Footer --}}
            <div class="food-detail-footer">

                <a
                    href="{{ route('foods.edit', $food->id) }}"
                    class="admin-btn admin-btn-primary"
                >
                    Edit Food
                </a>

                <a
                    href="{{ route('foods.index') }}"
                    class="admin-btn admin-btn-secondary"
                >
                    Back to Foods
                </a>

            </div>

        </div>

    </div>

@endsection
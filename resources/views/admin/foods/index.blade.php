@extends('admin.layouts.app')

@section('title', 'Food Menu')

@section('page-title', 'Food Menu')

@section('content')

    {{-- Success Message --}}
    @if (session('success'))
        <div id="success-message" class="admin-success-message">
            <span class="success-icon">✓</span>
            <span>{{ session('success') }}</span>
        </div>
    @endif


    {{-- Page Header --}}
    <div class="admin-page-header">

        <div>
            <h1>Food Menu</h1>

            <p>
                Manage your restaurant food items.
            </p>
        </div>

        <a
            href="{{ route('foods.create') }}"
            class="admin-primary-btn"
        >
            + Add Food
        </a>

    </div>


    {{-- Search --}}
    <div class="food-toolbar">

        <div class="food-search-wrapper">

            <span class="food-search-icon">
                🔍
            </span>

            <input
                type="text"
                name="search"
                id="search-input"
                class="food-search-input"
                placeholder="Search food by name, category or price..."
                value="{{ request('search') }}"
                autocomplete="off"
            >

        </div>

    </div>


    {{-- Food Table --}}
    <div class="admin-table-card">

        <div class="admin-table-wrapper">

            <table class="admin-table">

                <thead>

                    <tr>
                        <th>#</th>
                        <th>Food</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>

                </thead>


                <tbody id="food-table-body">

                    @forelse ($foods as $food)

                        <tr>

                            {{-- ID --}}
                            <td>
                                {{ $loop->iteration }}
                            </td>


                            {{-- Food --}}
                            <td>

                                <div class="food-name-cell">

                                    <div class="food-avatar">
                                        🍽️
                                    </div>

                                    <div>
                                        <strong>
                                            {{ $food->name }}
                                        </strong>
                                    </div>

                                </div>

                            </td>


                            {{-- Category --}}
                            <td>
                                {{ $food->category }}
                            </td>


                            {{-- Price --}}
                            <td>

                                <strong>
                                    ₹{{ number_format($food->price, 2) }}
                                </strong>

                            </td>


                            {{-- Status --}}
                            <td>

                                @if ($food->is_available)

                                    <span class="status-badge status-available">
                                        Available
                                    </span>

                                @else

                                    <span class="status-badge status-unavailable">
                                        Unavailable
                                    </span>

                                @endif

                            </td>


                            {{-- Actions --}}
                            <td>

                                <div class="food-action-buttons">

                                    <a
                                        href="{{ route('foods.show', $food) }}"
                                        class="food-action-btn view"
                                    >
                                        View
                                    </a>


                                    <a
                                        href="{{ route('foods.edit', $food) }}"
                                        class="food-action-btn edit"
                                    >
                                        Edit
                                    </a>


                                    <form
                                        action="{{ route('foods.destroy', $food) }}"
                                        method="POST"
                                        class="delete-form"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="button"
                                            class="food-action-btn delete"
                                            onclick="openDeleteModal(this)"
                                        >
                                            Delete
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="food-empty-row"
                            >

                                <div class="food-empty-state">

                                    <div class="empty-food-icon">
                                        🍽️
                                    </div>

                                    <h3>
                                        No Food Items Found
                                    </h3>

                                    <p>
                                        Add a food item to get started.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- Delete Confirmation Modal --}}
    <div
        id="deleteModal"
        class="food-modal-overlay"
    >

        <div class="food-delete-modal">

            <div class="food-modal-icon">
                ⚠️
            </div>

            <h2>
                Delete Food?
            </h2>

            <p>
                Are you sure you want to delete this food?
                <br>
                <strong>
                    This action cannot be undone.
                </strong>
            </p>

            <div class="food-modal-actions">

                <button
                    type="button"
                    class="food-modal-btn cancel"
                    onclick="closeDeleteModal()"
                >
                    Cancel
                </button>

                <button
                    type="button"
                    class="food-modal-btn confirm"
                    onclick="confirmDelete()"
                >
                    Delete
                </button>

            </div>

        </div>

    </div>

@endsection


@push('scripts')

<script>

    /*
    |--------------------------------------------------------------------------
    | Success Message
    |--------------------------------------------------------------------------
    */

    setTimeout(function () {

        const message =
            document.getElementById('success-message');

        if (message) {
            message.style.opacity = '0';

            setTimeout(function () {
                message.remove();
            }, 300);
        }

    }, 3000);


    /*
    |--------------------------------------------------------------------------
    | Delete Modal
    |--------------------------------------------------------------------------
    */

    let deleteForm = null;


    function openDeleteModal(button) {

        deleteForm =
            button.closest('.delete-form');

        const modal =
            document.getElementById('deleteModal');

        if (modal) {
            modal.style.display = 'flex';
        }
    }


    function closeDeleteModal() {

        const modal =
            document.getElementById('deleteModal');

        if (modal) {
            modal.style.display = 'none';
        }

        deleteForm = null;
    }


    function confirmDelete() {

        if (deleteForm) {
            deleteForm.submit();
        }

    }


    /*
    |--------------------------------------------------------------------------
    | Close Modal On Overlay Click
    |--------------------------------------------------------------------------
    */

    const deleteModal =
        document.getElementById('deleteModal');


    if (deleteModal) {

        deleteModal.addEventListener(
            'click',
            function (event) {

                if (event.target === deleteModal) {
                    closeDeleteModal();
                }

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | Search
    |--------------------------------------------------------------------------
    */

    const searchInput =
        document.getElementById('search-input');

    const foodTableBody =
        document.getElementById('food-table-body');

    let searchTimer;


    if (searchInput && foodTableBody) {

        searchInput.addEventListener(
            'input',
            function () {

                clearTimeout(searchTimer);


                searchTimer = setTimeout(function () {

                    const search =
                        searchInput.value.trim();


                    /*
                     * IMPORTANT:
                     * Admin Food route use karna hai.
                     */

                    const url =
                        `{{ route('foods.index') }}?search=${encodeURIComponent(search)}`;


                    fetch(url, {

                        headers: {
                            'X-Requested-With':
                                'XMLHttpRequest',

                            'Accept':
                                'application/json'
                        }

                    })

                    .then(function (response) {

                        if (!response.ok) {
                            throw new Error(
                                'Search request failed.'
                            );
                        }

                        return response.json();

                    })

                    .then(function (data) {

                        foodTableBody.innerHTML = '';


                        /*
                        |--------------------------------------------------------------------------
                        | No Result
                        |--------------------------------------------------------------------------
                        */

                        if (data.length === 0) {

                            foodTableBody.innerHTML = `

                                <tr>

                                    <td
                                        colspan="6"
                                        class="food-empty-row"
                                    >

                                        <div class="food-empty-state">

                                            <div class="empty-food-icon">
                                                🔍
                                            </div>

                                            <h3>
                                                No Food Found
                                            </h3>

                                            <p>
                                                Try a different search.
                                            </p>

                                        </div>

                                    </td>

                                </tr>

                            `;

                            return;
                        }


                        /*
                        |--------------------------------------------------------------------------
                        | Results
                        |--------------------------------------------------------------------------
                        */

                        data.forEach(function (food, index) {

                            const price =
                                parseFloat(food.price)
                                    .toFixed(2);


                            const status =
                                food.is_available

                                    ? `
                                        <span class="status-badge status-available">
                                            Available
                                        </span>
                                      `

                                    : `
                                        <span class="status-badge status-unavailable">
                                            Unavailable
                                        </span>
                                      `;


                            foodTableBody.innerHTML += `

                                <tr>

                                    <td>
                                        ${index + 1}
                                    </td>


                                    <td>

                                        <div class="food-name-cell">

                                            <div class="food-avatar">
                                                🍽️
                                            </div>

                                            <div>
                                                <strong>
                                                    ${food.name}
                                                </strong>
                                            </div>

                                        </div>

                                    </td>


                                    <td>
                                        ${food.category}
                                    </td>


                                    <td>

                                        <strong>
                                            ₹${price}
                                        </strong>

                                    </td>


                                    <td>
                                        ${status}
                                    </td>


                                    <td>

                                        <div class="food-action-buttons">

                                            <a
                                                href="/admin/foods/${food.id}"
                                                class="food-action-btn view"
                                            >
                                                View
                                            </a>


                                            <a
                                                href="/admin/foods/${food.id}/edit"
                                                class="food-action-btn edit"
                                            >
                                                Edit
                                            </a>


                                            <form
                                                action="/admin/foods/${food.id}"
                                                method="POST"
                                                class="delete-form"
                                            >

                                                <input
                                                    type="hidden"
                                                    name="_token"
                                                    value="{{ csrf_token() }}"
                                                >

                                                <input
                                                    type="hidden"
                                                    name="_method"
                                                    value="DELETE"
                                                >

                                                <button
                                                    type="button"
                                                    class="food-action-btn delete"
                                                    onclick="openDeleteModal(this)"
                                                >
                                                    Delete
                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            `;

                        });

                    })

                    .catch(function (error) {

                        console.error(
                            'Food search error:',
                            error
                        );

                    });

                }, 300);

            }
        );

    }

</script>

@endpush
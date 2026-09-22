<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Edit Inventory - Bubbles & Drop</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-[#edf4ff] min-h-screen">

<div class="min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-2xl bg-white
                rounded-2xl shadow-lg p-8">

        <h1 class="text-3xl font-bold text-blue-800 mb-2">
            Edit Inventory Item
        </h1>

        <p class="text-gray-500 mb-8">
            Update the inventory information below.
        </p>


        @if ($errors->any())

            <div class="mb-6 rounded-lg
                        bg-red-100 border border-red-300
                        text-red-700 px-4 py-3">

                <ul class="list-disc list-inside">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        <form
            method="POST"
            action="{{ route(
                'admin.inventory.update',
                $inventoryItem
            ) }}"
            class="space-y-5"
        >

            @csrf
            @method('PUT')


            <div>

                <label class="block font-semibold mb-2">
                    Item Name
                </label>

                <input
                    type="text"
                    name="item_name"
                    value="{{ old(
                        'item_name',
                        $inventoryItem->item_name
                    ) }}"
                    required
                    class="w-full rounded-lg border-gray-300"
                >

            </div>


            <div>

                <label class="block font-semibold mb-2">
                    Category
                </label>

                <input
                    type="text"
                    name="category"
                    value="{{ old(
                        'category',
                        $inventoryItem->category
                    ) }}"
                    required
                    class="w-full rounded-lg border-gray-300"
                >

            </div>


            <div>

                <label class="block font-semibold mb-2">
                    Quantity
                </label>

                <input
                    type="number"
                    name="quantity"
                    value="{{ old(
                        'quantity',
                        $inventoryItem->quantity
                    ) }}"
                    min="0"
                    step="0.01"
                    required
                    class="w-full rounded-lg border-gray-300"
                >

            </div>

            <div>
                <label class="block font-semibold mb-2">
                    Maximum Capacity
                </label>

                <input
                    type="number"
                    name="max_capacity"
                    value="{{ old(
                        'max_capacity',
                        $inventoryItem->max_capacity
                    ) }}"
                    min="0.01"
                    step="0.01"
                    required
                    class="w-full rounded-lg border-gray-300"
                >
            </div>


            <div>

                <label class="block font-semibold mb-2">
                    Reorder Level
                </label>

                <input
                    type="number"
                    name="reorder_level"
                    value="{{ old(
                        'reorder_level',
                        $inventoryItem->reorder_level
                    ) }}"
                    min="0"
                    step="0.01"
                    required
                    class="w-full rounded-lg border-gray-300"
                >

            </div>


            <div>

                <label class="block font-semibold mb-2">
                    Unit
                </label>

                <input
                    type="text"
                    name="unit"
                    value="{{ old(
                        'unit',
                        $inventoryItem->unit
                    ) }}"
                    required
                    class="w-full rounded-lg border-gray-300"
                >

            </div>


            <div class="flex gap-3 pt-4">

                <button
                    type="submit"
                    class="flex-1 bg-blue-700
                           text-white font-semibold
                           py-3 rounded-lg
                           hover:bg-blue-800"
                >
                    Save Changes
                </button>

                <a
                    href="{{ route('admin.inventory.index') }}"
                    class="flex-1 text-center
                           bg-gray-200 text-gray-700
                           font-semibold py-3 rounded-lg"
                >
                    Cancel
                </a>

            </div>

        </form>

    </div>

</div>

</body>
</html>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Manage Inventory - Bubbles & Drop</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-[#edf4ff] min-h-screen">

<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    <aside class="w-64 bg-[#233f91] text-white flex flex-col">

        <div class="px-6 py-6 border-b border-blue-400/20">

            <h1 class="font-bold text-lg">
                Bubbles & Drop
            </h1>

            <p class="text-xs text-blue-200">
                Laundry Shop
            </p>

        </div>

        <div class="px-4 pt-4">

            <div class="bg-white/10 rounded-lg px-4 py-3">

                <p class="text-sm font-semibold">
                    Admin Account
                </p>

                <p class="text-xs text-blue-200">
                    Admin Portal
                </p>

            </div>

        </div>

        <nav class="px-4 mt-6 flex-1">

            <p class="text-xs uppercase tracking-widest
                      text-blue-300 px-3 mb-3">
                Modules
            </p>

            <a
                href="{{ route('admin.dashboard') }}"
                class="block px-3 py-3 rounded-lg
                       text-blue-100 hover:bg-white/10"
            >
                Dashboard
            </a>

            <a
                href="{{ route('admin.inventory.index') }}"
                class="block px-3 py-3 rounded-lg
                       bg-white/15 text-white"
            >
                Manage Inventory
            </a>

            <a
                href="#"
                class="block px-3 py-3 rounded-lg
                       text-blue-100 hover:bg-white/10"
            >
                Monitor Stock Levels
            </a>

            <a
                href="#"
                class="block px-3 py-3 rounded-lg
                       text-blue-100 hover:bg-white/10"
            >
                Record Stock-In
            </a>

            <a
                href="#"
                class="block px-3 py-3 rounded-lg
                       text-blue-100 hover:bg-white/10"
            >
                Record Stock-Out
            </a>

            <a
                href="#"
                class="block px-3 py-3 rounded-lg
                       text-blue-100 hover:bg-white/10"
            >
                View Inventory
            </a>

        </nav>

        <div class="px-4 py-5 border-t border-blue-400/20">

            <form
                method="POST"
                action="{{ route('logout') }}"
            >

                @csrf

                <button
                    type="submit"
                    class="w-full text-left px-3 py-3
                           text-blue-100 hover:bg-white/10
                           rounded-lg"
                >
                    Sign Out
                </button>

            </form>

        </div>

    </aside>


    {{-- MAIN --}}
    <main class="flex-1 p-8 overflow-auto">

        <div class="mb-7">

            <h1 class="text-3xl font-bold text-[#183984]">
                Manage Inventory
            </h1>

            <p class="text-sm text-blue-500 mt-1">
                Manage and maintain inventory records.
            </p>

        </div>


        @if (session('success'))

            <div class="mb-6 rounded-lg
                        bg-green-100 border border-green-300
                        text-green-700 px-4 py-3">

                {{ session('success') }}

            </div>

        @endif


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


        {{-- ADD ITEM --}}
        <div class="bg-white rounded-2xl shadow-sm
                    border border-blue-100 p-6 mb-6">

            <h2 class="text-lg font-semibold text-blue-800 mb-5">
                Add Inventory Item
            </h2>

            <form
                method="POST"
                action="{{ route('admin.inventory.store') }}"
                class="grid grid-cols-1 md:grid-cols-2
                       xl:grid-cols-5 gap-4"
            >

                @csrf

                <input
                    type="text"
                    name="item_name"
                    placeholder="Item Name"
                    required
                    class="rounded-lg border-gray-300"
                >

                <input
                    type="text"
                    name="category"
                    placeholder="Category"
                    required
                    class="rounded-lg border-gray-300"
                >

                <input
                    type="number"
                    name="quantity"
                    placeholder="Quantity"
                    min="0"
                    step="0.01"
                    required
                    class="rounded-lg border-gray-300"
                >

                <input
                    type="number"
                    name="max_capacity"
                    placeholder="Maximum Capacity"
                    min="0.01"
                    step="0.01"
                    required
                    class="w-full rounded-lg border-gray-300"
                >

                <input
                    type="number"
                    name="reorder_level"
                    placeholder="Reorder Level"
                    min="0"
                    step="0.01"
                    required
                    class="rounded-lg border-gray-300"
                >

                <input
                    type="text"
                    name="unit"
                    placeholder="Unit (e.g. piece)"
                    required
                    class="rounded-lg border-gray-300"
                >

                <button
                    type="submit"
                    class="xl:col-span-5 bg-blue-700
                           text-white font-semibold
                           py-3 rounded-lg hover:bg-blue-800"
                >
                    Add Item
                </button>

            </form>

        </div>


        {{-- SEARCH / FILTER --}}
        <div class="bg-white rounded-2xl shadow-sm
                    border border-blue-100 p-6 mb-6">

            <form
                method="GET"
                action="{{ route('admin.inventory.index') }}"
                class="grid grid-cols-1 md:grid-cols-3 gap-4"
            >

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search item..."
                    class="rounded-lg border-gray-300"
                >

                <select
                    name="category"
                    class="rounded-lg border-gray-300"
                >

                    <option value="">
                        All Categories
                    </option>

                    @foreach ($categories as $category)

                        <option
                            value="{{ $category }}"
                            @selected(request('category') === $category)
                        >
                            {{ $category }}
                        </option>

                    @endforeach

                </select>

                <button
                    type="submit"
                    class="bg-blue-700 text-white
                           font-semibold rounded-lg"
                >
                    Search / Filter
                </button>

            </form>

        </div>


        {{-- INVENTORY TABLE --}}
        <div class="bg-white rounded-2xl shadow-sm
                    border border-blue-100 overflow-hidden">

            <div class="px-6 py-5 border-b border-gray-100">

                <h2 class="text-lg font-semibold text-blue-800">
                    Inventory Items
                </h2>

            </div>


            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-blue-700 text-white">

                    <tr>

                        <th class="px-5 py-4 text-left">
                            Item Name
                        </th>

                        <th class="px-5 py-4 text-left">
                            Category
                        </th>

                        <th class="px-5 py-4 text-left">
                            Quantity
                        </th>

                        <th class="px-5 py-4 text-left">
                            Status
                        </th>

                        <th class="px-5 py-4 text-left">
                            Last Updated
                        </th>

                        <th class="px-5 py-4 text-left">
                            Action
                        </th>

                    </tr>

                    </thead>


                    <tbody>

                    @forelse ($items as $item)

                        @php

                            if ($item->quantity <= $item->reorder_level) {
                                $status = 'Low';
                                $statusClass =
                                    'bg-red-100 text-red-700';
                            } elseif (
                                $item->quantity <=
                                ($item->reorder_level * 2)
                            ) {
                                $status = 'Medium';
                                $statusClass =
                                    'bg-yellow-100 text-yellow-700';
                            } else {
                                $status = 'Full';
                                $statusClass =
                                    'bg-green-100 text-green-700';
                            }

                        @endphp

                        <tr class="border-b border-gray-100">

                            <td class="px-5 py-4 font-semibold text-blue-900">

                                {{ $item->item_name }}

                            </td>

                            <td class="px-5 py-4">

                                {{ $item->category }}

                            </td>

                            <td class="px-5 py-4">

                                {{ $item->quantity }}
                                {{ $item->unit }}

                            </td>

                            <td class="px-5 py-4">

                                <span
                                    class="px-3 py-1 rounded-full
                                           text-xs font-semibold
                                           {{ $statusClass }}"
                                >

                                    {{ $status }}

                                </span>

                            </td>

                            <td class="px-5 py-4 text-sm text-gray-500">

                                {{ $item->updated_at->format('M d, Y') }}

                            </td>

                            <td class="px-5 py-4">

                                <div class="flex gap-2">

                                    <a
                                        href="{{ route(
                                            'admin.inventory.edit',
                                            $item
                                        ) }}"
                                        class="px-3 py-2
                                               bg-blue-100
                                               text-blue-700
                                               rounded-lg text-sm"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        method="POST"
                                        action="{{ route(
                                            'admin.inventory.destroy',
                                            $item
                                        ) }}"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            onclick="return confirm(
                                                'Remove this inventory item?'
                                            )"
                                            class="px-3 py-2
                                                   bg-red-100
                                                   text-red-700
                                                   rounded-lg text-sm"
                                        >
                                            Remove
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="px-5 py-10
                                       text-center text-gray-500"
                            >
                                No inventory items found.
                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </main>

</div>

</body>
</html>
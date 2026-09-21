<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Staff Orders - Bubble & Drop</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-sky-100 p-6">

    <div class="max-w-7xl mx-auto">

        <div class="flex justify-between items-center mb-8">

            <div>
                <h1 class="text-3xl font-bold text-blue-800">
                    Laundry Orders
                </h1>

                <p class="text-gray-600 mt-1">
                    Manage active laundry orders.
                </p>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button
                    type="submit"
                    class="px-4 py-2 bg-gray-700 text-white rounded-lg"
                >
                    Logout
                </button>
            </form>

        </div>


        @if (session('success'))

            <div class="mb-6 rounded-lg bg-green-100
                        border border-green-300
                        text-green-700 px-4 py-3">

                {{ session('success') }}

            </div>

        @endif


        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-blue-700 text-white">

                        <tr>

                            <th class="px-6 py-4 text-left">
                                Service No.
                            </th>

                            <th class="px-6 py-4 text-left">
                                Customer
                            </th>

                            <th class="px-6 py-4 text-left">
                                Service
                            </th>

                            <th class="px-6 py-4 text-left">
                                Weight
                            </th>

                            <th class="px-6 py-4 text-left">
                                Loads
                            </th>

                            <th class="px-6 py-4 text-left">
                                Total
                            </th>

                            <th class="px-6 py-4 text-left">
                                Status
                            </th>

                            <th class="px-6 py-4 text-left">
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse ($orders as $order)

                            <tr class="border-b">

                                <td class="px-6 py-4 font-semibold">
                                    {{ $order->service_number }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $order->customer->full_name }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $order->service->service_name }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $order->kilos ?? '-' }} kg
                                </td>

                                <td class="px-6 py-4">
                                    {{ $order->load_count ?: '-' }}
                                </td>

                                <td class="px-6 py-4">
                                    ₱{{ number_format($order->total_amount, 2) }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $order->status }}
                                </td>

                                <td class="px-6 py-4">

                                    <a
                                        href="{{ route('staff.orders.edit', $order) }}"
                                        class="inline-block px-4 py-2
                                               bg-blue-700 text-white
                                               rounded-lg"
                                    >
                                        Manage
                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="8"
                                    class="px-6 py-12 text-center text-gray-500"
                                >
                                    No active laundry orders found.
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</body>
</html>
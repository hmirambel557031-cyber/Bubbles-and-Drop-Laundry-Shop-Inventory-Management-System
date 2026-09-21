<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Laundry Order - Bubble & Drop</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-sky-100 flex items-center justify-center p-6">

    <div class="w-full max-w-2xl bg-white rounded-2xl shadow-lg p-8">

        <div class="mb-8">

            <h1 class="text-3xl font-bold text-blue-800">
                Manage Laundry Order
            </h1>

            <p class="text-gray-600 mt-1">
                {{ $order->service_number }}
            </p>

        </div>


        <div class="grid grid-cols-2 gap-4 mb-8">

            <div class="bg-gray-50 rounded-lg p-4">

                <p class="text-sm text-gray-500">
                    Customer
                </p>

                <p class="font-semibold text-lg">
                    {{ $order->customer->full_name }}
                </p>

            </div>


            <div class="bg-gray-50 rounded-lg p-4">

                <p class="text-sm text-gray-500">
                    Customer ID
                </p>

                <p class="font-semibold text-lg">
                    {{ $order->customer->customer_code }}
                </p>

            </div>


            <div class="bg-gray-50 rounded-lg p-4">

                <p class="text-sm text-gray-500">
                    Service
                </p>

                <p class="font-semibold">
                    {{ $order->service->service_name }}
                </p>

            </div>


            <div class="bg-gray-50 rounded-lg p-4">

                <p class="text-sm text-gray-500">
                    Price per Load
                </p>

                <p class="font-semibold">
                    ₱{{ number_format($order->service->price, 2) }}
                </p>

            </div>

        </div>


        @if ($errors->any())

            <div class="mb-6 rounded-lg bg-red-100
                        border border-red-300
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
            action="{{ route('staff.orders.update', $order) }}"
            class="space-y-6"
        >

            @csrf
            @method('PUT')


            <div>

                <label
                    for="kilos"
                    class="block text-sm font-semibold text-gray-700 mb-2"
                >
                    Actual Laundry Weight (kg)
                </label>

                <input
                    type="number"
                    name="kilos"
                    id="kilos"
                    value="{{ old('kilos', $order->kilos) }}"
                    step="0.01"
                    min="0.01"
                    required
                    class="w-full border border-gray-300
                           rounded-lg px-4 py-3"
                >

                <p class="mt-2 text-sm text-gray-500">
                    Maximum weight per load: 8.50 kg
                </p>

            </div>


            <div class="bg-blue-50 rounded-lg p-5">

                <p class="text-sm text-blue-600 font-semibold">
                    Number of Loads
                </p>

                <p class="text-3xl font-bold text-blue-800 mt-1">
                    {{ $order->load_count ?: 'Not calculated' }}
                </p>

            </div>


            <div class="bg-green-50 rounded-lg p-5">

                <p class="text-sm text-green-600 font-semibold">
                    Current Total
                </p>

                <p class="text-3xl font-bold text-green-800 mt-1">
                    ₱{{ number_format($order->total_amount, 2) }}
                </p>

            </div>


            <div>

                <label
                    for="status"
                    class="block text-sm font-semibold text-gray-700 mb-2"
                >
                    Laundry Status
                </label>

                <select
                    name="status"
                    id="status"
                    class="w-full border border-gray-300
                           rounded-lg px-4 py-3"
                >

                    @foreach ([
                        'Received',
                        'Washing',
                        'Drying',
                        'Folding',
                        'Ready for Pickup',
                        'Claimed'
                    ] as $status)

                        <option
                            value="{{ $status }}"
                            @selected($order->status === $status)
                        >
                            {{ $status }}
                        </option>

                    @endforeach

                </select>

            </div>


            <button
                type="submit"
                class="w-full bg-blue-700 text-white
                       font-semibold py-3 rounded-lg
                       hover:bg-blue-800 transition"
            >
                Save Changes
            </button>


            <a
                href="{{ route('staff.orders.index') }}"
                class="block text-center text-gray-600
                       hover:text-blue-700"
            >
                Back to Orders
            </a>

        </form>

    </div>

</body>
</html>
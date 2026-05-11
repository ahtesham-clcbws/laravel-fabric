<div class="p-6">
    <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Ecommerce Overview</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
        <div class="bg-white dark:bg-neutral-900 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-neutral-700">
            <p class="text-sm text-gray-500 uppercase">Total Orders</p>
            <p class="text-3xl font-bold text-blue-600">{{\App\Models\Order::count()}}</p>
        </div>
        <div class="bg-white dark:bg-neutral-900 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-neutral-700">
            <p class="text-sm text-gray-500 uppercase">Total Revenue</p>
            <p class="text-3xl font-bold text-green-600">$ {{\App\Models\Order::sum('total')}}</p>
        </div>
        <div class="bg-white dark:bg-neutral-900 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-neutral-700">
            <p class="text-sm text-gray-500 uppercase">Avg. Rating</p>
            <p class="text-3xl font-bold text-yellow-500">{{\App\Models\Review::avg('rating') ?? 0}} / 5</p>
        </div>
    </div>
</div>

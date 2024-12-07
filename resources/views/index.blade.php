<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Products CRUD</title>
</head>
<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-8">
        <div class="overflow-x-auto font-[sans-serif]">
            <h1 class="text-4xl font-semibold text-center text-blue-500 mb-8">
                Product Management System
            </h1>

            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-green-700">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Action Bar -->
            <div class="bg-white p-6 rounded-lg shadow-sm mb-6">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <!-- Add Product Button -->
                    <a href="{{ route('products.create') }}">
                        <button type="button" class="w-full md:w-auto px-6 py-3 rounded-lg text-white text-sm font-medium bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 transition-all duration-200 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16px" height="16px" class="fill-white">
                                <path d="M12 2C11.4477 2 11 2.4477 11 3V10H4C3.4477 10 3 10.4477 3 11C3 11.5523 3.4477 12 4 12H11V19C11 19.5523 11.4477 20 12 20C12.5523 20 13 19.5523 13 19V12H20C20.5523 12 21 11.5523 21 11C21 10.4477 20.5523 10 20 10H13V3C13 2.4477 12.5523 2 12 2Z" />
                            </svg>
                            <span>Add New Product</span>
                        </button>
                    </a>

                    <!-- Search Form -->
                    <form method="GET" action="{{ route('products.index') }}" class="w-full md:w-96">
                        <div class="relative">
                            <input type="text"
                                   name="search"
                                   placeholder="Search products..."
                                   value="{{ $search ?? '' }}"
                                   class="w-full pl-4 pr-12 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors duration-200" />
                            <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Products Table -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product Details</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($products as $product)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                                        <div class="text-sm text-gray-500 mt-1 line-clamp-2">{{ $product->description }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm font-medium text-gray-900">${{ number_format($product->price, 2) }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm text-gray-900">{{ $product->quantity }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-3">
                                        <a href="{{ route('products.edit', $product->id) }}"
                                           class="text-blue-600 hover:text-blue-900 transition-colors duration-200">
                                            <span class="sr-only">Edit</span>
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('products.destroy', $product->id) }}"
                                              method="POST"
                                              class="inline-block"
                                              onsubmit="return confirm('Are you sure you want to delete this product?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 transition-colors duration-200">
                                                <span class="sr-only">Delete</span>
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</body>
</html>

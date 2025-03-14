@extends('layout.admin')
@section('title laporan', 'Daftar Barang')

@section('content')
    <!-- tabel barang -->
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mx-52 my-24">
        <div class="flex items-center justify-between p-2" style="background:#EEF0F4">
            <!-- button tambah data barang -->
            <a href="{{ route('barang.create')}}" class="flex items-center group">
                <button title="Add New" class="cursor-pointer outline-none group-hover:rotate-90 duration-300 ml-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25px" height="25px" viewBox="0 0 24 24"
                        class="stroke-blue-600 fill-none group-active:stroke-blue-600 group-active:duration-0 duration-300">
                        <path d="M12 22C17.5 22 22 17.5 22 12C22 6.5 17.5 2 12 2C6.5 2 2 6.5 2 12C2 17.5 6.5 22 12 22Z"
                            stroke-width="1.5"></path>
                        <path d="M8 12H16" stroke-width="1.5"></path>
                        <path d="M12 16V8" stroke-width="1.5"></path>
                    </svg>
                </button>
                <p  class="text-blue-600 group-hover:underline px-2"
                    style="font-weight:bold; font-size:13px">Tambah</p>
            </a>
            <!-- button unduh informasi barang -->
            <a href="/barang/unduh">
                <button type="button"
                    class="text-white bg-[#0090F0] hover:bg-blue-800 duration-300 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 text-center inline-flex items-center me-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 me-2" viewBox="0 0 24 24">
                        <path fill="white"
                            d="M16.59 9H15V4c0-.55-.45-1-1-1h-4c-.55 0-1 .45-1 1v5H7.41c-.89 0-1.34 1.08-.71 1.71l4.59 4.59c.39.39 1.02.39 1.41 0l4.59-4.59c.63-.63.19-1.71-.7-1.71M5 19c0 .55.45 1 1 1h12c.55 0 1-.45 1-1s-.45-1-1-1H6c-.55 0-1 .45-1 1" />
                    </svg>
                    Unduh
                </button>
            </a>
        </div>
        <table class="relative w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-white uppercase bg-[#324150]">
                <tr>
                    <th scope="col" class="px-3 py-3">
                        Date
                    </th>
                    <th scope="col" class="px-3 py-3">
                        Price
                    </th>
                    <th scope="col" class="px-3 py-3">
                        Description
                    </th>
                    <th scope="col" class="px-3 py-3">
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data_keluar as $expense)
                    <tr class="bg-white border-b">

                        <th scope="row" class="px-3 py-1 font-medium text-gray-900 whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($expense->date)->format('d-m-Y') }}
                        </th>
                        <td class="px-3 py-1">
                            {{ 'Rp ' . number_format($expense->amount, 2, ',', '.') }}
                        </td>
                        <td class="px-3 py-1">
                            {{ $expense->description }}
                        </td>
                        <td class="flex items-center px-3 justify-end">
                            <a href="{{ route('barang.edit', $expense->expense_id) }}"
                                class="border-2 border-[#A3A3A3] rounded p-1 hover:bg-green-100 my-3 relative group">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path fill="#B6BE1A" fill-rule="evenodd"
                                        d="M17.204 10.796L19 9c.545-.545.818-.818.964-1.112a2 2 0 0 0 0-1.776C19.818 5.818 19.545 5.545 19 5s-.818-.818-1.112-.964a2 2 0 0 0-1.776 0c-.294.146-.567.419-1.112.964l-1.819 1.819a10.9 10.9 0 0 0 4.023 3.977m-5.477-2.523l-6.87 6.87c-.426.426-.638.638-.778.9c-.14.26-.199.555-.316 1.145l-.616 3.077c-.066.332-.1.498-.005.593s.26.061.593-.005l3.077-.616c.59-.117.885-.176 1.146-.316s.473-.352.898-.777l6.89-6.89a12.9 12.9 0 0 1-4.02-3.98"
                                        clip-rule="evenodd" />
                                </svg>
                                <span
                                    class="absolute -top-8 left-1/2 -translate-x-1/2 hidden group-hover:block bg-[#B6BE1A] text-white text-xs rounded py-1 px-2 shadow-md">
                                    Edit
                                </span>
                            </a>
                            <form action="{{ route('barang.destroy', $expense->expense_id) }}" method="POST"
                                onsubmit="return confirmDelete();" class="relative group">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="border-2 border-[#A3A3A3] rounded p-1 hover:bg-red-100 ml-1"
                                    title="Delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                        <g fill="none">
                                            <path fill="#C50505" fill-rule="evenodd"
                                                d="M21 6H3v3a2 2 0 0 1 2 2v4c0 2.828 0 4.243.879 5.121C6.757 21 8.172 21 11 21h2c2.829 0 4.243 0 5.121-.879c.88-.878.88-2.293.88-5.121v-4a2 2 0 0 1 2-2zm-10.5 5a1 1 0 0 0-2 0v5a1 1 0 1 0 2 0zm5 0a1 1 0 0 0-2 0v5a1 1 0 1 0 2 0z"
                                                clip-rule="evenodd" />
                                            <path stroke="#C50505" stroke-linecap="round" stroke-width="2"
                                                d="M10.068 3.37c.114-.106.365-.2.715-.267A6.7 6.7 0 0 1 12 3c.44 0 .868.036 1.217.103s.6.161.715.268" />
                                        </g>
                                    </svg>
                                </button>
                                <span
                                    class="absolute -top-8 left-1/2 -translate-x-1/2 hidden group-hover:block bg-red-800 text-white text-xs rounded py-1 px-2 shadow-md">
                                    Hapus
                                </span>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- pagination -->
        <div class="flex justify-between bg-[#E8E8E8]">
            <form method="GET" action="{{ route('barang.index') }}" class="flex items-center my-2 ml-2">
                <label for="per_page" class="block text-sm font-medium text-gray-700 pr-2">Items per page:</label>
                <select name="per_page" id="per_page"
                    class="mt-1 block cursor-pointer text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                    onchange="this.form.submit()">
                    <option value="1" {{ request('per_page') == 1 ? 'selected' : '' }}>1</option>
                    <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                    <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15</option>
                    <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                    <option value="30" {{ request('per_page') == 30 ? 'selected' : '' }}>30</option>
                    <option value="35" {{ request('per_page') == 35 ? 'selected' : '' }}>35</option>
                    <option value="40" {{ request('per_page') == 40 ? 'selected' : '' }}>40</option>
                    <option value="45" {{ request('per_page') == 45 ? 'selected' : '' }}>45</option>
                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                </select>
            </form>
            <div class="mt-2 mr-2">
                {{ $data_keluar->links('pagination::tailwind') }}
            </div>
        </div>
    </div>

    <script>
        function confirmDelete() {
            const confirmed = confirm('Delete this data?');
            if (!confirmed) return false;

            console.log('Delete confirmed. Submitting form.');
            return true;
        }
    </script>
@endsection
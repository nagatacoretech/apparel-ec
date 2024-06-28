<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin_Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('admin.parent_category') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">親カテゴリー名</label>
                            <input name="name" type="text" class="form-control"required>
                        </div><br>
                        <label>性別</label><br>
                        <label>
                            <input type="radio" name="gender" value="0" checked> 共通
                        </label>
                        <label>
                            <input type="radio" name="gender" value="1"> 男性
                        </label>
                        <label>
                            <input type="radio" name="gender" value="2"> 女性
                        </label><br><br>
                        <button type="submit" class="btn btn-primary">登録する</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

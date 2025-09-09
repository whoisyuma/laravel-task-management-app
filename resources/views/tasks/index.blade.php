<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>タスク管理アプリ</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 p-8 flex flex-col items-center">
    <div class="max-w-xl w-full">
        <h1 class="text-4xl font-bold mb-6 text-center">タスク管理</h1>

        <form action="/tasks" method="post" class="mb-6 flex">
            @csrf
            <input type="text" name="title" placeholder="タスクを入力" class="flex-1 border p-2 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-r-md">
                追加
            </button>
        </form>

        <ul class="bg-white rounded-md shadow-md p-4">
            @foreach($tasks as $task)
            <li class="flex justify-between items-center py-2 border-b last:border-b-0">
                <div class="flex items-center flex-1">
                    <form action="/tasks/{{ $task->id }}" method="post" class="mr-2">
                        @csrf
                        @method('put')
                        <input type="checkbox" onchange="this.form.submit()" class="form-checkbox h-5 w-5 text-blue-600" {{ $task->completed ? 'checked' : ''}}>
                    </form>

                    <span class="flex-1 text-lg {{ $task->completed ? 'line-through text-gray-400' : 'text-gray-800' }}">
                        {{ $task->title }}
                    </span>
                </div>

                <form action="/tasks/{{ $task->id }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded-md text-sm">
                        削除
                    </button>
                </form>
            </li>
            @endforeach
        </ul>
    </div>
</body>

</html>
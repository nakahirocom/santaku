<!doctype html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <title>santakuアプリ</title>
</head>

<body class="bg-gradient-to-r px-4 sm:px-8 lg:px-64">
    @auth
    <div class="flex justify-end items-center my-4">
        <a class="text-gray-500 hover:text-gray-700 underline decoration-gray-500 hover:decoration-blue-700 transition duration-300 ease-in-out"
            href="/">HOMEへ</a>
    </div>
    @endauth

    <div class="container mx-auto">
        <form action="{{ route('check.register') }}" method="post"
            class="border-2 border-gray-300 rounded-md p-4 shadow-lg bg-gradient-to-r from-pink-100 via-blue-100 to-purple-100">
            @csrf

            <div class="mb-4">
                <label for="basic_count" class="block text-gray-700 font-bold mb-2">Basic Count:</label>
                <input type="number" name="basic_count" id="basic_count" value="{{ auth()->user()->basic_count }}" class="w-full px-3 py-2 border rounded" required>
            </div>
        
            <div class="mb-4">
                <label for="user_mode" class="block text-gray-700 font-bold mb-2">User Mode:</label>
                <input type="number" name="user_mode" id="user_mode" value="{{ auth()->user()->user_mode }}" class="w-full px-3 py-2 border rounded" required>
            </div>

            <input type="hidden" name="form_type" value="basic_select">
            <div class="flex justify-between items-center mb-4">
                <div class="text-lg font-semibold">
                    基礎モード【{{ $countOf }}ジャンル中、星争奪バトル挑戦権🎴を得たのは{{ $countOfFiftyOrMore }}ジャンル】
                    <br>
                    10題以上回答したジャンルが対象
                    <br>
                    <!-- 星の数:各ジャンル正解率順に1位⭐️5個〜5位⭐️1個まで。同率は平均回答時間短い順) -->
                </div>
                <button type="button" onclick="toggleAllCheckboxes()"
                    class="from-orange-400 to-orange-600 hover:from-orange-500 hover:to-orange-700 text-black font-bold py-2 px-4 rounded-full border-2 border-orange-600 shadow-lg transition-transform transform hover:scale-105 hover:shadow-xl">
                    全選択/全解除
                </button>
            </div>
            @csrf
            @foreach($largelabelList as $largelabel)
            <div class="mb-6">
                <div class="flex justify-between items-center mb=2">
                    <div class="font-bold text-lg">
                        分類：{{ $largelabel->large_label }}
                    </div>
                    <button type="button" onclick="toggleCheckboxes('{{ $largelabel->id }}')"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-1 px-2 border border-gray-300 rounded shadow-sm hover:shadow-md transition ease-in-out duration-150">
                        選択解除
                    </button>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($middlelabelList as $middlelabel)
                    @if($largelabel->id == $middlelabel->large_label_id)
                    <div>
                        <div class="font-semibold text-sm mb-2">{{ $middlelabel->middle_label }}</div>
                        @foreach ($selectList as $user_select)
                        @if ($middlelabel->id == $user_select->smallLabel->middle_label_id)
                            @if ($user_select->small_question_count > 0)
                                <div class="flex items-center mb-2">
                                    <input type="hidden" name="labelstorages_id[{{ $user_select['id'] }}]" value="0">
                                    <input type="checkbox" id="{{ $user_select->smallLabel->small_label }}"
                                           name="labelstorages_id[{{ $user_select['id'] }}]" value="1"
                                           class="form-checkbox h-6 w-6 text-blue-600 rounded focus:ring-blue-500 border-gray-300 shadow-md transition duration-150 ease-in-out {{ $user_select->small_question_count == 1 ? 'opacity-50 cursor-not-allowed' : '' }}"
                                           {{ $user_select['basic_select'] ? 'checked' : '' }}
                                           {{ $user_select->small_question_count == 1 ? 'disabled' : '' }}
                                           data-large-label-id="{{ $largelabel->id }}">
                                    <label for="{{ $user_select->smallLabel->small_label }}"
                                           class="ml-2 text-sm text-gray-700 font-medium {{ $user_select->small_question_count == 1 ? 'text-gray-500' : '' }}">
                                        {{ $user_select->smallLabel->small_label }} (登録{{ $user_select->small_question_count }}件)
                                    </label>
                                    @if ($user_select->answer_count >= 10)
                                    🎴 今週{{ $user_select->answer_count }}題回答
                                        <br>
                                        <?php
                                        $accuracy = 0; // 初期化
                    
                                        if ($user_select->small_question_count > 0) {
                                            $accuracy = ($user_select->correct / $user_select->small_question_count) * 100;
                                        }
                    
                                        // 小数点以下1位まで表示するためのフォーマット
                                        $accuracyFormatted = number_format($accuracy, 1);
                                        ?>
                    
                                        正解{{ $accuracyFormatted }}%
                                        <br>平均{{ $user_select->average_time }}秒
                                    @else
                                        今週{{ $user_select->answer_count }}題回答
                                        <br>
                                        <?php
                                        $accuracy = 0; // 初期化
                    
                                        if ($user_select->small_question_count > 0) {
                                            $accuracy = ($user_select->correct / $user_select->small_question_count) * 100;
                                        }
                    
                                        // 小数点以下1位まで表示するためのフォーマット
                                        $accuracyFormatted = number_format($accuracy, 1);
                                        ?>
                    
                                        正解{{ $accuracyFormatted }}%
                                        <br>平均{{ $user_select->average_time }}秒
                                    @endif
                                </div>
                            @endif
                        @endif
                    @endforeach
                                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
            @endforeach

            <div class="flex space-x-4">
                <button type="submit"
                    class="bg-gradient-to-br from-blue-300 to-blue-800 hover:bg-gradient-to-tl text-white rounded px-4 py-2"
                    name="KeepForIndex">
                    保存してホームへ
                </button>
                <button type="button" onclick="resetCheckboxes()"
                    class="bg-gradient-to-br from-red-300 to-red-800 hover:bg-gradient-to-tl text-white rounded px-4 py-2">
                    初期選択に戻す
                </button>
            </div>
        </form>
    </div>

    <script>
        // ページが読み込まれた時にチェックボックスの状態を保存
        document.addEventListener('DOMContentLoaded', () => {
            window.initialCheckboxStates = {};
            document.querySelectorAll('input[type="checkbox"]').forEach((checkbox) => {
                window.initialCheckboxStates[checkbox.id] = checkbox.checked;
            });
        });

        // リセット機能
        function resetCheckboxes() {
            for (const id in window.initialCheckboxStates) {
                const checkbox = document.getElementById(id);
                if (checkbox) {
                    checkbox.checked = window.initialCheckboxStates[id];
                }
            }
        }

        function toggleCheckboxes(largeLabelId) {
            const checkboxes = document.querySelectorAll(`input[name^='labelstorages_id'][data-large-label-id='${largeLabelId}']`);
            let allChecked = true;
            checkboxes.forEach((checkbox) => {
                if (!checkbox.checked) {
                    allChecked = false;
                }
            });
            checkboxes.forEach((checkbox) => {
                checkbox.checked = !allChecked;
            });
        }

        function toggleAllCheckboxes() {
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
            const allChecked = Array.from(checkboxes).every(checkbox => checkbox.checked);

            checkboxes.forEach((checkbox) => {
                checkbox.checked = !allChecked;
            });
        }
    </script>
</body>

</html>

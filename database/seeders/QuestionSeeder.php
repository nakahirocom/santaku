<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    public function run()
    {
        Question::create([
            'small_label_id' => 2,
            'user_id' => 1,
            'status' => 0,
            'question' => "1+1=",
            'question_path' => null,
            'answer' => "2",
            'comment' => "イチタスイチハ",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 2,
            'user_id' => 1,
            'status' => 0,
            'question' => "2+1=",
            'question_path' => null,
            'answer' => "3",
            'comment' => "ニタスイチハ",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 3,
            'user_id' => 1,
            'status' => 0,
            'question' => "3+1=",
            'question_path' => null,
            'answer' => "4",
            'comment' => "サンタスイチハ",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 4,
            'user_id' => 1,
            'status' => 0,
            'question' => "4+1=",
            'question_path' => null,
            'answer' => "5",
            'comment' => "ヨンタスイチハ",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 4,
            'user_id' => 1,
            'status' => 0,
            'question' => "5+1=",
            'question_path' => null,
            'answer' => "6",
            'comment' => "ゴタスイチハ",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 4,
            'user_id' => 1,
            'status' => 0,
            'question' => "1-1=",
            'question_path' => null,
            'answer' => "0",
            'comment' => "イチヒクイチハ",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 4,
            'user_id' => 1,
            'status' => 0,
            'question' => "2-1=",
            'question_path' => null,
            'answer' => "1",
            'comment' => "ニヒクイチハ",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 5,
            'user_id' => 1,
            'status' => 0,
            'question' => "3-1=",
            'question_path' => null,
            'answer' => "2",
            'comment' => "サンヒクイチハ",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 5,
            'user_id' => 1,
            'status' => 0,
            'question' => "4-1=",
            'question_path' => null,
            'answer' => "3",
            'comment' => "ヨンヒクイチハ",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 5,
            'user_id' => 1,
            'status' => 0,
            'question' => "5-1=",
            'question_path' => null,
            'answer' => "4",
            'comment' => "ゴヒクイチハ",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 5,
            'user_id' => 1,
            'status' => 0,
            'question' => "明日",
            'question_path' => null,
            'answer' => "あした",
            'comment' => "次の日",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 5,
            'user_id' => 1,
            'status' => 0,
            'question' => "今日",
            'question_path' => null,
            'answer' => "きょう",
            'comment' => "当日",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 5,
            'user_id' => 1,
            'status' => 0,
            'question' => "昨日",
            'question_path' => null,
            'answer' => "きのう",
            'comment' => "前日",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 5,
            'user_id' => 1,
            'status' => 0,
            'question' => "明後日",
            'question_path' => null,
            'answer' => "あさって",
            'comment' => "2日後",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 5,
            'user_id' => 1,
            'status' => 0,
            'question' => "一昨日",
            'question_path' => null,
            'answer' => "おととい",
            'comment' => "2日前",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 5,
            'user_id' => 1,
            'status' => 0,
            'question' => "鬼の目にも〇〇",
            'question_path' => null,
            'answer' => "涙",
            'comment' => "鬼のような人でも時には同情したりする",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 5,
            'user_id' => 1,
            'status' => 0,
            'question' => "一寸先は〇〇",
            'question_path' => null,
            'answer' => "闇",
            'comment' => "将来のことはわからない",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 5,
            'user_id' => 1,
            'status' => 0,
            'question' => "〇〇も方便",
            'question_path' => null,
            'answer' => "嘘",
            'comment' => "時と場合によって嘘も必要なこと",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 5,
            'user_id' => 1,
            'status' => 0,
            'question' => "海老で〇〇を釣る",
            'question_path' => null,
            'answer' => "鯛",
            'comment' => "少しの元手で大きな利益を得ること",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 5,
            'user_id' => 1,
            'status' => 0,
            'question' => "〇〇に金棒",
            'question_path' => null,
            'answer' => "鬼",
            'comment' => "もともと強いのにさらに強力なものを得ること",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 5,
            'user_id' => 1,
            'status' => 0,
            'question' => "税引後当期純利益は別表〇〇で行う",
            'question_path' => null,
            'answer' => "四",
            'comment' => "法人税申告書",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 5,
            'user_id' => 1,
            'status' => 0,
            'question' => "欠損金の確認は別表〇〇で行う",
            'question_path' => null,
            'answer' => "七",
            'comment' => "法人税申告書",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 5,
            'user_id' => 1,
            'status' => 0,
            'question' => "法人税の計算は別表〇〇で行う",
            'question_path' => null,
            'answer' => "一",
            'comment' => "法人税申告書",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 5,
            'user_id' => 1,
            'status' => 0,
            'question' => "交際費の損金不算入は別表〇〇で行う",
            'question_path' => null,
            'answer' => "八",
            'comment' => "法人税申告書",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 5,
            'user_id' => 1,
            'status' => 0,
            'question' => "減価償却の記載は別表〇〇で行う",
            'question_path' => null,
            'answer' => "十六",
            'comment' => "法人税申告書",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 6,
            'user_id' => 1,
            'status' => 0,
            'question' => "交際費は原則、〇〇。",
            'question_path' => null,
            'answer' => "損金不算入",
            'comment' => "冗費の節約の観点から",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 6,
            'user_id' => 1,
            'status' => 0,
            'question' => "飲食1人当り5千円〇〇は交際費から除外する",
            'question_path' => null,
            'answer' => "未満",
            'comment' => "中小零細企業に配慮したもの",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 6,
            'user_id' => 1,
            'status' => 0,
            'question' => "期末資本金1億円〇〇の法人は接待交際費の50%が損金となる。",
            'question_path' => null,
            'answer' => "超",
            'comment' => "大きい規模の判定を1億円超としたもの",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 6,
            'user_id' => 1,
            'status' => 0,
            'question' => "個人事業主の交際費の上限額は〇〇",
            'question_path' => null,
            'answer' => "ない",
            'comment' => "そもそも、交際費に回る資金が少ないから",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 6,
            'user_id' => 1,
            'status' => 0,
            'question' => "期末資本金1億円以下の法人の交際費定額控除限度額は〇〇万円",
            'question_path' => null,
            'answer' => "800",
            'comment' => "交際費総額の50%と比べて多い方を選択可能",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 7,
            'user_id' => 1,
            'status' => 0,
            'question' => "不動産仲介収入の課税区分は",
            'question_path' => null,
            'answer' => "課税売上",
            'comment' => "課税区分",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 7,
            'user_id' => 1,
            'status' => 0,
            'question' => "住宅家賃収入の課税区分は",
            'question_path' => null,
            'answer' => "非課税売上",
            'comment' => "課税区分",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 7,
            'user_id' => 1,
            'status' => 0,
            'question' => "外国貨物の譲渡収入の課税区分は",
            'question_path' => null,
            'answer' => "輸出免税",
            'comment' => "課税区分",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 7,
            'user_id' => 1,
            'status' => 0,
            'question' => "配当金収入の課税区分は",
            'question_path' => null,
            'answer' => "不課税取引",
            'comment' => "課税区分",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 7,
            'user_id' => 1,
            'status' => 0,
            'question' => "新聞掲載料の課税区分は",
            'question_path' => null,
            'answer' => "課税仕入",
            'comment' => "課税区分",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 8,
            'user_id' => 1,
            'status' => 0,
            'question' => "消費税法の施行地を〇〇という",
            'question_path' => null,
            'answer' => "国内",
            'comment' => "消費税法",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 8,
            'user_id' => 1,
            'status' => 0,
            'question' => "事業を行う個人を〇〇という",
            'question_path' => null,
            'answer' => "個人事業主",
            'comment' => "消費税法",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 8,
            'user_id' => 1,
            'status' => 0,
            'question' => "個人事業者及び法人を〇〇という",
            'question_path' => null,
            'answer' => "事業者",
            'comment' => "消費税法",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 8,
            'user_id' => 1,
            'status' => 0,
            'question' => "合併により消滅した法人を〇〇という",
            'question_path' => null,
            'answer' => "被合併法人",
            'comment' => "消費税法",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 8,
            'user_id' => 1,
            'status' => 0,
            'question' => "法人でない社団又は財団で代表者又は管理人の定めのあるものを〇〇という",
            'question_path' => null,
            'answer' => "人格のない社団等",
            'comment' => "消費税法",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 9,
            'user_id' => 1,
            'status' => 0,
            'question' => "9月8日引落しに間に合う月次報酬以外の案件承認期限は〇〇まで",
            'question_path' => null,
            'answer' => "7月15日",
            'comment' => "請求ルール",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 9,
            'user_id' => 1,
            'status' => 0,
            'question' => "9月8日引落しに間に合う決算報酬の案件承認期限は〇〇まで",
            'question_path' => null,
            'answer' => "7月末",
            'comment' => "請求ルール",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 9,
            'user_id' => 1,
            'status' => 0,
            'question' => "9月8日引落しに間に合う月次報酬の案件承認期限は〇〇まで",
            'question_path' => null,
            'answer' => "8月15日",
            'comment' => "請求ルール",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 9,
            'user_id' => 1,
            'status' => 0,
            'question' => "9月1日に月次報酬の請求書を郵送するための案件承認期限は〇〇まで",
            'question_path' => null,
            'answer' => "8月15日",
            'comment' => "請求ルール",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 9,
            'user_id' => 1,
            'status' => 0,
            'question' => "8月1日に決算報酬の請求書を郵送するための案件承認期限は〇〇まで",
            'question_path' => null,
            'answer' => "7月15日",
            'comment' => "請求ルール",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 10,
            'user_id' => 1,
            'status' => 0,
            'question' => "リンクがマスターソードを抜く場所はどこですか？",
            'question_path' => null,
            'answer' => "コログの森",
            'comment' => "ゼルダの伝説ブレスオブワイルド",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 10,
            'user_id' => 1,
            'status' => 0,
            'question' => "リンクがハイラル全土を旅する際に頼りにする古代の地図を表示するアイテムは何ですか？",
            'question_path' => null,
            'answer' => "シーカーストーン",
            'comment' => "ゼルダの伝説ブレスオブワイルド",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 10,
            'user_id' => 1,
            'status' => 1,
            'question' => "ゲーム内でリンクが出会う、鳥人族のリーダーの名前は何ですか？",
            'question_path' => null,
            'answer' => "レヴァリ",
            'comment' => "ゼルダの伝説ブレスオブワイルド",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 10,
            'user_id' => 1,
            'status' => 0,
            'question' => "リンクが料理をする際に使う設備の名前は何ですか？",
            'question_path' => null,
            'answer' => "かまど",
            'comment' => "ゼルダの伝説ブレスオブワイルド",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 10,
            'user_id' => 1,
            'status' => 0,
            'question' => "ゲーム中にリンクが訪れることができる、雪が降る山の名前は何ですか？",
            'question_path' => null,
            'answer' => "ヘブラ山",
            'comment' => "ゼルダの伝説ブレスオブワイルド",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 10,
            'user_id' => 1,
            'status' => 1,
            'question' => "ブレス オブ ザ ワイルドでリンクが使用できる特別な力を与える祠の名前は何ですか？",
            'question_path' => null,
            'answer' => "チカ祠",
            'comment' => "ゼルダの伝説ブレスオブワイルド",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 10,
            'user_id' => 1,
            'question' => "ゲーム内でリンクがハイラル城で直面する最終ボスの名前は何ですか？",
            'question_path' => null,
            'answer' => "ガノン",
            'comment' => "ゼルダの伝説ブレスオブワイルド",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 10,
            'user_id' => 1,
            'status' => 0,
            'question' => "ブレス オブ ザ ワイルドでリンクが乗ることができる伝説の馬の名前は何ですか？",
            'question_path' => null,
            'answer' => "エポナ",
            'comment' => "ゼルダの伝説ブレスオブワイルド",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 10,
            'user_id' => 1,
            'status' => 1,
            'question' => "ブレス オブ ザ ワイルドに登場する青いローブを着た商人の名前は何ですか？",
            'question_path' => null,
            'answer' => "ビート",
            'comment' => "ゼルダの伝説ブレスオブワイルド",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 10,
            'user_id' => 1,
            'status' => 0,
            'question' => "ブレス オブ ザ ワイルドでリンクが集めることができる黄色い果実は何ですか？",
            'question_path' => null,
            'answer' => "コログのミ",
            'comment' => "ゼルダの伝説ブレスオブワイルド",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 10,
            'user_id' => 1,
            'status' => 0,
            'question' => "ゲーム内でリンクが空を飛ぶのに使うアイテムは何ですか？",
            'question_path' => null,
            'answer' => "パラセール",
            'comment' => "ゼルダの伝説ブレスオブワイルド",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 10,
            'user_id' => 1,
            'status' => 0,
            'question' => "リンクが最初に目覚める場所の名前は何ですか？",
            'question_path' => null,
            'answer' => "復活の祠",
            'comment' => "ゼルダの伝説ブレスオブワイルド",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 10,
            'user_id' => 1,
            'status' => 0,
            'question' => "ハイラル王国の王女の名前は何ですか？",
            'question_path' => null,
            'answer' => "ゼルダ",
            'comment' => "ゼルダの伝説ブレスオブワイルド",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 10,
            'user_id' => 1,
            'status' => 1,
            'question' => "リンクが集めるものの一つで象の形をしている神獣の名前は？",
            'question_path' => null,
            'answer' => "ヴァ・ルーダ",
            'comment' => "ゼルダの伝説ブレスオブワイルド",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 10,
            'user_id' => 1,
            'status' => 0,
            'question' => "ゲーム内で唯一の黄金のライネルが出現する場所はどこですか？",
            'question_path' => null,
            'answer' => "コログの森の北",
            'comment' => "ゼルダの伝説ブレスオブワイルド",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 10,
            'user_id' => 1,
            'status' => 0,
            'question' => "「ゲルドの町」に入るためにリンクが装着する必要がある服は何ですか？",
            'question_path' => null,
            'answer' => "ヴァイの服",
            'comment' => "ゼルダの伝説ブレスオブワイルド",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 10,
            'user_id' => 1,
            'status' => 0,
            'question' => "ゲーム内でリンクが祠を発見するのを助けるアイテムは何ですか？",
            'question_path' => null,
            'answer' => "シーカーセンサー",
            'comment' => "ゼルダの伝説ブレスオブワイルド",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 10,
            'user_id' => 1,
            'status' => 0,
            'question' => "ゲーム内でリンクが「炎のドラゴン」に会える場所はどこですか？",
            'question_path' => null,
            'answer' => "エルディン山",
            'comment' => "ゼルダの伝説ブレスオブワイルド",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 10,
            'user_id' => 1,
            'status' => 0,
            'question' => "ゲーム内で「ロード・オブ・ザ・マウンテン」として知られる神秘的な生き物はどこで見つけることができますか？",
            'question_path' => null,
            'answer' => "サトリ山",
            'comment' => "ゼルダの伝説ブレスオブワイルド",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 10,
            'user_id' => 1,
            'status' => 1,
            'question' => "リンクが「雷のガノン」に対峙するために訪れる神獣の名前は何ですか？",
            'question_path' => null,
            'answer' => "ヴァ・ナボリス",
            'comment' => "ゼルダの伝説ブレスオブワイルド",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 10,
            'user_id' => 1,
            'status' => 0,
            'question' => "リンクから常に逃げる小さな森の精霊は何ですか？",
            'question_path' => null,
            'answer' => "コログ",
            'comment' => "ゼルダの伝説ブレスオブワイルド",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 10,
            'user_id' => 1,
            'status' => 0,
            'question' => "赤い鱗を持つ火の龍で、炎を操る力を持っている三大龍は？",
            'question_path' => null,
            'answer' => "オルドラ",
            'comment' => "ゼルダの伝説ブレスオブワイルド",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 10,
            'user_id' => 1,
            'status' => 1,
            'question' => "青い鱗を持つ氷の龍で、氷を操る力を持っている三大龍は？",
            'question_path' => null,
            'answer' => "ナドラー",
            'comment' => "ゼルダの伝説ブレスオブワイルド",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 10,
            'user_id' => 1,
            'status' => 1,
            'question' => "黄金色の鱗を持つ雷の龍で、雷を操る力を持っている三題龍は？",
            'question_path' => null,
            'answer' => "ファロシュ",
            'comment' => "ゼルダの伝説ブレスオブワイルド",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 10,
            'user_id' => 1,
            'status' => 1,
            'question' => "リンクにパラグライダーを与える、謎めいた老人の正体は誰ですか？",
            'question_path' => null,
            'answer' => "キング・ロム",
            'comment' => "ゼルダの伝説ブレスオブワイルド",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 10,
            'user_id' => 1,
            'status' => 1,
            'question' => "フィローネ地方に住む、リンクに「雷のガノン」について情報を提供する鳥人族の女性の名前は何ですか？",
            'question_path' => null,
            'answer' => "レッタ",
            'comment' => "ゼルダの伝説ブレスオブワイルド",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 10,
            'user_id' => 1,
            'status' => 1,
            'question' => "ゲーム内でリンクに「水の神獣ヴァ・ルッタ」の攻略方法を教えるゾーラ族の王子の名前は何ですか？",
            'question_path' => null,
            'answer' => "シドン",
            'comment' => "ゼルダの伝説ブレスオブワイルド",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 10,
            'user_id' => 1,
            'status' => 0,
            'question' => "ハイラル王国の歴史を研究している、若返りをしたシーカー族の老婆の名前は何ですか？",
            'question_path' => null,
            'answer' => "プルア",
            'comment' => "ゼルダの伝説ブレスオブワイルド",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 10,
            'user_id' => 1,
            'status' => 0,
            'question' => "ミニチャレンジ「消えたコッコちゃん」イベントが発生する場所はどこですか？",
            'question_path' => null,
            'answer' => "カカリコ村",
            'comment' => "ゼルダの伝説ブレスオブワイルド",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 10,
            'user_id' => 1,
            'status' => 0,
            'question' => "ミニチャレンジ「雷怖い」イベントで馬宿のてっぺんから回収するものは？",
            'question_path' => null,
            'answer' => "木こりのオノ",
            'comment' => "ゼルダの伝説ブレスオブワイルド",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Question::create([
            'small_label_id' => 11,
            'user_id' => 1,
            'status' => 0,
            'question' => "単一条件でカラムと一致するデータを絞り込むメソッドは",
            'question_path' => null,
            'answer' => "where()",
            'comment' => "例)where()",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 11,
            'user_id' => 1,
            'status' => 0,
            'question' => "複数条件でカラムと一致するデータを絞り込むメソッドは",
            'question_path' => null,
            'answer' => "whereIn()",
            'comment' => "例)whereIn()",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 11,
            'user_id' => 1,
            'status' => 0,
            'question' => "複数条件の間にあるカラムのデータを取得するメソッドは",
            'question_path' => null,
            'answer' => "whereBetween()",
            'comment' => "例)whereBetween()",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 11,
            'user_id' => 1,
            'status' => 0,
            'question' => "データ中身を表示し、その場で処理を終了させる",
            'question_path' => null,
            'answer' => "dd()",
            'comment' => "例)dd()",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 11,
            'user_id' => 1,
            'status' => 0,
            'question' => "データの中身を表示しつつ、処理が終了にならない",
            'question_path' => null,
            'answer' => "dump()",
            'comment' => "例)dump()",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 12,
            'user_id' => 1,
            'status' => 0,
            'question' => "FROMの次の優先クエリは〇〇",
            'question_path' => null,
            'answer' => "ON・JOIN",
            'comment' => "Mysql",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 12,
            'user_id' => 1,
            'status' => 0,
            'question' => "ON・JOINの次の優先クエリは〇〇",
            'question_path' => null,
            'answer' => "WHERE",
            'comment' => "Mysql",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 12,
            'user_id' => 1,
            'status' => 0,
            'question' => "WHEREの次の優先クエリは〇〇",
            'question_path' => null,
            'answer' => "GROUP BY",
            'comment' => "Mysql",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 12,
            'user_id' => 1,
            'status' => 0,
            'question' => "GROUP BYの次の優先クエリは〇〇",
            'question_path' => null,
            'answer' => "COUNT・SUM・SUM・AVG・MIN",
            'comment' => "Mysql",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Question::create([
            'small_label_id' => 12,
            'user_id' => 1,
            'status' => 0,
            'question' => "HAVINGの次の優先クエリは〇〇",
            'question_path' => null,
            'answer' => "/SELECT・DISTINT",
            'comment' => "Mysql",
            'comment_path' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}

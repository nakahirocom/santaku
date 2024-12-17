<?php

namespace App\Http\Controllers\Santaku;

use App\Http\Controllers\Controller;
use App\Http\Requests\Santaku\AnswerResultRequest;
use App\Models\AnswerResults;
use App\Models\Question;
use App\Models\Mymemo;
use Carbon\Carbon;

use App\Models\User; // 必要に応じて適切な名前空間を使用してください

use Illuminate\Support\Facades\DB;

class AnswerViewModel_random
{
    private $choice; //$questionIdをAnswerViewModelの中で定義する
    private $question; //$questionをAnswerViewModelの中で定義する

    //AnswerControllerのnew AnswerViewMoelの引数は、（Questionモデルで$choiceという名前,Questionモデルで$questionという名前）とする。
    public function __construct(Question $choice, Question $question)
    {
        $this->choice = $choice; //選択肢から選んだもののコレクション情報
        $this->question = $question; //出題されたもののコレクション情報
    }

    //出題されたquestionコレクションの中から出題されたquestionを返す
    public function getQuestion(): string
    {
        return $this->question->question;
    }

    // 出題されたquestionコレクションの中からquestion_imageを返す
    // 画像のパスがnullならnullを返す
    public function getQuestion_path(): ?string
    {
        return $this->question->question_path ?? null;
    }

    //出題されたquestionコレクションの中から正しい正解のanswerを返す
    public function getAnswer(): string
    {
        return $this->question->answer;
    }

    //出題されたquestionコレクションの中から正しい正解のanswerを返す
    public function getAnswerId(): string
    {
        return $this->question->id;
    }


    //出題されたquestionコレクションの中からcommentを返す
    public function getComment(): string
    {
        return $this->question->comment;
    }

    // 出題されたquestionコレクションの中からcomment_imageを返す
    // 画像のパスがnullならnullを返す
    public function getComment_path(): ?string
    {
        return $this->question->comment_path ?? null;
    }

    // 出題されたquestionコレクションのリレーションからMymemoを返す
    // nullならnullを返す
    public function getMymemo(): ?string
    {
        return $this->question->Mymemo->mymemo ?? null;
    }

    public function getReference_url(): ?string
    {
        return $this->question->reference_url ?? null;
    }

    public function getUser_id(): ?string
    {
        return $this->question->user_id ?? null;
    }



    //選択されたchoiceコレクションの中から間違えて選択したanswerを返す
    public function getmissQuestion(): string
    {
        return $this->choice->question;
    }

    //選択されたchoiceコレクションの中から間違えて選択したanswerを返す
    public function getmissQuestion_path(): ?string
    {
        return $this->choice->question_path ?? null;
    }


    //選択されたchoiceコレクションの中から間違えて選択したanswerを返す
    public function getmissAnswer(): string
    {
        return $this->choice->answer;
    }

    //選択されたchoiceコレクションの中から間違えて選択したanswerを返す
    public function getmissComment(): string
    {
        return $this->choice->comment;
    }

    //選択されたchoiceコレクションの中から間違えて選択したanswerを返す
    public function getmissAnswerId(): string
    {
        return $this->choice->id;
    }

    //選択されたchoiceコレクションの中から間違えて選択したanswerを返す
    public function getmissComment_path(): ?string
    {
        return $this->choice->comment_path ?? null;
    }
    // 出題されたquestionコレクションのリレーションからMymemoを返す
    // nullならnullを返す
    public function getmissMymemo(): ?string
    {
        return $this->choice->Mymemo->mymemo ?? null;
    }

    public function getmissReference_url(): ?string
    {
        return $this->choice->reference_url ?? null;
    }
    public function getmissUser_id(): ?string
    {
        return $this->choice->user_id ?? null;
    }


    //選択されたchoiceコレクションの中のidと出題されたquestionコレクションの中のidが一致しているか判定し、一致ならtrueを返す
    public function isCorrect(): bool
    {
        return $this->choice->id === $this->question->id;
    }
}

class AnswerRandomController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(AnswerResultRequest $request)
    {
        $maxQuestions = $request->input('maxQuestions');

        // 解き始めの日時をブラウザから取得する;
        $solving = $request->input('start_solving_time');
        // 形式をtimeに合わせる
        $startSolvingTime = Carbon::parse($solving)->format('Y-m-d H:i:s.u');

        $uid = $request->userId();
        $user = User::find($uid); // ユーザーを取得

        // timeoutがtrueならば、連続正解数をリセットする
        $timeout = $request->input('timeout');
        if ($timeout) {
            $user->continuous_correct_answers = 0;
            $user->base_continuous_correct_answers = 0;
            $user->save(); // ユーザー情報を更新
        }

        $timeoutuser = User::find($uid); // ユーザーを取得

        $viewModels = [];
        $missedQuestionIds = []; // 不正解だった問題のIDを格納する配列
        $allkaitousuuModels = [];
        $allseikairituModels = [];
        $uidkaitousuuModels = [];
        $uidseikairituModels = [];

        for ($i = 1; $i <= $maxQuestions; $i++) {
            $questionId = $request->input("question{$i}_Id");
            $choiceId = $request->input("choice{$i}_Id");

            $answer_results = new AnswerResults;
            $answer_results->user_id = $uid;
            $answer_results->question_id = $questionId;
            $answer_results->answered_question_id = $choiceId;
            $answer_results->start_solving_time = $startSolvingTime;
            $answer_results->save();

            // 不正解の場合、IDを配列に追加
            if ($questionId != $choiceId) {
                $missedQuestionIds[] = $questionId;
            }

            $allkaitousuu = AnswerResults::where('question_id', $questionId)->count();
            $allseikaisuu = AnswerResults::where('question_id', $questionId)
                ->whereColumn('question_id', 'answered_question_id')
                ->count();
            $seikairitu = $allkaitousuu == 0 ? 0 : round($allseikaisuu / $allkaitousuu, 2) * 100;

            $allkaitousuuModels[] = $allkaitousuu;
            $allseikairituModels[] = $seikairitu;

            $uidkaitousuu = DB::table('answer_results')
                ->where('question_id', $questionId)
                ->where('user_id', $uid)
                ->count();
            $uidseikaisuu = DB::table('answer_results')
                ->where('question_id', $questionId)
                ->where('user_id', $uid)
                ->whereColumn('question_id', 'answered_question_id')
                ->count();
            $uidseikairitu = $uidkaitousuu == 0 ? 0 : round($uidseikaisuu / $uidkaitousuu, 2) * 100;

            $uidkaitousuuModels[] = $uidkaitousuu;
            $uidseikairituModels[] = $uidseikairitu;

            $ques = Question::where('id', $questionId)
                ->with(['Mymemo' => function ($query) use ($uid, $questionId) {
                    $query->where('user_id', $uid)
                        ->where('question_id', $questionId);
                }])
                ->firstOrFail();
            $cho = Question::where('id', $choiceId)
                ->with(['Mymemo' => function ($query) use ($uid, $choiceId) {
                    $query->where('user_id', $uid)
                        ->where('question_id', $choiceId);
                }])
                ->firstOrFail();
            //dd($cho);
            $viewModel = new AnswerViewModel($cho, $ques);
            $viewModels[] = $viewModel;

            // 正解判定と連続正解数、最高記録の更新
            if ($questionId == $choiceId) {
                $user->continuous_correct_answers++;
                $user->base_continuous_correct_answers++;
                if ($user->continuous_correct_answers > $user->best_record) {
                    $user->best_record = $user->continuous_correct_answers;
                    $user->best_record_at = now();
                    $isBestRecordUpdated = true;
                }
            } else {
                $user->continuous_correct_answers = 0;
                $user->base_continuous_correct_answers = 0;
            }
        }

        // basic_countがbase_continuous_correct_answers以下になった時、user_modeが0なら1に変更しメッセージ「通常モードが開放されました」を通知
        if ($user->basic_count <= $user->base_continuous_correct_answers && $user->user_mode == 0) {
            // user_modeを1に変更
            $user->user_mode = 1;

            // 通常モード開放メッセージを通知
            session()->flash('message', '基礎モード開放条件クリアにつき「0.出題ジャンル選択」ボタンが開放されました。好きなジャンルを選ぶことが出来ます。ホーム画面に移動します');

            // ユーザー情報を保存
            $user->save();
        }

        $user->save(); // ユーザー情報を更新
        //dd($viewModels);
        return view('santaku.answerrandom')
            ->with('viewModels', $viewModels)
            ->with('missedQuestionIds', $missedQuestionIds)
            ->with('allkaitousuuModels', $allkaitousuuModels)
            ->with('uidkaitousuuModels', $uidkaitousuuModels)
            ->with('allseikairituModels', $allseikairituModels)
            ->with('uidseikairituModels', $uidseikairituModels)
            ->with('isBestRecordUpdated', $isBestRecordUpdated ?? false)
            ->with('timeoutuser', $timeoutuser);
    }
}

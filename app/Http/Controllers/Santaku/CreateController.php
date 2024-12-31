<?php

namespace App\Http\Controllers\Santaku;

use App\Http\Controllers\Controller;
use App\Http\Requests\Santaku\CreateRequest;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CreateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(CreateRequest $request)
    {
        // ディレクトリ名
        $dir = 'images';

        // データベースへの保存
        $question = new Question;
        $question->user_id = $request->userId();
        $question->status = $request->input('status'); // statusの値を取得して設定
        $question->small_label_id = $request->small_label_id;
        $question->question = $request->question();
        $question->question_path = $request->question_path();
        $question->answer = $request->answer();
        $question->comment = $request->comment();
        $question->comment_path = $request->comment_path();
        $question->reference_url = $request->reference_url();

        // 質問画像がある場合、S3に保存。そうでない場合、デフォルト値を設定。
        if ($request->hasFile('question_image')) {
            $file = $request->file('question_image');
            
            try {
                // ファイルが有効かチェック
                if (!$file->isValid()) {
                    throw new \Exception('アップロードされたファイルが無効です');
                }

                // ファイル名の生成
                $originalName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $fileName = time() . '_' . md5(uniqid()) . '.' . $extension;
                
                // ファイル情報をログ出力
                \Log::info('アップロードファイル情報:', [
                    'original_name' => $originalName,
                    'new_name' => $fileName,
                    'mime_type' => $file->getMimeType(),
                    'size' => $file->getSize(),
                    'error' => $file->getError(),
                    'real_path' => $file->getRealPath()
                ]);

                $filePath = 'images/' . $fileName;
                
                // ACLを使用せずにアップロード
                $result = Storage::disk('s3')->put(
                    $filePath,
                    file_get_contents($file->getRealPath()),
                    [
                        'ContentType' => $file->getMimeType()
                    ]
                );

                if (!$result) {
                    throw new \Exception('ファイルのアップロードに失敗しました');
                }

                $fullPath = Storage::disk('s3')->url($filePath);
                $question->question_path = $fullPath;

                \Log::info('ファイルアップロード成功:', [
                    'path' => $filePath,
                    'url' => $fullPath
                ]);

            } catch (\Exception $e) {
                \Log::error('S3アップロードエラー詳細:', [
                    'error' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'trace' => $e->getTraceAsString()
                ]);
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'ファイルのアップロードに失敗しました: ' . $e->getMessage());
            }
        } else {
            $question->question_path = null;
        }

        // コメント画像がある場合、S3に保存。そうでない場合、デフォルト値を設定。
        if ($request->hasFile('comment_image')) {
            $file = $request->file('comment_image');
            
            try {
                // ファイルが有効かチェック
                if (!$file->isValid()) {
                    throw new \Exception('アップロードされたファイルが無効です');
                }

                // ファイル名の生成
                $originalName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $fileName = time() . '_' . md5(uniqid()) . '.' . $extension;
                
                // ファイル情報をログ出力
                \Log::info('コメント画像アップロード情報:', [
                    'original_name' => $originalName,
                    'new_name' => $fileName,
                    'mime_type' => $file->getMimeType(),
                    'size' => $file->getSize(),
                    'error' => $file->getError(),
                    'real_path' => $file->getRealPath()
                ]);

                $filePath = 'images/' . $fileName;
                
                // ACLを使用せずにアップロード
                $result = Storage::disk('s3')->put(
                    $filePath,
                    file_get_contents($file->getRealPath()),
                    [
                        'ContentType' => $file->getMimeType()
                    ]
                );

                if (!$result) {
                    throw new \Exception('ファイルのアップロードに失敗しました');
                }

                $fullPath = Storage::disk('s3')->url($filePath);
                $question->comment_path = $fullPath;

                \Log::info('コメント画像アップロード成功:', [
                    'path' => $filePath,
                    'url' => $fullPath
                ]);

            } catch (\Exception $e) {
                \Log::error('S3コメント画像アップロードエラー詳細:', [
                    'error' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'trace' => $e->getTraceAsString()
                ]);
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'コメント画像のアップロードに失敗しました: ' . $e->getMessage());
            }
        } else {
            $question->comment_path = null;
        }

        $question->save();

        // 登録したばかりのQuestionのIDを取得
        $questionId = $question->id;

        return redirect()
            ->route('edit', ['questionId' => $questionId])
            ->with('feedback.success', '新規登録が完了しました');
    }
}
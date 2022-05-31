<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function __construct()
    {
        // ログイン状態の時はlogoutにしかアクセスさせない
        $this->middleware('guest')->except('logout');
    }

    /**
     * 認証ページへユーザをリダイレクト
     */
    public function redirectToProvider()
    {
        return Socialite::driver('twitter')->redirect();
    }

    public function handleProviderCallback()
    {
        try {
            $twitterUser = Socialite::driver('twitter')->user();
            // アクセストークン取得
            $token = $twitterUser->token;
            $tokenSecret = $twitterUser->tokenSecret;

            if ($twitterUser) {
                // ユーザの取得または生成
                $user = User::firstOrCreate([
                    'unique_id' => $twitterUser->id
                ],[
                    'unique_id' => $twitterUser->id,
                    'avatar' => $twitterUser->avatar,
                    'bio' =>$twitterUser->user['description'],
                    'name' => $twitterUser->name,
                    'twitter_oauth_token' => $token,
                    'twitter_oauth_token_secret' => $tokenSecret
                ]);

                // ユーザが変更できるTwitterの情報はすべてログイン時に保存し直すべき
                $user->update(
                    [
                        'name' => $twitterUser->name,
                        // 'twitter_nickname' => $twitter_user->twitter_nickname,
                        'twitter_oauth_token' => $token,
                        'twitter_oauth_token_secret' => $tokenSecret
                    ]
                );

                Auth::login($user, true);
                return redirect('/');

            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
            return 'ログインエラーが発生しました';
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}

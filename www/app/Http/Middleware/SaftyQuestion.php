<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;
class SaftyQuestion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user =Auth::guard('api')->user();
        
        if(count($user->SaftyQuestion)>0)
        {
            return $next($request);
        }
        else
        {
            $Questions=[
                "ما هو رقم المنزل واسم الشارع الذي تعيش فيه؟",
                "ما هي الأرقام الأربعة الأخيرة من رقم هاتفك؟",
                "ما المدرسة الابتدائية التي التحقت بها؟",
                "في أي  مدينة كانت أول وظيفة لك؟",
                "في أي مدينة تسكن حاليا؟",
                "ما هو اسم أكبر اطفالك؟",
                "ما هي آخر خمسة أرقام من رقم رخصة القيادة/ البطاقة الخاصة بك؟",
                "ما هو اسم جدتك (على جانب والدتك)؟",
                "في أي مدينة يعيش اقرب اصدقائك؟",
                "في أي يوم من السنه ولدت؟",
                "في يوم من السنه ولد طفلك؟"
            ];
            // get random index from array $Questions
            $key = array_rand($Questions);

            return response([
                'type'=>'Warning',
                'message' => 'Your Have to Asnswer Safty Question',
                'key'=>$key,
                'question'=>$Questions[$key]
            ],200);
        }
    }
}

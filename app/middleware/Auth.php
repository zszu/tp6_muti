<?php
declare (strict_types = 1);

namespace app\middleware;

class Auth
{
    /**
     * 处理请求
     *
     * @param \think\Request $request
     * @param \Closure       $next
     * @return Response
     */
    public function handle($request, \Closure $next)
    {
        //得到用户信息
        //获取用户角色
        //获取用户权限组
        // 比较当前 路由 是否在 权限组中

        //得到当前的uri
        $uri = $request->controller().'/'.$request->action();
        return $next($request);
    }
}

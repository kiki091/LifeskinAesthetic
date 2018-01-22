<?php 

namespace Modules\Core\Http\Middleware;

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Session\Store;
use Modules\Core\Contracts\Authentication;

class AdminMiddleware
{
    /**
     * @var Authentication
     */
    private $auth;
    /**
     * @var SessionManager
     */
    private $session;
    /**
     * @var Request
     */
    private $request;
    /**
     * @var Redirector
     */
    private $redirect;
    /**
     * @var Application
     */
    private $application;

    public function __construct(Authentication $auth, Store $session, Request $request, Redirector $redirect, Application $application)
    {
        $this->auth = $auth;
        $this->session = $session;
        $this->request = $request;
        $this->redirect = $redirect;
        $this->application = $application;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        // Check if the user is logged in
        if (!$this->auth->check()) {
            $this->session->put('url.intended', $this->request->url());
            return $this->redirect->route('login');
        }

        // Check if the user has access to the dashboard page
        if (! $this->auth->hasAccess('dashboard.index')) {
            return $this->application->abort(403);
        }

        return $next($request);
    }
}

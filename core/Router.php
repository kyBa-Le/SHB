<?php
namespace app\core;
class Router
{
    public $routes = [];
    public Request $request;
    public Response $response;
    public function __construct(Request $request, Response $response) {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path, $callback): void
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback): void
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false) {
            $this->response->setStatusCode(404);
            Application::$app->controller->layout = 'noLayout';
            return $this->renderView('notFound');
        }
        if (is_string($callback)) {
            return $this->renderView($callback);
        }
        if (is_array($callback)) {
            Application::$app->controller = $callback[0];
        }
        return call_user_func($callback, $this->request);
    }

    public function renderView($view, $params = []) {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view, $params);
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    public function renderContent($viewContent) {
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    protected function layoutContent()
    {
        $authentication = MiddleWare::getInstance()->isLoggedIn();
        $layout = Application::$app->controller->layout;
        ob_start();
        include_once "views/layouts/$layout.php";
        return ob_get_clean();
    }

    protected function renderOnlyView($view, $params) {
        $params['authentication'] = MiddleWare::getInstance()->isLoggedIn();
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once "views/$view.php";
        return ob_get_clean();
    }
}
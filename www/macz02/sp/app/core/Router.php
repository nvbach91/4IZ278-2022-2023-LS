<?php

class Router {
    private $routes = [];

    public function add($route, $callback) {
        $this->routes[$route] = $callback;
    }

    public function run() {
        $url = $_SERVER['REQUEST_URI'];
        $basePath = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);

        // Odstranění základní cesty z URL
        if (substr($url, 0, strlen($basePath)) === $basePath) {
            $url = substr($url, strlen($basePath));
        }

        // Odstranění počátečního a koncového lomítka
        $url = trim($url, '/');

        // Najít odpovídající cestu
        foreach ($this->routes as $route => $callback) {
            if ($route === $url) {
                call_user_func($callback);
                return;
            }
        }

        // Pokud nebyla nalezena žádná odpovídající cesta, zobrazit chybovou stránku
        http_response_code(404);
        echo '404 Not Found';
    }
}

?>

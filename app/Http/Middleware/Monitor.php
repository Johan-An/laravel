<?php

namespace App\Http\Middleware;

use Error;
use Closure;
use Exception;
use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;
use Illuminate\Http\Request;
use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Debug\ExceptionHandler;
use MobileNowGroup\LaravelErrorDingDingNotice\SendDingDingService;
use Psy\Exception\ErrorException;
use Psy\Exception\FatalErrorException;

class Monitor extends Middleware
{
    /**
     * The App container
     *
     * @var Container
     */
    protected $container;

    /**
     * The Monitor Client
     *
     * @var
     */
    protected $monitor;

    protected $sendDingDingService;

    /**
     * Create a new middleware instance.
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->sendDingDingService = new SendDingDingService();
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $enabled = config('dingding.enabled');
        try {
            $response = $next($request);
        } catch (Exception $e) {
            $response = $this->handleException($request, $e);
            $enabled && $this->sendDingDingService->sendText(sprintf("文件：%s (%s 行) 内容：%s", $e->getFile(), $e->getLine(), $e->getMessage()), 'key_word_ERROR');

        } catch (Error $error) {
            $e = new FatalErrorException($error);
            $response = $this->handleException($request, $e);
            $enabled && $this->sendDingDingService->sendText(sprintf("文件：%s (%s 行) 内容：%s", $e->getFile(), $e->getLine(), $e->getMessage()), 'key_word_ERROR');
        } catch (ErrorException $error) {
            $e = new FatalErrorException($error);
            $response = $this->handleException($request, $e);
            $enabled && $this->sendDingDingService->sendText(sprintf("文件：%s (%s 行) 内容：%s", $e->getFile(), $e->getLine(), $e->getMessage()), 'key_word_ERROR');
        } finally {
            if ($response->getStatusCode() == '500' && (isset($response->exception) && $response->exception && $response->exception !== null)) {
                $this->sendDingDingService->sendText(substr($response->exception, 0,
                        500) . '，请求数据：' . json_encode($request->input()), 'key_word_ERROR');
            }
        }
        return $response;
    }

    /**
     * Handle the given exception.
     *
     * (Copy from Illuminate\Routing\Pipeline by Taylor Otwell)
     *
     * @param $passable
     * @param Exception $e
     * @return mixed
     * @throws Exception
     */
    protected function handleException($passable, Exception $e)
    {
        if (!$this->container->bound(ExceptionHandler::class) || !$passable instanceof Request) {
            throw $e;
        }

        $handler = $this->container->make(ExceptionHandler::class);

        $handler->report($e);

        return $handler->render($passable, $e);
    }
}
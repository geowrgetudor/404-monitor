<?php

namespace Geow\NotFoundMonitor\Recorders;

use Illuminate\Config\Repository;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Laravel\Pulse\Events\SharedBeat;
use Laravel\Pulse\Pulse;
use Laravel\Pulse\Concerns\ConfiguresAfterResolving;
use Laravel\Pulse\Recorders\Concerns;
use Symfony\Component\HttpFoundation\Response;

class NotFoundRecorder
{
    use Concerns\Ignores;
    use Concerns\LivewireRoutes;
    use Concerns\Sampling;
    use Concerns\Thresholds;
    use ConfiguresAfterResolving;

    public function __construct(
        protected Pulse $pulse,
        protected Repository $config
    ) {
    }

    public function register(callable $record, Application $app): void
    {
        $this->afterResolving(
            $app,
            Kernel::class,
            fn (Kernel $kernel) => $kernel->whenRequestLifecycleIsLongerThan(-1, $record) // @phpstan-ignore method.notFound
        );
    }

    public function record(Carbon $startedAt, Request $request, Response $response): void
    {
        if ($response->getStatusCode() !== 404) {
            return;
        }

        $this->pulse->record(
            type: 'page_not_found',
            key: json_encode([$request->method(), $request->getUri()], flags: JSON_THROW_ON_ERROR),
            timestamp: $startedAt,
        )->count();
    }
}
